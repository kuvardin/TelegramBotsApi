<?php

namespace TelegramBotsApi\Types\InlineQueryResult;

use \TelegramBotsApi;
use \TelegramBotsApi\Exceptions\Error;

/**
 * Represents a link to a file. By default, this file will be sent by the user with an optional caption. Alternatively, you can use input_message_content to send a message with the specified content instead of the file. Currently, only .PDF and .ZIP files can be sent using this method.
 * @package TelegramBotsApi\Types\InlineQueryResult
 * @author Maxim Kuvardin <kuvard.in@mail.ru>
 */
class Document extends TelegramBotsApi\Types\InlineQueryResult implements TelegramBotsApi\Types\TypeInterface
{

    public const TYPE = TelegramBotsApi\Types\InlineQueryResult::TYPE_DOCUMENT;

    /**
     * @var string Type of the result, must be self::TYPE
     */
    public $type = self::TYPE;

    /**
     * @var string Unique identifier for this result, 1-64 bytes
     */
    public $id;

    /**
     * @var string Title for the result
     */
    public $title;

    /**
     * @var string|null Caption of the document to be sent, 0-1024 characters
     */
    public $caption;

    /**
     * @var string|null Send Markdown or HTML, if you want Telegram apps to show bold, italic, fixed-width text or inline URLs in the media caption.
     */
    public $parse_mode;

    /**
     * @var string A valid URL for the file
     */
    public $document_url;

    /**
     * @var string Mime type of the content of the file, either “application/pdf” or “application/zip”
     */
    public $mime_type;

    /**
     * @var string|null Short description of the result
     */
    public $description;

    /**
     * @var TelegramBotsApi\Types\InlineKeyboardMarkup|null Inline keyboard attached to the message
     */
    public $reply_markup;

    /**
     * @var TelegramBotsApi\Types\InputMessageContent|null Content of the message to be sent instead of the file
     */
    public $input_message_content;

    /**
     * @var string|null URL of the thumbnail (jpeg only) for the file
     */
    public $thumb_url;

    /**
     * @var int|null Thumbnail width
     */
    public $thumb_width;

    /**
     * @var int|null Thumbnail height
     */
    public $thumb_height;

    /**
     * InlineQueryResultDocument constructor.
     * @param array $data
     * @throws Error
     */
    public function __construct(array $data)
    {
        if (isset($data['type'])) {
            if ($data['type'] !== self::TYPE) {
                throw new Error("Unknown type: {$data['type']}. Type must be self::TYPE.");
            }
            $this->type = $data['type'];
        }

        $this->id = $data['id'];
        $this->title = $data['title'];
        $this->caption = $data['caption'] ?? null;

        if (isset($data['parse_mode'])) {
            if (!TelegramBotsApi\Bot::checkParseMode($data['parse_mode'])) {
                throw new Error("Unknown parse mode: {$data['parse_mode']}");
            }
            $this->parse_mode = $data['parse_mode'];
        }

        $this->document_url = $data['document_url'];
        $this->mime_type = $data['mime_type'];
        $this->description = $data['description'] ?? null;

        if (isset($data['reply_markup'])) {
            $this->reply_markup = $data['reply_markup'] instanceof TelegramBotsApi\Types\InlineKeyboardMarkup ? $data['reply_markup'] : new TelegramBotsApi\Types\InlineKeyboardMarkup($data['reply_markup']);
        }

        if (isset($data['input_message_content'])) {
            $this->input_message_content = $data['input_message_content'] instanceof TelegramBotsApi\Types\InputMessageContent ? $data['input_message_content'] : TelegramBotsApi\Types\InputMessageContent::new($data['input_message_content']);
        }

        $this->thumb_url = $data['thumb_url'] ?? null;
        $this->thumb_width = $data['thumb_width'] ?? null;
        $this->thumb_height = $data['thumb_height'] ?? null;
    }

    /**
     * @return array
     */
    public function getRequestArray(): array
    {
        return [
            'type' => $this->type,
            'id' => $this->id,
            'title' => $this->title,
            'caption' => $this->caption,
            'parse_mode' => $this->parse_mode,
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

    /**
     * @param string $type
     * @param string $id
     * @param string $title
     * @param string $document_url
     * @param string $mime_type
     * @return Document
     * @throws Error
     */
    public static function make(string $type, string $id, string $title, string $document_url, string $mime_type): self
    {
        return new self([
            'type' => $type,
            'id' => $id,
            'title' => $title,
            'document_url' => $document_url,
            'mime_type' => $mime_type,
        ]);
    }
}