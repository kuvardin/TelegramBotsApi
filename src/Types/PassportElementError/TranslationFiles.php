<?php

declare(strict_types=1);

namespace Kuvardin\TelegramBotsApi\Types\PassportElementError;

use Kuvardin\TelegramBotsApi\Types\PassportElementError;
use RuntimeException;

/**
 * Represents an issue with the translated version of a document. The error is considered resolved when a file with the
 * document translation change.
 *
 * @package Kuvardin\TelegramBotsApi
 * @author Maxim Kuvardin <maxim@kuvard.in>
 */
class TranslationFiles extends PassportElementError
{
    /**
     * @var string $type Type of element of the user's Telegram Passport which has the issue, one of “passport”,
     *     “driver_license”, “identity_card”, “internal_passport”, “utility_bill”, “bank_statement”,
     *     “rental_agreement”, “passport_registration”, “temporary_registration”
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
        return 'translation_files';
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
