<?php

declare(strict_types=1);

namespace Kuvardin\TelegramBotsApi\Types\PassportElementError;

use Kuvardin\TelegramBotsApi\Exceptions\Error;
use Kuvardin\TelegramBotsApi\Types;

/**
 * Represents an issue with a document scan. The error is considered resolved when the file with
 * the document scan changes.
 *
 * @package Kuvardin\TelegramBotsApi
 * @author Maxim Kuvardin <maxim@kuvard.in>
 */
class File extends Types\PassportElementError implements Types\TypeInterface
{
    public const SOURCE = Types\PassportElementError::SOURCE_FILE;

    public const TYPE_UTILITY_BILL = 'utility_bill';
    public const TYPE_BANK_STATEMENT = 'bank_statement';
    public const TYPE_RENTAL_AGREEMENT = 'rental_agreement';
    public const TYPE_PASSPORT_REGISTRATION = 'passport_registration';
    public const TYPE_TEMPORARY_REGISTRATION = 'temporary_registration';

    /**
     * @var string Error source, must be file
     */
    public string $source;

    /**
     * @var string Base64-encoded file hash
     */
    public string $file_hash;

    /**
     * @var string Error message
     */
    public string $message;

    /**
     * @var string The section of the user's Telegram Passport which has the issue, one of self::TYPE_*
     */
    protected string $type;

    /**
     * File constructor.
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
        $this->file_hash = $data['file_hash'];
        $this->message = $data['message'];
    }

    /**
     * @param string $type The section of the user's Telegram Passport which has the issue, one of self::TYPE_*
     * @param string $file_hash Base64-encoded file hash
     * @param string $message Error message
     * @return File
     * @throws Error
     */
    public static function make(string $type, string $file_hash, string $message): self
    {
        return new self([
            'type' => $type,
            'file_hash' => $file_hash,
            'message' => $message,
        ]);
    }

    /**
     * @param string $type
     * @return bool
     */
    public static function checkType(string $type): bool
    {
        return $type === self::TYPE_UTILITY_BILL ||
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
            'file_hash' => $this->file_hash,
            'message' => $this->message,
        ];
    }
}
