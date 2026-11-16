<?php

declare(strict_types=1);

namespace Kuvardin\TelegramBotsApi\Types\RichTextModel;

use Kuvardin\TelegramBotsApi\Types\RichTextModel;
use Kuvardin\TelegramBotsApi\Types\User;
use RuntimeException;
use Kuvardin\TelegramBotsApi\Types\RichText;

/**
 * A mention of a Telegram user by their identifier.
 *
 * @package Kuvardin\TelegramBotsApi
 * @author Maxim Kuvardin <maxim@kuvard.in>
 */
class TextMention extends RichTextModel
{
    /**
     * @param RichText $text The text
     * @param User $user The mentioned user
     */
    public function __construct(
        public RichText $text,
        public User $user,
    )
    {

    }

    public static function getType(): string
    {
        return 'text_mention';
    }

    public static function makeByArray(array $data): static
    {
        if ($data['type'] !== self::getType()) {
            throw new RuntimeException("Wrong rich text type: {$data['type']}");
        }

        return new self(
            text: RichText::makeByInput($data['text']),
            user: User::makeByArray($data['user']),
        );
    }

    public function getRequestData(): array
    {
        return [
            'type' => self::getType(),
            'text' => $this->text,
            'user' => $this->user,
        ];
    }
}

