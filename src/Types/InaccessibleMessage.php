<?php

declare(strict_types=1);

namespace Kuvardin\TelegramBotsApi\Types;

/**
 * This object describes a message that was deleted or is otherwise inaccessible to the bot.
 *
 * @package Kuvardin\TelegramBotsApi
 * @author Maxim Kuvardin <maxim@kuvard.in>
 */
class InaccessibleMessage extends MaybeInaccessibleMessage
{
    /**
     * @param Chat $chat Chat the message belonged to
     * @param int $message_id Unique message identifier inside the chat
     * @param int $date Always 0. The field can be used to differentiate regular and inaccessible messages.
     */
    public function __construct(
        public Chat $chat,
        public int $message_id,
        public int $date,
    )
    {

    }

    public static function makeByArray(array $data): self
    {
        return new self(
            chat: Chat::makeByArray($data['chat']),
            message_id: $data['message_id'],
            date: $data['date'],
        );
    }

    public function getRequestData(): array
    {
        return [
            'chat' => $this->chat,
            'message_id' => $this->message_id,
            'date' => $this->date,
        ];
    }
}
