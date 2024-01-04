<?php

declare(strict_types=1);

namespace Kuvardin\TelegramBotsApi\Types\ReactionType;

use Kuvardin\TelegramBotsApi\Types\ReactionType;
use RuntimeException;

/**
 * The reaction is based on a custom emoji.
 *
 * @package Kuvardin\TelegramBotsApi
 * @author Maxim Kuvardin <maxim@kuvard.in>
 */
class CustomEmoji extends ReactionType
{
    /**
     * @param string $custom_emoji_id Custom emoji identifier
     */
    public function __construct(
        public string $custom_emoji_id,
    )
    {

    }

    public static function getType(): string
    {
        return 'custom_emoji';
    }

    public static function makeByArray(array $data): static
    {
        if ($data['type'] !== self::getType()) {
            throw new RuntimeException("Wrong reaction type: {$data['type']}");
        }

        return new self(
            custom_emoji_id: $data['custom_emoji_id'],
        );
    }

    public function getRequestData(): array
    {
        return [
            'type' => self::getType(),
            'custom_emoji_id' => $this->custom_emoji_id,
        ];
    }
}