<?php

declare(strict_types=1);

namespace Kuvardin\TelegramBotsApi\Types\PassportElementError;

use Kuvardin\TelegramBotsApi\Types\PassportElementError;
use RuntimeException;

/**
 * Represents an issue in one of the data fields that was provided by the user. The error is considered resolved when
 * the field&#39;s value changes.
 *
 * @package Kuvardin\TelegramBotsApi
 * @author Maxim Kuvardin <maxim@kuvard.in>
 */
class DataField extends PassportElementError
{
    /**
     * @var string $type The section of the user's Telegram Passport which has the error, one of “personal_details”,
     *     “passport”, “driver_license”, “identity_card”, “internal_passport”, “address”
     */
    public string $type;

    /**
     * @var string $field_name Name of the data field which has the error
     */
    public string $field_name;

    /**
     * @var string $data_hash Base64-encoded data hash
     */
    public string $data_hash;

    /**
     * @var string $message Error message
     */
    public string $message;

    public static function getSource(): string
    {
        return 'data';
    }

    public static function makeByArray(array $data): static
    {
        $result = new self;

        if ($data['source'] !== self::getSource()) {
            throw new RuntimeException("Wrong passport element error source: {$data['source']}");
        }

        $result->type = $data['type'];
        $result->field_name = $data['field_name'];
        $result->data_hash = $data['data_hash'];
        $result->message = $data['message'];
        return $result;
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
