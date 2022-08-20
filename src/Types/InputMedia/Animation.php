<?php

declare(strict_types=1);

namespace Kuvardin\TelegramBotsApi\Types\InputMedia;

use Kuvardin\TelegramBotsApi\Types\InputFile;
use Kuvardin\TelegramBotsApi\Types\InputMedia;
use Kuvardin\TelegramBotsApi\Types\MessageEntity;
use RuntimeException;

/**
 * Represents an animation file (GIF or H.264/MPEG-4 AVC video without sound) to be sent.
 *
 * @package Kuvardin\TelegramBotsApi
 * @author Maxim Kuvardin <maxim@kuvard.in>
 */
class Animation extends InputMedia
{
    /**
     * @var string $media File to send. Pass a file_id to send a file that exists on the Telegram servers
     *     (recommended), pass an HTTP URL for Telegram to get a file from the Internet, or pass
     *     “attach://<file_attach_name>” to upload a new one using multipart/form-data under <file_attach_name> name.
     *     <a href="https://core.telegram.org/bots/api#sending-files">More info on Sending Files »</a>
     */
    public string $media;

    /**
     * @var InputFile|null $thumb Thumbnail of the file sent; can be ignored if thumbnail generation for the file
     *     is supported server-side. The thumbnail should be in JPEG format and less than 200 kB in size. A thumbnail's
     *     width and height should not exceed 320. Ignored if the file is not uploaded using multipart/form-data.
     *     Thumbnails can't be reused and can be only uploaded as a new file, so you can pass
     *     “attach://<file_attach_name>” if the thumbnail was uploaded using multipart/form-data under
     *     <file_attach_name>. <a href="https://core.telegram.org/bots/api#sending-files">More info on Sending Files
     *     »</a>
     */
    public ?InputFile $thumb = null;

    /**
     * @var string|null $caption Caption of the animation to be sent, 0-1024 characters after entities parsing
     */
    public ?string $caption = null;

    /**
     * @var string|null $parse_mode Mode for parsing entities in the animation caption. See <a
     *     href="https://core.telegram.org/bots/api#formatting-options">formatting options</a> for more details.
     */
    public ?string $parse_mode = null;

    /**
     * @var MessageEntity[]|null $caption_entities List of special entities that appear in the caption, which can be
     *     specified instead of <em>parse_mode</em>
     */
    public ?array $caption_entities = null;

    /**
     * @var int|null $width Animation width
     */
    public ?int $width = null;

    /**
     * @var int|null $height Animation height
     */
    public ?int $height = null;

    /**
     * @var int|null $duration Animation duration in seconds
     */
    public ?int $duration = null;

    public static function getType(): string
    {
        return 'animation';
    }

    public static function makeByArray(array $data): static
    {
        $result = new self;

        if ($data['type'] !== self::getType()) {
            throw new RuntimeException("Wrong input media type: {$data['type']}");
        }

        $result->media = $data['media'];
        $result->thumb = isset($data['thumb'])
            ? InputFile::makeByString($data['thumb'])
            : null;
        $result->caption = $data['caption'] ?? null;
        $result->parse_mode = $data['parse_mode'] ?? null;
        if (isset($data['caption_entities'])) {
            $result->caption_entities = [];
            foreach ($data['caption_entities'] as $item_data) {
                $result->caption_entities[] = MessageEntity::makeByArray($item_data);
            }
        }
        $result->width = $data['width'] ?? null;
        $result->height = $data['height'] ?? null;
        $result->duration = $data['duration'] ?? null;
        return $result;
    }

    public function getRequestData(): array
    {
        return [
            'type' => self::getType(),
            'media' => $this->media,
            'thumb' => $this->thumb,
            'caption' => $this->caption,
            'parse_mode' => $this->parse_mode,
            'caption_entities' => $this->caption_entities,
            'width' => $this->width,
            'height' => $this->height,
            'duration' => $this->duration,
        ];
    }
}
