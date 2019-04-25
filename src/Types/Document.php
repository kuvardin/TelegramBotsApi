<?php

namespace TelegramBotsApi\Types;

use \TelegramBotsApi;
use \TelegramBotsApi\Exceptions\Error;

/**
 * Instance of this object represents a general file (as opposed to photos, voice messages and audio files).
 * @package TelegramBotsApi\Types
 * @author Maxim Kuvardin <kuvard.in@mail.ru>
 */
class Document implements TypeInterface
{
    /**
     * @var string Unique file identifier
     */
    public $file_id;

    /**
     * @var PhotoSize|null Document thumbnail as defined by sender
     */
    public $thumb;

    /**
     * @var string|null Original filename as defined by sender
     */
    public $file_name;

    /**
     * @var string|null MIME type of the file as defined by sender
     */
    public $mime_type;

    /**
     * @var int|null File size
     */
    public $file_size;

    /**
     * Document constructor.
     * @param array $data
     */
    public function __construct(array $data)
    {
        $this->file_id = $data['file_id'];
        $this->thumb = isset($data['thumb']) ? new PhotoSize($data['thumb']) : null;
        $this->file_name = $data['file_name'] ?? null;
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
            'thumb' => $this->thumb,
            'file_name' => $this->file_name,
            'mime_type' => $this->mime_type,
            'file_size' => $this->file_size,
        ];
    }

    /**
     * @param string $file_id
     * @return Document
     */
    public static function make(string $file_id): self
    {
        return new self([
            'file_id' => $file_id,
        ]);
    }
}