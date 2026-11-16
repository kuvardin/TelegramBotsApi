<?php

declare(strict_types=1);

namespace Kuvardin\TelegramBotsApi\Types\InputMessageContent;

use Kuvardin\TelegramBotsApi\Enums\ParseMode;
use Kuvardin\TelegramBotsApi\Types\InputMessageContent;
use Kuvardin\TelegramBotsApi\Types\MessageEntity;

/**
 * Represents the content of a message with an HTML widget to be sent as the result of an inline query. Currently,
 * widgets can't be sent in response to inline queries in the production environment.
 *
 * @package Kuvardin\TelegramBotsApi
 * @author Maxim Kuvardin <maxim@kuvard.in>
 */
class Widget extends InputMessageContent
{
    /**
     * @param string $html HTML code of the widget, 1-32768 bytes. The code must not exceed 4096 bytes when compressed
     *     by zlib with the maximum compression level.
     * @param int|null $width Width of the widget in logical pixels; omit if the widget must occupy the whole width of
     *     the message bubble. The width is clamped by the app to the range from 200 to the maximum width of the
     *     message bubble.
     * @param int|null $height Height of the widget in logical pixels; omit if the height of the widget isn't fixed.
     *     The height is clamped by the app to the range 50-600.
     * @param string|null $public_data Public data of the widget, 0-1024 bytes, which will be available wherever the
     *     widget is shown. If the widget is shared, then all messages with it will have the same public data.
     * @param string|null $chat_data Data of the widget, which is specific to the message, 0-1024 bytes
     * @param string|null $caption Widget caption, 0-1024 characters after entities parsing
     * @param ParseMode|string|null $parse_mode Mode for parsing entities in the widget caption.
     * @param MessageEntity[]|null $caption_entities List of special entities that appear in the caption, which can be
     *     specified instead of "parse_mode"
     * @param bool|null $show_caption_above_media Pass True if the caption must be shown above the widget
     * @param bool|null $allow_queries Pass True to allow the widget to send queries to the bot
     * @param bool|null $is_shared Pass True to create a shared widget. Each message sent from the result creates a
     *     separate shared widget, whose identifier is received by the bot only in the field "widget_id" of queries
     *     from the widget. To send an existing shared widget in response to an inline query, use
     *     InputSharedWidgetMessageContent instead.
     */
    public function __construct(
        public string $html,
        public ?int $width = null,
        public ?int $height = null,
        public ?string $public_data = null,
        public ?string $chat_data = null,
        public ?string $caption = null,
        public ParseMode|string|null $parse_mode = null,
        public ?array $caption_entities = null,
        public ?bool $show_caption_above_media = null,
        public ?bool $allow_queries = null,
        public ?bool $is_shared = null,
    )
    {

    }

    public static function makeByArray(array $data): static
    {
        return new self(
            html: $data['html'],
            width: $data['width'] ?? null,
            height: $data['height'] ?? null,
            public_data: $data['public_data'] ?? null,
            chat_data: $data['chat_data'] ?? null,
            caption: $data['caption'] ?? null,
            parse_mode: $data['parse_mode'] ?? null,
            caption_entities: isset($data['caption_entities'])
                ? array_map(
                    static fn(array $caption_entities_data) => MessageEntity::makeByArray($caption_entities_data),
                    $data['caption_entities'],
                )
                : null,
            show_caption_above_media: $data['show_caption_above_media'] ?? null,
            allow_queries: $data['allow_queries'] ?? null,
            is_shared: $data['is_shared'] ?? null,
        );
    }

    public function getRequestData(): array
    {
        return [
            'html' => $this->html,
            'width' => $this->width,
            'height' => $this->height,
            'public_data' => $this->public_data,
            'chat_data' => $this->chat_data,
            'caption' => $this->caption,
            'parse_mode' => $this->parse_mode,
            'caption_entities' => $this->caption_entities,
            'show_caption_above_media' => $this->show_caption_above_media,
            'allow_queries' => $this->allow_queries,
            'is_shared' => $this->is_shared,
        ];
    }
}

