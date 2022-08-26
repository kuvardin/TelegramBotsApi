<?php

declare(strict_types=1);

namespace Kuvardin\TelegramBotsApi\Types;

use Kuvardin\TelegramBotsApi\Enums\PassportElementType;
use Kuvardin\TelegramBotsApi\Type;

/**
 * Contains information about documents or other Telegram Passport elements shared with the bot by the user.
 *
 * @package Kuvardin\TelegramBotsApi
 * @author Maxim Kuvardin <maxim@kuvard.in>
 */
class EncryptedPassportElement extends Type
{
    /**
     * @param string $type_value Element type. One of Enums\PassportElementType::*.
     * @param string $hash Base64-encoded element hash for using in PassportElementErrorUnspecified
     * @param string|null $data Base64-encoded encrypted Telegram Passport element data provided by the user, available
     *     for “personal_details”, “passport”, “driver_license”, “identity_card”, “internal_passport” and “address”
     *     types. Can be decrypted and verified using the accompanying EncryptedCredentials.
     * @param string|null $phone_number User's verified phone number, available only for “phone_number” type
     * @param string|null $email User's verified email address, available only for “email” type
     * @param PassportFile[]|null $files Array of encrypted files with documents provided by the user, available for
     *     “utility_bill”, “bank_statement”, “rental_agreement”, “passport_registration” and “temporary_registration”
     *     types. Files can be decrypted and verified using the accompanying EncryptedCredentials.
     * @param PassportFile|null $front_side Encrypted file with the front side of the document, provided by the user.
     *     Available for “passport”, “driver_license”, “identity_card” and “internal_passport”. The file can be
     *     decrypted and verified using the accompanying EncryptedCredentials.
     * @param PassportFile|null $reverse_side Encrypted file with the reverse side of the document, provided by the
     *     user. Available for “driver_license” and “identity_card”. The file can be decrypted and verified using the
     *     accompanying EncryptedCredentials.
     * @param PassportFile|null $selfie Encrypted file with the selfie of the user holding a document, provided by the
     *     user; available for “passport”, “driver_license”, “identity_card” and “internal_passport”. The file can be
     *     decrypted and verified using the accompanying EncryptedCredentials.
     * @param PassportFile[]|null $translation Array of encrypted files with translated versions of documents provided
     *     by the user. Available if requested for “passport”, “driver_license”, “identity_card”, “internal_passport”,
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
        $result = new self(
            type_value: $data['type'],
            hash: $data['hash'],
            data: $data['data'] ?? null,
            phone_number: $data['phone_number'] ?? null,
            email: $data['email'] ?? null,
            files: null,
            front_side: isset($data['front_side'])
                ? PassportFile::makeByArray($data['front_side'])
                : null,
            reverse_side: isset($data['reverse_side'])
                ? PassportFile::makeByArray($data['reverse_side'])
                : null,
            selfie: isset($data['selfie'])
                ? PassportFile::makeByArray($data['selfie'])
                : null,
            translation: null
        );

        if (isset($data['files'])) {
            $result->files = [];
            foreach ($data['files'] as $passport_file_data) {
                $result->files[] = PassportFile::makeByArray($passport_file_data);
            }
        }
        if (isset($data['translation'])) {
            $result->translation = [];
            foreach ($data['translation'] as $translation_passport_file_data) {
                $result->translation[] = PassportFile::makeByArray($translation_passport_file_data);
            }
        }
        return $result;
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
     * @return PassportElementType|null Returns <em>Null</em> if the encrypted passport element type value is unknown.
     */
    public function getType(): ?PassportElementType
    {
        return PassportElementType::tryFrom($this->type_value);
    }
}
