<?php

declare(strict_types=1);

namespace TelegramBotsApi\Types;

use TelegramBotsApi;

/**
 * This object represents a general file (as opposed to photos, voice messages and audio files).
 *
 * @package TelegramBotsApi
 * @author Maxim Kuvardin <maxim@kuvard.in>
 */
class Document implements TypeInterface
{
    /**
     * @var string Identifier for this file, which can be used to download or reuse the file
     */
    public string $file_id;

    /**
     * @var string Unique identifier for this file, which is supposed to be the same over time and for
     * different bots. Can't be used to download or reuse the file.
     */
    public string $file_unique_id;

    /**
     * @var PhotoSize|null Document thumbnail as defined by sender
     */
    public ?PhotoSize $thumb = null;

    /**
     * @var string|null Original filename as defined by sender
     */
    public ?string $file_name = null;

    /**
     * @var string|null MIME type of the file as defined by sender
     */
    public ?string $mime_type = null;

    /**
     * @var int|null File size
     */
    public ?int $file_size = null;

    /**
     * Document constructor.
     *
     * @param array $data
     */
    public function __construct(array $data)
    {
        $this->file_id = $data['file_id'];
        $this->file_unique_id = $data['file_unique_id'];

        if (isset($data['thumb'])) {
            $this->thumb = $data['thumb'] instanceof PhotoSize
                ? $data['thumb']
                : new PhotoSize($data['thumb']);
        }

        if (isset($data['file_name'])) {
            $this->file_name = $data['file_name'];
        }

        if (isset($data['mime_type'])) {
            $this->mime_type = $data['mime_type'];
        }

        if (isset($data['file_size'])) {
            $this->file_size = $data['file_size'];
        }
    }

    /**
     * @param string $file_id Identifier for this file, which can be used to download or reuse the file
     * @param string $file_unique_id Unique identifier for this file, which is supposed to be the same over time
     * and for different bots. Can't be used to download or reuse the file.
     * @return Document
     */
    public static function make(string $file_id, string $file_unique_id): self
    {
        return new self([
            'file_id' => $file_id,
            'file_unique_id' => $file_unique_id,
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
            'thumb' => $this->thumb,
            'file_name' => $this->file_name,
            'mime_type' => $this->mime_type,
            'file_size' => $this->file_size,
        ];
    }
}
