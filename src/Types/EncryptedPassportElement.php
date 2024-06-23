<?php

declare(strict_types=1);

namespace Kuvardin\TelegramBotsApi\Types;

use Kuvardin\TelegramBotsApi\Enums\PassportElementType;
use Kuvardin\TelegramBotsApi\Type;

/**
 * Describes documents or other Telegram Passport elements shared with the bot by the user.
 *
 * @package Kuvardin\TelegramBotsApi
 * @author Maxim Kuvardin <maxim@kuvard.in>
 */
class EncryptedPassportElement extends Type
{
    /**
     * @param string $type_value Element type. One of Enums\PassportElementType::*.
     * @param string $hash Base64-encoded element hash for using in PassportElementErrorUnspecified
     * @param string|null $data Base64-encoded encrypted Telegram Passport element data provided by the user; available
     *     only for “personal_details”, “passport”, “driver_license”, “identity_card”, “internal_passport” and
     *     “address” types. Can be decrypted and verified using the accompanying EncryptedCredentials.
     * @param string|null $phone_number User's verified phone number; available only for “phone_number” type
     * @param string|null $email User's verified email address; available only for “email” type
     * @param PassportFile[]|null $files Array of encrypted files with documents provided by the user; available only
     *     for “utility_bill”, “bank_statement”, “rental_agreement”, “passport_registration” and
     *     “temporary_registration” types. Files can be decrypted and verified using the accompanying
     *     EncryptedCredentials.
     * @param PassportFile|null $front_side Encrypted file with the front side of the document, provided by the user;
     *     available only for “passport”, “driver_license”, “identity_card” and “internal_passport”. The file can be
     *     decrypted and verified using the accompanying EncryptedCredentials.
     * @param PassportFile|null $reverse_side Encrypted file with the reverse side of the document, provided by the
     *     user; available only for “driver_license” and “identity_card”. The file can be decrypted and verified using
     *     the accompanying EncryptedCredentials.
     * @param PassportFile|null $selfie Encrypted file with the selfie of the user holding a document, provided by the
     *     user; available if requested for “passport”, “driver_license”, “identity_card” and “internal_passport”. The
     *     file can be decrypted and verified using the accompanying EncryptedCredentials.
     * @param PassportFile[]|null $translation Array of encrypted files with translated versions of documents provided
     *     by the user; available if requested for “passport”, “driver_license”, “identity_card”, “internal_passport”,
     *     “utility_bill”, “bank_statement”, “rental_agreement”, “passport_registration” and “temporary_registration”
     *     types. Files can be decrypted and verified using the accompanying EncryptedCredentials.
     */
    public function __construct(
        public string $type_value,
        public string $hash,
        public ?string $data = null,
        public ?string $phone_number = null,
        public ?string $email = null,
        public ?array $files = null,
        public ?PassportFile $front_side = null,
        public ?PassportFile $reverse_side = null,
        public ?PassportFile $selfie = null,
        public ?array $translation = null,
    )
    {

    }

    public static function makeByArray(array $data): self
    {
        return new self(
            type_value: $data['type'],
            hash: $data['hash'],
            data: $data['data'] ?? null,
            phone_number: $data['phone_number'] ?? null,
            email: $data['email'] ?? null,
            files: isset($data['files'])
                ? array_map(
                    static fn(array $files_data) => PassportFile::makeByArray($files_data),
                    $data['files'],
                )
                : null,
            front_side: isset($data['front_side'])
                ? PassportFile::makeByArray($data['front_side'])
                : null,
            reverse_side: isset($data['reverse_side'])
                ? PassportFile::makeByArray($data['reverse_side'])
                : null,
            selfie: isset($data['selfie'])
                ? PassportFile::makeByArray($data['selfie'])
                : null,
            translation: isset($data['translation'])
                ? array_map(
                    static fn(array $translation_data) => PassportFile::makeByArray($translation_data),
                    $data['translation'],
                )
                : null,
        );
    }

    public function getRequestData(): array
    {
        return [
            'type' => $this->type_value,
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
     * @return PassportElementType|null Returns Null if the encrypted passport element type value is unknown.
     */
    public function getType(): ?PassportElementType
    {
        return PassportElementType::tryFrom($this->type_value);
    }
}
