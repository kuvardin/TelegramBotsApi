<?php

declare(strict_types=1);

namespace Kuvardin\TelegramBotsApi\Types\InputMedia;

use Kuvardin\TelegramBotsApi\Exceptions\Error;
use Kuvardin\TelegramBotsApi\Types;

/**
 * Represents an audio file to be treated as music to be sent.
 *
 * @package Kuvardin\TelegramBotsApi
 * @author Maxim Kuvardin <maxim@kuvard.in>
 */
class Audio extends Types\InputMedia implements Types\TypeInterface
{
    public const TYPE = Types\InputMedia::TYPE_AUDIO;

    /**
     * @var string File to send. Pass a file_id to send a file that exists on the Telegram servers (recommended),
     * pass an HTTP URL for Telegram to get a file from the Internet, or pass “attach://<file_attach_name>” to upload a
     *     new one using multipart/form-data under <file_attach_name> name
     */
    public string $media;

    /**
     * @var string|null Thumbnail of the file sent; can be ignored if thumbnail generation for the file is supported
     * server-side. The thumbnail should be in JPEG format and less than 200 kB in size. A thumbnail‘s width and height
     *     should not exceed 320. Ignored if the file is not uploaded using multipart/form-data. Thumbnails can’t be
     *     reused and can be only uploaded as a new file, so you can pass “attach://<file_attach_name>” if the
     *     thumbnail was uploaded using multipart/form-data under <file_attach_name>
     */
    public $thumb;

    /**
     * @var string|null Caption of the audio to be sent, 0-1024 characters
     */
    public ?string $caption = null;

    /**
     * @var string|null Send Markdown or HTML, if you want Telegram apps to show bold, italic, fixed-width text or
     *     inline URLs in the media caption.
     */
    public ?string $parse_mode = null;

    /**
     * @var int|null Duration of the audio in seconds
     */
    public ?int $duration = null;

    /**
     * @var string|null Performer of the audio
     */
    public ?string $performer = null;

    /**
     * @var string|null Title of the audio
     */
    public ?string $title = null;

    /**
     * Audio constructor.
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
        if (isset($data['thumb'])) {
            $this->thumb = $data['thumb'];
        }

        if (isset($data['caption'])) {
            $this->caption = $data['caption'];
        }

        if (isset($data['parse_mode'])) {
            $this->parse_mode = $data['parse_mode'];
        }

        if (isset($data['duration'])) {
            $this->duration = $data['duration'];
        }

        if (isset($data['performer'])) {
            $this->performer = $data['performer'];
        }

        if (isset($data['title'])) {
            $this->title = $data['title'];
        }
    }

    /**
     * @param string $media File to send. Pass a file_id to send a file that exists on the Telegram servers
     * (recommended), pass an HTTP URL for Telegram to get a file from the Internet, or pass
     * “attach://<file_attach_name>” to upload a new one using multipart/form-data under <file_attach_name> name
     * @return Audio
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
            'thumb' => $this->thumb,
            'caption' => $this->caption,
            'parse_mode' => $this->parse_mode,
            'duration' => $this->duration,
            'performer' => $this->performer,
            'title' => $this->title,
        ];
    }
}
