<?php

declare(strict_types=1);

namespace Kuvardin\TelegramBotsApi\Types;

use Kuvardin\TelegramBotsApi\Type;

/**
 * An item of a list to be sent.
 *
 * @package Kuvardin\TelegramBotsApi
 * @author Maxim Kuvardin <maxim@kuvard.in>
 */
class InputRichBlockListItem extends Type
{
    /**
     * @param InputRichBlock[] $blocks The content of the item
     * @param bool|null $has_checkbox Pass True if the item has a checkbox
     * @param bool|null $is_checked Pass True if the item has a checked checkbox
     * @param int|null $value For ordered lists, the numeric value of the item label
     * @param string|null $type For ordered lists, the type of the item label; must be one of “a” for lowercase
     *     letters, “A” for uppercase letters, “i” for lowercase Roman numerals, “I” for uppercase Roman numerals, or
     *     “1” for decimal numbers
     */
    public function __construct(
        public array $blocks,
        public ?bool $has_checkbox = null,
        public ?bool $is_checked = null,
        public ?int $value = null,
        public ?string $type = null,
    )
    {

    }

    public static function makeByArray(array $data): self
    {
        return new self(
            blocks: array_map(
                static fn(array $blocks_data) => InputRichBlock::makeByArray($blocks_data),
                $data['blocks'],
            ),
            has_checkbox: $data['has_checkbox'] ?? null,
            is_checked: $data['is_checked'] ?? null,
            value: $data['value'] ?? null,
            type: $data['type'] ?? null,
        );
    }

    public function getRequestData(): array
    {
        return [
            'blocks' => $this->blocks,
            'has_checkbox' => $this->has_checkbox,
            'is_checked' => $this->is_checked,
            'value' => $this->value,
            'type' => $this->type,
        ];
    }
}

