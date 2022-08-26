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
     * @param string $id Unique identifier for this result, 1-64 Bytes
     * @param string $title Title of the result
     * @param InputMessageContent $input_message_content Content of the message to be sent
     * @param InlineKeyboardMarkup|null $reply_markup <a
     *     href="https://core.telegram.org/bots#inline-keyboards-and-on-the-fly-updating">Inline keyboard</a> attached
     *     to the message
     * @param string|null $url URL of the result
     * @param bool|null $hide_url Pass <em>True</em>, if you don't want the URL to be shown in the message
     * @param string|null $description Short description of the result
     * @param string|null $thumb_url Url of the thumbnail for the result
     * @param int|null $thumb_width Thumbnail width
     * @param int|null $thumb_height Thumbnail height
     */
    public function __construct(
        public string $id,
        public string $title,
        public InputMessageContent $input_message_content,
        public ?InlineKeyboardMarkup $reply_markup = null,
        public ?string $url = null,
        public ?bool $hide_url = null,
        public ?string $description = null,
        public ?string $thumb_url = null,
        public ?int $thumb_width = null,
        public ?int $thumb_height = null,
    )
    {

    }

    public static function getType(): string
    {
        return 'article';
    }

    public static function makeByArray(array $data): static
    {
        if ($data['type'] !== self::getType()) {
            throw new RuntimeException("Wrong inline query result type: {$data['type']}");
        }

        return new self(
            id: $data['id'],
            title: $data['title'],
            input_message_content: InputMessageContent::makeByArray($data['input_message_content']),
            reply_markup: isset($data['reply_markup'])
                ? InlineKeyboardMarkup::makeByArray($data['reply_markup'])
                : null,
            url: $data['url'] ?? null,
            hide_url: $data['hide_url'] ?? null,
            description: $data['description'] ?? null,
            thumb_url: $data['thumb_url'] ?? null,
            thumb_width: $data['thumb_width'] ?? null,
            thumb_height: $data['thumb_height'] ?? null,
        );
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
