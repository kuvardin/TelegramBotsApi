<?php declare(strict_types=1);

namespace TelegramBotsApi\Types\PassportElementError;

use TelegramBotsApi;
use TelegramBotsApi\Exceptions\Error;
use TelegramBotsApi\Types;

/**
 * Represents an issue with the translated version of a document.
 * The error is considered resolved when a file with the document translation change.
 *
 * @package TelegramBotsApi
 * @author Maxim Kuvardin <maxim@kuvard.in>
 */
class TranslationFiles extends Types\PassportElementError implements Types\TypeInterface
{
    public const SOURCE = Types\PassportElementError::SOURCE_TRANSLATION_FILES;

    public const TYPE_PASSPORT = 'passport';
    public const TYPE_DRIVER_LICENSE = 'driver_license';
    public const TYPE_IDENTITY_CARD = 'identity_card';
    public const TYPE_INTERNAL_PASSPORT = 'internal_passport';
    public const TYPE_UTILITY_BILL = 'utility_bill';
    public const TYPE_BANK_STATEMENT = 'bank_statement';
    public const TYPE_RENTAL_AGREEMENT = 'rental_agreement';
    public const TYPE_PASSPORT_REGISTRATION = 'passport_registration';
    public const TYPE_TEMPORARY_REGISTRATION = 'temporary_registration';

    /**
     * @var string Error source, must be translation_files
     */
    public string $source;

    /**
     * @var string Type of element of the user's Telegram Passport which has the issue, one of self::TYPE_*
     */
    public string $type;

    /**
     * @var string[] List of base64-encoded file hashes
     */
    public array $file_hashes = [];

    /**
     * @var string Error message
     */
    public string $message;

    /**
     * TranslationFiles constructor.
     *
     * @param array $data
     * @throws Error
     */
    public function __construct(array $data)
    {
        parent::__construct($data);

        if ($data['source'] !== self::SOURCE) {
            throw new Error("Unknown source: {$data['source']} (must be self::SOURCE)");
        }

        $this->setType($data['type']);
        $this->file_hashes = $data['file_hashes'];
        $this->message = $data['message'];
    }

    /**
     * @param string $source Error source, must be translation_files
     * @param string $type Type of element of the user's Telegram Passport which has the issue,
     * one of self::TYPE_*
     * @param string[] $file_hashes List of base64-encoded file hashes
     * @param string $message Error message
     * @return TranslationFiles
     * @throws Error
     */
    public static function make(string $source, string $type, array $file_hashes, string $message): self
    {
        return new self([
            'source' => $source,
            'type' => $type,
            'file_hashes' => $file_hashes,
            'message' => $message,
        ]);
    }

    /**
     * @param string $type
     * @return bool
     */
    public static function checkType(string $type): bool
    {
        return $type === self::TYPE_PASSPORT ||
            $type === self::TYPE_DRIVER_LICENSE ||
            $type === self::TYPE_IDENTITY_CARD ||
            $type === self::TYPE_INTERNAL_PASSPORT ||
            $type === self::TYPE_UTILITY_BILL ||
            $type === self::TYPE_BANK_STATEMENT ||
            $type === self::TYPE_RENTAL_AGREEMENT ||
            $type === self::TYPE_PASSPORT_REGISTRATION ||
            $type === self::TYPE_TEMPORARY_REGISTRATION;
    }

    /**
     * @return string
     */
    public function getType(): string
    {
        return $this->type;
    }

    /**
     * @param string $type
     * @throws Error
     */
    public function setType(string $type): void
    {
        if (!self::checkType($type)) {
            throw new Error("Unknown type: $type");
        }
        $this->type = $type;
    }

    /**
     * @return array
     */
    public function getRequestArray(): array
    {
        return [
            'source' => self::SOURCE,
            'type' => $this->type,
            'file_hashes' => $this->file_hashes,
            'message' => $this->message,
        ];
    }
}