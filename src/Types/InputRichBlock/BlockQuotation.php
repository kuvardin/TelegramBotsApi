<?php

declare(strict_types=1);

namespace Kuvardin\TelegramBotsApi\Types\InputRichBlock;

use Kuvardin\TelegramBotsApi\Types\InputRichBlock;
use Kuvardin\TelegramBotsApi\Types\RichText;
use RuntimeException;

/**
 * A block quotation, corresponding to the HTML tag "&lt;blockquote&gt;".
 *
 * @package Kuvardin\TelegramBotsApi
 * @author Maxim Kuvardin <maxim@kuvard.in>
 */
class BlockQuotation extends InputRichBlock
{
    /**
     * @param InputRichBlock[] $blocks Content of the block
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
            throw new RuntimeException("Wrong input rich block type: {$data['type']}");
        }

        return new self(
            blocks: array_map(
                static fn(array $blocks_data) => InputRichBlock::makeByArray($blocks_data),
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





