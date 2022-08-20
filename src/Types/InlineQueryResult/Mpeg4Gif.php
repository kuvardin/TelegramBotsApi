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
     * @var string $id Unique identifier for this result, 1-64 bytes
     */
    public string $id;

    /**
     * @var string $mpeg4_url A valid URL for the MP4 file. File size must not exceed 1MB
     */
    public string $mpeg4_url;

    /**
     * @var int|null $mpeg4_width Video width
     */
    public ?int $mpeg4_width = null;

    /**
     * @var int|null $mpeg4_height Video height
     */
    public ?int $mpeg4_height = null;

    /**
     * @var int|null $mpeg4_duration Video duration in seconds
     */
    public ?int $mpeg4_duration = null;

    /**
     * @var string $thumb_url URL of the static (JPEG or GIF) or animated (MPEG4) thumbnail for the result
     */
    public string $thumb_url;

    /**
     * @var string|null $thumb_mime_type MIME type of the thumbnail, must be one of “image/jpeg”, “image/gif”, or
     *     “video/mp4”. Defaults to “image/jpeg”
     */
    public ?string $thumb_mime_type = null;

    /**
     * @var string|null $title Title for the result
     */
    public ?string $title = null;

    /**
     * @var string|null $caption Caption of the MPEG-4 file to be sent, 0-1024 characters after entities parsing
     */
    public ?string $caption = null;

    /**
     * @var string|null $parse_mode Mode for parsing entities in the caption. See <a
     *     href="https://core.telegram.org/bots/api#formatting-options">formatting options</a> for more details.
     */
    public ?string $parse_mode = null;

    /**
     * @var MessageEntity[]|null $caption_entities List of special entities that appear in the caption, which can be
     *     specified instead of <em>parse_mode</em>
     */
    public ?array $caption_entities = null;

    /**
     * @var InlineKeyboardMarkup|null $reply_markup <a
     *     href="https://core.telegram.org/bots#inline-keyboards-and-on-the-fly-updating">Inline keyboard</a> attached
     *     to the message
     */
    public ?InlineKeyboardMarkup $reply_markup = null;

    /**
     * @var InputMessageContent|null $input_message_content Content of the message to be sent instead of the video
     *     animation
     */
    public ?InputMessageContent $input_message_content = null;

    public static function getType(): string
    {
        return 'mpeg4_gif';
    }

    public static function makeByArray(array $data): static
    {
        $result = new self;

        if ($data['type'] !== self::getType()) {
            throw new RuntimeException("Wrong inline query result type: {$data['type']}");
        }

        $result->id = $data['id'];
        $result->mpeg4_url = $data['mpeg4_url'];
        $result->mpeg4_width = $data['mpeg4_width'] ?? null;
        $result->mpeg4_height = $data['mpeg4_height'] ?? null;
        $result->mpeg4_duration = $data['mpeg4_duration'] ?? null;
        $result->thumb_url = $data['thumb_url'];
        $result->thumb_mime_type = $data['thumb_mime_type'] ?? null;
        $result->title = $data['title'] ?? null;
        $result->caption = $data['caption'] ?? null;
        $result->parse_mode = $data['parse_mode'] ?? null;
        if (isset($data['caption_entities'])) {
            $result->caption_entities = [];
            foreach ($data['caption_entities'] as $item_data) {
                $result->caption_entities[] = MessageEntity::makeByArray($item_data);
            }
        }
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
