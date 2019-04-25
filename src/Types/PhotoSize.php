<?php

namespace TelegramBotsApi\Types;

use \TelegramBotsApi;
use \TelegramBotsApi\Exceptions\Error;

/**
 * Object of this class represents one size of a photo or a file / sticker thumbnail.
 * @package TelegramBotsApi\Types
 * @author Maxim Kuvardin <kuvard.in@mail.ru>
 */
class PhotoSize implements TypeInterface
{
    /**
     * @var string Unique identifier for this file
     */
    public $file_id;

    /**
     * @var int Photo width
     */
    public $width;

    /**
     * @var int Photo height
     */
    public $height;

    /**
     * @var int|null File size
     */
    public $file_size;

    /**
     * PhotoSize constructor.
     * @param array $data
     */
    public function __construct(array $data)
    {
        $this->file_id = $data['file_id'];
        $this->width = $data['width'];
        $this->height = $data['height'];
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
            'file_size' => $this->file_size,
        ];
    }

    /**
     * @param string $file_id
     * @param int $width
     * @param int $height
     * @return PhotoSize
     */
    public static function make(string $file_id, int $width, int $height): self
    {
        return new self([
            'file_id' => $file_id,
            'width' => $width,
            'height' => $height,
        ]);
    }
}