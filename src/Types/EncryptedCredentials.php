<?php

namespace TelegramBotsApi\Types;

use \TelegramBotsApi;
use \TelegramBotsApi\Exceptions\Error;

/**
 * Contains data required for decrypting and authenticating EncryptedPassportElement. See the Telegram Passport Documentation for a complete description of the data decryption and authentication processes.
 * @package TelegramBotsApi\Types
 * @author Maxim Kuvardin <kuvard.in@mail.ru>
 */
class EncryptedCredentials implements TypeInterface
{

    /**
     * @var string Base64-encoded encrypted JSON-serialized data with unique user&#39;s payload, data hashes and secrets required for EncryptedPassportElement decryption and authentication
     */
    public $data;

    /**
     * @var string Base64-encoded data hash for data authentication
     */
    public $hash;

    /**
     * @var string Base64-encoded secret, encrypted with the bot&#39;s public RSA key, required for data decryption
     */
    public $secret;

    /**
     * EncryptedCredentials constructor.
     * @param array $data
     */
    public function __construct(array $data)
    {
        $this->data = $data['data'];
        $this->hash = $data['hash'];
        $this->secret = $data['secret'];
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

    /**
     * @param string $data
     * @param string $hash
     * @param string $secret
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
}