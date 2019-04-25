<?php

namespace TelegramBotsApi\Types\InlineQueryResult;

use \TelegramBotsApi;
use \TelegramBotsApi\Exceptions\Error;

/**
 * Represents a link to an article or web page.
 * @package TelegramBotsApi\Types\InlineQueryResult
 * @author Maxim Kuvardin <kuvard.in@mail.ru>
 */
class Article extends TelegramBotsApi\Types\InlineQueryResult implements TelegramBotsApi\Types\TypeInterface
{
    public const TYPE = TelegramBotsApi\Types\InlineQueryResult::TYPE_ARTICLE;

    /**
     * @var string Type of the result, must be self::TYPE
     */
    public $type = self::TYPE;

    /**
     * @var string Unique identifier for this result, 1-64 Bytes
     */
    public $id;

    /**
     * @var string Title of the result
     */
    public $title;

    /**
     * @var TelegramBotsApi\Types\InputMessageContent Content of the message to be sent
     */
    public $input_message_content;

    /**
     * @var TelegramBotsApi\Types\InlineKeyboardMarkup|null Inline keyboard attached to the message
     */
    public $reply_markup;

    /**
     * @var string|null URL of the result
     */
    public $url;

    /**
     * @var bool Pass True, if you don't want the URL to be shown in the message
     */
    public $hide_url;

    /**
     * @var string|null Short description of the result
     */
    public $description;

    /**
     * @var string|null Url of the thumbnail for the result
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
     * Article constructor.
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
        $this->input_message_content = $data['input_message_content'];

        if (isset($data['reply_markup'])) {
            $this->reply_markup = $data['reply_markup'] instanceof TelegramBotsApi\Types\InlineKeyboardMarkup ? $data['reply_markup'] : new TelegramBotsApi\Types\InlineKeyboardMarkup($data['reply_markup']);
        }

        $this->url = $data['url'] ?? null;
        $this->hide_url = $data['hide_url'] ?? null;
        $this->description = $data['description'] ?? null;
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
            'input_message_content' => $this->input_message_content,
            'reply_markup' => $this->reply_markup,
            'url' => $this->url,
            'hide_url' => $this->hide_url,
            'description' => $this->description,
            'thumb_url' => $this->thumb_url,
            'thumb_width' => $this->thumb_width,
            'thumb_height' => $this->thumb_height,
        ];
    }

    /**
     * @param string $id
     * @param string $title
     * @param TelegramBotsApi\Types\InputMessageContent $input_message_content
     * @return Article
     * @throws Error
     */
    public static function make(string $id, string $title, TelegramBotsApi\Types\InputMessageContent $input_message_content): self
    {
        return new self([
            'id' => $id,
            'title' => $title,
            'input_message_content' => $input_message_content,
        ]);
    }
}