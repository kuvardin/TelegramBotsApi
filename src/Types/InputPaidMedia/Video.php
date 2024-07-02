<?php

declare(strict_types=1);

namespace Kuvardin\TelegramBotsApi\Types\InputPaidMedia;

use Kuvardin\TelegramBotsApi\Types\InputFile;
use Kuvardin\TelegramBotsApi\Types\InputPaidMedia;
use RuntimeException;

/**
 * The paid media to send is a video.
 *
 * @package Kuvardin\TelegramBotsApi
 * @author Maxim Kuvardin <maxim@kuvard.in>
 */
class Video extends InputPaidMedia
{
    /**
     * @param InputFile $media File to send. Pass a file_id to send a file that exists on the Telegram servers
     *     (recommended), pass an HTTP URL for Telegram to get a file from the Internet, or pass
     *     “attach://&lt;file_attach_name&gt;” to upload a new one using multipart/form-data under
     *     &lt;file_attach_name&gt; name.
     * @param InputFile|null $thumbnail Thumbnail of the file sent; can be ignored if thumbnail generation for the file
     *     is supported server-side. The thumbnail should be in JPEG format and less than 200 kB in size. A thumbnail's
     *     width and height should not exceed 320. Ignored if the file is not uploaded using multipart/form-data.
     *     Thumbnails can't be reused and can be only uploaded as a new file, so you can pass
     *     “attach://&lt;file_attach_name&gt;” if the thumbnail was uploaded using multipart/form-data under
     *     &lt;file_attach_name&gt;.
     * @param int|null $width Video width
     * @param int|null $height Video height
     * @param int|null $duration Video duration in seconds
     * @param bool|null $supports_streaming Pass "True" if the uploaded video is suitable for streaming
     */
    public function __construct(
        public InputFile $media,
        public ?InputFile $thumbnail = null,
        public ?int $width = null,
        public ?int $height = null,
        public ?int $duration = null,
        public ?bool $supports_streaming = null,
    )
    {

    }

    public static function getType(): string
    {
        return 'video';
    }

    public static function makeByArray(array $data): static
    {
        if ($data['type'] !== self::getType()) {
            throw new RuntimeException("Wrong input paid media type: {$data['type']}");
        }

        return new self(
            media: InputFile::makeByString($data['media']),
            thumbnail: isset($data['thumbnail'])
                ? InputFile::makeByString($data['thumbnail'])
                : null,
            width: $data['width'] ?? null,
            height: $data['height'] ?? null,
            duration: $data['duration'] ?? null,
            supports_streaming: $data['supports_streaming'] ?? null,
        );
    }

    public function getRequestData(): array
    {
        return [
            'type' => self::getType(),
            'media' => $this->media,
            'thumbnail' => $this->thumbnail,
            'width' => $this->width,
            'height' => $this->height,
            'duration' => $this->duration,
            'supports_streaming' => $this->supports_streaming,
        ];
    }
}
