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
     * @var string|null $vcard Additional data about the contact in the form of a <a
     *     href="https://en.wikipedia.org/wiki/VCard">vCard</a>, 0-2048 bytes
     */
    public ?string $vcard = null;

    public static function makeByArray(array $data): static
    {
        $result = new self;
        $result->phone_number = $data['phone_number'];
        $result->first_name = $data['first_name'];
        $result->last_name = $data['last_name'] ?? null;
        $result->vcard = $data['vcard'] ?? null;
        return $result;
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
