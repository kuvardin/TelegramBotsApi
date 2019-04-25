<?php

namespace TelegramBotsApi\Types\InlineQueryResult;

use \TelegramBotsApi;
use \TelegramBotsApi\Exceptions\Error;

/**
 * Represents a link to an animated GIF file. By default, this animated GIF file will be sent by the user with optional caption. Alternatively, you can use input_message_content to send a message with the specified content instead of the animation.
 * @package TelegramBotsApi\Types\InlineQueryResult
 * @author Maxim Kuvardin <kuvard.in@mail.ru>
 */
class Gif extends TelegramBotsApi\Types\InlineQueryResult implements TelegramBotsApi\Types\TypeInterface
{
    public const TYPE = TelegramBotsApi\Types\InlineQueryResult::TYPE_GIF;

    /**
     * @var string Type of the result, must be self::TYPE
     */
    public $type = self::TYPE;

    /**
     * @var string Unique identifier for this result, 1-64 Bytes
     */
    public $id;

    /**
     * @var string A valid URL for the GIF file. File size must not exceed 1MB
     */
    public $gif_url;

    /**
     * @var int|null Width of the GIF
     */
    public $gif_width;

    /**
     * @var int|null Height of the GIF
     */
    public $gif_height;

    /**
     * @var int|null Duration of the GIF
     */
    public $gif_duration;

    /**
     * @var string URL of the static thumbnail for the result (jpeg or gif)
     */
    public $thumb_url;

    /**
     * @var string|null Title for the result
     */
    public $title;

    /**
     * @var string|null Caption of the GIF file to be sent, 0-1024 characters
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
     * @var TelegramBotsApi\Types\InputMessageContent|null Content of the message to be sent instead of the GIF animation
     */
    public $input_message_content;

    /**
     * Gif constructor.
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
        $this->gif_url = $data['gif_url'];
        $this->gif_width = $data['gif_width'] ?? null;
        $this->gif_height = $data['gif_height'] ?? null;
        $this->gif_duration = $data['gif_duration'] ?? null;
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
            'gif_url' => $this->gif_url,
            'gif_width' => $this->gif_width,
            'gif_height' => $this->gif_height,
            'gif_duration' => $this->gif_duration,
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
     * @param string $gif_url
     * @param string $thumb_url
     * @return Gif
     * @throws Error
     */
    public static function make(string $id, string $gif_url, string $thumb_url): self
    {
        return new self([
            'id' => $id,
            'gif_url' => $gif_url,
            'thumb_url' => $thumb_url,
        ]);
    }
}