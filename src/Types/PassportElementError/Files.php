<?php

declare(strict_types=1);

namespace Kuvardin\TelegramBotsApi\Types\PassportElementError;

use Kuvardin\TelegramBotsApi\Types\PassportElementError;
use RuntimeException;

/**
 * Represents an issue with a list of scans. The error is considered resolved when the list of files containing the
 * scans changes.
 *
 * @package Kuvardin\TelegramBotsApi
 * @author Maxim Kuvardin <maxim@kuvard.in>
 */
class Files extends PassportElementError
{
    /**
     * @param string $type The section of the user's Telegram Passport which has the issue, one of “utility_bill”,
     *     “bank_statement”, “rental_agreement”, “passport_registration”, “temporary_registration”
     * @param string[] $file_hashes List of base64-encoded file hashes
     * @param string $message Error message
     */
    public function __construct(
        public string $type,
        public array $file_hashes,
        public string $message,
    )
    {

    }

    public static function getSource(): string
    {
        return 'files';
    }

    public static function makeByArray(array $data): static
    {
        if ($data['source'] !== self::getSource()) {
            throw new RuntimeException("Wrong passport element error source: {$data['source']}");
        }

        return new self(
            type: $data['type'],
            file_hashes: $data['file_hashes'],
            message: $data['message'],
        );
    }

    public function getRequestData(): array
    {
        return [
            'source' => self::getSource(),
            'type' => $this->type,
            'file_hashes' => $this->file_hashes,
            'message' => $this->message,
        ];
    }
}
