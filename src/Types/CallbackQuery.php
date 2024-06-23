<?php

declare(strict_types=1);

namespace Kuvardin\TelegramBotsApi\Types;

use Kuvardin\TelegramBotsApi\Type;

/**
 * This object represents an incoming callback query from a callback button in an inline keyboard. If the button that
 * originated the query was attached to a message sent by the bot, the field "message" will be present. If the button
 * was attached to a message sent via the bot (in inline mode), the field "inline_message_id" will be present. Exactly
 * one of the fields "data" or "game_short_name" will be present.
 *
 * @package Kuvardin\TelegramBotsApi
 * @author Maxim Kuvardin <maxim@kuvard.in>
 */
class CallbackQuery extends Type
{
    /**
     * @param string $id Unique identifier for this query
     * @param User $from Sender
     * @param string $chat_instance Global identifier, uniquely corresponding to the chat to which the message with the
     *     callback button was sent. Useful for high scores in games.
     * @param MaybeInaccessibleMessage|null $message Message sent by the bot with the callback button that originated
     *     the query
     * @param string|null $inline_message_id Identifier of the message sent via the bot in inline mode, that originated
     *     the query.
     * @param string|null $data Data associated with the callback button. Be aware that the message originated the
     *     query can contain no callback buttons with this data.
     * @param string|null $game_short_name Short name of a Game to be returned, serves as the unique identifier for the
     *     game
     */
    public function __construct(
        public string $id,
        public User $from,
        public string $chat_instance,
        public ?MaybeInaccessibleMessage $message = null,
        public ?string $inline_message_id = null,
        public ?string $data = null,
        public ?string $game_short_name = null,
    )
    {

    }

    public static function makeByArray(array $data): self
    {
        return new self(
            id: $data['id'],
            from: User::makeByArray($data['from']),
            chat_instance: $data['chat_instance'],
            message: isset($data['message'])
                ? MaybeInaccessibleMessage::makeByArray($data['message'])
                : null,
            inline_message_id: $data['inline_message_id'] ?? null,
            data: $data['data'] ?? null,
            game_short_name: $data['game_short_name'] ?? null,
        );
    }

    public function getRequestData(): array
    {
        return [
            'id' => $this->id,
            'from' => $this->from,
            'message' => $this->message,
            'inline_message_id' => $this->inline_message_id,
            'chat_instance' => $this->chat_instance,
            'data' => $this->data,
            'game_short_name' => $this->game_short_name,
        ];
    }
}
