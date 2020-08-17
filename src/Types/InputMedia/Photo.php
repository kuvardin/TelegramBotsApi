<?php

declare(strict_types=1);

namespace Kuvardin\TelegramBotsApi\Types\InputMedia;

use Kuvardin\TelegramBotsApi\Exceptions\Error;
use Kuvardin\TelegramBotsApi\Types;

/**
 * Represents a photo to be sent.
 *
 * @package Kuvardin\TelegramBotsApi
 * @author Maxim Kuvardin <maxim@kuvard.in>
 */
class Photo extends Types\InputMedia implements Types\TypeInterface
{
    public const TYPE = Types\InputMedia::TYPE_PHOTO;

    /**
     * @var string File to send. Pass a file_id to send a file that exists on the Telegram servers (recommended),
     * pass an HTTP URL for Telegram to get a file from the Internet, or pass “attach://<file_attach_name>”
     * to upload a new one using multipart/form-data under <file_attach_name> name
     */
    public string $media;

    /**
     * @var string|null Caption of the photo to be sent, 0-1024 characters
     */
    public ?string $caption = null;

    /**
     * @var string|null Send Markdown or HTML, if you want Telegram apps to show bold, italic, fixed-width text or
     *     inline URLs in the media caption.
     */
    public ?string $parse_mode = null;

    /**
     * Photo constructor.
     *
     * @param array $data
     */
    public function __construct(array $data)
    {
        parent::__construct($data);

        if ($data['type'] !== self::TYPE) {
            throw new Error("Unknown type: {$data['type']} (must be self::TYPE)");
        }

        $this->media = $data['media'];
        if (isset($data['caption'])) {
            $this->caption = $data['caption'];
        }

        if (isset($data['parse_mode'])) {
            $this->parse_mode = $data['parse_mode'];
        }
    }

    /**
     * @param string $media File to send. Pass a file_id to send a file that exists on the Telegram servers
     * (recommended), pass an HTTP URL for Telegram to get a file from the Internet, or pass
     * “attach://<file_attach_name>” to upload a new one using multipart/form-data under <file_attach_name> name
     * @return Photo
     */
    public static function make(string $media): self
    {
        return new self([
            'type' => self::TYPE,
            'media' => $media,
        ]);
    }

    /**
     * @return array
     */
    public function getRequestArray(): array
    {
        return [
            'type' => self::TYPE,
            'media' => $this->media,
            'caption' => $this->caption,
            'parse_mode' => $this->parse_mode,
        ];
    }
}
