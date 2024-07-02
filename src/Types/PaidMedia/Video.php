<?php

declare(strict_types=1);

namespace Kuvardin\TelegramBotsApi\Types\PaidMedia;

use Kuvardin\TelegramBotsApi\Types\PaidMedia;
use Kuvardin\TelegramBotsApi\Types\Video as TelegramVideo;
use RuntimeException;

/**
 * The paid media is a video.
 *
 * @package Kuvardin\TelegramBotsApi
 * @author Maxim Kuvardin <maxim@kuvard.in>
 */
class Video extends PaidMedia
{
    /**
     * @param TelegramVideo $video The video
     */
    public function __construct(
        public TelegramVideo $video,
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
            throw new RuntimeException("Wrong paid media type: {$data['type']}");
        }

        return new self(
            video: TelegramVideo::makeByArray($data['video']),
        );
    }

    public function getRequestData(): array
    {
        return [
            'type' => self::getType(),
            'video' => $this->video,
        ];
    }
}
