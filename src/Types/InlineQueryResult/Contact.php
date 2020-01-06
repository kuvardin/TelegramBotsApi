<?php declare(strict_types=1);

namespace TelegramBotsApi\Types\InlineQueryResult;

use TelegramBotsApi;
use TelegramBotsApi\Exceptions\Error;
use TelegramBotsApi\Types;
use TelegramBotsApi\Types\InlineQueryResult;

/**
 * Represents a contact with a phone number. By default, this contact will be sent by the user. Alternatively,
 * you can use input_message_content to send a message with the specified content instead of the contact.
 *
 * @package TelegramBotsApi
 * @author Maxim Kuvardin <maxim@kuvard.in>
 */
class Contact extends InlineQueryResult implements TelegramBotsApi\Types\TypeInterface
{
    public const TYPE = InlineQueryResult::TYPE_CONTACT;

    /**
     * @var string Unique identifier for this result, 1-64 Bytes
     */
    public string $id;

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
     * @var Types\InlineKeyboardMarkup|null Inline keyboard attached to the message
     */
    public ?Types\InlineKeyboardMarkup $reply_markup = null;

    /**
     * @var Types\InputMessageContent|null Content of the message to be sent instead of the contact
     */
    public ?Types\InputMessageContent $input_message_content = null;

    /**
     * @var string|null Url of the thumbnail for the result
     */
    public ?string $thumb_url = null;

    /**
     * @var int|null Thumbnail width
     */
    public ?int $thumb_width = null;

    /**
     * @var int|null Thumbnail height
     */
    public ?int $thumb_height = null;

    /**
     * Contact constructor.
     *
     * @param array $data
     * @throws Error
     */
    public function __construct(array $data)
    {
        parent::__construct($data);

        if ($data['type'] !== self::TYPE) {
            throw new Error("Unknown type: {$data['type']} (must be self::TYPE");
        }

        $this->id = $data['id'];
        $this->phone_number = $data['phone_number'];
        $this->first_name = $data['first_name'];

        if (isset($data['last_name'])) {
            $this->last_name = $data['last_name'];
        }

        if (isset($data['vcard'])) {
            $this->vcard = $data['vcard'];
        }

        if (isset($data['reply_markup'])) {
            $this->reply_markup = $data['reply_markup'] instanceof Types\InlineKeyboardMarkup
                ? $data['reply_markup']
                : new Types\InlineKeyboardMarkup($data['reply_markup']);
        }

        if (isset($data['input_message_content'])) {
            $this->input_message_content = $data['input_message_content'] instanceof Types\InputMessageContent
                ? $data['input_message_content']
                : Types\InputMessageContent::constructChild($data['input_message_content']);
        }

        if (isset($data['thumb_url'])) {
            $this->thumb_url = $data['thumb_url'];
        }

        if (isset($data['thumb_width'])) {
            $this->thumb_width = $data['thumb_width'];
        }

        if (isset($data['thumb_height'])) {
            $this->thumb_height = $data['thumb_height'];
        }
    }

    /**
     * @param string $id Unique identifier for this result, 1-64 Bytes
     * @param string $phone_number Contact's phone number
     * @param string $first_name Contact's first name
     * @return self
     * @throws Error
     */
    public static function make(string $id, string $phone_number, string $first_name): self
    {
        return new self([
            'type' => self::TYPE,
            'id' => $id,
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
            'type' => self::TYPE,
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
}