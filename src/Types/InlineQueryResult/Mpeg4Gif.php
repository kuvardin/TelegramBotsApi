<?php

declare(strict_types=1);

namespace Kuvardin\TelegramBotsApi\Types\InlineQueryResult;

use Kuvardin\TelegramBotsApi\Types\InlineKeyboardMarkup;
use Kuvardin\TelegramBotsApi\Types\InlineQueryResult;
use Kuvardin\TelegramBotsApi\Types\InputMessageContent;
use Kuvardin\TelegramBotsApi\Types\MessageEntity;
use RuntimeException;

/**
 * Represents a link to a video animation (H.264/MPEG-4 AVC video without sound). By default, this animated MPEG-4 file
 * will be sent by the user with optional caption. Alternatively, you can use <em>input_message_content</em> to send a
 * message with the specified content instead of the animation.
 *
 * @package Kuvardin\TelegramBotsApi
 * @author Maxim Kuvardin <maxim@kuvard.in>
 */
class Mpeg4Gif extends InlineQueryResult
{
    /**
     * @param string $id Unique identifier for this result, 1-64 bytes
     * @param string $mpeg4_url A valid URL for the MP4 file. File size must not exceed 1MB
     * @param string $thumb_url URL of the static (JPEG or GIF) or animated (MPEG4) thumbnail for the result
     * @param int|null $mpeg4_width Video width
     * @param int|null $mpeg4_height Video height
     * @param int|null $mpeg4_duration Video duration in seconds
     * @param string|null $thumb_mime_type MIME type of the thumbnail, must be one of “image/jpeg”, “image/gif”, or
     *     “video/mp4”. Defaults to “image/jpeg”
     * @param string|null $title Title for the result
     * @param string|null $caption Caption of the MPEG-4 file to be sent, 0-1024 characters after entities parsing
     * @param string|null $parse_mode Mode for parsing entities in the caption. See <a
     *     href="https://core.telegram.org/bots/api#formatting-options">formatting options</a> for more details.
     * @param MessageEntity[]|null $caption_entities List of special entities that appear in the caption, which can be
     *     specified instead of <em>parse_mode</em>
     * @param InlineKeyboardMarkup|null $reply_markup <a
     *     href="https://core.telegram.org/bots#inline-keyboards-and-on-the-fly-updating">Inline keyboard</a> attached
     *     to the message
     * @param InputMessageContent|null $input_message_content Content of the message to be sent instead of the video
     *     animation
     */
    public function __construct(
        public string $id,
        public string $mpeg4_url,
        public string $thumb_url,
        public ?int $mpeg4_width = null,
        public ?int $mpeg4_height = null,
        public ?int $mpeg4_duration = null,
        public ?string $thumb_mime_type = null,
        public ?string $title = null,
        public ?string $caption = null,
        public ?string $parse_mode = null,
        public ?array $caption_entities = null,
        public ?InlineKeyboardMarkup $reply_markup = null,
        public ?InputMessageContent $input_message_content = null,
    )
    {

    }

    public static function getType(): string
    {
        return 'mpeg4_gif';
    }

    public static function makeByArray(array $data): static
    {
        if ($data['type'] !== self::getType()) {
            throw new RuntimeException("Wrong inline query result type: {$data['type']}");
        }

        $result = new self(
            id: $data['id'],
            mpeg4_url: $data['mpeg4_url'],
            thumb_url: $data['thumb_url'],
            mpeg4_width: $data['mpeg4_width'] ?? null,
            mpeg4_height: $data['mpeg4_height'] ?? null,
            mpeg4_duration: $data['mpeg4_duration'] ?? null,
            thumb_mime_type: $data['thumb_mime_type'] ?? null,
            title: $data['title'] ?? null,
            caption: $data['caption'] ?? null,
            parse_mode: $data['parse_mode'] ?? null,
            caption_entities: null,
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
            'mpeg4_url' => $this->mpeg4_url,
            'mpeg4_width' => $this->mpeg4_width,
            'mpeg4_height' => $this->mpeg4_height,
            'mpeg4_duration' => $this->mpeg4_duration,
            'thumb_url' => $this->thumb_url,
            'thumb_mime_type' => $this->thumb_mime_type,
            'title' => $this->title,
            'caption' => $this->caption,
            'parse_mode' => $this->parse_mode,
            'caption_entities' => $this->caption_entities,
            'reply_markup' => $this->reply_markup,
            'input_message_content' => $this->input_message_content,
        ];
    }
}
