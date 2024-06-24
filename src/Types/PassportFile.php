<?php

declare(strict_types=1);

namespace Kuvardin\TelegramBotsApi\Types;

use Kuvardin\TelegramBotsApi\Type;

/**
 * This object represents a file uploaded to Telegram Passport. Currently all Telegram Passport files are in JPEG
 * format when decrypted and don&#39;t exceed 10MB.
 *
 * @package Kuvardin\TelegramBotsApi
 * @author Maxim Kuvardin <maxim@kuvard.in>
 */
class PassportFile extends Type
{
    /**
     * @param string $file_id Identifier for this file, which can be used to download or reuse the file
     * @param string $file_unique_id Unique identifier for this file, which is supposed to be the same over time and
     *     for different bots. Can't be used to download or reuse the file.
     * @param int $file_size File size in bytes
     * @param int $file_date Unix time when the file was uploaded
     */
    public function __construct(
        public string $file_id,
        public string $file_unique_id,
        public int $file_size,
        public int $file_date,
    )
    {

    }

    public static function makeByArray(array $data): self
    {
        return new self(
            file_id: $data['file_id'],
            file_unique_id: $data['file_unique_id'],
            file_size: $data['file_size'],
            file_date: $data['file_date'],
        );
    }

    public function getRequestData(): array
    {
        return [
            'file_id' => $this->file_id,
            'file_unique_id' => $this->file_unique_id,
            'file_size' => $this->file_size,
            'file_date' => $this->file_date,
        ];
    }
}
