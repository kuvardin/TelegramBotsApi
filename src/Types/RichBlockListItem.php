<?php

declare(strict_types=1);

namespace Kuvardin\TelegramBotsApi\Types;

use Kuvardin\TelegramBotsApi\Type;

/**
 * An item of a list.
 *
 * @package Kuvardin\TelegramBotsApi
 * @author Maxim Kuvardin <maxim@kuvard.in>
 */
class RichBlockListItem extends Type
{
    /**
     * @param string $label Label of the item
     * @param RichBlock[] $blocks The content of the item
     * @param bool|null $has_checkbox True, if the item has a checkbox
     * @param bool|null $is_checked True, if the item has a checked checkbox
     * @param int|null $value For ordered lists, the numeric value of the item label
     * @param string|null $type For ordered lists, the type of the item label; must be one of “a” for lowercase
     *     letters, “A” for uppercase letters, “i” for lowercase Roman numerals, “I” for uppercase Roman numerals, or
     *     “1” for decimal numbers
     */
    public function __construct(
        public string $label,
        public array $blocks,
        public bool|null $has_checkbox = null,
        public bool|null $is_checked = null,
        public int|null $value = null,
        public string|null $type = null,
    )
    {

    }

    public static function makeByArray(array $data): self
    {
        return new self(
            label: $data['label'],
            blocks: array_map(
                static fn(array $blocks_data) => RichBlock::makeByArray($blocks_data),
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
            'label' => $this->label,
            'blocks' => $this->blocks,
            'has_checkbox' => $this->has_checkbox,
            'is_checked' => $this->is_checked,
            'value' => $this->value,
            'type' => $this->type,
        ];
    }
}





