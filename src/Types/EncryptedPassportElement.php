<?php

namespace TelegramBotsApi\Types;

use \TelegramBotsApi;
use \TelegramBotsApi\Exceptions\Error;

/**
 * Contains information about documents or other Telegram Passport elements shared with the bot by the user.
 * @package TelegramBotsApi\Types
 * @author Maxim Kuvardin <kuvard.in@mail.ru>
 */
class EncryptedPassportElement implements TypeInterface
{
    public const TYPE_PERSONAL_DETAILS = 'personal_details';
    public const TYPE_PASSPORT = 'passport';
    public const TYPE_DRIVER_LICENSE = 'driver_license';
    public const TYPE_IDENTITY_CARD = 'identity_card';
    public const TYPE_INTERNAL_PASSPORT = 'internal_passport';
    public const TYPE_ADDRESS = 'address';
    public const TYPE_UTILITY_BILL = 'utility_bill';
    public const TYPE_BANK_STATEMENT = 'bank_statement';
    public const TYPE_RENTAL_AGREEMENT = 'rental_agreement';
    public const TYPE_PASSPORT_REGISTRATION = 'passport_registration';
    public const TYPE_TEMPORARY_REGISTRATION = 'temporary_registration';
    public const TYPE_PHONE_NUMBER = 'phone_number';
    public const TYPE_EMAIL = 'email';

    /**
     * @var string Element type. One of self::TYPE_*
     */
    public $type;

    /**
     * @var string|null Base64-encoded encrypted Telegram Passport element data provided by the user, available for “personal_details”, “passport”, “driver_license”, “identity_card”, “internal_passport” and “address” types. Can be decrypted and verified using the accompanying EncryptedCredentials.
     */
    public $data;

    /**
     * @var string|null User's verified phone number, available only for “phone_number” type
     */
    public $phone_number;

    /**
     * @var string|null User's verified email address, available only for “email” type
     */
    public $email;

    /**
     * @var PassportFile[]|null Array of encrypted files with documents provided by the user, available for “utility_bill”, “bank_statement”, “rental_agreement”, “passport_registration” and “temporary_registration” types. Files can be decrypted and verified using the accompanying EncryptedCredentials.
     */
    public $files;

    /**
     * @var PassportFile|null Encrypted file with the front side of the document, provided by the user. Available for “passport”, “driver_license”, “identity_card” and “internal_passport”. The file can be decrypted and verified using the accompanying EncryptedCredentials.
     */
    public $front_side;

    /**
     * @var PassportFile|null Encrypted file with the reverse side of the document, provided by the user. Available for “driver_license” and “identity_card”. The file can be decrypted and verified using the accompanying EncryptedCredentials.
     */
    public $reverse_side;

    /**
     * @var PassportFile|null Encrypted file with the selfie of the user holding a document, provided by the user; available for “passport”, “driver_license”, “identity_card” and “internal_passport”. The file can be decrypted and verified using the accompanying EncryptedCredentials.
     */
    public $selfie;

    /**
     * @var PassportFile[]|null Array of encrypted files with translated versions of documents provided by the user. Available if requested for “passport”, “driver_license”, “identity_card”, “internal_passport”, “utility_bill”, “bank_statement”, “rental_agreement”, “passport_registration” and “temporary_registration” types. Files can be decrypted and verified using the accompanying EncryptedCredentials.
     */
    public $translation;

    /**
     * @var string Base64-encoded element hash for using in PassportElementErrorUnspecified
     */
    public $hash;

    /**
     * EncryptedPassportElement constructor.
     * @param array $data
     * @throws Error
     */
    public function __construct(array $data)
    {
        $this->setType($data['type']);
        $this->data = $data['data'] ?? null;
        $this->phone_number = $data['phone_number'] ?? null;
        $this->email = $data['email'] ?? null;

        if (isset($data['files'])) {
            $this->files = [];
            foreach ($data['files'] as $passport_file) {
                $this->files = $passport_file instanceof PassportFile ? $passport_file : new PassportFile($passport_file);
            }
        }


        if (isset($data['front_side'])) {
            $this->front_side = $data['front_side'] instanceof PassportFile ? $data['front_side'] : new PassportFile($data['front_side']);
        }


        if (isset($data['reverse_side'])) {
            $this->reverse_side = $data['reverse_side'] instanceof PassportFile ? $data['reverse_side'] : new PassportFile($data['reverse_side']);
        }


        if (isset($data['selfie'])) {
            $this->selfie = $data['selfie'] instanceof PassportFile ? $data['selfie'] : new PassportFile($data['selfie']);
        }


        if (isset($data['translation'])) {
            $this->translation = [];
            foreach ($data['translation'] as $passport_file) {
                $this->translation = $passport_file instanceof PassportFile ? $passport_file : new PassportFile($passport_file);
            }
        }

        $this->hash = $data['hash'];
    }

    /**
     * @return array
     */
    public function getRequestArray(): array
    {
        return [
            'type' => $this->type,
            'data' => $this->data,
            'phone_number' => $this->phone_number,
            'email' => $this->email,
            'files' => $this->files,
            'front_side' => $this->front_side,
            'reverse_side' => $this->reverse_side,
            'selfie' => $this->selfie,
            'translation' => $this->translation,
            'hash' => $this->hash,
        ];
    }

    /**
     * @param string $type
     * @return EncryptedPassportElement
     * @throws Error
     */
    public function setType(string $type): self
    {
        switch ($type) {
            case self::TYPE_PERSONAL_DETAILS:
            case self::TYPE_PASSPORT:
            case self::TYPE_DRIVER_LICENSE:
            case self::TYPE_IDENTITY_CARD:
            case self::TYPE_INTERNAL_PASSPORT:
            case self::TYPE_ADDRESS:
            case self::TYPE_UTILITY_BILL:
            case self::TYPE_BANK_STATEMENT:
            case self::TYPE_RENTAL_AGREEMENT:
            case self::TYPE_PASSPORT_REGISTRATION:
            case self::TYPE_TEMPORARY_REGISTRATION:
            case self::TYPE_PHONE_NUMBER:
            case self::TYPE_EMAIL:
                $this->type = $type;
                break;
            default:
                throw new Error("Unknown type: {$type}");
        }

        return $this;
    }

    /**
     * @param string $type
     * @param string $hash
     * @return EncryptedPassportElement
     * @throws Error
     */
    public static function make(string $type, string $hash): self
    {
        return new self([
            'type' => $type,
            'hash' => $hash,
        ]);
    }
}