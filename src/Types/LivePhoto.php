<?php

declare(strict_types=1);

namespace Kuvardin\TelegramBotsApi\Types;

use Kuvardin\TelegramBotsApi\Type;

/**
 * This object represents a live photo.
 *
 * @package Kuvardin\TelegramBotsApi
 * @author Maxim Kuvardin <maxim@kuvard.in>
 */
class LivePhoto extends Type
{
    /**
     * @param string $file_id Identifier for the video file which can be used to download or reuse the file
     * @param string $file_unique_id Unique identifier for the video file which is supposed to be the same over time
     *     and for different bots. Can't be used to download or reuse the file.
     * @param int $width Video width as defined by the sender
     * @param int $height Video height as defined by the sender
     * @param int $duration Duration of the video in seconds as defined by the sender
     * @param PhotoSize[]|null $photo Available sizes of the corresponding static photo
     * @param string|null $mime_type MIME type of the file as defined by the sender
     * @param int|null $file_size File size in bytes. It can be bigger than 2^31 and some programming languages may
     *     have difficulty/silent defects in interpreting it. But it has at most 52 significant bits, so a signed
     *     64-bit integer or double-precision float type are safe for storing this value.
     */
    public function __construct(
        public string $file_id,
        public string $file_unique_id,
        public int $width,
        public int $height,
        public int $duration,
        public ?array $photo = null,
        public ?string $mime_type = null,
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
            duration: $data['duration'],
            photo: isset($data['photo'])
                ? array_map(
                    static fn(array $photo_data) => PhotoSize::makeByArray($photo_data),
                    $data['photo'],
                )
                : null,
            mime_type: $data['mime_type'] ?? null,
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
            'duration' => $this->duration,
            'photo' => $this->photo,
            'mime_type' => $this->mime_type,
            'file_size' => $this->file_size,
        ];
    }
}





