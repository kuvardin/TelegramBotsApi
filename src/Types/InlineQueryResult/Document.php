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
 * Represents a link to a file. By default, this file will be sent by the user with an optional caption. Alternatively,
 * you can use "input_message_content" to send a message with the specified content instead of the file. Currently,
 * only ".PDF" and ".ZIP" files can be sent using this method.
 *
 * @package Kuvardin\TelegramBotsApi
 * @author Maxim Kuvardin <maxim@kuvard.in>
 */
class Document extends InlineQueryResult
{
    /**
     * @param string $id Unique identifier for this result, 1-64 bytes
     * @param string $title Title for the result
     * @param string $document_url A valid URL for the file
     * @param string $mime_type MIME type of the content of the file, either “application/pdf” or “application/zip”
     * @param string|null $caption Caption of the document to be sent, 0-1024 characters after entities parsing
     * @param ParseMode|string|null $parse_mode Mode for parsing entities in the document caption
     * @param MessageEntity[]|null $caption_entities List of special entities that appear in the caption, which can be
     *     specified instead of "parse_mode"
     * @param string|null $description Short description of the result
     * @param InlineKeyboardMarkup|null $reply_markup Inline keyboard attached to the message
     * @param InputMessageContent|null $input_message_content Content of the message to be sent instead of the file
     * @param string|null $thumbnail_url URL of the thumbnail (JPEG only) for the file
     * @param int|null $thumbnail_width Thumbnail width
     * @param int|null $thumbnail_height Thumbnail height
     */
    public function __construct(
        public string $id,
        public string $title,
        public string $document_url,
        public string $mime_type,
        public ?string $caption = null,
        public ParseMode|string|null $parse_mode = null,
        public ?array $caption_entities = null,
        public ?string $description = null,
        public ?InlineKeyboardMarkup $reply_markup = null,
        public ?InputMessageContent $input_message_content = null,
        public ?string $thumbnail_url = null,
        public ?int $thumbnail_width = null,
        public ?int $thumbnail_height = null,

        #[Deprecated] public ?string $thumb_url = null,
        #[Deprecated] public ?int $thumb_width = null,
        #[Deprecated] public ?int $thumb_height = null,
    )
    {
        $this->thumbnail_url ??= $this->thumb_url;
        $this->thumb_url ??= $this->thumbnail_url;

        $this->thumbnail_width ??= $this->thumb_width;
        $this->thumb_width ??= $this->thumbnail_width;

        $this->thumbnail_height ??= $this->thumb_height;
        $this->thumb_height ??= $this->thumbnail_height;
    }

    public static function getType(): string
    {
        return 'document';
    }

    public static function makeByArray(array $data): static
    {
        if ($data['type'] !== self::getType()) {
            throw new RuntimeException("Wrong inline query result type: {$data['type']}");
        }

        return new self(
            id: $data['id'],
            title: $data['title'],
            document_url: $data['document_url'],
            mime_type: $data['mime_type'],
            caption: $data['caption'] ?? null,
            parse_mode: $data['parse_mode'] ?? null,
            caption_entities: isset($data['caption_entities'])
                ? array_map(
                    static fn(array $caption_entities_data) => MessageEntity::makeByArray($caption_entities_data),
                    $data['caption_entities'],
                )
                : null,
            description: $data['description'] ?? null,
            reply_markup: isset($data['reply_markup'])
                ? InlineKeyboardMarkup::makeByArray($data['reply_markup'])
                : null,
            input_message_content: isset($data['input_message_content'])
                ? InputMessageContent::makeByArray($data['input_message_content'])
                : null,
            thumbnail_url: $data['thumbnail_url'] ?? null,
            thumbnail_width: $data['thumbnail_width'] ?? null,
            thumbnail_height: $data['thumbnail_height'] ?? null,
        );
    }

    public function getRequestData(): array
    {
        return [
            'type' => self::getType(),
            'id' => $this->id,
            'title' => $this->title,
            'caption' => $this->caption,
            'parse_mode' => $this->parse_mode instanceof ParseMode ? $this->parse_mode->value : $this->parse_mode,
            'caption_entities' => $this->caption_entities,
            'document_url' => $this->document_url,
            'mime_type' => $this->mime_type,
            'description' => $this->description,
            'reply_markup' => $this->reply_markup,
            'input_message_content' => $this->input_message_content,
            'thumbnail_url' => $this->thumbnail_url,
            'thumbnail_width' => $this->thumbnail_width,
            'thumbnail_height' => $this->thumbnail_height,
        ];
    }
}
