<?php

declare(strict_types=1);

namespace Kuvardin\TelegramBotsApi\Types\InlineQueryResult;

use Kuvardin\TelegramBotsApi;
use Kuvardin\TelegramBotsApi\Exceptions\Error;
use Kuvardin\TelegramBotsApi\Types;
use Kuvardin\TelegramBotsApi\Types\InlineQueryResult;

/**
 * Represents a link to an article or web page.
 *
 * @package Kuvardin\TelegramBotsApi
 * @author Maxim Kuvardin <maxim@kuvard.in>
 */
class Article extends InlineQueryResult implements TelegramBotsApi\Types\TypeInterface
{
    public const TYPE = InlineQueryResult::TYPE_ARTICLE;

    /**
     * @var string Unique identifier for this result, 1-64 Bytes
     */
    public string $id;

    /**
     * @var string Title of the result
     */
    public string $title;

    /**
     * @var Types\InputMessageContent Content of the message to be sent
     */
    public Types\InputMessageContent $input_message_content;

    /**
     * @var Types\InlineKeyboardMarkup|null Inline keyboard attached to the message
     */
    public ?Types\InlineKeyboardMarkup $reply_markup = null;

    /**
     * @var string|null URL of the result
     */
    public ?string $url = null;

    /**
     * @var bool|null Pass True, if you don't want the URL to be shown in the message
     */
    public ?bool $hide_url = null;

    /**
     * @var string|null Short description of the result
     */
    public ?string $description = null;

    /**
     * @var string|null Url of the thumbnail for the result
     */
    public ?string $thumb_url = null;

    /**
     * @var int|null Thumbnail width
     */
    public ?int $thumb_width = null;

    /**
     * @var int|null Thumbnail height
     */
    public ?int $thumb_height = null;

    /**
     * Article constructor.
     *
     * @param array $data
     */
    public function __construct(array $data)
    {
        parent::__construct($data);

        if ($data['type'] !== self::TYPE) {
            throw new Error("Unknown type: {$data['type']} (must be self::TYPE");
        }

        $this->id = $data['id'];
        $this->title = $data['title'];
        $this->input_message_content = $data['input_message_content'] instanceof Types\InputMessageContent
            ? $data['input_message_content']
            : Types\InputMessageContent::constructChild($data['input_message_content']);

        if (isset($data['reply_markup'])) {
            $this->reply_markup = $data['reply_markup'] instanceof Types\InlineKeyboardMarkup
                ? $data['reply_markup']
                : new Types\InlineKeyboardMarkup($data['reply_markup']);
        }

        if (isset($data['url'])) {
            $this->url = $data['url'];
        }

        if (isset($data['hide_url'])) {
            $this->hide_url = $data['hide_url'];
        }

        if (isset($data['description'])) {
            $this->description = $data['description'];
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
     * @param string $id Unique identifier for this result, 1-64 Bytes
     * @param string $title Title of the result
     * @param Types\InputMessageContent $input_message_content Content of the message to be sent
     * @return self
     */
    public static function make(string $id, string $title,
        Types\InputMessageContent $input_message_content): self
    {
        return new self([
            'type' => self::TYPE,
            'id' => $id,
            'title' => $title,
            'input_message_content' => $input_message_content,
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
}
