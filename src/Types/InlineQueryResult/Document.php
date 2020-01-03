<?php declare(strict_types=1);

namespace TelegramBotsApi\Types\InlineQueryResult;

use TelegramBotsApi;
use TelegramBotsApi\Exceptions\Error;
use TelegramBotsApi\Types;
use TelegramBotsApi\Types\InlineQueryResult;

/**
 * Represents a link to a file. By default, this file will be sent by the user with an optional caption. Alternatively, you can use input_message_content to send a message with the specified content instead of the file. Currently, only .PDF and .ZIP files can be sent using this method.
 *
 * @package TelegramBotsApi
 * @author Maxim Kuvardin <maxim@kuvard.in>
 */
class Document extends InlineQueryResult implements TelegramBotsApi\Types\TypeInterface
{
    public const TYPE = InlineQueryResult::TYPE_DOCUMENT;

    /**
     * @var string Unique identifier for this result, 1-64 bytes
     */
    public string $id;

    /**
     * @var string Title for the result
     */
    public string $title;

    /**
     * @var string|null Caption of the document to be sent, 0-1024 characters
     */
    public ?string $caption;

    /**
     * @var string|null Send Markdown or HTML, if you want Telegram apps to show bold, italic, fixed-width text or inline URLs in the media caption.
     */
    public ?string $parse_mode;

    /**
     * @var string A valid URL for the file
     */
    public string $document_url;

    /**
     * @var string Mime type of the content of the file, either “application/pdf” or “application/zip”
     */
    public string $mime_type;

    /**
     * @var string|null Short description of the result
     */
    public ?string $description;

    /**
     * @var Types\InlineKeyboardMarkup|null Inline keyboard attached to the message
     */
    public ?Types\InlineKeyboardMarkup $reply_markup;

    /**
     * @var Types\InputMessageContent|null Content of the message to be sent instead of the file
     */
    public ?Types\InputMessageContent $input_message_content;

    /**
     * @var string|null URL of the thumbnail (jpeg only) for the file
     */
    public ?string $thumb_url;

    /**
     * @var int|null Thumbnail width
     */
    public ?int $thumb_width;

    /**
     * @var int|null Thumbnail height
     */
    public ?int $thumb_height;

    /**
     * Document constructor.
     *
     * @param array $data
     * @throws Error
     */
    public function __construct(array $data)
    {
        parent::__construct($data);

        if ($data['type'] !== self::TYPE) {
            throw new Error("Unknown type: {$data['type']} (must be self::TYPE)");
        }

        $this->id = $data['id'];
        $this->title = $data['title'];

        if (isset($data['caption'])) {
            $this->caption = $data['caption'];
        }

        if (isset($data['parse_mode'])) {
            $this->parse_mode = $data['parse_mode'];
        }

        $this->document_url = $data['document_url'];
        $this->mime_type = $data['mime_type'];
        if (isset($data['description'])) {
            $this->description = $data['description'];
        }

        if (isset($data['reply_markup'])) {
            $this->reply_markup = $data['reply_markup'] instanceof Types\InlineKeyboardMarkup
                ? $data['reply_markup']
                : new Types\InlineKeyboardMarkup($data['reply_markup']);
        }

        if (isset($data['input_message_content'])) {
            $this->input_message_content = $data['input_message_content'] instanceof Types\InputMessageContent
                ? $data['input_message_content']
                : Types\InputMessageContent::constructChild($data['input_message_content']);
        }

        if (isset($data['thumb_url'])) {
            $this->thumb_url = $data['thumb_url'];
        }

        if (isset($data['thumb_width'])) {
            $this->thumb_width = $data['thumb_width'];
        }

        if (isset($data['thumb_height'])) {
            $this->thumb_height = $data['thumb_height'];
        }
    }

    /**
     * @param string $type Type of the result, must be document
     * @param string $id Unique identifier for this result, 1-64 bytes
     * @param string $title Title for the result
     * @param string $document_url A valid URL for the file
     * @param string $mime_type Mime type of the content of the file, either “application/pdf” or “application/zip”
     * @return self
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

    /**
     * @return array
     */
    public function getRequestArray(): array
    {
        return [
            'type' => self::TYPE,
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
}