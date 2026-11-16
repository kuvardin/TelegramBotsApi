<?php

declare(strict_types=1);

namespace Kuvardin\TelegramBotsApi\Types;

use Kuvardin\TelegramBotsApi\Type;

/**
 * @package Kuvardin\TelegramBotsApi
 * @author Maxim Kuvardin <maxim@kuvard.in>
 */
class EphemeralMessageParameters extends Type
{
    /**
     * @param int|null $receiver_user_id Identifier of the user who will receive the message; required unless the
     *     message is sent as an ephemeral reply to a callback query. If omitted, then the parameter "chat_id" of the
     *     method is ignored. If specified together with "callback_query_id", then it must be the identifier of the
     *     user who pressed the button. Must be omitted for messages sent in chats where the bot isn't a member, unless
     *     the message is a reply to an ephemeral message. It is not guaranteed that the user will receive the message,
     *     especially if they are offline. See here for more details.
     * @param string|null $callback_query_id Identifier of the callback query which triggered the message, if any. If
     *     specified and "receiver_user_id" is omitted, then the message is sent as an ephemeral reply to the callback
     *     query and will be shown only to the user who pressed the button. Ephemeral replies can't be sent to callback
     *     queries from messages in channel direct messages chats. The bot must still answer the callback query using
     *     answerCallbackQuery().
     * @param bool|null $replace_callback_query_message Pass True if the ephemeral message must be shown in place of
     *     the original message. Must be "False" for callback queries from ephemeral messages, which must be edited
     *     using regular "editEphemeralMessage…" methods.
     */
    public function __construct(
        public ?int $receiver_user_id = null,
        public ?string $callback_query_id = null,
        public ?bool $replace_callback_query_message = null,
    )
    {

    }

    public static function makeByArray(array $data): self
    {
        return new self(
            receiver_user_id: $data['receiver_user_id'] ?? null,
            callback_query_id: $data['callback_query_id'] ?? null,
            replace_callback_query_message: $data['replace_callback_query_message'] ?? null,
        );
    }

    public function getRequestData(): array
    {
        return [
            'receiver_user_id' => $this->receiver_user_id,
            'callback_query_id' => $this->callback_query_id,
            'replace_callback_query_message' => $this->replace_callback_query_message,
        ];
    }
}
