<?php

declare(strict_types=1);

namespace Kuvardin\TelegramBotsApi\Types\PassportElementError;

use Kuvardin\TelegramBotsApi\Types\PassportElementError;
use RuntimeException;

/**
 * Represents an issue with the selfie with a document. The error is considered resolved when the file with the selfie
 * changes.
 *
 * @package Kuvardin\TelegramBotsApi
 * @author Maxim Kuvardin <maxim@kuvard.in>
 */
class Selfie extends PassportElementError
{
    /**
     * @var string $type The section of the user's Telegram Passport which has the issue, one of “passport”,
     *     “driver_license”, “identity_card”, “internal_passport”
     */
    public string $type;

    /**
     * @var string $file_hash Base64-encoded hash of the file with the selfie
     */
    public string $file_hash;

    /**
     * @var string $message Error message
     */
    public string $message;

    public static function getSource(): string
    {
        return 'selfie';
    }

    public static function makeByArray(array $data): static
    {
        $result = new self;

        if ($data['source'] !== self::getSource()) {
            throw new RuntimeException("Wrong passport element error source: {$data['source']}");
        }

        $result->type = $data['type'];
        $result->file_hash = $data['file_hash'];
        $result->message = $data['message'];
        return $result;
    }

    public function getRequestData(): array
    {
        return [
            'source' => self::getSource(),
            'type' => $this->type,
            'file_hash' => $this->file_hash,
            'message' => $this->message,
        ];
    }
}
