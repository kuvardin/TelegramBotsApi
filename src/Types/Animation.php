<?php declare(strict_types=1);

namespace TelegramBotsApi\Types;

use TelegramBotsApi;

/**
 * This object represents an animation file (GIF or H.264/MPEG-4 AVC video without sound).
 *
 * @package TelegramBotsApi
 * @author Maxim Kuvardin <maxim@kuvard.in>
 */
class Animation implements TypeInterface
{
    /**
     * @var string Identifier for this file, which can be used to download or reuse the file
     */
    public string $file_id;

    /**
     * @var string Unique identifier for this file, which is supposed to be the same over time
     * and for different bots. Can't be used to download or reuse the file.
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
     * @var PhotoSize|null Animation thumbnail as defined by sender
     */
    public ?PhotoSize $thumb;

    /**
     * @var string|null Original animation filename as defined by sender
     */
    public ?string $file_name;

    /**
     * @var string|null MIME type of the file as defined by sender
     */
    public ?string $mime_type;

    /**
     * @var int|null File size
     */
    public ?int $file_size;

    /**
     * Animation constructor.
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

        if (isset($data['file_name'])) {
            $this->file_name = $data['file_name'];
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
     * @param string $file_unique_id Unique identifier for this file, which is supposed to be the same
     * over time and for different bots. Can't be used to download or reuse the file.
     * @param int $width Video width as defined by sender
     * @param int $height Video height as defined by sender
     * @param int $duration Duration of the video in seconds as defined by sender
     * @return Animation
     */
    public static function make(string $file_id, string $file_unique_id, int $width, int $height, int $duration): self
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
            'file_name' => $this->file_name,
            'mime_type' => $this->mime_type,
            'file_size' => $this->file_size,
        ];
    }
}