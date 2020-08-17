<?php

declare(strict_types=1);

namespace Kuvardin\TelegramBotsApi\Types\PassportElementError;

use Kuvardin\TelegramBotsApi\Exceptions\Error;
use Kuvardin\TelegramBotsApi\Types;

/**
 * Represents an issue with the selfie with a document. The error is considered resolved when the file with
 * the selfie changes.
 *
 * @package Kuvardin\TelegramBotsApi
 * @author Maxim Kuvardin <maxim@kuvard.in>
 */
class Selfie extends Types\PassportElementError implements Types\TypeInterface
{
    public const SOURCE = Types\PassportElementError::SOURCE_SELFIE;

    public const TYPE_PASSPORT = 'passport';
    public const TYPE_DRIVER_LICENSE = 'driver_license';
    public const TYPE_IDENTITY_CARD = 'identity_card';
    public const TYPE_INTERNAL_PASSPORT = 'internal_passport';

    /**
     * @var string Error source, must be selfie
     */
    public string $source;

    /**
     * @var string Base64-encoded hash of the file with the selfie
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
     * Selfie constructor.
     *
     * @param array $data
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
     * @param string $file_hash Base64-encoded hash of the file with the selfie
     * @param string $message Error message
     * @return Selfie
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
        return $type === self::TYPE_PASSPORT ||
            $type === self::TYPE_DRIVER_LICENSE ||
            $type === self::TYPE_IDENTITY_CARD ||
            $type === self::TYPE_INTERNAL_PASSPORT;
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
     */
    public function setType(string $type): void
    {
        if (!self::checkType($type)) {
            throw new Error("unknown type: $type");
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
