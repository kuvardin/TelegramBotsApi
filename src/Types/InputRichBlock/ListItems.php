<?php

declare(strict_types=1);

namespace Kuvardin\TelegramBotsApi\Types\InputRichBlock;

use Kuvardin\TelegramBotsApi\Types\InputRichBlock;
use Kuvardin\TelegramBotsApi\Types\InputRichBlockListItem;
use RuntimeException;

/**
 * A list of blocks, corresponding to the HTML tag "&lt;ul&gt;" or "&lt;ol&gt;" with multiple nested tags "&lt;li&gt;".
 *
 * @package Kuvardin\TelegramBotsApi
 * @author Maxim Kuvardin <maxim@kuvard.in>
 */
class ListItems extends InputRichBlock
{
    /**
     * @param InputRichBlockListItem[] $items Items of the list
     */
    public function __construct(
        public array $items,
    )
    {

    }

    public static function getType(): string
    {
        return 'list';
    }

    public static function makeByArray(array $data): static
    {
        if ($data['type'] !== self::getType()) {
            throw new RuntimeException("Wrong input rich block type: {$data['type']}");
        }

        return new self(
            items: array_map(
                static fn(array $items_data) => InputRichBlockListItem::makeByArray($items_data),
                $data['items'],
            ),
        );
    }

    public function getRequestData(): array
    {
        return [
            'type' => self::getType(),
            'items' => $this->items,
        ];
    }
}

