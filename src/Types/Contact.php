<?php

namespace TelegramBotsApi\Types;

use \TelegramBotsApi;
use \TelegramBotsApi\Exceptions\Error;

/**
 * Instance of thhis object represents a phone contact
 * @package TelegramBotsApi\Types
 * @author Maxim Kuvardin <kuvard.in@mail.ru>
 */
class Contact implements TypeInterface
{

    /**
     * @var string Contact's phone number
     */
    public $phone_number;

    /**
     * @var string Contact's first name
     */
    public $first_name;

    /**
     * @var string|null Contact's last name
     */
    public $last_name;

    /**
     * @var int|null Contact's user identifier in Telegram
     */
    public $user_id;

    /**
     * @var string|null Additional data about the contact in the form of a vCard
     */
    public $vcard;

    /**
     * Contact constructor.
     * @param array $data
     */
    public function __construct(array $data)
    {
        $this->phone_number = $data['phone_number'];
        $this->first_name = $data['first_name'];
        $this->last_name = $data['last_name'] ?? null;
        $this->user_id = $data['user_id'] ?? null;
        $this->vcard = $data['vcard'] ?? null;
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

    /**
     * @param string $phone_number
     * @param string $first_name
     * @return Contact
     */
    public static function make(string $phone_number, string $first_name): self
    {
        return new self([
            'phone_number' => $phone_number,
            'first_name' => $first_name,
        ]);
    }
}