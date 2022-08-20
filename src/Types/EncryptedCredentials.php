<?php

declare(strict_types=1);

namespace Kuvardin\TelegramBotsApi\Types;

use Kuvardin\TelegramBotsApi\Type;

/**
 * Contains data required for decrypting and authenticating <a
 * href="https://core.telegram.org/bots/api#encryptedpassportelement">EncryptedPassportElement</a>. See the <a
 * href="https://core.telegram.org/passport#receiving-information">Telegram Passport Documentation</a> for a complete
 * description of the data decryption and authentication processes.
 *
 * @package Kuvardin\TelegramBotsApi
 * @author Maxim Kuvardin <maxim@kuvard.in>
 */
class EncryptedCredentials extends Type
{
    /**
     * @var string $data Base64-encoded encrypted JSON-serialized data with unique user's payload, data hashes and
     *     secrets required for <a
     *     href="https://core.telegram.org/bots/api#encryptedpassportelement">EncryptedPassportElement</a> decryption
     *     and authentication
     */
    public string $data;

    /**
     * @var string $hash Base64-encoded data hash for data authentication
     */
    public string $hash;

    /**
     * @var string $secret Base64-encoded secret, encrypted with the bot's public RSA key, required for data decryption
     */
    public string $secret;

    public static function makeByArray(array $data): self
    {
        $result = new self;
        $result->data = $data['data'];
        $result->hash = $data['hash'];
        $result->secret = $data['secret'];
        return $result;
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
