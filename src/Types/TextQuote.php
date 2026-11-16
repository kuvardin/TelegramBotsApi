<?php

declare(strict_types=1);

namespace Kuvardin\TelegramBotsApi\Types;

use Kuvardin\TelegramBotsApi\Type;

/**
 * This object contains information about the quoted part of a message that is replied to by the given message.
 *
 * @package Kuvardin\TelegramBotsApi
 * @author Maxim Kuvardin <maxim@kuvard.in>
 */
class TextQuote extends Type
{
    /**
     * @param string $text Text of the quoted part of a message that is replied to by the given message; may be empty
     *     if the quote was chosen from a rich message
     * @param int $position Approximate quote position in the original message in UTF-16 code units as specified by the
     *     sender. For quotes from rich messages, it is the position in the text formed by joining plain texts of all
     *     quotable texts of the message, separated by line feeds.
     * @param MessageEntity[]|null $entities Special entities that appear in the quote. Currently, only "bold",
     *     "italic", "underline", "strikethrough", "spoiler", "custom_emoji", and "date_time" entities are kept in
     *     quotes.
     * @param bool|null $is_manual True, if the quote was chosen manually by the message sender. Otherwise, the quote
     *     was added automatically by the server.
     * @param RichText[]|null $rich_texts Rich text of the quote if it was chosen from a rich message. May contain only
     *     plain text, RichTextBold, RichTextItalic, RichTextUnderline, RichTextStrikethrough, RichTextSpoiler,
     *     RichTextSubscript, RichTextSuperscript, RichTextDateTime, RichTextCustomEmoji,
     *     RichTextMathematicalExpression, and arrays of them.
     */
    public function __construct(
        public string $text,
        public int $position,
        public ?array $entities = null,
        public ?bool $is_manual = null,
        public array|null $rich_texts = null,
    )
    {

    }

    public static function makeByArray(array $data): self
    {
        return new self(
            text: $data['text'],
            position: $data['position'],
            entities: isset($data['entities'])
                ? array_map(
                    static fn(array $item_data) => MessageEntity::makeByArray($item_data),
                    $data['entities'],
                )
                : null,
            is_manual: $data['is_manual'] ?? null,
            rich_texts: isset($data['rich_texts'])
                ? array_map(
                    static fn(array $rich_texts_data) => RichText::makeByInput($rich_texts_data),
                    $data['rich_texts'],
                )
                : null,
        );
    }

    public function getRequestData(): array
    {
        return [
            'text' => $this->text,
            'entities' => $this->entities,
            'position' => $this->position,
            'is_manual' => $this->is_manual,
            'rich_texts' => $this->rich_texts,
        ];
    }
}
