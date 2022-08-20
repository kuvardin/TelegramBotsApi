<?php

declare(strict_types=1);

namespace Kuvardin\TelegramBotsApi\Types;

use Kuvardin\TelegramBotsApi\Type;

/**
 * Contains information about Telegram Passport data shared with the bot by the user.
 *
 * @package Kuvardin\TelegramBotsApi
 * @author Maxim Kuvardin <maxim@kuvard.in>
 */
class PassportData extends Type
{
    /**
     * @var EncryptedPassportElement[] $data Array with information about documents and other Telegram Passport
     *     elements that was shared with the bot
     */
    public array $data;

    /**
     * @var EncryptedCredentials $credentials Encrypted credentials required to decrypt the data
     */
    public EncryptedCredentials $credentials;

    public static function makeByArray(array $data): self
    {
        $result = new self;
        $result->data = [];
        foreach ($data['data'] as $item_data) {
            $result->data[] = EncryptedPassportElement::makeByArray($item_data);
        }
        $result->credentials = EncryptedCredentials::makeByArray($data['credentials']);
        return $result;
    }

    public function getRequestData(): array
    {
        return [
            'data' => $this->data,
            'credentials' => $this->credentials,
        ];
    }
}
