<?php

declare(strict_types=1);

namespace Kuvardin\TelegramBotsApi\Types;

use Kuvardin\TelegramBotsApi\Type;

/**
 * Cell in a table.
 *
 * @package Kuvardin\TelegramBotsApi
 * @author Maxim Kuvardin <maxim@kuvard.in>
 */
class RichBlockTableCell extends Type
{
    /**
     * @param string $align Horizontal cell content alignment. Currently, must be one of “left”, “center”, or “right”.
     * @param string $valign Vertical cell content alignment. Currently, must be one of “top”, “middle”, or “bottom”.
     * @param RichText|null $text Text in the cell. If omitted, then the cell is invisible.
     * @param bool|null $is_header True, if the cell is a header cell
     * @param int|null $colspan The number of columns the cell spans if it is bigger than 1
     * @param int|null $rowspan The number of rows the cell spans if it is bigger than 1
     */
    public function __construct(
        public string $align,
        public string $valign,
        public ?RichText $text = null,
        public ?bool $is_header = null,
        public ?int $colspan = null,
        public ?int $rowspan = null,
    )
    {

    }

    public static function makeByArray(array $data): self
    {
        return new self(
            align: $data['align'],
            valign: $data['valign'],
            text: isset($data['text'])
                ? RichText::makeByInput($data['text'])
                : null,
            is_header: $data['is_header'] ?? null,
            colspan: $data['colspan'] ?? null,
            rowspan: $data['rowspan'] ?? null,
        );
    }

    public function getRequestData(): array
    {
        return [
            'align' => $this->align,
            'valign' => $this->valign,
            'text' => $this->text,
            'is_header' => $this->is_header,
            'colspan' => $this->colspan,
            'rowspan' => $this->rowspan,
        ];
    }
}

