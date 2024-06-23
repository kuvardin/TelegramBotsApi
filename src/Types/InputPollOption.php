<?php

declare(strict_types=1);

namespace Kuvardin\TelegramBotsApi\Types;

use Kuvardin\TelegramBotsApi\Type;

/**
 * This object contains information about one answer option in a poll to send.
 *
 * @package Kuvardin\TelegramBotsApi
 * @author Maxim Kuvardin <maxim@kuvard.in>
 */
class InputPollOption extends Type
{
    /**
     * @param string $text Option text, 1-100 characters
     * @param string|null $text_parse_mode Mode for parsing entities in the text. See formatting options for more
     *     details. Currently, only custom emoji entities are allowed
     * @param MessageEntity[]|null $text_entities A JSON-serialized list of special entities that appear in the poll
     *     option text. It can be specified instead of text_parse_mode
     */
    public function __construct(
        public string $text,
        public ?string $text_parse_mode = null,
        public ?array $text_entities = null,
    )
    {

    }

    public static function makeByArray(array $data): self
    {
        return new self(
            text: $data['text'],
            text_parse_mode: $data['text_parse_mode'] ?? null,
            text_entities: isset($data['text_entities'])
                ? array_map(
                    static fn(array $text_entities_data) => MessageEntity::makeByArray($text_entities_data),
                    $data['text_entities'],
                )
                : null,
        );
    }

    public function getRequestData(): array
    {
        return [
            'text' => $this->text,
            'text_parse_mode' => $this->text_parse_mode,
            'text_entities' => $this->text_entities,
        ];
    }
}
