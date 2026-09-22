<?php

namespace App\Models;

use Illuminate\Contracts\Encryption\DecryptException;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Facades\Log;

class Integration extends Model
{
    /** @use HasFactory<\Database\Factories\IntegrationFactory> */
    use HasFactory;

    protected $fillable = [
        'user_id', 'anthropic_api_key', 'anthropic_key_hint', 'anthropic_key_verified_at',
        'anthropic_environment_id', 'anthropic_agent_id', 'anthropic_agent_version',
        'anthropic_config_hash',
    ];

    /** The key is never serialised, on any surface. */
    protected $hidden = ['anthropic_api_key'];

    protected function casts(): array
    {
        return [
            'anthropic_api_key' => 'encrypted',
            'anthropic_key_verified_at' => 'datetime',
            'anthropic_agent_version' => 'integer',
        ];
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * The ONLY read of the key. An APP_KEY rotation makes the stored
     * ciphertext undecryptable, and the `encrypted` cast throws for it: that
     * must read as "no key configured", not as a 500 on every page. The dead
     * ciphertext is discarded so the teacher is asked for a new key once.
     */
    public function apiKey(): ?string
    {
        try {
            return $this->anthropic_api_key;
        } catch (DecryptException) {
            Log::warning('Discarded an Anthropic API key that no longer decrypts', [
                'integration_id' => $this->id,
                'user_id' => $this->user_id,
            ]);

            $this->forceFill([
                'anthropic_api_key' => null,
                'anthropic_key_hint' => null,
                'anthropic_key_verified_at' => null,
            ])->save();

            return null;
        }
    }

    public function hasKey(): bool
    {
        return $this->apiKey() !== null;
    }

    public function clearProvisioning(): void
    {
        $this->forceFill([
            'anthropic_environment_id' => null,
            'anthropic_agent_id' => null,
            'anthropic_agent_version' => null,
            'anthropic_config_hash' => null,
        ])->save();
    }

    /**
     * createOrFirst(): the create-then-rescue-the-unique-violation helper (the
     * C2 ruling), so two concurrent first-time writes end up on one row
     * instead of one of them 500ing.
     */
    public static function forUser(User $user): self
    {
        return self::createOrFirst(['user_id' => $user->id]);
    }
}
