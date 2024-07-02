<?php

declare(strict_types=1);

namespace Kuvardin\TelegramBotsApi\Types\InlineQueryResult;

use JetBrains\PhpStorm\Deprecated;
use Kuvardin\TelegramBotsApi\Enums\ParseMode;
use Kuvardin\TelegramBotsApi\Types\InlineKeyboardMarkup;
use Kuvardin\TelegramBotsApi\Types\InlineQueryResult;
use Kuvardin\TelegramBotsApi\Types\InputMessageContent;
use Kuvardin\TelegramBotsApi\Types\MessageEntity;
use RuntimeException;

/**
 * Represents a link to a page containing an embedded video player or a video file. By default, this video file will be
 * sent by the user with an optional caption. Alternatively, you can use "input_message_content" to send a message with
 * the specified content instead of the video.
 *
 * If an InlineQueryResultVideo message contains an embedded video (e.g., YouTube), you must replace
 * its content using input_message_content.
 *
 * @package Kuvardin\TelegramBotsApi
 * @author Maxim Kuvardin <maxim@kuvard.in>
 */
class Video extends InlineQueryResult
{
    /**
     * @param string $id Unique identifier for this result, 1-64 bytes
     * @param string $video_url A valid URL for the embedded video player or video file
     * @param string $mime_type MIME type of the content of the video URL, “text/html” or “video/mp4”
     * @param string $thumbnail_url URL of the thumbnail (JPEG only) for the video
     * @param string $title Title for the result
     * @param string|null $caption Caption of the video to be sent, 0-1024 characters after entities parsing
     * @param ParseMode|string|null $parse_mode Mode for parsing entities in the video caption
     * @param MessageEntity[]|null $caption_entities List of special entities that appear in the caption, which can be
     *     specified instead of "parse_mode"
     * @param int|null $video_width Video width
     * @param int|null $video_height Video height
     * @param int|null $video_duration Video duration in seconds
     * @param string|null $description Short description of the result
     * @param InlineKeyboardMarkup|null $reply_markup Inline keyboard attached to the message
     * @param InputMessageContent|null $input_message_content Content of the message to be sent instead of the video.
     *     This field is "required" if InlineQueryResultVideo is used to send an HTML-page as a result (e.g., a YouTube
     *     video).
     * @param bool|null $show_caption_above_media Pass "True", if the caption must be shown above the message media
     */
    public function __construct(
        public string $id,
        public string $video_url,
        public string $mime_type,
        public string $thumbnail_url,
        public string $title,
        public ?string $caption = null,
        public ParseMode|string|null $parse_mode = null,
        public ?array $caption_entities = null,
        public ?int $video_width = null,
        public ?int $video_height = null,
        public ?int $video_duration = null,
        public ?string $description = null,
        public ?InlineKeyboardMarkup $reply_markup = null,
        public ?InputMessageContent $input_message_content = null,
        public ?bool $show_caption_above_media = null,

        #[Deprecated] public ?string $thumb_url = null,
    )
    {
        $this->thumb_url ??= $this->thumbnail_url;
        $this->thumbnail_url ??= $this->thumb_url;
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

        return new self(
            id: $data['id'],
            video_url: $data['video_url'],
            mime_type: $data['mime_type'],
            thumbnail_url: $data['thumbnail_url'],
            title: $data['title'],
            caption: $data['caption'] ?? null,
            parse_mode: $data['parse_mode'] ?? null,
            caption_entities: isset($data['caption_entities'])
                ? array_map(
                    static fn(array $caption_entities_data) => MessageEntity::makeByArray($caption_entities_data),
                    $data['caption_entities'],
                )
                : null,
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
            show_caption_above_media: $data['show_caption_above_media'] ?? null,
        );
    }

    public function getRequestData(): array
    {
        return [
            'type' => self::getType(),
            'id' => $this->id,
            'video_url' => $this->video_url,
            'mime_type' => $this->mime_type,
            'thumbnail_url' => $this->thumbnail_url,
            'title' => $this->title,
            'caption' => $this->caption,
            'parse_mode' => $this->parse_mode instanceof ParseMode ? $this->parse_mode->value : $this->parse_mode,
            'caption_entities' => $this->caption_entities,
            'show_caption_above_media' => $this->show_caption_above_media,
            'video_width' => $this->video_width,
            'video_height' => $this->video_height,
            'video_duration' => $this->video_duration,
            'description' => $this->description,
            'reply_markup' => $this->reply_markup,
            'input_message_content' => $this->input_message_content,
        ];
    }
}
