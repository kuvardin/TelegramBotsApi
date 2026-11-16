<?php

declare(strict_types=1);

namespace Kuvardin\TelegramBotsApi\Types\InputRichBlock;

use Kuvardin\TelegramBotsApi\Types\InputRichBlock;
use Kuvardin\TelegramBotsApi\Types\RichBlockCaption;
use RuntimeException;

/**
 * A collage, corresponding to the custom HTML tag "&lt;tg-collage&gt;".
 *
 * @package Kuvardin\TelegramBotsApi
 * @author Maxim Kuvardin <maxim@kuvard.in>
 */
class Collage extends InputRichBlock
{
    /**
     * @param InputRichBlock[] $blocks Elements of the collage
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
            throw new RuntimeException("Wrong input rich block type: {$data['type']}");
        }

        return new self(
            blocks: array_map(
                static fn(array $blocks_data) => InputRichBlock::makeByArray($blocks_data),
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

