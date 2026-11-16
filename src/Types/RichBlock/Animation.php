<?php

declare(strict_types=1);

namespace Kuvardin\TelegramBotsApi\Types\RichBlock;

use Kuvardin\TelegramBotsApi\Types\RichBlock;
use Kuvardin\TelegramBotsApi\Types\RichBlockCaption;
use RuntimeException;
use Kuvardin\TelegramBotsApi\Types\Animation as TelegramAnimation;

/**
 * A block with an animation, corresponding to the HTML tag "&lt;video&gt;".
 *
 * @package Kuvardin\TelegramBotsApi
 * @author Maxim Kuvardin <maxim@kuvard.in>
 */
class Animation extends RichBlock
{
    /**
     * @param TelegramAnimation $animation The animation
     * @param bool|null $has_spoiler True, if the media preview is covered by a spoiler animation
     * @param RichBlockCaption|null $caption Caption of the block
     */
    public function __construct(
        public TelegramAnimation $animation,
        public ?bool $has_spoiler = null,
        public ?RichBlockCaption $caption = null,
    )
    {

    }

    public static function getType(): string
    {
        return 'animation';
    }

    public static function makeByArray(array $data): static
    {
        if ($data['type'] !== self::getType()) {
            throw new RuntimeException("Wrong rich block type: {$data['type']}");
        }

        return new self(
            animation: TelegramAnimation::makeByArray($data['animation']),
            has_spoiler: $data['has_spoiler'] ?? null,
            caption: isset($data['caption'])
                ? RichBlockCaption::makeByArray($data['caption'])
                : null,
        );
    }

    public function getRequestData(): array
    {
        return [
            'type' => self::getType(),
            'animation' => $this->animation,
            'has_spoiler' => $this->has_spoiler,
            'caption' => $this->caption,
        ];
    }
}

