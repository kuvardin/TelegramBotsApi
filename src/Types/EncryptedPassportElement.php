<?php

declare(strict_types=1);

namespace Kuvardin\TelegramBotsApi\Types;

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
     * @var string $type Element type. One of “personal_details”, “passport”, “driver_license”, “identity_card”,
     *     “internal_passport”, “address”, “utility_bill”, “bank_statement”, “rental_agreement”,
     *     “passport_registration”, “temporary_registration”, “phone_number”, “email”.
     */
    public string $type;

    /**
     * @var string|null $data Base64-encoded encrypted Telegram Passport element data provided by the user, available
     *     for “personal_details”, “passport”, “driver_license”, “identity_card”, “internal_passport” and “address”
     *     types. Can be decrypted and verified using the accompanying <a
     *     href="https://core.telegram.org/bots/api#encryptedcredentials">EncryptedCredentials</a>.
     */
    public ?string $data = null;

    /**
     * @var string|null $phone_number User's verified phone number, available only for “phone_number” type
     */
    public ?string $phone_number = null;

    /**
     * @var string|null $email User's verified email address, available only for “email” type
     */
    public ?string $email = null;

    /**
     * @var PassportFile[]|null $files Array of encrypted files with documents provided by the user, available for
     *     “utility_bill”, “bank_statement”, “rental_agreement”, “passport_registration” and “temporary_registration”
     *     types. Files can be decrypted and verified using the accompanying <a
     *     href="https://core.telegram.org/bots/api#encryptedcredentials">EncryptedCredentials</a>.
     */
    public ?array $files = null;

    /**
     * @var PassportFile|null $front_side Encrypted file with the front side of the document, provided by the user.
     *     Available for “passport”, “driver_license”, “identity_card” and “internal_passport”. The file can be
     *     decrypted and verified using the accompanying <a
     *     href="https://core.telegram.org/bots/api#encryptedcredentials">EncryptedCredentials</a>.
     */
    public ?PassportFile $front_side = null;

    /**
     * @var PassportFile|null $reverse_side Encrypted file with the reverse side of the document, provided by the user.
     *     Available for “driver_license” and “identity_card”. The file can be decrypted and verified using the
     *     accompanying <a href="https://core.telegram.org/bots/api#encryptedcredentials">EncryptedCredentials</a>.
     */
    public ?PassportFile $reverse_side = null;

    /**
     * @var PassportFile|null $selfie Encrypted file with the selfie of the user holding a document, provided by the
     *     user; available for “passport”, “driver_license”, “identity_card” and “internal_passport”. The file can be
     *     decrypted and verified using the accompanying <a
     *     href="https://core.telegram.org/bots/api#encryptedcredentials">EncryptedCredentials</a>.
     */
    public ?PassportFile $selfie = null;

    /**
     * @var PassportFile[]|null $translation Array of encrypted files with translated versions of documents provided by
     *     the user. Available if requested for “passport”, “driver_license”, “identity_card”, “internal_passport”,
     *     “utility_bill”, “bank_statement”, “rental_agreement”, “passport_registration” and “temporary_registration”
     *     types. Files can be decrypted and verified using the accompanying <a
     *     href="https://core.telegram.org/bots/api#encryptedcredentials">EncryptedCredentials</a>.
     */
    public ?array $translation = null;

    /**
     * @var string $hash Base64-encoded element hash for using in <a
     *     href="https://core.telegram.org/bots/api#passportelementerrorunspecified">PassportElementErrorUnspecified</a>
     */
    public string $hash;

    public static function makeByArray(array $data): self
    {
        $result = new self;
        $result->type = $data['type'];
        $result->data = $data['data'] ?? null;
        $result->phone_number = $data['phone_number'] ?? null;
        $result->email = $data['email'] ?? null;
        if (isset($data['files'])) {
            $result->files = [];
            foreach ($data['files'] as $item_data) {
                $result->files[] = PassportFile::makeByArray($item_data);
            }
        }
        $result->front_side = isset($data['front_side'])
            ? PassportFile::makeByArray($data['front_side'])
            : null;
        $result->reverse_side = isset($data['reverse_side'])
            ? PassportFile::makeByArray($data['reverse_side'])
            : null;
        $result->selfie = isset($data['selfie'])
            ? PassportFile::makeByArray($data['selfie'])
            : null;
        if (isset($data['translation'])) {
            $result->translation = [];
            foreach ($data['translation'] as $item_data) {
                $result->translation[] = PassportFile::makeByArray($item_data);
            }
        }
        $result->hash = $data['hash'];
        return $result;
    }

    public function getRequestData(): array
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
