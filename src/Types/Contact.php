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
     * @var string $phone_number Contact's phone number
     */
    public string $phone_number;

    /**
     * @var string $first_name Contact's first name
     */
    public string $first_name;

    /**
     * @var string|null $last_name Contact's last name
     */
    public ?string $last_name = null;

    /**
     * @var int|null $user_id Contact's user identifier in Telegram. This number may have more than 32 significant bits
     *     and some programming languages may have difficulty/silent defects in interpreting it. But it has at most 52
     *     significant bits, so a 64-bit integer or double-precision float type are safe for storing this identifier.
     */
    public ?int $user_id = null;

    /**
     * @var string|null $vcard Additional data about the contact in the form of a <a
     *     href="https://en.wikipedia.org/wiki/VCard">vCard</a>
     */
    public ?string $vcard = null;

    public static function makeByArray(array $data): self
    {
        $result = new self;
        $result->phone_number = $data['phone_number'];
        $result->first_name = $data['first_name'];
        $result->last_name = $data['last_name'] ?? null;
        $result->user_id = $data['user_id'] ?? null;
        $result->vcard = $data['vcard'] ?? null;
        return $result;
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
