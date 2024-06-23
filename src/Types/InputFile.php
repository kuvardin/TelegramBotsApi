<?php

declare(strict_types=1);

namespace Kuvardin\TelegramBotsApi\Types;

use Kuvardin\TelegramBotsApi\Type;

/**
 * This object represents the contents of a file to be uploaded. Must be posted using multipart/form-data in the usual
 * way that files are uploaded via the browser.
 *
 * @package Kuvardin\TelegramBotsApi
 * @author Maxim Kuvardin <maxim@kuvard.in>
 */
class InputFile extends Type
{
    protected ?string $file_id = null;
    protected ?string $url = null;
    protected ?string $attach_name;

    private function __construct(
        string $file_id = null,
        string $url = null,
        string $attach_name = null,
    )
    {
        $this->file_id = $file_id;
        $this->url = $url;
        $this->attach_name = $attach_name;
    }

    /**
     * If the file is already stored somewhere on the Telegram servers, you don't need to reupload it: each file object
     * has a file_id field, simply pass this file_id as a parameter instead of uploading. There are no limits for files
     * sent this way.
     */
    public static function makeByFileId(string $file_id): self
    {
        return new self(file_id: $file_id);
    }

    /**
     * Provide Telegram with an HTTP URL for the file to be sent. Telegram will download and send the file. 5 MB max
     * size for photos and 20 MB max for other types of content.
     */
    public static function makeByUrl(string $url): self
    {
        return new self(url: $url);
    }

    /**
     * to upload a new one using multipart/form-data under &lt;file_attach_name&gt; name.
     */
    public static function makeByAttachName(string $attach_name): self
    {
        return new self(attach_name: $attach_name);
    }

    public static function makeByString(string $string): self
    {
        if (preg_match('|^\w+$|', $string)) {
            return new self(file_id: $string);
        }

        if (preg_match('|^attach://(.+)$|i', $string, $match)) {
            return new self(attach_name: $match[1]);
        }

        return new self(url: $string);
    }

    public function getFileId(): ?string
    {
        return $this->file_id;
    }

    public function getUrl(): ?string
    {
        return $this->url;
    }

    public function getAttachName(): ?string
    {
        return $this->attach_name;
    }

    public function getRequestData(): string
    {
        return $this->file_id ?? $this->url ?? "attach://$this->attach_name";
    }
}