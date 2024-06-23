<?php

declare(strict_types=1);

namespace Kuvardin\TelegramBotsApi\Types\InlineQueryResult;

use JetBrains\PhpStorm\Deprecated;
use Kuvardin\TelegramBotsApi\Types\InlineKeyboardMarkup;
use Kuvardin\TelegramBotsApi\Types\InlineQueryResult;
use Kuvardin\TelegramBotsApi\Types\InputMessageContent;
use Kuvardin\TelegramBotsApi\Types\MessageEntity;
use RuntimeException;

/**
 * Represents a link to an animated GIF file. By default, this animated GIF file will be sent by the user with optional
 * caption. Alternatively, you can use "input_message_content" to send a message with the specified content instead of
 * the animation.
 *
 * @package Kuvardin\TelegramBotsApi
 * @author Maxim Kuvardin <maxim@kuvard.in>
 */
class Gif extends InlineQueryResult
{
    /**
     * @param string $id Unique identifier for this result, 1-64 bytes
     * @param string $gif_url A valid URL for the GIF file. File size must not exceed 1MB
     * @param string $thumbnail_url URL of the static (JPEG or GIF) or animated (MPEG4) thumbnail for the result
     * @param int|null $gif_width Width of the GIF
     * @param int|null $gif_height Height of the GIF
     * @param int|null $gif_duration Duration of the GIF in seconds
     * @param string|null $thumbnail_mime_type MIME type of the thumbnail, must be one of “image/jpeg”, “image/gif”, or
     *     “video/mp4”. Defaults to “image/jpeg”
     * @param string|null $title Title for the result
     * @param string|null $caption Caption of the GIF file to be sent, 0-1024 characters after entities parsing
     * @param string|null $parse_mode Mode for parsing entities in the caption.
     * @param MessageEntity[]|null $caption_entities List of special entities that appear in the caption, which can be
     *     specified instead of "parse_mode"
     * @param InlineKeyboardMarkup|null $reply_markup Inline keyboard attached to the message
     * @param InputMessageContent|null $input_message_content Content of the message to be sent instead of the GIF
     *     animation
     * @param bool|null $show_caption_above_media Pass "True", if the caption must be shown above the message media
     */
    public function __construct(
        public string $id,
        public string $gif_url,
        public string $thumbnail_url,
        public ?int $gif_width = null,
        public ?int $gif_height = null,
        public ?int $gif_duration = null,
        public ?string $thumbnail_mime_type = null,
        public ?string $title = null,
        public ?string $caption = null,
        public ?string $parse_mode = null,
        public ?array $caption_entities = null,
        public ?InlineKeyboardMarkup $reply_markup = null,
        public ?InputMessageContent $input_message_content = null,
        public ?bool $show_caption_above_media = null,

        #[Deprecated] public ?string $thumb_url = null,
        #[Deprecated] public ?string $thumb_mime_type = null,
    )
    {
        $this->thumb_url ??= $this->thumbnail_url;
        $this->thumbnail_url ??= $this->thumb_url;

        $this->thumb_mime_type ??= $this->thumbnail_mime_type;
        $this->thumbnail_mime_type ??= $this->thumb_mime_type;
    }

    public static function getType(): string
    {
        return 'gif';
    }

    public static function makeByArray(array $data): static
    {
        if ($data['type'] !== self::getType()) {
            throw new RuntimeException("Wrong inline query result type: {$data['type']}");
        }

        return new self(
            id: $data['id'],
            gif_url: $data['gif_url'],
            thumbnail_url: $data['thumbnail_url'],
            gif_width: $data['gif_width'] ?? null,
            gif_height: $data['gif_height'] ?? null,
            gif_duration: $data['gif_duration'] ?? null,
            thumbnail_mime_type: $data['thumbnail_mime_type'] ?? null,
            title: $data['title'] ?? null,
            caption: $data['caption'] ?? null,
            parse_mode: $data['parse_mode'] ?? null,
            caption_entities: isset($data['caption_entities'])
                ? array_map(
                    static fn(array $caption_entities_data) => MessageEntity::makeByArray($caption_entities_data),
                    $data['caption_entities'],
                )
                : null,
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
            'gif_url' => $this->gif_url,
            'gif_width' => $this->gif_width,
            'gif_height' => $this->gif_height,
            'gif_duration' => $this->gif_duration,
            'thumbnail_url' => $this->thumbnail_url,
            'thumbnail_mime_type' => $this->thumbnail_mime_type,
            'title' => $this->title,
            'caption' => $this->caption,
            'parse_mode' => $this->parse_mode,
            'caption_entities' => $this->caption_entities,
            'show_caption_above_media' => $this->show_caption_above_media,
            'reply_markup' => $this->reply_markup,
            'input_message_content' => $this->input_message_content,
        ];
    }
}
