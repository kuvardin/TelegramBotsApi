<?php

declare(strict_types=1);

namespace Kuvardin\TelegramBotsApi\Types;

use Kuvardin\TelegramBotsApi\Type;

/**
 * This object represents a file ready to be downloaded. The file can be downloaded via the link
 * <code>https://api.telegram.org/file/bot&lt;token&gt;/&lt;file_path&gt;</code>. It is guaranteed that the link will
 * be valid for at least 1 hour. When the link expires, a new one can be requested by calling <a
 * href="https://core.telegram.org/bots/api#getfile">getFile</a>.<br><br>
 * The maximum file size to download is 20 MB
 *
 * @package Kuvardin\TelegramBotsApi
 * @author Maxim Kuvardin <maxim@kuvard.in>
 */
class File extends Type
{
    /**
     * @var string $file_id Identifier for this file, which can be used to download or reuse the file
     */
    public string $file_id;

    /**
     * @var string $file_unique_id Unique identifier for this file, which is supposed to be the same over time and for
     *     different bots. Can't be used to download or reuse the file.
     */
    public string $file_unique_id;

    /**
     * @var int|null $file_size File size in bytes, if known
     */
    public ?int $file_size = null;

    /**
     * @var string|null $file_path File path. Use <code>https://api.telegram.org/file/bot<token>/<file_path></code> to
     *     get the file.
     */
    public ?string $file_path = null;

    public static function makeByArray(array $data): self
    {
        $result = new self;
        $result->file_id = $data['file_id'];
        $result->file_unique_id = $data['file_unique_id'];
        $result->file_size = $data['file_size'] ?? null;
        $result->file_path = $data['file_path'] ?? null;
        return $result;
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
