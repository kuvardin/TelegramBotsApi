<?php

declare(strict_types=1);

namespace Kuvardin\TelegramBotsApi\Types;

/**
 * This object represents a video file.
 *
 * @package Kuvardin\TelegramBotsApi
 * @author Maxim Kuvardin <maxim@kuvard.in>
 */
class Video implements TypeInterface
{
    /**
     * @var string Identifier for this file, which can be used to download or reuse the file
     */
    public string $file_id;

    /**
     * @var string Unique identifier for this file, which is supposed to be the same over time and for different
     * bots. Can't be used to download or reuse the file.
     */
    public string $file_unique_id;

    /**
     * @var int Video width as defined by sender
     */
    public int $width;

    /**
     * @var int Video height as defined by sender
     */
    public int $height;

    /**
     * @var int Duration of the video in seconds as defined by sender
     */
    public int $duration;

    /**
     * @var PhotoSize|null Video thumbnail
     */
    public ?PhotoSize $thumb = null;

    /**
     * @var string|null Mime type of a file as defined by sender
     */
    public ?string $mime_type = null;

    /**
     * @var int|null File size
     */
    public ?int $file_size = null;

    /**
     * Video constructor.
     *
     * @param array $data
     */
    public function __construct(array $data)
    {
        $this->file_id = $data['file_id'];
        $this->file_unique_id = $data['file_unique_id'];
        $this->width = $data['width'];
        $this->height = $data['height'];
        $this->duration = $data['duration'];

        if (isset($data['thumb'])) {
            $this->thumb = $data['thumb'] instanceof PhotoSize
                ? $data['thumb']
                : new PhotoSize($data['thumb']);
        }

        if (isset($data['mime_type'])) {
            $this->mime_type = $data['mime_type'];
        }

        if (isset($data['file_size'])) {
            $this->file_size = $data['file_size'];
        }
    }

    /**
     * @param string $file_id Identifier for this file, which can be used to download or reuse the file
     * @param string $file_unique_id Unique identifier for this file, which is supposed to be the same over time
     * and for different bots. Can't be used to download or reuse the file.
     * @param int $width Video width as defined by sender
     * @param int $height Video height as defined by sender
     * @param int $duration Duration of the video in seconds as defined by sender
     * @return Video
     */
    public static function make(string $file_id, string $file_unique_id, int $width, int $height,
        int $duration): self
    {
        return new self([
            'file_id' => $file_id,
            'file_unique_id' => $file_unique_id,
            'width' => $width,
            'height' => $height,
            'duration' => $duration,
        ]);
    }

    /**
     * @return array
     */
    public function getRequestArray(): array
    {
        return [
            'file_id' => $this->file_id,
            'file_unique_id' => $this->file_unique_id,
            'width' => $this->width,
            'height' => $this->height,
            'duration' => $this->duration,
            'thumb' => $this->thumb,
            'mime_type' => $this->mime_type,
            'file_size' => $this->file_size,
        ];
    }
}
