<?php

declare(strict_types=1);

namespace Kuvardin\TelegramBotsApi\Types\InlineQueryResult;

use Kuvardin\TelegramBotsApi\Types\InlineKeyboardMarkup;
use Kuvardin\TelegramBotsApi\Types\InlineQueryResult;
use Kuvardin\TelegramBotsApi\Types\InputMessageContent;
use RuntimeException;

/**
 * Represents a contact with a phone number. By default, this contact will be sent by the user. Alternatively, you can
 * use <em>input_message_content</em> to send a message with the specified content instead of the contact.
 *
 * @package Kuvardin\TelegramBotsApi
 * @author Maxim Kuvardin <maxim@kuvard.in>
 */
class Contact extends InlineQueryResult
{
    /**
     * @var string $id Unique identifier for this result, 1-64 Bytes
     */
    public string $id;

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

    /**
     * @var InlineKeyboardMarkup|null $reply_markup <a
     *     href="https://core.telegram.org/bots#inline-keyboards-and-on-the-fly-updating">Inline keyboard</a> attached
     *     to the message
     */
    public ?InlineKeyboardMarkup $reply_markup = null;

    /**
     * @var InputMessageContent|null $input_message_content Content of the message to be sent instead of the contact
     */
    public ?InputMessageContent $input_message_content = null;

    /**
     * @var string|null $thumb_url Url of the thumbnail for the result
     */
    public ?string $thumb_url = null;

    /**
     * @var int|null $thumb_width Thumbnail width
     */
    public ?int $thumb_width = null;

    /**
     * @var int|null $thumb_height Thumbnail height
     */
    public ?int $thumb_height = null;

    public static function getType(): string
    {
        return 'contact';
    }

    public static function makeByArray(array $data): static
    {
        $result = new self;

        if ($data['type'] !== self::getType()) {
            throw new RuntimeException("Wrong inline query result type: {$data['type']}");
        }

        $result->id = $data['id'];
        $result->phone_number = $data['phone_number'];
        $result->first_name = $data['first_name'];
        $result->last_name = $data['last_name'] ?? null;
        $result->vcard = $data['vcard'] ?? null;
        $result->reply_markup = isset($data['reply_markup'])
            ? InlineKeyboardMarkup::makeByArray($data['reply_markup'])
            : null;
        $result->input_message_content = isset($data['input_message_content'])
            ? InputMessageContent::makeByArray($data['input_message_content'])
            : null;
        $result->thumb_url = $data['thumb_url'] ?? null;
        $result->thumb_width = $data['thumb_width'] ?? null;
        $result->thumb_height = $data['thumb_height'] ?? null;
        return $result;
    }

    public function getRequestData(): array
    {
        return [
            'type' => self::getType(),
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
