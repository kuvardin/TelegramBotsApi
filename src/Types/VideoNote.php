<?php

namespace TelegramBotsApi\Types;

use \TelegramBotsApi;
use \TelegramBotsApi\Exceptions\Error;

/**
 * Instance of this object represents a video message (available in Telegram apps as of v.4.0).
 * @package TelegramBotsApi\Types
 * @author Maxim Kuvardin <kuvard.in@mail.ru>
 */
class VideoNote implements TypeInterface
{
    /**
     * @var string Unique identifier for this file
     */
    public $file_id;

    /**
     * @var int Video width and height (diameter of the video message) as defined by sender
     */
    public $length;

    /**
     * @var int Duration of the video in seconds as defined by sender
     */
    public $duration;

    /**
     * @var PhotoSize|null Video thumbnail
     */
    public $thumb;

    /**
     * @var int|null File size
     */
    public $file_size;

    /**
     * VideoNote constructor.
     * @param array $data
     */
    public function __construct(array $data)
    {
        $this->file_id = $data['file_id'];
        $this->length = $data['length'];
        $this->duration = $data['duration'];
        if (isset($data['thumb'])) {
            $this->thumb = is_array($data['thumb']) ? new PhotoSize($data['thumb']) : $data['thumb'];
        }
        $this->file_size = $data['file_size'] ?? null;
    }

    public function getRequestArray(): array
    {
        return [
            'file_id' => $this->file_id,
            'length' => $this->length,
            'duration' => $this->duration,
            'thumb' => $this->thumb,
            'file_size' => $this->file_size,
        ];
    }

    /**
     * @param string $file_id
     * @param int $length
     * @param int $duration
     * @return VideoNote
     */
    public static function make(string $file_id, int $length, int $duration): self
    {
        return new self([
            'file_id' => $file_id,
            'length' => $length,
            'duration' => $duration,
        ]);
    }
}