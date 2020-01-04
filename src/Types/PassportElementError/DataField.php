<?php declare(strict_types=1);

namespace TelegramBotsApi\Types\PassportElementError;

use TelegramBotsApi;
use TelegramBotsApi\Exceptions\Error;
use TelegramBotsApi\Types;

/**
 * Represents an issue in one of the data fields that was provided by the user. The error is considered resolved
 * when the field's value changes.
 *
 * @package TelegramBotsApi
 * @author Maxim Kuvardin <maxim@kuvard.in>
 */
class DataField extends Types\PassportElementError implements Types\TypeInterface
{
    public const SOURCE = Types\PassportElementError::SOURCE_DATA;

    public const TYPE_PERSONAL_DETAILS = 'personal_details';
    public const TYPE_PASSPORT = 'passport';
    public const TYPE_DRIVER_LICENSE = 'driver_license';
    public const TYPE_IDENTITY_CARD = 'identity_card';
    public const TYPE_INTERNAL_PASSPORT = 'internal_passport';
    public const TYPE_ADDRESS = 'address”';

    /**
     * @var string Name of the data field which has the error
     */
    public string $field_name;

    /**
     * @var string Base64-encoded data hash
     */
    public string $data_hash;

    /**
     * @var string Error message
     */
    public string $message;

    /**
     * @var string The section of the user's Telegram Passport which has the error, one of self::TYPE_*
     */
    protected string $type;

    /**
     * DataField constructor.
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
        $this->field_name = $data['field_name'];
        $this->data_hash = $data['data_hash'];
        $this->message = $data['message'];
    }

    /**
     * @param string $type The section of the user's Telegram Passport which has the error, one of self::TYPE_*
     * @param string $field_name Name of the data field which has the error
     * @param string $data_hash Base64-encoded data hash
     * @param string $message Error message
     * @return DataField
     * @throws Error
     */
    public static function make(string $type, string $field_name, string $data_hash, string $message): self
    {
        return new self([
            'type' => $type,
            'field_name' => $field_name,
            'data_hash' => $data_hash,
            'message' => $message,
        ]);
    }

    /**
     * @param string $type
     * @return bool
     */
    public static function checkType(string $type): bool
    {
        return $type === self::TYPE_PERSONAL_DETAILS ||
            $type === self::TYPE_PASSPORT ||
            $type === self::TYPE_DRIVER_LICENSE ||
            $type === self::TYPE_IDENTITY_CARD ||
            $type === self::TYPE_INTERNAL_PASSPORT ||
            $type === self::TYPE_ADDRESS;
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
            throw new Error("Unknown type: {$type}");
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
            'field_name' => $this->field_name,
            'data_hash' => $this->data_hash,
            'message' => $this->message,
        ];
    }
}