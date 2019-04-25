<?php

namespace TelegramBotsApi\Types;

use \TelegramBotsApi;
use \TelegramBotsApi\Exceptions\Error;

/**
 * This object represents an error in the Telegram Passport element which was submitted that should be resolved by the user. It should be one of:
 * @package TelegramBotsApi\Types
 * @author Maxim Kuvardin <kuvard.in@mail.ru>
 */
class PassportElementError implements TypeInterface
{

    /**
     * @var string Error source, must be data
     */
    public $source;

    /**
     * @var string The section of the user&#39;s Telegram Passport which has the error, one of “personal_details”, “passport”, “driver_license”, “identity_card”, “internal_passport”, “address”
     */
    public $type;

    /**
     * @var string Name of the data field which has the error
     */
    public $field_name;

    /**
     * @var string Base64-encoded data hash
     */
    public $data_hash;

    /**
     * @var string Error message
     */
    public $message;

    /**
     * PassportElementError constructor.
     * @param array $data
     * @throws Error
     */
    public function __construct(array $data)
    {
        $this->source = $data['source'];
        $this->setType($data['type']);
        $this->field_name = $data['field_name'];
        $this->data_hash = $data['data_hash'];
        $this->message = $data['message'];
    }

    /**
     * @return array
     */
    public function getRequestArray(): array
    {
        return [
            'source' => $this->source,
            'type' => $this->type,
            'field_name' => $this->field_name,
            'data_hash' => $this->data_hash,
            'message' => $this->message,
        ];
    }

    /**
     * @param string $type
     * @return PassportElementError
     * @throws Error
     */
    public function setType(string $type): self
    {
        switch ($type) {
            case EncryptedPassportElement::TYPE_PERSONAL_DETAILS:
            case EncryptedPassportElement::TYPE_PASSPORT:
            case EncryptedPassportElement::TYPE_DRIVER_LICENSE:
            case EncryptedPassportElement::TYPE_IDENTITY_CARD:
            case EncryptedPassportElement::TYPE_INTERNAL_PASSPORT:
            case EncryptedPassportElement::TYPE_ADDRESS:
                $this->type = $type;
                break;
            default:
                throw new Error("Unknown or unsupported type: {$type}");
        }

        return $this;
    }

    /**
     * @param string $source
     * @param string $type
     * @param string $field_name
     * @param string $data_hash
     * @param string $message
     * @return PassportElementError
     * @throws Error
     */
    public static function make(string $source, string $type, string $field_name, string $data_hash, string $message): self
    {
        return new self([
            'source' => $source,
            'type' => $type,
            'field_name' => $field_name,
            'data_hash' => $data_hash,
            'message' => $message,
        ]);
    }
}