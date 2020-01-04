<?php declare(strict_types=1);

namespace TelegramBotsApi\Types\PassportElementError;

use TelegramBotsApi;
use TelegramBotsApi\Exceptions\Error;
use TelegramBotsApi\Types;

/**
 * Represents an issue with the reverse side of a document. The error is considered resolved when the file with
 * reverse side of the document changes.
 *
 * @package TelegramBotsApi
 * @author Maxim Kuvardin <maxim@kuvard.in>
 */
class ReverseSide extends Types\PassportElementError implements Types\TypeInterface
{
    public const SOURCE = Types\PassportElementError::SOURCE_REVERSE_SIDE;

    public const TYPE_DRIVER_LICENSE = 'driver_license';
    public const TYPE_IDENTITY_CARD = 'identity_card';

    /**
     * @var string Error source, must be reverse_side
     */
    public string $source;

    /**
     * @var string Base64-encoded hash of the file with the reverse side of the document
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
     * ReverseSide constructor.
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
     * @param string $file_hash Base64-encoded hash of the file with the reverse side of the document
     * @param string $message Error message
     * @return ReverseSide
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
        return $type === self::TYPE_DRIVER_LICENSE ||
            $type === self::TYPE_IDENTITY_CARD;
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