<?php

namespace TelegramBotsApi\Types;

use \TelegramBotsApi;
use \TelegramBotsApi\Exceptions\Error;

/**
 * This object represents a file uploaded to Telegram Passport. Currently all Telegram Passport files are in JPEG format when decrypted and don&#39;t exceed 10MB.
 * @package TelegramBotsApi\Types
 * @author Maxim Kuvardin <kuvard.in@mail.ru>
 */
class PassportFile implements TypeInterface
{
    /**
     * @var string Unique identifier for this file
     */
    public $file_id;

    /**
     * @var int File size
     */
    public $file_size;

    /**
     * @var int Unix time when the file was uploaded
     */
    public $file_date;

    /**
     * PassportFile constructor.
     * @param array $data
     */
    public function __construct(array $data)
    {
        $this->file_id = $data['file_id'];
        $this->file_size = $data['file_size'];
        $this->file_date = $data['file_date'];
    }

    /**
     * @return array
     */
    public function getRequestArray(): array
    {
        return [
            'file_id' => $this->file_id,
            'file_size' => $this->file_size,
            'file_date' => $this->file_date,
        ];
    }

    /**
     * @param string $file_id
     * @param int $file_size
     * @param int $file_date
     * @return PassportFile
     */
    public static function make(string $file_id, int $file_size, int $file_date): self
    {
        return new self([
            'file_id' => $file_id,
            'file_size' => $file_size,
            'file_date' => $file_date,
        ]);
    }
}