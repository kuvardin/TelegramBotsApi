<?php

namespace TelegramBotsApi\Types\InputMedia;

use \TelegramBotsApi;
use \TelegramBotsApi\Exceptions\Error;

/**
 * Represents an animation file (GIF or H.264/MPEG-4 AVC video without sound) to be sent.
 * @package TelegramBotsApi\Types
 * @author Maxim Kuvardin <kuvard.in@mail.ru>
 */
class Animation extends TelegramBotsApi\Types\InputMedia implements TelegramBotsApi\Types\TypeInterface
{
    public const TYPE = TelegramBotsApi\Types\InputMedia::TYPE_ANIMATION;

    /**
     * @var string Type of the result, must be self::TYPE
     */
    public $type = self::TYPE;

    /**
     * @var string File to send. Pass a file_id to send a file that exists on the Telegram servers (recommended), pass an HTTP URL for Telegram to get a file from the Internet, or pass “attach://<file_attach_name>” to upload a new one using multipart/form-data under <file_attach_name> name.
     */
    public $media;

    /**
     * @var string|null Thumbnail of the file sent; can be ignored if thumbnail generation for the file is supported server-side. The thumbnail should be in JPEG format and less than 200 kB in size. A thumbnail‘s width and height should not exceed 90. Ignored if the file is not uploaded using multipart/form-data. Thumbnails can’t be reused and can be only uploaded as a new file, so you can pass “attach://<file_attach_name>” if the thumbnail was uploaded using multipart/form-data under <file_attach_name>.
     */
    public $thumb;

    /**
     * @var string Caption of the animation to be sent, 0-1024 characters
     */
    public $caption;

    /**
     * @var string|null Send Markdown or HTML, if you want Telegram apps to show bold, italic, fixed-width text or inline URLs in the media caption.
     */
    public $parse_mode;

    /**
     * @var int|null Animation width
     */
    public $width;

    /**
     * @var int|null Animation height
     */
    public $height;

    /**
     * @var int|null Animation duration
     */
    public $duration;

    /**
     * InputMediaAnimation constructor.
     * @param array $data
     * @throws Error
     */
    public function __construct(array $data)
    {
        if (isset($data['type'])) {
            if ($data['type'] !== self::TYPE) {
                throw new Error('Element with key "type" must be self::TYPE or undefined');
            }
            $this->type = $data['type'];
        }

        $this->media = $data['media'];
        $this->thumb = $data['thumb'] ?? null;
        $this->caption = $data['caption'] ?? null;

        if (isset($data['parse_mode'])) {
            if (!TelegramBotsApi\Bot::checkParseMode($data['parse_mode'])) {
                throw new Error("Unknown parse mode: {$data['parse_mode']}");
            }
            $this->parse_mode = $data['parse_mode'];
        }

        $this->width = $data['width'] ?? null;
        $this->height = $data['height'] ?? null;
        $this->duration = $data['duration'] ?? null;
    }

    /**
     * @return array
     */
    public function getRequestArray(): array
    {
        return [
            'type' => $this->type,
            'media' => $this->media,
            'thumb' => $this->thumb,
            'caption' => $this->caption,
            'parse_mode' => $this->parse_mode,
            'width' => $this->width,
            'height' => $this->height,
            'duration' => $this->duration,
        ];
    }

    /**
     * @param string $media
     * @param string $type
     * @return Animation
     * @throws Error
     */
    public static function make(string $media, string $type = self::TYPE): self
    {
        return new self([
            'type' => $type,
            'media' => $media,
        ]);
    }
}