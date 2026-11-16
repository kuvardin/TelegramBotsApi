<?php

declare(strict_types=1);

namespace Kuvardin\TelegramBotsApi\Types;

use Kuvardin\TelegramBotsApi\Type;

/**
 * This object represents an incoming query from a widget in a message sent by the bot or via the bot. Use
 * answerWidgetQuery() to answer the query. Each user can send at most 5 queries per 5 seconds to the bot from all its
 * widgets.
 *
 * @package Kuvardin\TelegramBotsApi
 * @author Maxim Kuvardin <maxim@kuvard.in>
 */
class WidgetQuery extends Type
{
    /**
     * @param string $id Unique identifier for this query
     * @param User $from Sender
     * @param string $chat_instance Global identifier, uniquely corresponding to the chat to which the message with the
     *     widget was sent
     * @param WidgetQueryType $type Type of the query
     * @param string $data Data of the query, 1-64 bytes
     * @param Chat|null $chat Chat with the message containing the widget; omitted if the widget is in an inline
     *     message
     * @param int|null $message_id Identifier of the message containing the widget; omitted if the widget is in an
     *     inline message
     * @param string|null $inline_message_id Identifier of the inline message containing the widget
     * @param string|null $chat_type For widgets in inline messages, type of the chat to which the message was sent.
     *     Can be either “sender” for a private chat with the inline query sender, “private”, “group”, “supergroup”, or
     *     “channel”.
     * @param string|null $widget_id Unique identifier of the shared widget, which sent the query; omitted if the
     *     widget isn't shared
     */
    public function __construct(
        public string $id,
        public User $from,
        public string $chat_instance,
        public WidgetQueryType $type,
        public string $data,
        public Chat|null $chat = null,
        public int|null $message_id = null,
        public string|null $inline_message_id = null,
        public string|null $chat_type = null,
        public string|null $widget_id = null,
    )
    {

    }

    public static function makeByArray(array $data): self
    {
        return new self(
            id: $data['id'],
            from: User::makeByArray($data['from']),
            chat_instance: $data['chat_instance'],
            type: WidgetQueryType::makeByArray($data['type']),
            data: $data['data'],
            chat: isset($data['chat'])
                ? Chat::makeByArray($data['chat'])
                : null,
            message_id: $data['message_id'] ?? null,
            inline_message_id: $data['inline_message_id'] ?? null,
            chat_type: $data['chat_type'] ?? null,
            widget_id: $data['widget_id'] ?? null,
        );
    }

    public function getRequestData(): array
    {
        return [
            'id' => $this->id,
            'from' => $this->from,
            'chat_instance' => $this->chat_instance,
            'type' => $this->type,
            'data' => $this->data,
            'chat' => $this->chat,
            'message_id' => $this->message_id,
            'inline_message_id' => $this->inline_message_id,
            'chat_type' => $this->chat_type,
            'widget_id' => $this->widget_id,
        ];
    }
}





