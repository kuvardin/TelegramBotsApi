<?php

declare(strict_types=1);

namespace Kuvardin\TelegramBotsApi\Types\StoryAreaType;

use Kuvardin\TelegramBotsApi\Types\ReactionType;
use Kuvardin\TelegramBotsApi\Types\StoryAreaType;
use RuntimeException;

/**
 * Describes a story area pointing to a suggested reaction. Currently, a story can have up to 5 suggested reaction areas
 *
 * @package Kuvardin\TelegramBotsApi
 * @author Maxim Kuvardin <maxim@kuvard.in>
 */
class SuggestedReaction extends StoryAreaType
{
    /**
     * @param ReactionType $reaction_type Type of the reaction
     * @param bool|null $is_dark Pass True if the reaction area has a dark background
     * @param bool|null $is_flipped Pass True if reaction area corner is flipped
     */
    public function __construct(
        public ReactionType $reaction_type,
        public ?bool $is_dark = null,
        public ?bool $is_flipped = null,
    )
    {

    }

    public static function getType(): string
    {
        return 'suggested_reaction';
    }

    public static function makeByArray(array $data): static
    {
        if ($data['type'] !== self::getType()) {
            throw new RuntimeException("Wrong story area types type: {$data['type']}");
        }

        return new self(
            reaction_type: ReactionType::makeByArray($data['reaction_type']),
            is_dark: $data['is_dark'] ?? null,
            is_flipped: $data['is_flipped'] ?? null,
        );
    }

    public function getRequestData(): array
    {
        return [
            'type' => self::getType(),
            'reaction_type' => $this->reaction_type,
            'is_dark' => $this->is_dark,
            'is_flipped' => $this->is_flipped,
        ];
    }
}
