<?php

declare(strict_types=1);

namespace Kuvardin\TelegramBotsApi\Types;

use JetBrains\PhpStorm\Deprecated;

/**
 * This object represents a video file.
 *
 * @package Kuvardin\TelegramBotsApi
 * @author Maxim Kuvardin <maxim@kuvard.in>
 */
class Video extends FileAbstract
{
    /**
     * @param string $file_id Identifier for this file, which can be used to download or reuse the file
     * @param string $file_unique_id Unique identifier for this file, which is supposed to be the same over time and
     *     for different bots. Can't be used to download or reuse the file.
     * @param int $width Video width as defined by the sender
     * @param int $height Video height as defined by the sender
     * @param int $duration Duration of the video in seconds as defined by the sender
     * @param PhotoSize|null $thumbnail Video thumbnail
     * @param string|null $file_name Original filename as defined by the sender
     * @param string|null $mime_type MIME type of the file as defined by the sender
     * @param int|null $file_size File size in bytes. It can be bigger than 2^31 and some programming languages may
     *     have difficulty/silent defects in interpreting it. But it has at most 52 significant bits, so a signed
     *     64-bit integer or double-precision float type are safe for storing this value.
     * @param PhotoSize[]|null $cover Available sizes of the cover of the video in the message
     * @param int|null $start_timestamp Timestamp in seconds from which the video will play in the message
     * @param VideoQuality[]|null $qualities List of available qualities of the video
     */
    public function __construct(
        public string $file_id,
        public string $file_unique_id,
        public int $width,
        public int $height,
        public int $duration,
        public ?PhotoSize $thumbnail = null,
        public ?string $file_name = null,
        public ?string $mime_type = null,
        public ?int $file_size = null,
        public ?array $cover = null,
        public ?int $start_timestamp = null,
        public ?array $qualities = null,

        #[Deprecated] public ?PhotoSize $thumb = null,
    )
    {
        $this->thumb ??= $this->thumbnail;
        $this->thumbnail ??= $this->thumb;
    }

    public static function makeByArray(array $data): self
    {
        return new self(
            file_id: $data['file_id'],
            file_unique_id: $data['file_unique_id'],
            width: $data['width'],
            height: $data['height'],
            duration: $data['duration'],
            thumbnail: isset($data['thumbnail'])
                ? PhotoSize::makeByArray($data['thumbnail'])
                : null,
            file_name: $data['file_name'] ?? null,
            mime_type: $data['mime_type'] ?? null,
            file_size: $data['file_size'] ?? null,
            cover: isset($data['cover'])
                ? array_map(
                    static fn(array $cover_data) => PhotoSize::makeByArray($cover_data),
                    $data['cover'],
                )
                : null,
            start_timestamp: $data['start_timestamp'] ?? null,
            qualities: isset($data['qualities'])
                ? array_map(
                    static fn(array $qualities_data) => VideoQuality::makeByArray($qualities_data),
                    $data['qualities'],
                )
                : null,
        );
    }

    public function getRequestData(): array
    {
        return [
            'file_id' => $this->file_id,
            'file_unique_id' => $this->file_unique_id,
            'width' => $this->width,
            'height' => $this->height,
            'duration' => $this->duration,
            'thumbnail' => $this->thumbnail,
            'file_name' => $this->file_name,
            'mime_type' => $this->mime_type,
            'file_size' => $this->file_size,
            'cover' => $this->cover,
            'start_timestamp' => $this->start_timestamp,
            'qualities' => $this->qualities,
        ];
    }
}
