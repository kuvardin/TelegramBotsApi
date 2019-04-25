<?php

namespace TelegramBotsApi\Types;

use \TelegramBotsApi;
use \TelegramBotsApi\Exceptions\Error;

/**
 * Instance of this object represents a video file
 * @package TelegramBotsApi\Types
 * @author Maxim Kuvardin <kuvard.in@mail.ru>
 */
class Video implements TypeInterface
{
    /**
     * @var string Unique identifier for this file
     */
    public $file_id;

    /**
     * @var int Video width as defined by sender
     */
    public $width;

    /**
     * @var int Video height as defined by sender
     */
    public $height;

    /**
     * @var int Duration of the video in seconds as defined by sender
     */
    public $duration;

    /**
     * @var PhotoSize|null Video thumbnail
     */
    public $thumb;

    /**
     * @var string|null Mime type of a file as defined by sender
     */
    public $mime_type;

    /**
     * @var int|null File size
     */
    public $file_size;

    /**
     * Video constructor.
     * @param array $data
     */
    public function __construct(array $data)
    {
        $this->file_id = $data['file_id'];
        $this->width = $data['width'];
        $this->height = $data['height'];
        $this->duration = $data['duration'];
        $this->thumb = isset($data['thumb']) ? new PhotoSize($data['thumb']) : null;
        $this->mime_type = $data['mime_type'] ?? null;
        $this->file_size = $data['file_size'] ?? null;
    }

    /**
     * @return array
     */
    public function getRequestArray(): array
    {
        return [
            'file_id' => $this->file_id,
            'width' => $this->width,
            'height' => $this->height,
            'duration' => $this->duration,
            'thumb' => $this->thumb,
            'mime_type' => $this->mime_type,
            'file_size' => $this->file_size,
        ];
    }

    /**
     * @param string $file_id
     * @param int $width
     * @param int $height
     * @param int $duration
     * @return Video
     */
    public static function make(string $file_id, int $width, int $height, int $duration): self
    {
        return new self([
            'file_id' => $file_id,
            'width' => $width,
            'height' => $height,
            'duration' => $duration,
        ]);
    }
}