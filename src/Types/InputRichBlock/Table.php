<?php

declare(strict_types=1);

namespace Kuvardin\TelegramBotsApi\Types\InputRichBlock;

use Kuvardin\TelegramBotsApi\Types\InputRichBlock;
use Kuvardin\TelegramBotsApi\Types\RichBlockTableCell;
use Kuvardin\TelegramBotsApi\Types\RichText;
use RuntimeException;

/**
 * A table, corresponding to the HTML tag "&lt;table&gt;".
 *
 * @package Kuvardin\TelegramBotsApi
 * @author Maxim Kuvardin <maxim@kuvard.in>
 */
class Table extends InputRichBlock
{
    /**
     * @param RichBlockTableCell[][] $cells Cells of the table
     * @param bool|null $is_bordered Pass True if the table has borders
     * @param bool|null $is_striped Pass True if the table is striped
     * @param bool|null $is_compact Pass True if table cells must have smaller indents
     * @param RichText|null $caption Caption of the table
     */
    public function __construct(
        public array $cells,
        public ?bool $is_bordered = null,
        public ?bool $is_striped = null,
        public ?bool $is_compact = null,
        public ?RichText $caption = null,
    )
    {

    }

    public static function getType(): string
    {
        return 'table';
    }

    public static function makeByArray(array $data): static
    {
        if ($data['type'] !== self::getType()) {
            throw new RuntimeException("Wrong input rich block type: {$data['type']}");
        }

        return new self(
            cells: array_map(
                static fn(array $list_cells_data) => array_map(
                    static fn(array $cell_data) => RichBlockTableCell::makeByArray($cell_data),
                    $list_cells_data,
                ),
                $data['cells'],
            ),
            is_bordered: $data['is_bordered'] ?? null,
            is_striped: $data['is_striped'] ?? null,
            is_compact: $data['is_compact'] ?? null,
            caption: isset($data['caption'])
                ? RichText::makeByInput($data['caption'])
                : null,
        );
    }

    public function getRequestData(): array
    {
        return [
            'type' => self::getType(),
            'cells' => $this->cells,
            'is_bordered' => $this->is_bordered,
            'is_striped' => $this->is_striped,
            'is_compact' => $this->is_compact,
            'caption' => $this->caption,
        ];
    }
}





