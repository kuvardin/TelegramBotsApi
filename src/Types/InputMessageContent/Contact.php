<?php declare(strict_types=1);

namespace TelegramBotsApi\Types\InputMessageContent;

use TelegramBotsApi;
use TelegramBotsApi\Types;

/**
 * Represents the content of a contact message to be sent as the result of an inline query.
 *
 * @package TelegramBotsApi
 * @author Maxim Kuvardin <maxim@kuvard.in>
 */
class Contact extends Types\InputMessageContent implements Types\TypeInterface
{
    public const TYPE = Types\InputMessageContent::TYPE_CONTACT;

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
     * @var string|null Additional data about the contact in the form of a vCard, 0-2048 bytes
     */
    public ?string $vcard = null;

    /**
     * Contact constructor.
     *
     * @param array $data
     */
    public function __construct(array $data)
    {
        parent::__construct($data);

        $this->phone_number = $data['phone_number'];
        $this->first_name = $data['first_name'];

        if (isset($data['last_name'])) {
            $this->last_name = $data['last_name'];
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
            'vcard' => $this->vcard,
        ];
    }
}