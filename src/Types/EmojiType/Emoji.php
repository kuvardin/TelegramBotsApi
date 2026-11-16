<?php

declare(strict_types=1);

namespace Kuvardin\TelegramBotsApi\Types\EmojiType;

use Kuvardin\TelegramBotsApi\Types\EmojiType;
use RuntimeException;

/**
 * A regular emoji.
 *
 * @package Kuvardin\TelegramBotsApi
 * @author Maxim Kuvardin <maxim@kuvard.in>
 */
class Emoji extends EmojiType
{
    /**
     * @param string $emoji The emoji
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
            throw new RuntimeException("Wrong emoji type: {$data['type']}");
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
