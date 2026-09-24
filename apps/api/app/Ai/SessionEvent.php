<?php

namespace App\Ai;

/**
 * One session event, flattened. The advancer reads only these fields, so the
 * raw platform shape is confined to fromArray() and the fake can hand back the
 * same DTOs the real gateway builds.
 */
final readonly class SessionEvent
{
    public function __construct(
        public string $id,
        public string $type,
        public ?string $text = null,
        public ?string $toolName = null,
        public ?array $toolInput = null,
        public ?string $stopReasonType = null,
        public ?string $errorMessage = null,
    ) {}

    public static function fromArray(array $raw): self
    {
        $type = (string) ($raw['type'] ?? '');

        return new self(
            // An interrupt echo carries no id; '' is the marker-unsafe value the
            // advancer (plan 3) refuses to store as last_event_id.
            id: (string) ($raw['id'] ?? ''),
            type: $type,
            text: $type === 'agent.message' ? self::text($raw) : null,
            toolName: $type === 'agent.custom_tool_use' ? (string) ($raw['name'] ?? '') : null,
            toolInput: $type === 'agent.custom_tool_use' ? (array) ($raw['input'] ?? []) : null,
            stopReasonType: $type === 'session.status_idle' ? (string) ($raw['stop_reason']['type'] ?? '') : null,
            errorMessage: $type === 'session.error'
                ? (string) ($raw['error']['message'] ?? $raw['message'] ?? 'Unknown error')
                : null,
        );
    }

    private static function text(array $raw): string
    {
        $blocks = array_filter(
            (array) ($raw['content'] ?? []),
            fn ($block) => is_array($block) && ($block['type'] ?? null) === 'text',
        );

        return implode('', array_map(fn (array $block) => (string) ($block['text'] ?? ''), $blocks));
    }
}
