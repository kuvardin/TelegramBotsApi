<?php

declare(strict_types=1);

namespace Kuvardin\TelegramBotsApi\Types;

use Kuvardin\TelegramBotsApi\Type;

/**
 * Describes reply parameters for the message that is being sent.
 *
 * @package Kuvardin\TelegramBotsApi
 * @author Maxim Kuvardin <maxim@kuvard.in>
 */
class ReplyParameters extends Type
{
    /**
     * @param int $message_id Identifier of the message that will be replied to in the current chat, or in the chat
     *     "chat_id" if it is specified
     * @param int|string|null $chat_id If the message to be replied to is from a different chat, unique identifier for
     *     the chat or username of the channel (in the format "&#64;channelusername"). Not supported for messages sent
     *     on behalf of a business account.
     * @param bool|null $allow_sending_without_reply Pass "True" if the message should be sent even if the specified
     *     message to be replied to is not found. Always "False" for replies in another chat or forum topic. Always
     *     "True" for messages sent on behalf of a business account.
     * @param string|null $quote Quoted part of the message to be replied to; 0-1024 characters after entities parsing.
     *     The quote must be an exact substring of the message to be replied to, including "bold", "italic",
     *     "underline", "strikethrough", "spoiler", and "custom_emoji" entities. The message will fail to send if the
     *     quote isn't found in the original message.
     * @param string|null $quote_parse_mode Mode for parsing entities in the quote. See formatting options for more
     *     details.
     * @param MessageEntity[]|null $quote_entities A JSON-serialized list of special entities that appear in the quote.
     *     It can be specified instead of "quote_parse_mode".
     * @param int|null $quote_position Position of the quote in the original message in UTF-16 code units
     */
    public function __construct(
        public int $message_id,
        public int|string|null $chat_id = null,
        public ?bool $allow_sending_without_reply = null,
        public ?string $quote = null,
        public ?string $quote_parse_mode = null,
        public ?array $quote_entities = null,
        public ?int $quote_position = null,
    )
    {

    }

    public static function makeByArray(array $data): self
    {
        return new self(
            message_id: $data['message_id'],
            chat_id: $data['chat_id'] ?? null,
            allow_sending_without_reply: $data['allow_sending_without_reply'] ?? null,
            quote: $data['quote'] ?? null,
            quote_parse_mode: $data['quote_parse_mode'] ?? null,
            quote_entities: isset($data['quote_entities'])
                ? array_map(
                    static fn(array $quote_entities_data) => MessageEntity::makeByArray($quote_entities_data),
                    $data['quote_entities'],
                )
                : null,
            quote_position: $data['quote_position'] ?? null,
        );
    }

    public function getRequestData(): array
    {
        return [
            'message_id' => $this->message_id,
            'chat_id' => $this->chat_id,
            'allow_sending_without_reply' => $this->allow_sending_without_reply,
            'quote' => $this->quote,
            'quote_parse_mode' => $this->quote_parse_mode,
            'quote_entities' => $this->quote_entities,
            'quote_position' => $this->quote_position,
        ];
    }
}
