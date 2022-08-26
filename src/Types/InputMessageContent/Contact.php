<?php

declare(strict_types=1);

namespace Kuvardin\TelegramBotsApi\Types\InputMessageContent;

use Kuvardin\TelegramBotsApi\Types\InputMessageContent;

/**
 * Represents the <a href="https://core.telegram.org/bots/api#inputmessagecontent">content</a> of a contact message to
 * be sent as the result of an inline query.
 *
 * @package Kuvardin\TelegramBotsApi
 * @author Maxim Kuvardin <maxim@kuvard.in>
 */
class Contact extends InputMessageContent
{
    /**
     * @param string $phone_number Contact's phone number
     * @param string $first_name Contact's first name
     * @param string|null $last_name Contact's last name
     * @param string|null $vcard Additional data about the contact in the form of a <a
     *     href="https://en.wikipedia.org/wiki/VCard">vCard</a>, 0-2048 bytes
     */
    public function __construct(
        public string $phone_number,
        public string $first_name,
        public ?string $last_name = null,
        public ?string $vcard = null,
    )
    {

    }

    public static function makeByArray(array $data): static
    {
        return new self(
            phone_number: $data['phone_number'],
            first_name: $data['first_name'],
            last_name: $data['last_name'] ?? null,
            vcard: $data['vcard'] ?? null,
        );
    }

    public function getRequestData(): array
    {
        return [
            'phone_number' => $this->phone_number,
            'first_name' => $this->first_name,
            'last_name' => $this->last_name,
            'vcard' => $this->vcard,
        ];
    }
}
