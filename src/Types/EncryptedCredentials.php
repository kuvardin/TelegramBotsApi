<?php

declare(strict_types=1);

namespace TelegramBotsApi\Types;

use TelegramBotsApi;

/**
 * Contains data required for decrypting and authenticating EncryptedPassportElement. See the Telegram Passport
 * Documentation for a complete description of the data decryption and authentication processes.
 *
 * @package TelegramBotsApi
 * @author Maxim Kuvardin <maxim@kuvard.in>
 */
class EncryptedCredentials implements TypeInterface
{
    /**
     * @var string Base64-encoded encrypted JSON-serialized data with unique user's payload, data hashes and
     * secrets required for EncryptedPassportElement decryption and authentication
     */
    public string $data;

    /**
     * @var string Base64-encoded data hash for data authentication
     */
    public string $hash;

    /**
     * @var string Base64-encoded secret, encrypted with the bot's public RSA key, required for data decryption
     */
    public string $secret;

    /**
     * EncryptedCredentials constructor.
     *
     * @param array $data
     */
    public function __construct(array $data)
    {
        $this->data = $data['data'];
        $this->hash = $data['hash'];
        $this->secret = $data['secret'];
    }

    /**
     * @param string $data Base64-encoded encrypted JSON-serialized data with unique user's payload, data hashes
     * and secrets required for EncryptedPassportElement decryption and authentication
     * @param string $hash Base64-encoded data hash for data authentication
     * @param string $secret Base64-encoded secret, encrypted with the bot's public RSA key, required for
     * data decryption
     * @return EncryptedCredentials
     */
    public static function make(string $data, string $hash, string $secret): self
    {
        return new self([
            'data' => $data,
            'hash' => $hash,
            'secret' => $secret,
        ]);
    }

    /**
     * @return array
     */
    public function getRequestArray(): array
    {
        return [
            'data' => $this->data,
            'hash' => $this->hash,
            'secret' => $this->secret,
        ];
    }
}
