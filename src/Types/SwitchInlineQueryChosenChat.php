<?php

declare(strict_types=1);

namespace Kuvardin\TelegramBotsApi\Types;

use Kuvardin\TelegramBotsApi\Type;

/**
 * This object represents an inline button that switches the current user to inline mode in a chosen chat, with an
 * optional default inline query.
 *
 * @package Kuvardin\TelegramBotsApi
 * @author Maxim Kuvardin <maxim@kuvard.in>
 */
class SwitchInlineQueryChosenChat extends Type
{
    /**
     * @param string|null $query The default inline query to be inserted in the input field. If left empty, only the
     *     bot's username will be inserted
     * @param bool|null $allow_user_chats True, if private chats with users can be chosen
     * @param bool|null $allow_bot_chats True, if private chats with bots can be chosen
     * @param bool|null $allow_group_chats True, if group and supergroup chats can be chosen
     * @param bool|null $allow_channel_chats True, if channel chats can be chosen
     */
    public function __construct(
        public ?string $query = null,
        public ?bool $allow_user_chats = null,
        public ?bool $allow_bot_chats = null,
        public ?bool $allow_group_chats = null,
        public ?bool $allow_channel_chats = null,
    )
    {

    }

    public static function makeByArray(array $data): self
    {
        return new self(
            query: $data['query'] ?? null,
            allow_user_chats: $data['allow_user_chats'] ?? null,
            allow_bot_chats: $data['allow_bot_chats'] ?? null,
            allow_group_chats: $data['allow_group_chats'] ?? null,
            allow_channel_chats: $data['allow_channel_chats'] ?? null,
        );
    }

    public function getRequestData(): array
    {
        return [
            'query' => $this->query,
            'allow_user_chats' => $this->allow_user_chats,
            'allow_bot_chats' => $this->allow_bot_chats,
            'allow_group_chats' => $this->allow_group_chats,
            'allow_channel_chats' => $this->allow_channel_chats,
        ];
    }
}
