<?php

declare(strict_types=1);

namespace TelegramBotsApi\Types;

use TelegramBotsApi;
use TelegramBotsApi\Exceptions\Error;

/**
 * Contains information about documents or other Telegram Passport elements shared with the bot by the user.
 *
 * @package TelegramBotsApi
 * @author Maxim Kuvardin <maxim@kuvard.in>
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
     * @var string|null Base64-encoded encrypted Telegram Passport element data provided by the user,
     * available for “personal_details”, “passport”, “driver_license”, “identity_card”, “internal_passport”
     * and “address” types. Can be decrypted and verified using the accompanying EncryptedCredentials.
     */
    public ?string $data = null;

    /**
     * @var string|null User's verified phone number, available only for “phone_number” type
     */
    public ?string $phone_number = null;

    /**
     * @var string|null User's verified email address, available only for “email” type
     */
    public ?string $email = null;

    /**
     * @var PassportFile[]|null Array of encrypted files with documents provided by the user, available for
     * “utility_bill”, “bank_statement”, “rental_agreement”, “passport_registration” and
     * “temporary_registration” types. Files can be decrypted and verified using the
     * accompanying EncryptedCredentials.
     */
    public ?array $files = null;

    /**
     * @var PassportFile|null Encrypted file with the front side of the document, provided by the user.
     * Available for “passport”, “driver_license”, “identity_card” and “internal_passport”.
     * The file can be decrypted and verified using the accompanying EncryptedCredentials.
     */
    public ?PassportFile $front_side = null;

    /**
     * @var PassportFile|null Encrypted file with the reverse side of the document, provided by the user.
     * Available for “driver_license” and “identity_card”. The file can be decrypted and verified using
     * the accompanying EncryptedCredentials.
     */
    public ?PassportFile $reverse_side = null;

    /**
     * @var PassportFile|null Encrypted file with the selfie of the user holding a document, provided by
     * the user; available for “passport”, “driver_license”, “identity_card” and “internal_passport”.
     * The file can be decrypted and verified using the accompanying EncryptedCredentials.
     */
    public ?PassportFile $selfie = null;

    /**
     * @var PassportFile[]|null Array of encrypted files with translated versions of documents provided by
     * the user. Available if requested for “passport”, “driver_license”, “identity_card”, “internal_passport”,
     * “utility_bill”, “bank_statement”, “rental_agreement”, “passport_registration” and
     * “temporary_registration” types. Files can be decrypted and verified using the
     * accompanying EncryptedCredentials.
     */
    public ?array $translation = null;

    /**
     * @var string Base64-encoded element hash for using in PassportElementErrorUnspecified
     */
    public string $hash;

    /**
     * @var string Element type. One of self::TYPE_*
     */
    protected string $type;

    /**
     * EncryptedPassportElement constructor.
     *
     * @param array $data
     * @throws Error
     */
    public function __construct(array $data)
    {
        $this->setType($data['type']);

        if (isset($data['data'])) {
            $this->data = $data['data'];
        }

        if (isset($data['phone_number'])) {
            $this->phone_number = $data['phone_number'];
        }

        if (isset($data['email'])) {
            $this->email = $data['email'];
        }

        if (isset($data['files'])) {
            $this->files = [];
            foreach ($data['files'] as $item) {
                $this->files[] = $item instanceof PassportFile ? $item : new PassportFile($item);
            }
        }

        if (isset($data['front_side'])) {
            $this->front_side = $data['front_side'] instanceof PassportFile
                ? $data['front_side']
                : new PassportFile($data['front_side']);
        }

        if (isset($data['reverse_side'])) {
            $this->reverse_side = $data['reverse_side'] instanceof PassportFile
                ? $data['reverse_side']
                : new PassportFile($data['reverse_side']);
        }

        if (isset($data['selfie'])) {
            $this->selfie = $data['selfie'] instanceof PassportFile
                ? $data['selfie']
                : new PassportFile($data['selfie']);
        }

        if (isset($data['translation'])) {
            foreach ($data['translation'] as $item) {
                $this->translation[] = $item instanceof PassportFile ? $item : new PassportFile($item);
            }
        }

        $this->hash = $data['hash'];
    }

    /**
     * @param string $type Element type. One of self::TYPE_*
     * @param string $hash Base64-encoded element hash for using in PassportElementErrorUnspecified
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
            $type === self::TYPE_ADDRESS ||
            $type === self::TYPE_UTILITY_BILL ||
            $type === self::TYPE_BANK_STATEMENT ||
            $type === self::TYPE_RENTAL_AGREEMENT ||
            $type === self::TYPE_PASSPORT_REGISTRATION ||
            $type === self::TYPE_TEMPORARY_REGISTRATION ||
            $type === self::TYPE_PHONE_NUMBER ||
            $type === self::TYPE_EMAIL;
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
            throw new Error("Unknown encrypted passport element type: $type");
        }
        $this->type = $type;
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
}
