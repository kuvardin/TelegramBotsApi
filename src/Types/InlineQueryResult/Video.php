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
     * @param string $id Unique identifier for this result, 1-64 bytes
     * @param string $video_url A valid URL for the embedded video player or video file
     * @param string $mime_type Mime type of the content of video url, “text/html” or “video/mp4”
     * @param string $thumb_url URL of the thumbnail (JPEG only) for the video
     * @param string $title Title for the result
     * @param string|null $caption Caption of the video to be sent, 0-1024 characters after entities parsing
     * @param string|null $parse_mode Mode for parsing entities in the video caption. See <a
     *     href="https://core.telegram.org/bots/api#formatting-options">formatting options</a> for more details.
     * @param MessageEntity[]|null $caption_entities List of special entities that appear in the caption, which can be
     *     specified instead of <em>parse_mode</em>
     * @param int|null $video_width Video width
     * @param int|null $video_height Video height
     * @param int|null $video_duration Video duration in seconds
     * @param string|null $description Short description of the result
     * @param InlineKeyboardMarkup|null $reply_markup <a
     *     href="https://core.telegram.org/bots#inline-keyboards-and-on-the-fly-updating">Inline keyboard</a> attached
     *     to the message
     * @param InputMessageContent|null $input_message_content Content of the message to be sent instead of the video.
     *     This field is <strong>required</strong> if InlineQueryResultVideo is used to send an HTML-page as a result
     *     (e.g., a YouTube video).
     */
    public function __construct(
        public string $id,
        public string $video_url,
        public string $mime_type,
        public string $thumb_url,
        public string $title,
        public ?string $caption = null,
        public ?string $parse_mode = null,
        public ?array $caption_entities = null,
        public ?int $video_width = null,
        public ?int $video_height = null,
        public ?int $video_duration = null,
        public ?string $description = null,
        public ?InlineKeyboardMarkup $reply_markup = null,
        public ?InputMessageContent $input_message_content = null,
    )
    {

    }

    public static function getType(): string
    {
        return 'video';
    }

    public static function makeByArray(array $data): static
    {
        if ($data['type'] !== self::getType()) {
            throw new RuntimeException("Wrong inline query result type: {$data['type']}");
        }

        $result = new self(
            id: $data['id'],
            video_url: $data['video_url'],
            mime_type: $data['mime_type'],
            thumb_url: $data['thumb_url'],
            title: $data['title'],
            caption: $data['caption'] ?? null,
            parse_mode: $data['parse_mode'] ?? null,
            caption_entities: null,
            video_width: $data['video_width'] ?? null,
            video_height: $data['video_height'] ?? null,
            video_duration: $data['video_duration'] ?? null,
            description: $data['description'] ?? null,
            reply_markup: isset($data['reply_markup'])
                ? InlineKeyboardMarkup::makeByArray($data['reply_markup'])
                : null,
            input_message_content: isset($data['input_message_content'])
                ? InputMessageContent::makeByArray($data['input_message_content'])
                : null,
        );

        if (isset($data['caption_entities'])) {
            $result->caption_entities = [];
            foreach ($data['caption_entities'] as $item_data) {
                $result->caption_entities[] = MessageEntity::makeByArray($item_data);
            }
        }
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
