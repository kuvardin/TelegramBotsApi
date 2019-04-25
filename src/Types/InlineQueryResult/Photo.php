<?php

namespace TelegramBotsApi\Types\InlineQueryResult;

use \TelegramBotsApi;
use \TelegramBotsApi\Exceptions\Error;

/**
 * Represents a link to a photo. By default, this photo will be sent by the user with optional caption. Alternatively, you can use input_message_content to send a message with the specified content instead of the photo.
 * @package TelegramBotsApi\Types\InlineQueryResult
 * @author Maxim Kuvardin <kuvard.in@mail.ru>
 */
class Photo extends TelegramBotsApi\Types\InlineQueryResult implements TelegramBotsApi\Types\TypeInterface
{
    public const TYPE = TelegramBotsApi\Types\InlineQueryResult::TYPE_PHOTO;

    /**
     * @var string Type of the result, must be self::TYPE
     */
    public $type = self::TYPE;

    /**
     * @var string Unique identifier for this result, 1-64 Bytes
     */
    public $id;

    /**
     * @var string A valid URL of the photo. Photo must be in jpeg format. Photo size must not exceed 5MB
     */
    public $photo_url;

    /**
     * @var string URL of the thumbnail for the photo
     */
    public $thumb_url;

    /**
     * @var int|null Width of the photo
     */
    public $photo_width;

    /**
     * @var int|null Height of the photo
     */
    public $photo_height;

    /**
     * @var string|null Title for the result
     */
    public $title;

    /**
     * @var string|null Short description of the result
     */
    public $description;

    /**
     * @var string|null Caption of the photo to be sent, 0-1024 characters
     */
    public $caption;

    /**
     * @var string|null Send Markdown or HTML, if you want Telegram apps to show bold, italic, fixed-width text or inline URLs in the media caption.
     */
    public $parse_mode;

    /**
     * @var TelegramBotsApi\Types\InlineKeyboardMarkup|null Inline keyboard attached to the message
     */
    public $reply_markup;

    /**
     * @var TelegramBotsApi\Types\InputMessageContent|null Content of the message to be sent instead of the photo
     */
    public $input_message_content;

    /**
     * Photo constructor.
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
        $this->photo_url = $data['photo_url'];
        $this->thumb_url = $data['thumb_url'];
        $this->photo_width = $data['photo_width'] ?? null;
        $this->photo_height = $data['photo_height'] ?? null;
        $this->title = $data['title'] ?? null;
        $this->description = $data['description'] ?? null;
        $this->caption = $data['caption'] ?? null;

        if (isset($data['parse_mode'])) {
            if (!TelegramBotsApi\Bot::checkParseMode($data['parse_mode'])) {
                throw new Error("Unknown parse mode: {$data['parse_mode']}");
            }
            $this->parse_mode = $data['parse_mode'];
        }

        if (isset($data['reply_markup'])) {
            $this->reply_markup = $data['reply_markup'] instanceof TelegramBotsApi\Types\InlineKeyboardMarkup ? $data['reply_markup'] : new TelegramBotsApi\Types\InlineKeyboardMarkup($data['reply_markup']);
        }

        if (isset($data['input_message_content'])) {
            $this->input_message_content = $data['input_message_content'] instanceof TelegramBotsApi\Types\InputMessageContent ? $data['input_message_content'] : TelegramBotsApi\Types\InputMessageContent::new($data['input_message_content']);
        }
    }

    /**
     * @return array
     */
    public function getRequestArray(): array
    {
        return [
            'type' => $this->type,
            'id' => $this->id,
            'photo_url' => $this->photo_url,
            'thumb_url' => $this->thumb_url,
            'photo_width' => $this->photo_width,
            'photo_height' => $this->photo_height,
            'title' => $this->title,
            'description' => $this->description,
            'caption' => $this->caption,
            'parse_mode' => $this->parse_mode,
            'reply_markup' => $this->reply_markup,
            'input_message_content' => $this->input_message_content,
        ];
    }

    /**
     * @param string $id
     * @param string $photo_url
     * @param string $thumb_url
     * @return Photo
     * @throws Error
     */
    public static function make(string $id, string $photo_url, string $thumb_url): self
    {
        return new self([
            'id' => $id,
            'photo_url' => $photo_url,
            'thumb_url' => $thumb_url,
        ]);
    }
}