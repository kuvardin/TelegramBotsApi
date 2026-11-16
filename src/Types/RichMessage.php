<?php

declare(strict_types=1);

namespace Kuvardin\TelegramBotsApi\Types;

use Kuvardin\TelegramBotsApi\Type;

/**
 * Rich formatted message.
 *
 * @package Kuvardin\TelegramBotsApi
 * @author Maxim Kuvardin <maxim@kuvard.in>
 */
class RichMessage extends Type
{
    /**
     * @param RichBlock[] $blocks Content of the message
     * @param bool|null $is_rtl True, if the rich message must be shown right-to-left
     */
    public function __construct(
        public array $blocks,
        public ?bool $is_rtl = null,
    )
    {

    }

    public static function makeByArray(array $data): self
    {
        return new self(
            blocks: array_map(
                static fn(array $blocks_data) => RichBlock::makeByArray($blocks_data),
                $data['blocks'],
            ),
            is_rtl: $data['is_rtl'] ?? null,
        );
    }

    public function getRequestData(): array
    {
        return [
            'blocks' => $this->blocks,
            'is_rtl' => $this->is_rtl,
        ];
    }
}

