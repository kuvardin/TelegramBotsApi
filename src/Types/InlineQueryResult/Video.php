<?php

declare(strict_types=1);

namespace Kuvardin\TelegramBotsApi\Types\InlineQueryResult;

use Kuvardin\TelegramBotsApi\Types\InlineKeyboardMarkup;
use Kuvardin\TelegramBotsApi\Types\InlineQueryResult;
use Kuvardin\TelegramBotsApi\Types\InputMessageContent;
use Kuvardin\TelegramBotsApi\Types\MessageEntity;
use RuntimeException;

/**
 * Represents a link to a page containing an embedded video player or a video file. By default, this video file will be
 * sent by the user with an optional caption. Alternatively, you can use <em>input_message_content</em> to send a
 * message with the specified content instead of the video.<br><br>
 *
 * If an InlineQueryResultVideo message contains an embedded video (e.g., YouTube), you <strong>must</strong> replace
 * its content using <em>input_message_content</em>.
 *
 * @package Kuvardin\TelegramBotsApi
 * @author Maxim Kuvardin <maxim@kuvard.in>
 */
class Video extends InlineQueryResult
{
    /**
     * @var string $id Unique identifier for this result, 1-64 bytes
     */
    public string $id;

    /**
     * @var string $video_url A valid URL for the embedded video player or video file
     */
    public string $video_url;

    /**
     * @var string $mime_type Mime type of the content of video url, “text/html” or “video/mp4”
     */
    public string $mime_type;

    /**
     * @var string $thumb_url URL of the thumbnail (JPEG only) for the video
     */
    public string $thumb_url;

    /**
     * @var string $title Title for the result
     */
    public string $title;

    /**
     * @var string|null $caption Caption of the video to be sent, 0-1024 characters after entities parsing
     */
    public ?string $caption = null;

    /**
     * @var string|null $parse_mode Mode for parsing entities in the video caption. See <a
     *     href="https://core.telegram.org/bots/api#formatting-options">formatting options</a> for more details.
     */
    public ?string $parse_mode = null;

    /**
     * @var MessageEntity[]|null $caption_entities List of special entities that appear in the caption, which can be
     *     specified instead of <em>parse_mode</em>
     */
    public ?array $caption_entities = null;

    /**
     * @var int|null $video_width Video width
     */
    public ?int $video_width = null;

    /**
     * @var int|null $video_height Video height
     */
    public ?int $video_height = null;

    /**
     * @var int|null $video_duration Video duration in seconds
     */
    public ?int $video_duration = null;

    /**
     * @var string|null $description Short description of the result
     */
    public ?string $description = null;

    /**
     * @var InlineKeyboardMarkup|null $reply_markup <a
     *     href="https://core.telegram.org/bots#inline-keyboards-and-on-the-fly-updating">Inline keyboard</a> attached
     *     to the message
     */
    public ?InlineKeyboardMarkup $reply_markup = null;

    /**
     * @var InputMessageContent|null $input_message_content Content of the message to be sent instead of the video.
     *     This field is <strong>required</strong> if InlineQueryResultVideo is used to send an HTML-page as a result
     *     (e.g., a YouTube video).
     */
    public ?InputMessageContent $input_message_content = null;

    public static function getType(): string
    {
        return 'video';
    }

    public static function makeByArray(array $data): static
    {
        $result = new self;

        if ($data['type'] !== self::getType()) {
            throw new RuntimeException("Wrong inline query result type: {$data['type']}");
        }

        $result->id = $data['id'];
        $result->video_url = $data['video_url'];
        $result->mime_type = $data['mime_type'];
        $result->thumb_url = $data['thumb_url'];
        $result->title = $data['title'];
        $result->caption = $data['caption'] ?? null;
        $result->parse_mode = $data['parse_mode'] ?? null;
        if (isset($data['caption_entities'])) {
            $result->caption_entities = [];
            foreach ($data['caption_entities'] as $item_data) {
                $result->caption_entities[] = MessageEntity::makeByArray($item_data);
            }
        }
        $result->video_width = $data['video_width'] ?? null;
        $result->video_height = $data['video_height'] ?? null;
        $result->video_duration = $data['video_duration'] ?? null;
        $result->description = $data['description'] ?? null;
        $result->reply_markup = isset($data['reply_markup'])
            ? InlineKeyboardMarkup::makeByArray($data['reply_markup'])
            : null;
        $result->input_message_content = isset($data['input_message_content'])
            ? InputMessageContent::makeByArray($data['input_message_content'])
            : null;
        return $result;
    }

    public function getRequestData(): array
    {
        return [
            'type' => self::getType(),
            'id' => $this->id,
            'video_url' => $this->video_url,
            'mime_type' => $this->mime_type,
            'thumb_url' => $this->thumb_url,
            'title' => $this->title,
            'caption' => $this->caption,
            'parse_mode' => $this->parse_mode,
            'caption_entities' => $this->caption_entities,
            'video_width' => $this->video_width,
            'video_height' => $this->video_height,
            'video_duration' => $this->video_duration,
            'description' => $this->description,
            'reply_markup' => $this->reply_markup,
            'input_message_content' => $this->input_message_content,
        ];
    }
}
