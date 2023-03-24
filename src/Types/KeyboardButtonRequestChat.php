<?php

declare(strict_types=1);

namespace Kuvardin\TelegramBotsApi\Types;

use Kuvardin\TelegramBotsApi\Type;

/**
 * This object defines the criteria used to request a suitable chat. The identifier of the selected chat will be shared
 * with the bot when the corresponding button is pressed.<br><br>
 * <a href="https://core.telegram.org/bots/features#chat-and-user-selection">More about requesting chats »</a>
 *
 * @package Kuvardin\TelegramBotsApi
 * @author Maxim Kuvardin <maxim@kuvard.in>
 */
class KeyboardButtonRequestChat extends Type
{
    /**
     * @param int $request_id Signed 32-bit identifier of the request, which will be received back in the
     *     ChatShared object. Must be unique within the message
     * @param bool $chat_is_channel Pass <em>True</em> to request a channel chat, pass <em>False</em> to request a group
     *     or a supergroup chat.
     * @param bool|null $chat_is_forum Pass <em>True</em> to request a forum supergroup, pass <em>False</em> to request
     *     a non-forum chat. If not specified, no additional restrictions are applied.
     * @param bool|null $chat_has_username Pass <em>True</em> to request a supergroup or a channel with a username, pass
     *     <em>False</em> to request a chat without a username. If not specified, no additional restrictions are applied.
     * @param bool|null $chat_is_created Pass <em>True</em> to request a chat owned by the user. Otherwise, no
     *     additional restrictions are applied.
     * @param ChatAdministratorRights|null $user_administrator_rights A JSON-serialized object listing the required
     *     administrator rights of the user in the chat. The rights must be a superset of
     *     <em>bot_administrator_rights</em>. If not specified, no additional restrictions are applied.
     * @param ChatAdministratorRights|null $bot_administrator_rights A JSON-serialized object listing the required
     *     administrator rights of the bot in the chat. The rights must be a subset of
     *     <em>user_administrator_rights</em>. If not specified, no additional restrictions are applied.
     * @param bool|null $bot_is_member Pass <em>True</em> to request a chat with the bot as a member.
     *     Otherwise, no additional restrictions are applied.
     */
    public function __construct(
        public int $request_id,
        public bool $chat_is_channel,
        public ?bool $chat_is_forum = null,
        public ?bool $chat_has_username = null,
        public ?bool $chat_is_created = null,
        public ?ChatAdministratorRights $user_administrator_rights = null,
        public ?ChatAdministratorRights $bot_administrator_rights = null,
        public ?bool $bot_is_member = null,
    )
    {

    }

    public static function makeByArray(array $data): self
    {
        return new self(
            request_id: $data['request_id'],
            chat_is_channel: $data['chat_is_channel'],
            chat_is_forum: $data['chat_is_forum'] ?? null,
            chat_has_username: $data['chat_has_username'] ?? null,
            chat_is_created: $data['chat_is_created'] ?? null,
            user_administrator_rights: isset($data['user_administrator_rights'])
                ? ChatAdministratorRights::makeByArray($data['user_administrator_rights'])
                : null,
            bot_administrator_rights: isset($data['bot_administrator_rights'])
                ? ChatAdministratorRights::makeByArray($data['bot_administrator_rights'])
                : null,
            bot_is_member: $data['bot_is_member'] ?? null,
        );
    }

    public function getRequestData(): array
    {
        return [
            'request_id' => $this->request_id,
            'chat_is_channel' => $this->chat_is_channel,
            'chat_is_forum' => $this->chat_is_forum,
            'chat_has_username' => $this->chat_has_username,
            'chat_is_created' => $this->chat_is_created,
            'user_administrator_rights' => $this->user_administrator_rights,
            'bot_administrator_rights' => $this->bot_administrator_rights,
            'bot_is_member' => $this->bot_is_member,
        ];
    }
}
