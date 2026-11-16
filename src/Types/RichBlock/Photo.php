<?php

declare(strict_types=1);

namespace Kuvardin\TelegramBotsApi\Types\RichBlock;

use Kuvardin\TelegramBotsApi\Types\RichBlock;
use RuntimeException;
use Kuvardin\TelegramBotsApi\Types\PhotoSize;
use Kuvardin\TelegramBotsApi\Types\RichBlockCaption;

/**
 * A block with a photo, corresponding to the HTML tag "&lt;img&gt;".
 *
 * @package Kuvardin\TelegramBotsApi
 * @author Maxim Kuvardin <maxim@kuvard.in>
 */
class Photo extends RichBlock
{
    /**
     * @param PhotoSize[] $photo Available sizes of the photo
     * @param bool|null $has_spoiler True, if the media preview is covered by a spoiler animation
     * @param RichBlockCaption|null $caption Caption of the block
     */
    public function __construct(
        public array $photo,
        public ?bool $has_spoiler = null,
        public ?RichBlockCaption $caption = null,
    )
    {

    }

    public static function getType(): string
    {
        return 'photo';
    }

    public static function makeByArray(array $data): static
    {
        if ($data['type'] !== self::getType()) {
            throw new RuntimeException("Wrong rich block type: {$data['type']}");
        }

        return new self(
            photo: array_map(
                static fn(array $photo_data) => PhotoSize::makeByArray($photo_data),
                $data['photo'],
            ),
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
            'photo' => $this->photo,
            'has_spoiler' => $this->has_spoiler,
            'caption' => $this->caption,
        ];
    }
}

