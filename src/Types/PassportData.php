<?php declare(strict_types=1);

namespace TelegramBotsApi\Types;

use TelegramBotsApi;
use TelegramBotsApi\Exceptions\Error;

/**
 * Contains information about Telegram Passport data shared with the bot by the user.
 *
 * @package TelegramBotsApi
 * @author Maxim Kuvardin <maxim@kuvard.in>
 */
class PassportData implements TypeInterface
{
    /**
     * @var EncryptedPassportElement[] Array with information about documents and other Telegram Passport
     * elements that was shared with the bot
     */
    public array $data = [];

    /**
     * @var EncryptedCredentials Encrypted credentials required to decrypt the data
     */
    public EncryptedCredentials $credentials;

    /**
     * PassportData constructor.
     *
     * @param array $data
     * @throws Error
     */
    public function __construct(array $data)
    {
        foreach ($data['data'] as $item) {
            $this->data[] = $item instanceof EncryptedPassportElement
                ? $item
                : new EncryptedPassportElement($item);
        }

        $this->credentials = $data['credentials'] instanceof EncryptedCredentials
            ? $data['credentials']
            : new EncryptedCredentials($data['credentials']);
    }

    /**
     * @param EncryptedPassportElement[] $data Array with information about documents and other Telegram Passport
     * elements that was shared with the bot
     * @param EncryptedCredentials $credentials Encrypted credentials required to decrypt the data
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
}