<?php

declare(strict_types=1);

namespace Kuvardin\TelegramBotsApi\Types;

use Kuvardin\TelegramBotsApi\Type;

/**
 * This object represents a video file of a specific quality.
 *
 * @package Kuvardin\TelegramBotsApi
 * @author Maxim Kuvardin <maxim@kuvard.in>
 */
class VideoQuality extends Type
{
    /**
     * @param string $file_id Identifier for this file, which can be used to download or reuse the file
     * @param string $file_unique_id Unique identifier for this file, which is supposed to be the same over time and for
     *     different bots. Can't be used to download or reuse the file.
     * @param int $width Video width
     * @param int $height Video height
     * @param string $codec Codec that was used to encode the video, for example, “h264”, “h265”, or “av01”
     * @param int|null $file_size File size in bytes. It can be bigger than 2^31 and some programming languages may have
     *     difficulty/silent defects in interpreting it. But it has at most 52 significant bits, so a signed 64-bit
     *     integer or double-precision float type are safe for storing this value.
     */
    public function __construct(
        public string $file_id,
        public string $file_unique_id,
        public int $width,
        public int $height,
        public string $codec,
        public ?int $file_size = null,
    )
    {

    }

    public static function makeByArray(array $data): self
    {
        return new self(
            file_id: $data['file_id'],
            file_unique_id: $data['file_unique_id'],
            width: $data['width'],
            height: $data['height'],
            codec: $data['codec'],
            file_size: $data['file_size'] ?? null,
        );
    }

    public function getRequestData(): array
    {
        return [
            'file_id' => $this->file_id,
            'file_unique_id' => $this->file_unique_id,
            'width' => $this->width,
            'height' => $this->height,
            'codec' => $this->codec,
            'file_size' => $this->file_size,
        ];
    }
}
