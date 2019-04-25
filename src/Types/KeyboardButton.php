<?php

namespace TelegramBotsApi\Types;

use \TelegramBotsApi;
use \TelegramBotsApi\Exceptions\Error;

/**
 * Instance of this object represents one button of the reply keyboard. For simple text buttons String can be used instead of this object to specify text of the button. Optional fields are mutually exclusive.
 * @package TelegramBotsApi\Types
 * @author Maxim Kuvardin <kuvard.in@mail.ru>
 */
class KeyboardButton implements TypeInterface
{
    /**
     * @var string Text of the button. If none of the optional fields are used, it will be sent as a message when the button is pressed
     */
    public $text;

    /**
     * @var bool|null If True, the user's phone number will be sent as a contact when the button is pressed. Available in private chats only
     */
    public $request_contact;

    /**
     * @var bool|null If True, the user's current location will be sent when the button is pressed. Available in private chats only
     */
    public $request_location;

    /**
     * KeyboardButton constructor.
     * @param array $data
     */
    public function __construct(array $data)
    {
        $this->text = $data['text'];
        $this->request_contact = $data['request_contact'] ?? null;
        $this->request_location = $data['request_location'] ?? null;
    }

    /**
     * @return array
     */
    public function getRequestArray(): array
    {
        return [
            'text' => $this->text,
            'request_contact' => $this->request_contact,
            'request_location' => $this->request_location,
        ];
    }

    /**
     * @param string $text
     * @return KeyboardButton
     */
    public static function make(string $text): self
    {
        return new self([
            'text' => $text,
        ]);
    }
}