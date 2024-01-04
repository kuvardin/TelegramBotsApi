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
     * @param string $text Text of the quoted part of a message that is replied to by the given message
     * @param int $position Approximate quote position in the original message in UTF-16 code units as specified by the
     *     sender
     * @param MessageEntity[]|null $entities Special entities that appear in the quote. Currently, only bold, italic,
     *     underline, strikethrough, spoiler, and custom_emoji entities are kept in quotes.
     * @param bool|null $is_manual True, if the quote was chosen manually by the message sender. Otherwise, the quote
     *     was added automatically by the server.
     */
    public function __construct(
        public string $text,
        public int $position,
        public ?array $entities = null,
        public ?bool $is_manual = null,
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
        );
    }

    public function getRequestData(): array
    {
        return [
            'text' => $this->text,
            'entities' => $this->entities,
            'position' => $this->position,
            'is_manual' => $this->is_manual,
        ];
    }
}
