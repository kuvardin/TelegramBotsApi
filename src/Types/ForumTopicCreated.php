<?php

declare(strict_types=1);

namespace Kuvardin\TelegramBotsApi\Types;

use Kuvardin\TelegramBotsApi\Type;

/**
 * This object represents a service message about a new forum topic created in the chat.
 *
 * @package Kuvardin\TelegramBotsApi
 * @author Maxim Kuvardin <maxim@kuvard.in>
 */
class ForumTopicCreated extends Type
{
    /**
     * @param string $name Name of the topic
     * @param int $icon_color Color of the topic icon in RGB format
     * @param string|null $icon_custom_emoji_id Unique identifier of the custom emoji shown as the topic icon
     */
    public function __construct(
        public string $name,
        public int $icon_color,
        public ?string $icon_custom_emoji_id = null,
    )
    {

    }

    public static function makeByArray(array $data): self
    {
        return new self(
            name: $data['name'],
            icon_color: $data['icon_color'],
            icon_custom_emoji_id: $data['icon_custom_emoji_id'] ?? null,
        );
    }

    public function getRequestData(): array
    {
        return [
            'name' => $this->name,
            'icon_color' => $this->icon_color,
            'icon_custom_emoji_id' => $this->icon_custom_emoji_id,
        ];
    }
}
