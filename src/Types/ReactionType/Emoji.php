<?php

declare(strict_types=1);

namespace Kuvardin\TelegramBotsApi\Types\ReactionType;

use Kuvardin\TelegramBotsApi\Types\ReactionType;
use RuntimeException;

/**
 * The reaction is based on an emoji.
 *
 * @package Kuvardin\TelegramBotsApi
 * @author Maxim Kuvardin <maxim@kuvard.in>
 */
class Emoji extends ReactionType
{
    /**
     * @param string $emoji Reaction emoji. Currently, it can be one
     *     of <a href="https://core.telegram.org/bots/api#reactiontypeemoji">available emojis</a>
     */
    public function __construct(
        public string $emoji,
    )
    {

    }

    public static function getType(): string
    {
        return 'emoji';
    }


    public static function makeByArray(array $data): static
    {
        if ($data['type'] !== self::getType()) {
            throw new RuntimeException("Wrong reaction type: {$data['type']}");
        }

        return new self(
            emoji: $data['emoji'],
        );
    }

    public function getRequestData(): array
    {
        return [
            'type' => self::getType(),
            'emoji' => $this->emoji,
        ];
    }
}