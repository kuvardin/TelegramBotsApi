<?php

declare(strict_types=1);

namespace Kuvardin\TelegramBotsApi\Types\InputRichBlock;

use Kuvardin\TelegramBotsApi\Types\InputRichBlock;
use RuntimeException;
use Kuvardin\TelegramBotsApi\Types\InputMedia\Animation as InputMediaAnimation;
use Kuvardin\TelegramBotsApi\Types\RichBlockCaption;

/**
 * A block with an animation, corresponding to the HTML tag "&lt;video&gt;".
 *
 * @package Kuvardin\TelegramBotsApi
 * @author Maxim Kuvardin <maxim@kuvard.in>
 */
class Animation extends InputRichBlock
{
    /**
     * @param InputMediaAnimation $animation The animation. Caption is ignored.
     * @param RichBlockCaption|null $caption Caption of the block
     */
    public function __construct(
        public InputMediaAnimation $animation,
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
            throw new RuntimeException("Wrong input rich block type: {$data['type']}");
        }

        return new self(
            animation: InputMediaAnimation::makeByArray($data['animation']),
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
            'caption' => $this->caption,
        ];
    }
}

