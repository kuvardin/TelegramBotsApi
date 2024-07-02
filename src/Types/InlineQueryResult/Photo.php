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
 * Represents a link to a photo. By default, this photo will be sent by the user with optional caption. Alternatively,
 * you can use "input_message_content" to send a message with the specified content instead of the photo.
 *
 * @package Kuvardin\TelegramBotsApi
 * @author Maxim Kuvardin <maxim@kuvard.in>
 */
class Photo extends InlineQueryResult
{
    /**
     * @param string $id Unique identifier for this result, 1-64 bytes
     * @param string $photo_url A valid URL of the photo. Photo must be in "JPEG" format. Photo size must not exceed
     *     5MB
     * @param string $thumbnail_url URL of the thumbnail for the photo
     * @param int|null $photo_width Width of the photo
     * @param int|null $photo_height Height of the photo
     * @param string|null $title Title for the result
     * @param string|null $description Short description of the result
     * @param string|null $caption Caption of the photo to be sent, 0-1024 characters after entities parsing
     * @param ParseMode|string|null $parse_mode Mode for parsing entities in the photo caption
     * @param MessageEntity[]|null $caption_entities List of special entities that appear in the caption, which can be
     *     specified instead of "parse_mode"
     * @param InlineKeyboardMarkup|null $reply_markup Inline keyboard attached to the message
     * @param InputMessageContent|null $input_message_content Content of the message to be sent instead of the photo
     * @param bool|null $show_caption_above_media Pass "True", if the caption must be shown above the message media
     */
    public function __construct(
        public string $id,
        public string $photo_url,
        public string $thumbnail_url,
        public ?int $photo_width = null,
        public ?int $photo_height = null,
        public ?string $title = null,
        public ?string $description = null,
        public ?string $caption = null,
        public ParseMode|string|null $parse_mode = null,
        public ?array $caption_entities = null,
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
        return 'photo';
    }

    public static function makeByArray(array $data): static
    {
        if ($data['type'] !== self::getType()) {
            throw new RuntimeException("Wrong inline query result type: {$data['type']}");
        }

        return new self(
            id: $data['id'],
            photo_url: $data['photo_url'],
            thumbnail_url: $data['thumbnail_url'],
            photo_width: $data['photo_width'] ?? null,
            photo_height: $data['photo_height'] ?? null,
            title: $data['title'] ?? null,
            description: $data['description'] ?? null,
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
            'photo_url' => $this->photo_url,
            'thumbnail_url' => $this->thumbnail_url,
            'photo_width' => $this->photo_width,
            'photo_height' => $this->photo_height,
            'title' => $this->title,
            'description' => $this->description,
            'caption' => $this->caption,
            'parse_mode' => $this->parse_mode instanceof ParseMode ? $this->parse_mode->value : $this->parse_mode,
            'caption_entities' => $this->caption_entities,
            'show_caption_above_media' => $this->show_caption_above_media,
            'reply_markup' => $this->reply_markup,
            'input_message_content' => $this->input_message_content,
        ];
    }
}
