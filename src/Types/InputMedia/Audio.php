<?php

declare(strict_types=1);

namespace Kuvardin\TelegramBotsApi\Types\InputMedia;

use Kuvardin\TelegramBotsApi\Types\InputFile;
use Kuvardin\TelegramBotsApi\Types\InputMedia;
use Kuvardin\TelegramBotsApi\Types\MessageEntity;
use RuntimeException;

/**
 * Represents an audio file to be treated as music to be sent.
 *
 * @package Kuvardin\TelegramBotsApi
 * @author Maxim Kuvardin <maxim@kuvard.in>
 */
class Audio extends InputMedia
{
    /**
     * @param string $media File to send. Pass a file_id to send a file that exists on the Telegram servers
     *     (recommended), pass an HTTP URL for Telegram to get a file from the Internet, or pass
     *     “attach://<file_attach_name>” to upload a new one using multipart/form-data under <file_attach_name> name.
     *     <a href="https://core.telegram.org/bots/api#sending-files">More info on Sending Files »</a>
     * @param InputFile|null $thumb Thumbnail of the file sent; can be ignored if thumbnail generation for the file is
     *     supported server-side. The thumbnail should be in JPEG format and less than 200 kB in size. A thumbnail's
     *     width and height should not exceed 320. Ignored if the file is not uploaded using multipart/form-data.
     *     Thumbnails can't be reused and can be only uploaded as a new file, so you can pass
     *     “attach://<file_attach_name>” if the thumbnail was uploaded using multipart/form-data under
     *     <file_attach_name>. <a href="https://core.telegram.org/bots/api#sending-files">More info on Sending Files
     *     »</a>
     * @param string|null $caption Caption of the audio to be sent, 0-1024 characters after entities parsing
     * @param string|null $parse_mode Mode for parsing entities in the audio caption. See <a
     *     href="https://core.telegram.org/bots/api#formatting-options">formatting options</a> for more details.
     * @param MessageEntity[]|null $caption_entities List of special entities that appear in the caption, which can be
     *     specified instead of <em>parse_mode</em>
     * @param int|null $duration Duration of the audio in seconds
     * @param string|null $performer Performer of the audio
     * @param string|null $title Title of the audio
     */
    public function __construct(
        public string $media,
        public ?InputFile $thumb = null,
        public ?string $caption = null,
        public ?string $parse_mode = null,
        public ?array $caption_entities = null,
        public ?int $duration = null,
        public ?string $performer = null,
        public ?string $title = null,
    )
    {

    }

    public static function getType(): string
    {
        return 'audio';
    }

    public static function makeByArray(array $data): static
    {
        if ($data['type'] !== self::getType()) {
            throw new RuntimeException("Wrong input media type: {$data['type']}");
        }

        $result = new self(
            media: $data['media'],
            thumb: isset($data['thumb'])
                ? InputFile::makeByString($data['thumb'])
                : null,
            caption: $data['caption'] ?? null,
            parse_mode: $data['parse_mode'] ?? null,
            caption_entities: null,
            duration: $data['duration'] ?? null,
            performer: $data['performer'] ?? null,
            title: $data['title'] ?? null,
        );

        if (isset($data['caption_entities'])) {
            $result->caption_entities = [];
            foreach ($data['caption_entities'] as $item_data) {
                $result->caption_entities[] = MessageEntity::makeByArray($item_data);
            }
        }
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
            'duration' => $this->duration,
            'performer' => $this->performer,
            'title' => $this->title,
        ];
    }
}
