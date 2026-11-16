<?php

declare(strict_types=1);

namespace Kuvardin\TelegramBotsApi\Types\InputRichBlock;

use Kuvardin\TelegramBotsApi\Types\InputRichBlock;
use Kuvardin\TelegramBotsApi\Types\InputMedia\Video as InputMediaVideo;
use Kuvardin\TelegramBotsApi\Types\RichBlockCaption;
use RuntimeException;

/**
 * A block with a video, corresponding to the HTML tag "&lt;video&gt;".
 *
 * @package Kuvardin\TelegramBotsApi
 * @author Maxim Kuvardin <maxim@kuvard.in>
 */
class Video extends InputRichBlock
{
    /**
     * @param InputMediaVideo $video The video. Caption is ignored.
     * @param RichBlockCaption|null $caption Caption of the block
     */
    public function __construct(
        public InputMediaVideo $video,
        public ?RichBlockCaption $caption = null,
    )
    {

    }

    public static function getType(): string
    {
        return 'video';
    }

    public static function makeByArray(array $data): static
    {
        if ($data['type'] !== self::getType()) {
            throw new RuntimeException("Wrong input rich block type: {$data['type']}");
        }

        return new self(
            video: InputMediaVideo::makeByArray($data['video']),
            caption: isset($data['caption'])
                ? RichBlockCaption::makeByArray($data['caption'])
                : null,
        );
    }

    public function getRequestData(): array
    {
        return [
            'type' => self::getType(),
            'video' => $this->video,
            'caption' => $this->caption,
        ];
    }
}

