<?php

declare(strict_types=1);

namespace Kuvardin\TelegramBotsApi\Types;

use Kuvardin\TelegramBotsApi\Exceptions\Error;

/**
 * This object represents an incoming callback query from a callback button in an inline keyboard.
 * If the button that originated the query was attached to a message sent by the bot, the field message
 * will be present. If the button was attached to a message sent via the bot (in inline mode), the field
 * inline_message_id will be present. Exactly one of the fields data or game_short_name will be present.
 *
 * @package Kuvardin\TelegramBotsApi
 * @author Maxim Kuvardin <maxim@kuvard.in>
 */
class CallbackQuery implements TypeInterface
{
    /**
     * @var string Unique identifier for this query
     */
    public string $id;

    /**
     * @var User Sender
     */
    public User $from;

    /**
     * @var Message|null Message with the callback button that originated the query. Note that message
     * content and message date will not be available if the message is too old
     */
    public ?Message $message = null;

    /**
     * @var string|null Identifier of the message sent via the bot in inline mode, that originated the query.
     */
    public ?string $inline_message_id = null;

    /**
     * @var string Global identifier, uniquely corresponding to the chat to which the message with
     * the callback button was sent. Useful for high scores in games.
     */
    public string $chat_instance;

    /**
     * @var string|null Data associated with the callback button. Be aware that a bad client can send
     * arbitrary data in this field.
     */
    public ?string $data = null;

    /**
     * @var string|null Short name of a Game to be returned, serves as the unique identifier for the game
     */
    public ?string $game_short_name = null;

    /**
     * CallbackQuery constructor.
     *
     * @param array $data
     * @throws Error
     */
    public function __construct(array $data)
    {
        $this->id = $data['id'];
        $this->from = $data['from'] instanceof User
            ? $data['from']
            : new User($data['from']);
        if (isset($data['message'])) {
            $this->message = $data['message'] instanceof Message
                ? $data['message']
                : new Message($data['message']);
        }

        if (isset($data['inline_message_id'])) {
            $this->inline_message_id = $data['inline_message_id'];
        }

        $this->chat_instance = $data['chat_instance'];
        if (isset($data['data'])) {
            $this->data = $data['data'];
        }

        if (isset($data['game_short_name'])) {
            $this->game_short_name = $data['game_short_name'];
        }

    }

    /**
     * @param string $id Unique identifier for this query
     * @param User $from Sender
     * @param string $chat_instance Global identifier, uniquely corresponding to the chat to which
     * the message with the callback button was sent. Useful for high scores in games.
     * @return CallbackQuery
     * @throws Error
     */
    public static function make(string $id, User $from, string $chat_instance): self
    {
        return new self([
            'id' => $id,
            'from' => $from,
            'chat_instance' => $chat_instance,
        ]);
    }

    /**
     * @return array
     */
    public function getRequestArray(): array
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
