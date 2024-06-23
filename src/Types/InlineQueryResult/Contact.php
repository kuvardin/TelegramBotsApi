<?php

declare(strict_types=1);

namespace Kuvardin\TelegramBotsApi\Types\InlineQueryResult;

use JetBrains\PhpStorm\Deprecated;
use Kuvardin\TelegramBotsApi\Types\InlineKeyboardMarkup;
use Kuvardin\TelegramBotsApi\Types\InlineQueryResult;
use Kuvardin\TelegramBotsApi\Types\InputMessageContent;
use RuntimeException;

/**
 * Represents a contact with a phone number. By default, this contact will be sent by the user. Alternatively, you can
 * use "input_message_content" to send a message with the specified content instead of the contact.
 *
 * @package Kuvardin\TelegramBotsApi
 * @author Maxim Kuvardin <maxim@kuvard.in>
 */
class Contact extends InlineQueryResult
{
    /**
     * @param string $id Unique identifier for this result, 1-64 Bytes
     * @param string $phone_number Contact's phone number
     * @param string $first_name Contact's first name
     * @param string|null $last_name Contact's last name
     * @param string|null $vcard Additional data about the contact in the form of a vCard, 0-2048 bytes
     * @param InlineKeyboardMarkup|null $reply_markup Inline keyboard attached to the message
     * @param InputMessageContent|null $input_message_content Content of the message to be sent instead of the contact
     * @param string|null $thumbnail_url Url of the thumbnail for the result
     * @param int|null $thumbnail_width Thumbnail width
     * @param int|null $thumbnail_height Thumbnail height
     */
    public function __construct(
        public string $id,
        public string $phone_number,
        public string $first_name,
        public ?string $last_name = null,
        public ?string $vcard = null,
        public ?InlineKeyboardMarkup $reply_markup = null,
        public ?InputMessageContent $input_message_content = null,
        public ?string $thumbnail_url = null,
        public ?int $thumbnail_width = null,
        public ?int $thumbnail_height = null,

        #[Deprecated] public ?string $thumb_url = null,
        #[Deprecated] public ?int $thumb_width = null,
        #[Deprecated] public ?int $thumb_height = null,
    )
    {
        $this->thumb_url ??= $this->thumbnail_url;
        $this->thumbnail_url ??= $this->thumb_url;

        $this->thumb_width ??= $this->thumbnail_width;
        $this->thumbnail_width ??= $this->thumb_width;

        $this->thumb_height ??= $this->thumbnail_height;
        $this->thumbnail_height ??= $this->thumb_height;
    }

    public static function getType(): string
    {
        return 'contact';
    }

    public static function makeByArray(array $data): static
    {
        if ($data['type'] !== self::getType()) {
            throw new RuntimeException("Wrong inline query result type: {$data['type']}");
        }

        return new self(
            id: $data['id'],
            phone_number: $data['phone_number'],
            first_name: $data['first_name'],
            last_name: $data['last_name'] ?? null,
            vcard: $data['vcard'] ?? null,
            reply_markup: isset($data['reply_markup'])
                ? InlineKeyboardMarkup::makeByArray($data['reply_markup'])
                : null,
            input_message_content: isset($data['input_message_content'])
                ? InputMessageContent::makeByArray($data['input_message_content'])
                : null,
            thumbnail_url: $data['thumbnail_url'] ?? null,
            thumbnail_width: $data['thumbnail_width'] ?? null,
            thumbnail_height: $data['thumbnail_height'] ?? null,
        );
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
            'thumbnail_url' => $this->thumbnail_url,
            'thumbnail_width' => $this->thumbnail_width,
            'thumbnail_height' => $this->thumbnail_height,
        ];
    }
}
