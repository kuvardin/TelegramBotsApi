<?php

declare(strict_types=1);

namespace Kuvardin\TelegramBotsApi\Types;

/**
 * This object represents a phone contact.
 *
 * @package Kuvardin\TelegramBotsApi
 * @author Maxim Kuvardin <maxim@kuvard.in>
 */
class Contact implements TypeInterface
{
    /**
     * @var string Contact's phone number
     */
    public string $phone_number;

    /**
     * @var string Contact's first name
     */
    public string $first_name;

    /**
     * @var string|null Contact's last name
     */
    public ?string $last_name = null;

    /**
     * @var int|null Contact's user identifier in Telegram
     */
    public ?int $user_id = null;

    /**
     * @var string|null Additional data about the contact in the form of a vCard
     */
    public ?string $vcard = null;

    /**
     * Contact constructor.
     *
     * @param array $data
     */
    public function __construct(array $data)
    {
        $this->phone_number = $data['phone_number'];
        $this->first_name = $data['first_name'];

        if (isset($data['last_name'])) {
            $this->last_name = $data['last_name'];
        }

        if (isset($data['user_id'])) {
            $this->user_id = $data['user_id'];
        }

        if (isset($data['vcard'])) {
            $this->vcard = $data['vcard'];
        }
    }

    /**
     * @param string $phone_number Contact's phone number
     * @param string $first_name Contact's first name
     * @return Contact
     */
    public static function make(string $phone_number, string $first_name): self
    {
        return new self([
            'phone_number' => $phone_number,
            'first_name' => $first_name,
        ]);
    }

    /**
     * @return array
     */
    public function getRequestArray(): array
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
