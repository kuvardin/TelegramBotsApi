<?php

namespace TelegramBotsApi\Types;

use \TelegramBotsApi;
use \TelegramBotsApi\Exceptions\Error;

/**
 * Instance of this object represents a file ready to be downloaded. The file can be downloaded via the link https://api.telegram.org/file/bot<token>/<file_path>. It is guaranteed that the link will be valid for at least 1 hour. When the link expires, a new one can be requested by calling getFile.
 * @package TelegramBotsApi\Types
 * @author Maxim Kuvardin <kuvard.in@mail.ru>
 */
class File implements TypeInterface
{
    /**
     * @var string Unique identifier for this file
     */
    public $file_id;

    /**
     * @var int|null File size, if known
     */
    public $file_size;

    /**
     * @var string|null File path. Use https://api.telegram.org/file/bot<token>/<file_path> to get the file
     */
    public $file_path;

    /**
     * File constructor.
     * @param array $data
     */
    public function __construct(array $data)
    {
        $this->file_id = $data['file_id'];
        $this->file_size = $data['file_size'] ?? null;
        $this->file_path = $data['file_path'] ?? null;
    }

    /**
     * @return array
     */
    public function getRequestArray(): array
    {
        return [
            'file_id' => $this->file_id,
            'file_size' => $this->file_size,
            'file_path' => $this->file_path,
        ];
    }

    /**
     * @param string $file_id
     * @return File
     */
    public static function make(string $file_id): self
    {
        return new self([
            'file_id' => $file_id,
        ]);
    }
}