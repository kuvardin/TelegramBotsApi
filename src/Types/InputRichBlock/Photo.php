<?php

declare(strict_types=1);

namespace Kuvardin\TelegramBotsApi\Types\InputRichBlock;

use Kuvardin\TelegramBotsApi\Types\InputRichBlock;
use Kuvardin\TelegramBotsApi\Types\InputMedia\Photo as InputMediaPhoto;
use Kuvardin\TelegramBotsApi\Types\RichBlockCaption;
use RuntimeException;

/**
 * A block with a photo, corresponding to the HTML tag "&lt;img&gt;".
 *
 * @package Kuvardin\TelegramBotsApi
 * @author Maxim Kuvardin <maxim@kuvard.in>
 */
class Photo extends InputRichBlock
{
    /**
     * @param InputMediaPhoto $photo The photo. Caption is ignored.
     * @param RichBlockCaption|null $caption Caption of the block
     */
    public function __construct(
        public InputMediaPhoto $photo,
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
            throw new RuntimeException("Wrong input rich block type: {$data['type']}");
        }

        return new self(
            photo: InputMediaPhoto::makeByArray($data['photo']),
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
            'caption' => $this->caption,
        ];
    }
}





