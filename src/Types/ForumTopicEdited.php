<?php

declare(strict_types=1);

namespace Kuvardin\TelegramBotsApi\Types;

use Kuvardin\TelegramBotsApi\Type;

/**
 * This object represents a service message about an edited forum topic.
 *
 * @package Kuvardin\TelegramBotsApi
 * @author Maxim Kuvardin <maxim@kuvard.in>
 */
class ForumTopicEdited extends Type
{
    /**
     * @param string|null $name New name of the topic, if it was edited
     * @param string|null $icon_custom_emoji_id New identifier of the custom emoji shown as the topic icon,
     *     if it was edited; an empty string if the icon was removed
     */
    public function __construct(
        public ?string $name = null,
        public ?string $icon_custom_emoji_id = null,
    )
    {

    }

    public static function makeByArray(array $data): self
    {
        return new self(
            name: $data['name'] ?? null,
            icon_custom_emoji_id: $data['icon_custom_emoji_id'] ?? null,
        );
    }

    public function getRequestData(): array
    {
        return [
            'name' => $this->name,
            'icon_custom_emoji_id' => $this->icon_custom_emoji_id,
        ];
    }
}
