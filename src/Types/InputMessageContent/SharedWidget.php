<?php

declare(strict_types=1);

namespace Kuvardin\TelegramBotsApi\Types\InputMessageContent;

use Kuvardin\TelegramBotsApi\Types\InputMessageContent;
use Kuvardin\TelegramBotsApi\Types\MessageEntity;

/**
 * Represents the content of a message with a shared widget to be sent as the result of an inline query. Currently,
 * widgets can't be sent in response to inline queries in the production environment.
 *
 * @package Kuvardin\TelegramBotsApi
 * @author Maxim Kuvardin <maxim@kuvard.in>
 */
class SharedWidget extends InputMessageContent
{
    /**
     * @param string $widget_id Unique identifier of the shared widget created by the bot
     * @param string|null $chat_data Data of the widget, which is specific to the message, 0-1024 bytes
     * @param string|null $caption Widget caption, 0-1024 characters after entities parsing
     * @param string|null $parse_mode Mode for parsing entities in the widget caption. See formatting options for more
     *     details.
     * @param MessageEntity[]|null $caption_entities List of special entities that appear in the caption, which can be
     *     specified instead of "parse_mode"
     * @param bool|null $show_caption_above_media Pass True if the caption must be shown above the widget
     */
    public function __construct(
        public string $widget_id,
        public ?string $chat_data = null,
        public ?string $caption = null,
        public ?string $parse_mode = null,
        public ?array $caption_entities = null,
        public ?bool $show_caption_above_media = null,
    )
    {

    }

    public static function makeByArray(array $data): static
    {
        return new self(
            widget_id: $data['widget_id'],
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
        );
    }

    public function getRequestData(): array
    {
        return [
            'widget_id' => $this->widget_id,
            'chat_data' => $this->chat_data,
            'caption' => $this->caption,
            'parse_mode' => $this->parse_mode,
            'caption_entities' => $this->caption_entities,
            'show_caption_above_media' => $this->show_caption_above_media,
        ];
    }
}

