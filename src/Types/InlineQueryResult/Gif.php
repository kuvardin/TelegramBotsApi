<?php

declare(strict_types=1);

namespace Kuvardin\TelegramBotsApi\Types\InlineQueryResult;

use Kuvardin\TelegramBotsApi;
use Kuvardin\TelegramBotsApi\Exceptions\Error;
use Kuvardin\TelegramBotsApi\Types;
use Kuvardin\TelegramBotsApi\Types\InlineQueryResult;

/**
 * Represents a link to an animated GIF file. By default, this animated GIF file will be sent by the user with
 * optional caption. Alternatively, you can use input_message_content to send a message with the specified
 * content instead of the animation.
 *
 * @package Kuvardin\TelegramBotsApi
 * @author Maxim Kuvardin <maxim@kuvard.in>
 */
class Gif extends InlineQueryResult implements TelegramBotsApi\Types\TypeInterface
{
    public const TYPE = InlineQueryResult::TYPE_GIF;

    /**
     * @var string Unique identifier for this result, 1-64 bytes
     */
    public string $id;

    /**
     * @var string A valid URL for the GIF file. File size must not exceed 1MB
     */
    public string $gif_url;

    /**
     * @var int|null Width of the GIF
     */
    public ?int $gif_width = null;

    /**
     * @var int|null Height of the GIF
     */
    public ?int $gif_height = null;

    /**
     * @var int|null Duration of the GIF
     */
    public ?int $gif_duration = null;

    /**
     * @var string URL of the static thumbnail for the result (jpeg or gif)
     */
    public string $thumb_url;

    /**
     * @var string|null Title for the result
     */
    public ?string $title = null;

    /**
     * @var string|null Caption of the GIF file to be sent, 0-1024 characters
     */
    public ?string $caption = null;

    /**
     * @var string|null Send Markdown or HTML, if you want Telegram apps to show bold, italic, fixed-width text or
     *     inline URLs in the media caption.
     */
    public ?string $parse_mode = null;

    /**
     * @var Types\InlineKeyboardMarkup|null Inline keyboard attached to the message
     */
    public ?Types\InlineKeyboardMarkup $reply_markup = null;

    /**
     * @var Types\InputMessageContent|null Content of the message to be sent instead of the GIF animation
     */
    public ?Types\InputMessageContent $input_message_content = null;

    /**
     * Gif constructor.
     *
     * @param array $data
     */
    public function __construct(array $data)
    {
        parent::__construct($data);

        if ($data['type'] !== self::TYPE) {
            throw new Error("Unknown type: {$data['type']} (must be self::TYPE)");
        }

        $this->id = $data['id'];
        $this->gif_url = $data['gif_url'];

        if (isset($data['gif_width'])) {
            $this->gif_width = $data['gif_width'];
        }

        if (isset($data['gif_height'])) {
            $this->gif_height = $data['gif_height'];
        }

        if (isset($data['gif_duration'])) {
            $this->gif_duration = $data['gif_duration'];
        }

        $this->thumb_url = $data['thumb_url'];
        if (isset($data['title'])) {
            $this->title = $data['title'];
        }

        if (isset($data['caption'])) {
            $this->caption = $data['caption'];
        }

        if (isset($data['parse_mode'])) {
            $this->parse_mode = $data['parse_mode'];
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
    }

    /**
     * @param string $id Unique identifier for this result, 1-64 bytes
     * @param string $gif_url A valid URL for the GIF file. File size must not exceed 1MB
     * @param string $thumb_url URL of the static thumbnail for the result (jpeg or gif)
     * @return self
     */
    public static function make(string $id, string $gif_url, string $thumb_url): self
    {
        return new self([
            'type' => self::TYPE,
            'id' => $id,
            'gif_url' => $gif_url,
            'thumb_url' => $thumb_url,
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
}
