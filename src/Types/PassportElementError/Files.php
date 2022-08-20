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
     * @var string $type The section of the user's Telegram Passport which has the issue, one of “utility_bill”,
     *     “bank_statement”, “rental_agreement”, “passport_registration”, “temporary_registration”
     */
    public string $type;

    /**
     * @var string[] $file_hashes List of base64-encoded file hashes
     */
    public array $file_hashes;

    /**
     * @var string $message Error message
     */
    public string $message;

    public static function getSource(): string
    {
        return 'files';
    }

    public static function makeByArray(array $data): static
    {
        $result = new self;

        if ($data['source'] !== self::getSource()) {
            throw new RuntimeException("Wrong passport element error source: {$data['source']}");
        }

        $result->type = $data['type'];
        $result->file_hashes = $data['file_hashes'];
        $result->message = $data['message'];
        return $result;
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
