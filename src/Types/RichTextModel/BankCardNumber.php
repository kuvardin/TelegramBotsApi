<?php

declare(strict_types=1);

namespace Kuvardin\TelegramBotsApi\Types\RichTextModel;

use Kuvardin\TelegramBotsApi\Types\RichTextModel;
use RuntimeException;
use Kuvardin\TelegramBotsApi\Types\RichText;

/**
 * A text with a bank card number.
 *
 * @package Kuvardin\TelegramBotsApi
 * @author Maxim Kuvardin <maxim@kuvard.in>
 */
class BankCardNumber extends RichTextModel
{
    /**
     * @param RichText $text The text
     * @param string $bank_card_number The bank card number
     */
    public function __construct(
        public RichText $text,
        public string $bank_card_number,
    )
    {

    }

    public static function getType(): string
    {
        return 'bank_card_number';
    }

    public static function makeByArray(array $data): static
    {
        if ($data['type'] !== self::getType()) {
            throw new RuntimeException("Wrong rich text type: {$data['type']}");
        }

        return new self(
            text: RichText::makeByInput($data['text']),
            bank_card_number: $data['bank_card_number'],
        );
    }

    public function getRequestData(): array
    {
        return [
            'type' => self::getType(),
            'text' => $this->text,
            'bank_card_number' => $this->bank_card_number,
        ];
    }
}





