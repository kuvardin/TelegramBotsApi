<?php

declare(strict_types=1);

namespace Kuvardin\TelegramBotsApi\Types\PassportElementError;

use Kuvardin\TelegramBotsApi\Types\PassportElementError;
use RuntimeException;

/**
 * Represents an issue with the front side of a document. The error is considered resolved when the file with the front
 * side of the document changes.
 *
 * @package Kuvardin\TelegramBotsApi
 * @author Maxim Kuvardin <maxim@kuvard.in>
 */
class FrontSide extends PassportElementError
{
    /**
     * @param string $type The section of the user's Telegram Passport which has the issue, one of “passport”,
     *     “driver_license”, “identity_card”, “internal_passport”
     * @param string $file_hash Base64-encoded hash of the file with the front side of the document
     * @param string $message Error message
     */
    public function __construct(
        public string $type,
        public string $file_hash,
        public string $message,
    )
    {

    }

    public static function getSource(): string
    {
        return 'front_side';
    }

    public static function makeByArray(array $data): static
    {
        if ($data['source'] !== self::getSource()) {
            throw new RuntimeException("Wrong passport element error source: {$data['source']}");
        }

        return new self(
            type: $data['type'],
            file_hash: $data['file_hash'],
            message: $data['message'],
        );
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
