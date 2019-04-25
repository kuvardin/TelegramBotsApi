<?php

namespace TelegramBotsApi\Types;

use \TelegramBotsApi;
use \TelegramBotsApi\Exceptions\Error;

/**
 * Instance of this object represents a voice note
 * @package TelegramBotsApi\Types
 * @author Maxim Kuvardin <kuvard.in@mail.ru>
 */
class Voice implements TypeInterface
{
    /**
     * @var string Unique identifier for this file
     */
    public $file_id;

    /**
     * @var int Duration of the video in seconds as defined by sender
     */
    public $duration;

    /**
     * @var string|null Mime type of a file as defined by sender
     */
    public $mime_type;

    /**
     * @var int|null File size
     */
    public $file_size;

    /**
     * Voice constructor.
     * @param array $data
     */
    public function __construct(array $data)
    {
        $this->file_id = $data['file_id'];
        $this->duration = $data['duration'];
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
            'duration' => $this->duration,
            'mime_type' => $this->mime_type,
            'file_size' => $this->file_size,
        ];
    }

    public static function make(string $file_id, int $duration): self
    {
        return new self([
            'file_id' => $file_id,
            'duration' => $duration,
        ]);
    }
}