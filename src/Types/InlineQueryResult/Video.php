<?php declare(strict_types=1);

namespace TelegramBotsApi\Types\InlineQueryResult;

use TelegramBotsApi;
use TelegramBotsApi\Exceptions\Error;
use TelegramBotsApi\Types;
use TelegramBotsApi\Types\InlineQueryResult;

/**
 * Represents a link to a page containing an embedded video player or a video file. By default, this video file
 * will be sent by the user with an optional caption. Alternatively, you can use input_message_content to send
 * a message with the specified content instead of the video.
 *
 * @package TelegramBotsApi
 * @author Maxim Kuvardin <maxim@kuvard.in>
 */
class Video extends InlineQueryResult implements TelegramBotsApi\Types\TypeInterface
{
    public const TYPE = InlineQueryResult::TYPE_VIDEO;

    /**
     * @var string Unique identifier for this result, 1-64 bytes
     */
    public string $id;

    /**
     * @var string A valid URL for the embedded video player or video file
     */
    public string $video_url;

    /**
     * @var string Mime type of the content of video url, “text/html” or “video/mp4”
     */
    public string $mime_type;

    /**
     * @var string URL of the thumbnail (jpeg only) for the video
     */
    public string $thumb_url;

    /**
     * @var string Title for the result
     */
    public string $title;

    /**
     * @var string|null Caption of the video to be sent, 0-1024 characters
     */
    public ?string $caption = null;

    /**
     * @var string|null Send Markdown or HTML, if you want Telegram apps to show bold, italic, fixed-width text or inline URLs in the media caption.
     */
    public ?string $parse_mode = null;

    /**
     * @var int|null Video width
     */
    public ?int $video_width = null;

    /**
     * @var int|null Video height
     */
    public ?int $video_height = null;

    /**
     * @var int|null Video duration in seconds
     */
    public ?int $video_duration = null;

    /**
     * @var string|null Short description of the result
     */
    public ?string $description = null;

    /**
     * @var Types\InlineKeyboardMarkup|null Inline keyboard attached to the message
     */
    public ?Types\InlineKeyboardMarkup $reply_markup;

    /**
     * @var Types\InputMessageContent|null Content of the message to be sent instead of the video. This field is required if InlineQueryResultVideo is used to send an HTML-page as a result (e.g., a YouTube video).
     */
    public ?Types\InputMessageContent $input_message_content;

    /**
     * Video constructor.
     *
     * @param array $data
     * @throws Error
     */
    public function __construct(array $data)
    {
        parent::__construct($data);

        if ($data['type'] !== self::TYPE) {
            throw new Error("Unknown type: {$data['type']} (must be self::TYPE)");
        }

        $this->id = $data['id'];
        $this->video_url = $data['video_url'];
        $this->mime_type = $data['mime_type'];
        $this->thumb_url = $data['thumb_url'];
        $this->title = $data['title'];

        if (isset($data['caption'])) {
            $this->caption = $data['caption'];
        }

        if (isset($data['parse_mode'])) {
            $this->parse_mode = $data['parse_mode'];
        }

        if (isset($data['video_width'])) {
            $this->video_width = $data['video_width'];
        }

        if (isset($data['video_height'])) {
            $this->video_height = $data['video_height'];
        }

        if (isset($data['video_duration'])) {
            $this->video_duration = $data['video_duration'];
        }

        if (isset($data['description'])) {
            $this->description = $data['description'];
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
     * @param string $video_url A valid URL for the embedded video player or video file
     * @param string $mime_type Mime type of the content of video url, “text/html” or “video/mp4”
     * @param string $thumb_url URL of the thumbnail (jpeg only) for the video
     * @param string $title Title for the result
     * @return self
     * @throws Error
     */
    public static function make(string $id, string $video_url, string $mime_type, string $thumb_url, string $title): self
    {
        return new self([
            'type' => self::TYPE,
            'id' => $id,
            'video_url' => $video_url,
            'mime_type' => $mime_type,
            'thumb_url' => $thumb_url,
            'title' => $title,
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
            'video_url' => $this->video_url,
            'mime_type' => $this->mime_type,
            'thumb_url' => $this->thumb_url,
            'title' => $this->title,
            'caption' => $this->caption,
            'parse_mode' => $this->parse_mode,
            'video_width' => $this->video_width,
            'video_height' => $this->video_height,
            'video_duration' => $this->video_duration,
            'description' => $this->description,
            'reply_markup' => $this->reply_markup,
            'input_message_content' => $this->input_message_content,
        ];
    }
}