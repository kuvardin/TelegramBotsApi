<?php

namespace TelegramBotsApi\Types\InlineQueryResult;

use \TelegramBotsApi;
use \TelegramBotsApi\Exceptions\Error;

/**
 * Represents a contact with a phone number. By default, this contact will be sent by the user. Alternatively, you can use input_message_content to send a message with the specified content instead of the contact.
 * @package TelegramBotsApi\Types\InlineQueryResult
 * @author Maxim Kuvardin <kuvard.in@mail.ru>
 */
class Contact extends TelegramBotsApi\Types\InlineQueryResult implements TelegramBotsApi\Types\TypeInterface
{
    public const TYPE = TelegramBotsApi\Types\InlineQueryResult::TYPE_CONTACT;

    /**
     * @var string Type of the result, must be self::TYPE
     */
    public $type = self::TYPE;

    /**
     * @var string Unique identifier for this result, 1-64 Bytes
     */
    public $id;

    /**
     * @var string Contact&#39;s phone number
     */
    public $phone_number;

    /**
     * @var string Contact&#39;s first name
     */
    public $first_name;

    /**
     * @var string|null Contact&#39;s last name
     */
    public $last_name;

    /**
     * @var string|null Additional data about the contact in the form of a vCard, 0-2048 bytes
     */
    public $vcard;

    /**
     * @var TelegramBotsApi\Types\InlineKeyboardMarkup|null Inline keyboard attached to the message
     */
    public $reply_markup;

    /**
     * @var TelegramBotsApi\Types\InputMessageContent|null Content of the message to be sent instead of the contact
     */
    public $input_message_content;

    /**
     * @var string|null Url of the thumbnail for the result
     */
    public $thumb_url;

    /**
     * @var int|null Thumbnail width
     */
    public $thumb_width;

    /**
     * @var int|null Thumbnail height
     */
    public $thumb_height;

    /**
     * Contact constructor.
     * @param array $data
     * @throws Error
     */
    public function __construct(array $data)
    {
        if (isset($data['type'])) {
            if ($data['type'] !== self::TYPE) {
                throw new Error("Unknown type: {$data['type']}. Type must be self::TYPE.");
            }
            $this->type = $data['type'];
        }

        $this->id = $data['id'];
        $this->phone_number = $data['phone_number'];
        $this->first_name = $data['first_name'];
        $this->last_name = $data['last_name'] ?? null;
        $this->vcard = $data['vcard'] ?? null;

        if (isset($data['reply_markup'])) {
            $this->reply_markup = $data['reply_markup'] instanceof TelegramBotsApi\Types\InlineKeyboardMarkup ? $data['reply_markup'] : new TelegramBotsApi\Types\InlineKeyboardMarkup($data['reply_markup']);
        }

        if (isset($data['input_message_content'])) {
            $this->input_message_content = $data['input_message_content'] instanceof TelegramBotsApi\Types\InputMessageContent ? $data['input_message_content'] : TelegramBotsApi\Types\InputMessageContent::new($data['input_message_content']);
        }

        $this->thumb_url = $data['thumb_url'] ?? null;
        $this->thumb_width = $data['thumb_width'] ?? null;
        $this->thumb_height = $data['thumb_height'] ?? null;
    }

    /**
     * @return array
     */
    public function getRequestArray(): array
    {
        return [
            'type' => $this->type,
            'id' => $this->id,
            'phone_number' => $this->phone_number,
            'first_name' => $this->first_name,
            'last_name' => $this->last_name,
            'vcard' => $this->vcard,
            'reply_markup' => $this->reply_markup,
            'input_message_content' => $this->input_message_content,
            'thumb_url' => $this->thumb_url,
            'thumb_width' => $this->thumb_width,
            'thumb_height' => $this->thumb_height,
        ];
    }

    /**
     * @param string $id
     * @param string $phone_number
     * @param string $first_name
     * @return Contact
     * @throws Error
     */
    public static function make(string $id, string $phone_number, string $first_name): self
    {
        return new self([
            'id' => $id,
            'phone_number' => $phone_number,
            'first_name' => $first_name,
        ]);
    }
}