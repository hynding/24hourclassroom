<?php

namespace App\Models;

use App\Enums\ConnectionStatus;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Connection extends Model
{
    protected $fillable = ['requester_id', 'addressee_id', 'status', 'pair_key'];

    protected function casts(): array
    {
        return ['status' => ConnectionStatus::class];
    }

    public static function pairKey(int $a, int $b): string
    {
        return min($a, $b).'-'.max($a, $b);
    }

    /** One accepted row exists for the pair, in either direction. */
    public static function acceptedBetween(User $a, User $b): bool
    {
        return static::where('pair_key', static::pairKey($a->id, $b->id))
            ->where('status', ConnectionStatus::Accepted)
            ->exists();
    }

    /**
     * Every user `$user` currently has an ACCEPTED connection with, in either
     * direction. Resolved in one query and folded in PHP because `pair_key`
     * cannot be expressed as a subquery on the counterpart's id.
     *
     * @return list<int>
     */
    public static function acceptedCounterpartIds(User $user): array
    {
        return static::where('status', ConnectionStatus::Accepted)
            ->where(fn ($q) => $q->where('requester_id', $user->id)->orWhere('addressee_id', $user->id))
            ->get()
            ->map(fn (Connection $c) => $c->requester_id === $user->id ? $c->addressee_id : $c->requester_id)
            ->all();
    }

    public function requester(): BelongsTo
    {
        return $this->belongsTo(User::class, 'requester_id');
    }

    public function addressee(): BelongsTo
    {
        return $this->belongsTo(User::class, 'addressee_id');
    }

    /** The other party, from `$user`'s point of view. */
    public function counterpart(User $user): User
    {
        return $this->requester_id === $user->id ? $this->addressee : $this->requester;
    }

    public function involves(User $user): bool
    {
        return $this->requester_id === $user->id || $this->addressee_id === $user->id;
    }
}
