<?php

declare(strict_types=1);

namespace Kuvardin\TelegramBotsApi\Types\PassportElementError;

use Kuvardin\TelegramBotsApi\Types\PassportElementError;
use RuntimeException;

/**
 * Represents an issue in one of the data fields that was provided by the user. The error is considered resolved when
 * the field's value changes.
 *
 * @package Kuvardin\TelegramBotsApi
 * @author Maxim Kuvardin <maxim@kuvard.in>
 */
class DataField extends PassportElementError
{
    /**
     * @param string $type The section of the user's Telegram Passport which has the error, one of “personal_details”,
     *     “passport”, “driver_license”, “identity_card”, “internal_passport”, “address”
     * @param string $field_name Name of the data field which has the error
     * @param string $data_hash Base64-encoded data hash
     * @param string $message Error message
     */
    public function __construct(
        public string $type,
        public string $field_name,
        public string $data_hash,
        public string $message,
    )
    {

    }

    public static function getSource(): string
    {
        return 'data';
    }

    public static function makeByArray(array $data): static
    {
        if ($data['source'] !== self::getSource()) {
            throw new RuntimeException("Wrong passport element error source: {$data['source']}");
        }

        return new self(
            type: $data['type'],
            field_name: $data['field_name'],
            data_hash: $data['data_hash'],
            message: $data['message'],
        );
    }

    public function getRequestData(): array
    {
        return [
            'source' => self::getSource(),
            'type' => $this->type,
            'field_name' => $this->field_name,
            'data_hash' => $this->data_hash,
            'message' => $this->message,
        ];
    }
}
