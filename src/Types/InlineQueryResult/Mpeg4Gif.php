<?php

namespace TelegramBotsApi\Types\InlineQueryResult;

use \TelegramBotsApi;
use \TelegramBotsApi\Exceptions\Error;

class Mpeg4Gif extends TelegramBotsApi\Types\InlineQueryResult implements TelegramBotsApi\Types\TypeInterface
{
    public const TYPE = TelegramBotsApi\Types\InlineQueryResult::TYPE_MPEG4_GIF;

    /**
     * @var string Type of the result, must be self::TYPE
     */
    public $type = self::TYPE;

    /**
     * @var string Unique identifier for this result, 1-64 bytes
     */
    public $id;

    /**
     * @var string A valid URL for the MP4 file. File size must not exceed 1MB
     */
    public $mpeg4_url;

    /**
     * @var int|null Video width
     */
    public $mpeg4_width;

    /**
     * @var int|null Video height
     */
    public $mpeg4_height;

    /**
     * @var int|null Video duration
     */
    public $mpeg4_duration;

    /**
     * @var string URL of the static thumbnail (jpeg or gif) for the result
     */
    public $thumb_url;

    /**
     * @var string|null Title for the result
     */
    public $title;

    /**
     * @var string|null Caption of the MPEG-4 file to be sent, 0-1024 characters
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
     * @var TelegramBotsApi\Types\InputMessageContent|null Content of the message to be sent instead of the video animation
     */
    public $input_message_content;

    /**
     * Mpeg4Gif constructor.
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
        $this->mpeg4_url = $data['mpeg4_url'];
        $this->mpeg4_width = $data['mpeg4_width'] ?? null;
        $this->mpeg4_height = $data['mpeg4_height'] ?? null;
        $this->mpeg4_duration = $data['mpeg4_duration'] ?? null;
        $this->thumb_url = $data['thumb_url'];
        $this->title = $data['title'] ?? null;
        $this->caption = $data['caption'] ?? null;

        if (isset($data['parse_mode'])) {
            if (!TelegramBotsApi\Bot::checkParseMode($data['parse_mode'])) {
                throw new Error("Unknown parse mode: {$data['parse_mode']}");
            }
            $this->parse_mode = $data['parse_mode'];
        }

        if (isset($data['reply_markup'])) {
            $this->reply_markup = $data['reply_markup'] instanceof TelegramBotsApi\Types\InlineKeyboardMarkup ? $data['reply_markup'] : TelegramBotsApi\Types\InlineKeyboardMarkup($data['reply_markup']);
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
            'mpeg4_url' => $this->mpeg4_url,
            'mpeg4_width' => $this->mpeg4_width,
            'mpeg4_height' => $this->mpeg4_height,
            'mpeg4_duration' => $this->mpeg4_duration,
            'thumb_url' => $this->thumb_url,
            'title' => $this->title,
            'caption' => $this->caption,
            'parse_mode' => $this->parse_mode,
            'reply_markup' => $this->reply_markup,
            'input_message_content' => $this->input_message_content,
        ];
    }

    /**
     * @param string $id
     * @param string $mpeg4_url
     * @param string $thumb_url
     * @return Mpeg4Gif
     * @throws Error
     */
    public static function make(string $id, string $mpeg4_url, string $thumb_url): self
    {
        return new self([
            'id' => $id,
            'mpeg4_url' => $mpeg4_url,
            'thumb_url' => $thumb_url,
        ]);
    }
}