<?php

declare(strict_types=1);

namespace Kuvardin\TelegramBotsApi\Types;

use Kuvardin\TelegramBotsApi\Type;

/**
 * This object represents a <a href="https://telegram.org/blog/video-messages-and-telescope">video message</a>
 * (available in Telegram apps as of <a href="https://telegram.org/blog/video-messages-and-telescope">v.4.0</a>).
 *
 * @package Kuvardin\TelegramBotsApi
 * @author Maxim Kuvardin <maxim@kuvard.in>
 */
class VideoNote extends Type
{
    /**
     * @var string $file_id Identifier for this file, which can be used to download or reuse the file
     */
    public string $file_id;

    /**
     * @var string $file_unique_id Unique identifier for this file, which is supposed to be the same over time and for
     *     different bots. Can't be used to download or reuse the file.
     */
    public string $file_unique_id;

    /**
     * @var int $length Video width and height (diameter of the video message) as defined by sender
     */
    public int $length;

    /**
     * @var int $duration Duration of the video in seconds as defined by sender
     */
    public int $duration;

    /**
     * @var PhotoSize|null $thumb Video thumbnail
     */
    public ?PhotoSize $thumb = null;

    /**
     * @var int|null $file_size File size in bytes
     */
    public ?int $file_size = null;

    public static function makeByArray(array $data): self
    {
        $result = new self;
        $result->file_id = $data['file_id'];
        $result->file_unique_id = $data['file_unique_id'];
        $result->length = $data['length'];
        $result->duration = $data['duration'];
        $result->thumb = isset($data['thumb'])
            ? PhotoSize::makeByArray($data['thumb'])
            : null;
        $result->file_size = $data['file_size'] ?? null;
        return $result;
    }

    public function getRequestData(): array
    {
        return [
            'file_id' => $this->file_id,
            'file_unique_id' => $this->file_unique_id,
            'length' => $this->length,
            'duration' => $this->duration,
            'thumb' => $this->thumb,
            'file_size' => $this->file_size,
        ];
    }
}
