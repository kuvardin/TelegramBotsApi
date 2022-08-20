<?php

declare(strict_types=1);

namespace Kuvardin\TelegramBotsApi\Types;

use Kuvardin\TelegramBotsApi\Type;

/**
 * This object represents a general file (as opposed to <a
 * href="https://core.telegram.org/bots/api#photosize">photos</a>, <a
 * href="https://core.telegram.org/bots/api#voice">voice messages</a> and <a
 * href="https://core.telegram.org/bots/api#audio">audio files</a>).
 *
 * @package Kuvardin\TelegramBotsApi
 * @author Maxim Kuvardin <maxim@kuvard.in>
 */
class Document extends Type
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
     * @var PhotoSize|null $thumb Document thumbnail as defined by sender
     */
    public ?PhotoSize $thumb = null;

    /**
     * @var string|null $file_name Original filename as defined by sender
     */
    public ?string $file_name = null;

    /**
     * @var string|null $mime_type MIME type of the file as defined by sender
     */
    public ?string $mime_type = null;

    /**
     * @var int|null $file_size File size in bytes
     */
    public ?int $file_size = null;

    public static function makeByArray(array $data): self
    {
        $result = new self;
        $result->file_id = $data['file_id'];
        $result->file_unique_id = $data['file_unique_id'];
        $result->thumb = isset($data['thumb'])
            ? PhotoSize::makeByArray($data['thumb'])
            : null;
        $result->file_name = $data['file_name'] ?? null;
        $result->mime_type = $data['mime_type'] ?? null;
        $result->file_size = $data['file_size'] ?? null;
        return $result;
    }

    public function getRequestData(): array
    {
        return [
            'file_id' => $this->file_id,
            'file_unique_id' => $this->file_unique_id,
            'thumb' => $this->thumb,
            'file_name' => $this->file_name,
            'mime_type' => $this->mime_type,
            'file_size' => $this->file_size,
        ];
    }
}
