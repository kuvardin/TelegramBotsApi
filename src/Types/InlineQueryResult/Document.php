<?php

declare(strict_types=1);

namespace Kuvardin\TelegramBotsApi\Types\InlineQueryResult;

use Kuvardin\TelegramBotsApi\Types\InlineKeyboardMarkup;
use Kuvardin\TelegramBotsApi\Types\InlineQueryResult;
use Kuvardin\TelegramBotsApi\Types\InputMessageContent;
use Kuvardin\TelegramBotsApi\Types\MessageEntity;
use RuntimeException;

/**
 * Represents a link to a file. By default, this file will be sent by the user with an optional caption. Alternatively,
 * you can use <em>input_message_content</em> to send a message with the specified content instead of the file.
 * Currently, only <strong>.PDF</strong> and <strong>.ZIP</strong> files can be sent using this method.
 *
 * @package Kuvardin\TelegramBotsApi
 * @author Maxim Kuvardin <maxim@kuvard.in>
 */
class Document extends InlineQueryResult
{
    /**
     * @var string $id Unique identifier for this result, 1-64 bytes
     */
    public string $id;

    /**
     * @var string $title Title for the result
     */
    public string $title;

    /**
     * @var string|null $caption Caption of the document to be sent, 0-1024 characters after entities parsing
     */
    public ?string $caption = null;

    /**
     * @var string|null $parse_mode Mode for parsing entities in the document caption. See <a
     *     href="https://core.telegram.org/bots/api#formatting-options">formatting options</a> for more details.
     */
    public ?string $parse_mode = null;

    /**
     * @var MessageEntity[]|null $caption_entities List of special entities that appear in the caption, which can be
     *     specified instead of <em>parse_mode</em>
     */
    public ?array $caption_entities = null;

    /**
     * @var string $document_url A valid URL for the file
     */
    public string $document_url;

    /**
     * @var string $mime_type Mime type of the content of the file, either “application/pdf” or “application/zip”
     */
    public string $mime_type;

    /**
     * @var string|null $description Short description of the result
     */
    public ?string $description = null;

    /**
     * @var InlineKeyboardMarkup|null $reply_markup Inline keyboard attached to the message
     */
    public ?InlineKeyboardMarkup $reply_markup = null;

    /**
     * @var InputMessageContent|null $input_message_content Content of the message to be sent instead of the file
     */
    public ?InputMessageContent $input_message_content = null;

    /**
     * @var string|null $thumb_url URL of the thumbnail (JPEG only) for the file
     */
    public ?string $thumb_url = null;

    /**
     * @var int|null $thumb_width Thumbnail width
     */
    public ?int $thumb_width = null;

    /**
     * @var int|null $thumb_height Thumbnail height
     */
    public ?int $thumb_height = null;

    public static function getType(): string
    {
        return 'document';
    }

    public static function makeByArray(array $data): static
    {
        $result = new self;

        if ($data['type'] !== self::getType()) {
            throw new RuntimeException("Wrong inline query result type: {$data['type']}");
        }

        $result->id = $data['id'];
        $result->title = $data['title'];
        $result->caption = $data['caption'] ?? null;
        $result->parse_mode = $data['parse_mode'] ?? null;
        if (isset($data['caption_entities'])) {
            $result->caption_entities = [];
            foreach ($data['caption_entities'] as $item_data) {
                $result->caption_entities[] = MessageEntity::makeByArray($item_data);
            }
        }
        $result->document_url = $data['document_url'];
        $result->mime_type = $data['mime_type'];
        $result->description = $data['description'] ?? null;
        $result->reply_markup = isset($data['reply_markup'])
            ? InlineKeyboardMarkup::makeByArray($data['reply_markup'])
            : null;
        $result->input_message_content = isset($data['input_message_content'])
            ? InputMessageContent::makeByArray($data['input_message_content'])
            : null;
        $result->thumb_url = $data['thumb_url'] ?? null;
        $result->thumb_width = $data['thumb_width'] ?? null;
        $result->thumb_height = $data['thumb_height'] ?? null;
        return $result;
    }

    public function getRequestData(): array
    {
        return [
            'type' => self::getType(),
            'id' => $this->id,
            'title' => $this->title,
            'caption' => $this->caption,
            'parse_mode' => $this->parse_mode,
            'caption_entities' => $this->caption_entities,
            'document_url' => $this->document_url,
            'mime_type' => $this->mime_type,
            'description' => $this->description,
            'reply_markup' => $this->reply_markup,
            'input_message_content' => $this->input_message_content,
            'thumb_url' => $this->thumb_url,
            'thumb_width' => $this->thumb_width,
            'thumb_height' => $this->thumb_height,
        ];
    }
}
