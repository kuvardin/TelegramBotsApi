<?php declare(strict_types=1);

namespace TelegramBotsApi\Types;

use TelegramBotsApi;

/**
 * This object represents a file uploaded to Telegram Passport. Currently all Telegram Passport files are in JPEG
 * format when decrypted and don't exceed 10MB.
 *
 * @package TelegramBotsApi
 * @author Maxim Kuvardin <maxim@kuvard.in>
 */
class PassportFile implements TypeInterface
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
     * @var int File size
     */
    public int $file_size;

    /**
     * @var int Unix time when the file was uploaded
     */
    public int $file_date;

    /**
     * PassportFile constructor.
     *
     * @param array $data
     */
    public function __construct(array $data)
    {
        $this->file_id = $data['file_id'];
        $this->file_unique_id = $data['file_unique_id'];
        $this->file_size = $data['file_size'];
        $this->file_date = $data['file_date'];
    }

    /**
     * @param string $file_id Identifier for this file, which can be used to download or reuse the file
     * @param string $file_unique_id Unique identifier for this file, which is supposed to be the same over time
     * and for different bots. Can't be used to download or reuse the file.
     * @param int $file_size File size
     * @param int $file_date Unix time when the file was uploaded
     * @return PassportFile
     */
    public static function make(string $file_id, string $file_unique_id, int $file_size, int $file_date): self
    {
        return new self([
            'file_id' => $file_id,
            'file_unique_id' => $file_unique_id,
            'file_size' => $file_size,
            'file_date' => $file_date,
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
            'file_size' => $this->file_size,
            'file_date' => $this->file_date,
        ];
    }
}