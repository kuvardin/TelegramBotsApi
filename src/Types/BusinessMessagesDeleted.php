<?php

declare(strict_types=1);

namespace Kuvardin\TelegramBotsApi\Types;

use Kuvardin\TelegramBotsApi\Type;

/**
 * This object is received when messages are deleted from a connected business account.
 *
 * @package Kuvardin\TelegramBotsApi
 * @author Maxim Kuvardin <maxim@kuvard.in>
 */
class BusinessMessagesDeleted extends Type
{
    /**
     * @param string $business_connection_id Unique identifier of the business connection
     * @param Chat $chat Information about a chat in the business account. The bot may not have access to the chat
     *     or the corresponding user.
     * @param int[] $message_ids The list of identifiers of deleted messages in the chat of the business account
     */
    public function __construct(
        public string $business_connection_id,
        public Chat $chat,
        public array $message_ids,
    )
    {

    }

    public static function makeByArray(array $data): self
    {
        return new self(
            business_connection_id: $data['business_connection_id'],
            chat: Chat::makeByArray($data['chat']),
            message_ids: $data['message_ids'],
        );
    }

    public function getRequestData(): array
    {
        return [
            'business_connection_id' => $this->business_connection_id,
            'chat' => $this->chat,
            'message_ids' => $this->message_ids,
        ];
    }
}
