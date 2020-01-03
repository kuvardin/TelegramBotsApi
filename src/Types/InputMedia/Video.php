<?php declare(strict_types=1);

namespace TelegramBotsApi\Types\InputMedia;

use TelegramBotsApi;
use TelegramBotsApi\Exceptions\Error;
use TelegramBotsApi\Types;

/**
 * Represents a video to be sent.
 *
 * @package TelegramBotsApi
 * @author Maxim Kuvardin <maxim@kuvard.in>
 */
class Video extends Types\InputMedia implements Types\TypeInterface
{
    public const TYPE = Types\InputMedia::TYPE_VIDEO;

    /**
     * @var string File to send. Pass a file_id to send a file that exists on the Telegram servers (recommended),
     * pass an HTTP URL for Telegram to get a file from the Internet, or pass “attach://<file_attach_name>”
     * to upload a new one using multipart/form-data under <file_attach_name> name
     */
    public string $media;

    /**
     * @var string|null Thumbnail of the file sent; can be ignored if thumbnail generation for the file is
     * supported server-side. The thumbnail should be in JPEG format and less than 200 kB in size. A thumbnail‘s
     * width and height should not exceed 320. Ignored if the file is not uploaded using multipart/form-data.
     * Thumbnails can’t be reused and can be only uploaded as a new file, so you can pass
     * “attach://<file_attach_name>” if the thumbnail was uploaded using multipart/form-data
     * under <file_attach_name>
     */
    public $thumb;

    /**
     * @var string|null Caption of the video to be sent, 0-1024 characters
     */
    public ?string $caption;

    /**
     * @var string|null Send Markdown or HTML, if you want Telegram apps to show bold, italic, fixed-width text
     * or inline URLs in the media caption.
     */
    public ?string $parse_mode;

    /**
     * @var int|null Video width
     */
    public ?int $width;

    /**
     * @var int|null Video height
     */
    public ?int $height;

    /**
     * @var int|null Video duration
     */
    public ?int $duration;

    /**
     * @var bool|null Pass True, if the uploaded video is suitable for streaming
     */
    public ?bool $supports_streaming;

    /**
     * Video constructor.
     *
     * @param array $data
     * @throws Error
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

        if (isset($data['width'])) {
            $this->width = $data['width'];
        }

        if (isset($data['height'])) {
            $this->height = $data['height'];
        }

        if (isset($data['duration'])) {
            $this->duration = $data['duration'];
        }

        if (isset($data['supports_streaming'])) {
            $this->supports_streaming = $data['supports_streaming'];
        }
    }

    /**
     * @param string $type Type of the result, must be video
     * @param string $media File to send. Pass a file_id to send a file that exists on the Telegram servers
     * (recommended), pass an HTTP URL for Telegram to get a file from the Internet, or pass
     * “attach://<file_attach_name>” to upload a new one using multipart/form-data
     * under <file_attach_name> name
     * @return Video
     * @throws Error
     */
    public static function make(string $type, string $media): self
    {
        return new self([
            'type' => $type,
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
            'width' => $this->width,
            'height' => $this->height,
            'duration' => $this->duration,
            'supports_streaming' => $this->supports_streaming,
        ];
    }
}