<?php

declare(strict_types=1);

namespace Kuvardin\TelegramBotsApi\Types\InputMedia;

use JetBrains\PhpStorm\Deprecated;
use Kuvardin\TelegramBotsApi\Enums\ParseMode;
use Kuvardin\TelegramBotsApi\Types\InputFile;
use Kuvardin\TelegramBotsApi\Types\InputMedia;
use Kuvardin\TelegramBotsApi\Types\MessageEntity;
use RuntimeException;

/**
 * Represents a video to be sent.
 *
 * @package Kuvardin\TelegramBotsApi
 * @author Maxim Kuvardin <maxim@kuvard.in>
 */
class Video extends InputMedia
{
    /**
     * @param string $media File to send. Pass a file_id to send a file that exists on the Telegram servers
     *     (recommended), pass an HTTP URL for Telegram to get a file from the Internet, or pass
     *     “attach://<file_attach_name>” to upload a new one using multipart/form-data under <file_attach_name> name.
     * @param InputFile|null $thumbnail Thumbnail of the file sent; can be ignored if thumbnail generation for the file
     *     is supported server-side. The thumbnail should be in JPEG format and less than 200 kB in size. A thumbnail's
     *     width and height should not exceed 320. Ignored if the file is not uploaded using multipart/form-data.
     *     Thumbnails can't be reused and can be only uploaded as a new file, so you can pass
     *     “attach://<file_attach_name>” if the thumbnail was uploaded using multipart/form-data under
     *     <file_attach_name>.
     * @param string|null $caption Caption of the video to be sent, 0-1024 characters after entities parsing
     * @param ParseMode|string|null $parse_mode Mode for parsing entities in the video caption
     * @param MessageEntity[]|null $caption_entities List of special entities that appear in the caption, which can be
     *     specified instead of parse_mode
     * @param int|null $width Video width
     * @param int|null $height Video height
     * @param int|null $duration Video duration in seconds
     * @param bool|null $supports_streaming Pass True if the uploaded video is suitable for streaming
     * @param bool|null $has_spoiler Pass True if the video needs to be covered with a spoiler animation
     * @param bool|null $show_caption_above_media Pass True, if the caption must be shown above the message media
     */
    public function __construct(
        public string $media,
        public ?InputFile $thumbnail = null,
        public ?string $caption = null,
        public ParseMode|string|null $parse_mode = null,
        public ?array $caption_entities = null,
        public ?int $width = null,
        public ?int $height = null,
        public ?int $duration = null,
        public ?bool $supports_streaming = null,
        public ?bool $has_spoiler = null,
        public ?bool $show_caption_above_media = null,

        #[Deprecated] public ?InputFile $thumb = null,
    )
    {
        $this->thumb ??= $this->thumbnail;
        $this->thumbnail ??= $this->thumb;
    }

    public static function getType(): string
    {
        return 'video';
    }

    public static function makeByArray(array $data): static
    {
        if ($data['type'] !== self::getType()) {
            throw new RuntimeException("Wrong input media type: {$data['type']}");
        }

        return new self(
            media: $data['media'],
            thumbnail: isset($data['thumbnail'])
                ? InputFile::makeByString($data['thumbnail'])
                : null,
            caption: $data['caption'] ?? null,
            parse_mode: $data['parse_mode'] ?? null,
            caption_entities: isset($data['caption_entities'])
                ? array_map(
                    static fn(array $caption_entities_data) => MessageEntity::makeByArray($caption_entities_data),
                    $data['caption_entities'],
                )
                : null,
            width: $data['width'] ?? null,
            height: $data['height'] ?? null,
            duration: $data['duration'] ?? null,
            supports_streaming: $data['supports_streaming'] ?? null,
            has_spoiler: $data['has_spoiler'] ?? null,
            show_caption_above_media: $data['show_caption_above_media'] ?? null,
        );
    }

    public function getRequestData(): array
    {
        return [
            'type' => self::getType(),
            'media' => $this->media,
            'thumbnail' => $this->thumbnail,
            'caption' => $this->caption,
            'parse_mode' => $this->parse_mode instanceof ParseMode ? $this->parse_mode->value : $this->parse_mode,
            'caption_entities' => $this->caption_entities,
            'show_caption_above_media' => $this->show_caption_above_media,
            'width' => $this->width,
            'height' => $this->height,
            'duration' => $this->duration,
            'supports_streaming' => $this->supports_streaming,
            'has_spoiler' => $this->has_spoiler,
        ];
    }
}
