<?php

declare(strict_types=1);

namespace Kuvardin\TelegramBotsApi\Types\RichBlock;

use Kuvardin\TelegramBotsApi\Types\RichBlock;
use RuntimeException;
use Kuvardin\TelegramBotsApi\Types\RichText;

/**
 * An expandable block for details disclosure, corresponding to the HTML tag "&lt;details&gt;".
 *
 * @package Kuvardin\TelegramBotsApi
 * @author Maxim Kuvardin <maxim@kuvard.in>
 */
class Details extends RichBlock
{
    /**
     * @param RichText $summary Always shown summary of the block
     * @param RichBlock[] $blocks Content of the block
     * @param bool|null $is_open True, if the content of the block is visible by default
     */
    public function __construct(
        public RichText $summary,
        public array $blocks,
        public ?bool $is_open = null,
    )
    {

    }

    public static function getType(): string
    {
        return 'details';
    }

    public static function makeByArray(array $data): static
    {
        if ($data['type'] !== self::getType()) {
            throw new RuntimeException("Wrong rich block type: {$data['type']}");
        }

        return new self(
            summary: RichText::makeByInput($data['summary']),
            blocks: array_map(
                static fn(array $blocks_data) => RichBlock::makeByArray($blocks_data),
                $data['blocks'],
            ),
            is_open: $data['is_open'] ?? null,
        );
    }

    public function getRequestData(): array
    {
        return [
            'type' => self::getType(),
            'summary' => $this->summary,
            'blocks' => $this->blocks,
            'is_open' => $this->is_open,
        ];
    }
}

