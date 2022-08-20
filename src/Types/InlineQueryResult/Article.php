<?php

declare(strict_types=1);

namespace Kuvardin\TelegramBotsApi\Types\InlineQueryResult;

use Kuvardin\TelegramBotsApi\Types\InlineKeyboardMarkup;
use Kuvardin\TelegramBotsApi\Types\InlineQueryResult;
use Kuvardin\TelegramBotsApi\Types\InputMessageContent;
use RuntimeException;

/**
 * Represents a link to an article or web page.
 *
 * @package Kuvardin\TelegramBotsApi
 * @author Maxim Kuvardin <maxim@kuvard.in>
 */
class Article extends InlineQueryResult
{
    /**
     * @var string $id Unique identifier for this result, 1-64 Bytes
     */
    public string $id;

    /**
     * @var string $title Title of the result
     */
    public string $title;

    /**
     * @var InputMessageContent $input_message_content Content of the message to be sent
     */
    public InputMessageContent $input_message_content;

    /**
     * @var InlineKeyboardMarkup|null $reply_markup <a
     *     href="https://core.telegram.org/bots#inline-keyboards-and-on-the-fly-updating">Inline keyboard</a> attached
     *     to the message
     */
    public ?InlineKeyboardMarkup $reply_markup = null;

    /**
     * @var string|null $url URL of the result
     */
    public ?string $url = null;

    /**
     * @var bool|null $hide_url Pass <em>True</em>, if you don't want the URL to be shown in the message
     */
    public ?bool $hide_url = null;

    /**
     * @var string|null $description Short description of the result
     */
    public ?string $description = null;

    /**
     * @var string|null $thumb_url Url of the thumbnail for the result
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
        return 'article';
    }

    public static function makeByArray(array $data): static
    {
        $result = new self;

        if ($data['type'] !== self::getType()) {
            throw new RuntimeException("Wrong inline query result type: {$data['type']}");
        }

        $result->id = $data['id'];
        $result->title = $data['title'];
        $result->input_message_content = InputMessageContent::makeByArray($data['input_message_content']);
        $result->reply_markup = InlineKeyboardMarkup::makeByArray($data['reply_markup']);
        $result->url = $data['url'] ?? null;
        $result->hide_url = $data['hide_url'] ?? null;
        $result->description = $data['description'] ?? null;
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
