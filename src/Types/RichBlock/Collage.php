<?php

declare(strict_types=1);

namespace Kuvardin\TelegramBotsApi\Types\RichBlock;

use Kuvardin\TelegramBotsApi\Types\RichBlock;
use RuntimeException;
use Kuvardin\TelegramBotsApi\Types\RichBlockCaption;

/**
 * A collage, corresponding to the custom HTML tag "&lt;tg-collage&gt;".
 *
 * @package Kuvardin\TelegramBotsApi
 * @author Maxim Kuvardin <maxim@kuvard.in>
 */
class Collage extends RichBlock
{
    /**
     * @param RichBlock[] $blocks Elements of the collage
     * @param RichBlockCaption|null $caption Caption of the block
     */
    public function __construct(
        public array $blocks,
        public ?RichBlockCaption $caption = null,
    )
    {

    }

    public static function getType(): string
    {
        return 'collage';
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
            caption: isset($data['caption'])
                ? RichBlockCaption::makeByArray($data['caption'])
                : null,
        );
    }

    public function getRequestData(): array
    {
        return [
            'type' => self::getType(),
            'blocks' => $this->blocks,
            'caption' => $this->caption,
        ];
    }
}

