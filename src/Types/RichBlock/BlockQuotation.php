<?php

declare(strict_types=1);

namespace Kuvardin\TelegramBotsApi\Types\RichBlock;

use Kuvardin\TelegramBotsApi\Types\RichBlock;
use RuntimeException;
use Kuvardin\TelegramBotsApi\Types\RichText;

/**
 * A block quotation, corresponding to the HTML tag "&lt;blockquote&gt;".
 *
 * @package Kuvardin\TelegramBotsApi
 * @author Maxim Kuvardin <maxim@kuvard.in>
 */
class BlockQuotation extends RichBlock
{
    /**
     * @param RichBlock[] $blocks Content of the block
     * @param RichText|null $credit Credit of the block
     */
    public function __construct(
        public array $blocks,
        public ?RichText $credit = null,
    )
    {

    }

    public static function getType(): string
    {
        return 'blockquote';
    }

    public static function makeByArray(array $data): static
    {
        if ($data['type'] !== self::getType()) {
            throw new RuntimeException("Wrong rich block type: {$data['type']}");
        }

        return new self(
            blocks: array_map(
                static fn(array $blocks_data) => RichBlock::makeByArray($blocks_data),
                $data['blocks'],
            ),
            credit: isset($data['credit'])
                ? RichText::makeByInput($data['credit'])
                : null,
        );
    }

    public function getRequestData(): array
    {
        return [
            'type' => self::getType(),
            'blocks' => $this->blocks,
            'credit' => $this->credit,
        ];
    }
}

