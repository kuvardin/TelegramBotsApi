<?php

declare(strict_types=1);

namespace Kuvardin\TelegramBotsApi\Types;

use Kuvardin\TelegramBotsApi\Type;

/**
 * Describes Telegram Passport data shared with the bot by the user.
 *
 * @package Kuvardin\TelegramBotsApi
 * @author Maxim Kuvardin <maxim@kuvard.in>
 */
class PassportData extends Type
{
    /**
     * @param EncryptedPassportElement[] $data Array with information about documents and other Telegram Passport
     *     elements that was shared with the bot
     * @param EncryptedCredentials $credentials Encrypted credentials required to decrypt the data
     */
    public function __construct(
        public array $data,
        public EncryptedCredentials $credentials,
    )
    {

    }

    public static function makeByArray(array $data): self
    {
        return new self(
            data: array_map(
                static fn(array $data_data) => EncryptedPassportElement::makeByArray($data_data),
                $data['data'],
            ),
            credentials: EncryptedCredentials::makeByArray($data['credentials']),
        );
    }

    public function getRequestData(): array
    {
        return [
            'data' => $this->data,
            'credentials' => $this->credentials,
        ];
    }
}
