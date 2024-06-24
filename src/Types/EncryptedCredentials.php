<?php

declare(strict_types=1);

namespace Kuvardin\TelegramBotsApi\Types;

use Kuvardin\TelegramBotsApi\Type;

/**
 * Describes data required for decrypting and authenticating EncryptedPassportElement. See the Telegram Passport
 * Documentation for a complete description of the data decryption and authentication processes.
 *
 * @package Kuvardin\TelegramBotsApi
 * @author Maxim Kuvardin <maxim@kuvard.in>
 */
class EncryptedCredentials extends Type
{
    /**
     * @param string $data Base64-encoded encrypted JSON-serialized data with unique user's payload, data hashes and
     *     secrets required for EncryptedPassportElement decryption and authentication
     * @param string $hash Base64-encoded data hash for data authentication
     * @param string $secret Base64-encoded secret, encrypted with the bot's public RSA key, required for data
     *     decryption
     */
    public function __construct(
        public string $data,
        public string $hash,
        public string $secret,
    )
    {

    }

    public static function makeByArray(array $data): self
    {
        return new self(
            data: $data['data'],
            hash: $data['hash'],
            secret: $data['secret'],
        );
    }

    public function getRequestData(): array
    {
        return [
            'data' => $this->data,
            'hash' => $this->hash,
            'secret' => $this->secret,
        ];
    }
}
