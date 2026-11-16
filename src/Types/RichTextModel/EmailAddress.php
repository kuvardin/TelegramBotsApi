<?php

declare(strict_types=1);

namespace Kuvardin\TelegramBotsApi\Types\RichTextModel;

use Kuvardin\TelegramBotsApi\Types\RichTextModel;
use RuntimeException;
use Kuvardin\TelegramBotsApi\Types\RichText;

/**
 * A text with an email address.
 *
 * @package Kuvardin\TelegramBotsApi
 * @author Maxim Kuvardin <maxim@kuvard.in>
 */
class EmailAddress extends RichTextModel
{
    /**
     * @param RichText $text The text
     * @param string $email_address The email address
     */
    public function __construct(
        public RichText $text,
        public string $email_address,
    )
    {

    }

    public static function getType(): string
    {
        return 'email_address';
    }

    public static function makeByArray(array $data): static
    {
        if ($data['type'] !== self::getType()) {
            throw new RuntimeException("Wrong rich text type: {$data['type']}");
        }

        return new self(
            text: RichText::makeByInput($data['text']),
            email_address: $data['email_address'],
        );
    }

    public function getRequestData(): array
    {
        return [
            'type' => self::getType(),
            'text' => $this->text,
            'email_address' => $this->email_address,
        ];
    }
}

