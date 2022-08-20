<?php

declare(strict_types=1);

namespace Kuvardin\TelegramBotsApi\Types;

use Kuvardin\TelegramBotsApi\Type;

/**
 * This object represents an incoming callback query from a callback button in an <a
 * href="https://core.telegram.org/bots#inline-keyboards-and-on-the-fly-updating">inline keyboard</a>. If the button
 * that originated the query was attached to a message sent by the bot, the field <em>message</em> will be present. If
 * the button was attached to a message sent via the bot (in <a
 * href="https://core.telegram.org/bots/api#inline-mode">inline mode</a>), the field <em>inline_message_id</em> will be
 * present. Exactly one of the fields <em>data</em> or <em>game_short_name</em> will be present.<br><br>
 *
 * <strong>NOTE:</strong> After the user presses a callback button, Telegram clients will display a progress bar until
 * you call <a href="https://core.telegram.org/bots/api#answercallbackquery">answerCallbackQuery</a>. It is, therefore,
 * necessary to react by calling <a
 * href="https://core.telegram.org/bots/api#answercallbackquery">answerCallbackQuery</a> even if no notification to the
 * user is needed (e.g., without specifying any of the optional parameters).
 *
 * @package Kuvardin\TelegramBotsApi
 * @author Maxim Kuvardin <maxim@kuvard.in>
 */
class CallbackQuery extends Type
{
    /**
     * @var string $id Unique identifier for this query
     */
    public string $id;

    /**
     * @var User $from Sender
     */
    public User $from;

    /**
     * @var Message|null $message Message with the callback button that originated the query. Note that message content
     *     and message date will not be available if the message is too old
     */
    public ?Message $message = null;

    /**
     * @var string|null $inline_message_id Identifier of the message sent via the bot in inline mode, that originated
     *     the query.
     */
    public ?string $inline_message_id = null;

    /**
     * @var string $chat_instance Global identifier, uniquely corresponding to the chat to which the message with the
     *     callback button was sent. Useful for high scores in <a
     *     href="https://core.telegram.org/bots/api#games">games</a>.
     */
    public string $chat_instance;

    /**
     * @var string|null $data Data associated with the callback button. Be aware that a bad client can send arbitrary
     *     data in this field.
     */
    public ?string $data = null;

    /**
     * @var string|null $game_short_name Short name of a <a href="https://core.telegram.org/bots/api#games">Game</a> to
     *     be returned, serves as the unique identifier for the game
     */
    public ?string $game_short_name = null;

    public static function makeByArray(array $data): self
    {
        $result = new self;
        $result->id = $data['id'];
        $result->from = User::makeByArray($data['from']);
        $result->message = isset($data['message'])
            ? Message::makeByArray($data['message'])
            : null;
        $result->inline_message_id = $data['inline_message_id'] ?? null;
        $result->chat_instance = $data['chat_instance'];
        $result->data = $data['data'] ?? null;
        $result->game_short_name = $data['game_short_name'] ?? null;
        return $result;
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
