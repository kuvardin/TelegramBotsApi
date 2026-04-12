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
     * @param bool|null $is_name_implicit True, if the name of the topic wasn't specified explicitly by its creator and
     *     likely needs to be changed by the bot
     */
    public function __construct(
        public string $name,
        public int $icon_color,
        public ?string $icon_custom_emoji_id = null,
        public ?bool $is_name_implicit = null,
    )
    {

    }

    public static function makeByArray(array $data): self
    {
        return new self(
            name: $data['name'],
            icon_color: $data['icon_color'],
            icon_custom_emoji_id: $data['icon_custom_emoji_id'] ?? null,
            is_name_implicit: $data['is_name_implicit'] ?? null,
        );
    }

    public function getRequestData(): array
    {
        return [
            'name' => $this->name,
            'icon_color' => $this->icon_color,
            'icon_custom_emoji_id' => $this->icon_custom_emoji_id,
            'is_name_implicit' => $this->is_name_implicit,
        ];
    }
}
