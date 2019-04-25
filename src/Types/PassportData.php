<?php

namespace TelegramBotsApi\Types;

use \TelegramBotsApi;
use \TelegramBotsApi\Exceptions\Error;

/**
 * Contains information about Telegram Passport data shared with the bot by the user.
 * @package TelegramBotsApi\Types
 * @author Maxim Kuvardin <kuvard.in@mail.ru>
 */
class PassportData implements TypeInterface
{

    /**
     * @var EncryptedPassportElement[] Array with information about documents and other Telegram Passport elements that was shared with the bot
     */
    public $data;

    /**
     * @var EncryptedCredentials Encrypted credentials required to decrypt the data
     */
    public $credentials;

    /**
     * PassportData constructor.
     * @param array $data
     * @throws Error
     */
    public function __construct(array $data)
    {
        $this->data = [];
        foreach ($data['data'] as $encrypted_passport_element) {
            $this->data[] = $encrypted_passport_element instanceof EncryptedPassportElement ? $encrypted_passport_element : new EncryptedPassportElement($encrypted_passport_element);
        }

        $this->credentials = $data['credentials'] instanceof EncryptedCredentials ? $data['credentials'] : new EncryptedCredentials($data['credentials']);
    }

    /**
     * @return array
     */
    public function getRequestArray(): array
    {
        return [
            'data' => $this->data,
            'credentials' => $this->credentials,
        ];
    }

    /**
     * @param array $data
     * @param EncryptedCredentials $credentials
     * @return PassportData
     * @throws Error
     */
    public static function make(array $data, EncryptedCredentials $credentials): self
    {
        return new self([
            'data' => $data,
            'credentials' => $credentials,
        ]);
    }
}