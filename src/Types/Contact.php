<?php

declare(strict_types=1);

namespace Kuvardin\TelegramBotsApi\Types;

use Kuvardin\TelegramBotsApi\Type;

/**
 * This object represents a phone contact.
 *
 * @package Kuvardin\TelegramBotsApi
 * @author Maxim Kuvardin <maxim@kuvard.in>
 */
class Contact extends Type
{
    /**
     * @param string $phone_number Contact's phone number
     * @param string $first_name Contact's first name
     * @param string|null $last_name Contact's last name
     * @param int|null $user_id Contact's user identifier in Telegram. This number may have more than 32 significant
     *     bits and some programming languages may have difficulty/silent defects in interpreting it. But it has at
     *     most 52 significant bits, so a 64-bit integer or double-precision float type are safe for storing this
     *     identifier.
     * @param string|null $vcard Additional data about the contact in the form of a <a
     *     href="https://en.wikipedia.org/wiki/VCard">vCard</a>
     */
    public function __construct(
        public string $phone_number,
        public string $first_name,
        public ?string $last_name = null,
        public ?int $user_id = null,
        public ?string $vcard = null,
    )
    {

    }

    public static function makeByArray(array $data): self
    {
        return new self(
            phone_number: $data['phone_number'],
            first_name: $data['first_name'],
            last_name: $data['last_name'] ?? null,
            user_id: $data['user_id'] ?? null,
            vcard: $data['vcard'] ?? null,
        );
    }

    public function getRequestData(): array
    {
        return [
            'phone_number' => $this->phone_number,
            'first_name' => $this->first_name,
            'last_name' => $this->last_name,
            'user_id' => $this->user_id,
            'vcard' => $this->vcard,
        ];
    }
}
