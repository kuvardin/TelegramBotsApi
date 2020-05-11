<?php

declare(strict_types=1);

namespace Kuvardin\TelegramBotsApi\Types;

/**
 * This object represents a file ready to be downloaded. The file can be downloaded via the link
 * https://api.telegram.org/file/bot<token>/<file_path>. It is guaranteed that the link will be valid for
 * at least 1 hour. When the link expires, a new one can be requested by calling getFile.
 *
 * @package Kuvardin\TelegramBotsApi
 * @author Maxim Kuvardin <maxim@kuvard.in>
 */
class File implements TypeInterface
{
    public const URL_FORMAT = 'https://api.telegram.org/file/bot%s/%s';

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
     * @var int|null File size, if known
     */
    public ?int $file_size = null;

    /**
     * @var string|null File path. Use $this->getUrl() to get the file.
     */
    public ?string $file_path = null;

    /**
     * File constructor.
     *
     * @param array $data
     */
    public function __construct(array $data)
    {
        $this->file_id = $data['file_id'];
        $this->file_unique_id = $data['file_unique_id'];

        if (isset($data['file_size'])) {
            $this->file_size = $data['file_size'];
        }

        if (isset($data['file_path'])) {
            $this->file_path = $data['file_path'];
        }
    }

    /**
     * @param string $file_id Identifier for this file, which can be used to download or reuse the file
     * @param string $file_unique_id Unique identifier for this file, which is supposed to be the same over time
     * and for different bots. Can't be used to download or reuse the file.
     * @return File
     */
    public static function make(string $file_id, string $file_unique_id): self
    {
        return new self([
            'file_id' => $file_id,
            'file_unique_id' => $file_unique_id,
        ]);
    }

    /**
     * @param string $token
     * @return string|null
     */
    public function getUrl(string $token): ?string
    {
        return $this->file_path === null ? null : self::getFileUrl($token, $this->file_path);
    }

    /**
     * @param string $token
     * @param string $file_path
     * @return string
     */
    public static function getFileUrl(string $token, string $file_path): string
    {
        return sprintf(self::URL_FORMAT, $token, $file_path);
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
            'file_path' => $this->file_path,
        ];
    }
}
