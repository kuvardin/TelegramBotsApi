<?php

declare(strict_types=1);

namespace Kuvardin\TelegramBotsApi\Types;

/**
 * This object represents a file ready to be downloaded. The file can be downloaded via the link
 * "https://api.telegram.org/file/bot&lt;token&gt;/&lt;file_path&gt;". It is guaranteed that the link will be valid for
 * at least 1 hour. When the link expires, a new one can be requested by calling getFile().
 *
 * @package Kuvardin\TelegramBotsApi
 * @author Maxim Kuvardin <maxim@kuvard.in>
 */
class File extends FileAbstract
{
    /**
     * @param string $file_id Identifier for this file, which can be used to download or reuse the file
     * @param string $file_unique_id Unique identifier for this file, which is supposed to be the same over time and
     *     for different bots. Can't be used to download or reuse the file.
     * @param int|null $file_size File size in bytes. It can be bigger than 2^31 and some programming languages may
     *     have difficulty/silent defects in interpreting it. But it has at most 52 significant bits, so a signed
     *     64-bit integer or double-precision float type are safe for storing this value.
     * @param string|null $file_path File path. Use "https://api.telegram.org/file/bot<token>/<file_path>"
     *     to get the file.
     */
    public function __construct(
        string $file_id,
        string $file_unique_id,
        ?int $file_size = null,
        public ?string $file_path = null,
    )
    {
        $this->file_id = $file_id;
        $this->file_unique_id = $file_unique_id;
        $this->file_size = $file_size;
    }

    public static function makeByArray(array $data): self
    {
        return new self(
            file_id: $data['file_id'],
            file_unique_id: $data['file_unique_id'],
            file_size: $data['file_size'] ?? null,
            file_path: $data['file_path'] ?? null,
        );
    }

    public function getRequestData(): array
    {
        return [
            'file_id' => $this->file_id,
            'file_unique_id' => $this->file_unique_id,
            'file_size' => $this->file_size,
            'file_path' => $this->file_path,
        ];
    }
}
