<?php

declare(strict_types=1);

namespace Kuvardin\TelegramBotsApi\Types;

use Kuvardin\TelegramBotsApi\Type;
use Kuvardin\TelegramBotsApi\Enums\ParseMode;

/**
 * Describes a task to add to a checklist.
 *
 * @package Kuvardin\TelegramBotsApi
 * @author Maxim Kuvardin <maxim@kuvard.in>
 */
class InputChecklistTask extends Type
{
    /**
     * @param int $id Unique identifier of the task; must be positive and unique among all task identifiers currently
     *     present in the checklist
     * @param string $text Text of the task; 1-100 characters after entities parsing
     * @param ParseMode|string|null $parse_mode Mode for parsing entities in the text.
     * @param MessageEntity[]|null $text_entities List of special entities that appear in the text, which can be
     *     specified instead of parse_mode. Currently, only "bold", "italic", "underline", "strikethrough", "spoiler",
     *     "custom_emoji", and "date_time" entities are allowed.
     */
    public function __construct(
        public int $id,
        public string $text,
        public ParseMode|string|null $parse_mode = null,
        public ?array $text_entities = null,
    )
    {

    }

    public static function makeByArray(array $data): self
    {
        return new self(
            id: $data['id'],
            text: $data['text'],
            parse_mode: $data['parse_mode'] ?? null,
            text_entities: isset($data['text_entities'])
                ? array_map(
                    static fn(array $entity_data) => MessageEntity::makeByArray($entity_data),
                    $data['text_entities'],
                )
                : null,
        );
    }

    public function getRequestData(): array
    {
        return [
            'id' => $this->id,
            'text' => $this->text,
            'parse_mode' => $this->parse_mode,
            'text_entities' => $this->text_entities,
        ];
    }
}
