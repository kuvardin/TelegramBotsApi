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
     * @param int|null $message_id Identifier of the message that will be replied to in the current chat, or in the
     *     chat 'chat_id' if it is specified. Required if 'ephemeral_message_id' isn't specified.
     * @param int|string|null $chat_id If the message to be replied to is from a different chat, unique identifier for
     *     the chat or username of the bot, supergroup, or channel in the format '&#64;username'. Not supported for
     *     messages sent on behalf of a business account, messages from channel direct messages chats and ephemeral
     *     messages.
     * @param bool|null $allow_sending_without_reply Pass True if the message should be sent even if the specified
     *     message to be replied to is not found. Always 'False' for replies in another chat or forum topic, and sent
     *     ephemeral messages. Always True for messages sent on behalf of a business account.
     * @param string|null $quote Quoted part of the message to be replied to; 0-1024 characters after entities parsing.
     *     The quote must be an exact substring of the message to be replied to, including 'bold', 'italic',
     *     'underline', 'strikethrough', 'spoiler', 'custom_emoji', and 'date_time' entities. The message will fail to
     *     send if the quote isn't found in the original message. Ignored for ephemeral messages.
     * @param string|null $quote_parse_mode Mode for parsing entities in the quote. See formatting options for more
     *     details.
     * @param MessageEntity[]|null $quote_entities A JSON-serialized list of special entities that appear in the quote.
     *     It can be specified instead of "quote_parse_mode".
     * @param int|null $quote_position Position of the quote in the original message in UTF-16 code units. For quotes
     *     from rich messages, it is the position in the text formed by joining plain texts of all quotable texts of
     *     the message, separated by line feeds.
     * @param int|null $checklist_task_id Identifier of the specific checklist task to be replied to
     * @param string|null $poll_option_id Persistent identifier of the specific poll option to be replied to
     * @param RichText[]|null $quote_rich_texts A JSON-serialized list of quoted parts of the rich message to be
     *     replied to. Must contain one element for each quoted text of the message in the order of their appearance.
     *     Each of the following is a separate quoted text: the text of a paragraph, a heading, a preformatted block, a
     *     footer, or a mathematical expression; the text and the credit of a block quotation or a pull quotation; the
     *     summary of a details block; the caption and each cell of a table; the text and the credit of a caption of a
     *     media block, a collage, a slideshow, or a map. Texts of blocks nested in lists, block quotations, details,
     *     collages, and slideshows are separate quoted texts too. The first and the last elements can contain only a
     *     part of the corresponding text; all other elements must contain the whole text. Formatting of the quoted
     *     parts must be kept, and rich texts must be nested in the same way as in the message received from the
     *     server. Mathematical expressions must be quoted entirely. Buttons in RichBlockButtons, anchors and dividers
     *     can't be quoted. Up to 32 quoted texts with total length up to 1024 characters can be specified. Only plain
     *     text, RichTextBold, RichTextItalic, RichTextUnderline, RichTextStrikethrough, RichTextSpoiler,
     *     RichTextSubscript, RichTextSuperscript, RichTextDateTime, RichTextCustomEmoji,
     *     RichTextMathematicalExpression, and arrays of them are kept in the quote; other rich text types are replaced
     *     with their text. If non-empty, then "quote", "quote_parse_mode" and "quote_entities" are ignored.
     * @param int|null $ephemeral_message_id Identifier of the incoming ephemeral message that will be replied to in
     *     the current chat. A reply to an ephemeral message must itself be an ephemeral message. An ephemeral message
     *     may only be replied to within 15 seconds of being sent. Required if 'message_id' isn't specified.
     */
    public function __construct(
        public ?int $message_id,
        public int|string|null $chat_id = null,
        public ?bool $allow_sending_without_reply = null,
        public ?string $quote = null,
        public ?string $quote_parse_mode = null,
        public ?array $quote_entities = null,
        public ?int $quote_position = null,
        public ?int $checklist_task_id = null,
        public ?string $poll_option_id = null,
        public ?array $quote_rich_texts = null,
        public ?int $ephemeral_message_id = null,
    )
    {

    }

    public static function makeByArray(array $data): self
    {
        return new self(
            message_id: $data['message_id'] ?? null,
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
            checklist_task_id: $data['checklist_task_id'] ?? null,
            poll_option_id: $data['poll_option_id'] ?? null,
            quote_rich_texts: isset($data['quote_rich_texts'])
                ? array_map(
                    static fn(array $quote_rich_texts_data) => RichText::makeByInput($quote_rich_texts_data),
                    $data['quote_rich_texts'],
                )
                : null,
            ephemeral_message_id: $data['ephemeral_message_id'] ?? null,
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
            'checklist_task_id' => $this->checklist_task_id,
            'poll_option_id' => $this->poll_option_id,
            'quote_rich_texts' => $this->quote_rich_texts,
            'ephemeral_message_id' => $this->ephemeral_message_id,
        ];
    }
}
