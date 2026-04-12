<?php

declare(strict_types=1);

namespace Kuvardin\TelegramBotsApi\Types\InputStoryContent;

use Kuvardin\TelegramBotsApi\Types\InputFile;
use Kuvardin\TelegramBotsApi\Types\InputStoryContent;
use RuntimeException;

/**
 * Describes a video to post as a story.
Describes a video to post as a story.
 *
 * @package Kuvardin\TelegramBotsApi
 * @author Maxim Kuvardin <maxim@kuvard.in>
 */
class Video extends InputStoryContent
{
    /**
     * @param InputFile $video The video to post as a story. The video must be of the size 720x1280, streamable,
     *     encoded with H.265 codec, with key frames added each second in the MPEG4 format, and must not exceed 30 MB.
     *     The video can't be reused and can only be uploaded as a new file, so you can pass
     *     “attach://&lt;file_attach_name&gt;” if the video was uploaded using multipart/form-data under
     *     &lt;file_attach_name&gt;.
     * @param float|null $duration Precise duration of the video in seconds; 0-60
     * @param float|null $cover_frame_timestamp Timestamp in seconds of the frame that will be used as the static cover
     *     for the story. Defaults to 0.0.
     * @param bool|null $is_animation Pass True if the video has no sound
     */
    public function __construct(
        public InputFile $video,
        public ?float $duration = null,
        public ?float $cover_frame_timestamp = null,
        public ?bool $is_animation = null,
    )
    {
        if ($this->video->getAttachName() === null) {
            throw new RuntimeException('Input file attach name must be not empty');
        }
    }

    public static function getType(): string
    {
        return 'video';
    }

    public static function makeByArray(array $data): static
    {
        if ($data['type'] !== self::getType()) {
            throw new RuntimeException("Wrong input story content type: {$data['type']}");
        }

        return new self(
            video: InputFile::makeByString($data['video']),
            duration: $data['duration'] ?? null,
            cover_frame_timestamp: $data['cover_frame_timestamp'] ?? null,
            is_animation: $data['is_animation'] ?? null,
        );
    }

    public function getRequestData(): array
    {
        return [
            'type' => self::getType(),
            'video' => $this->video,
            'duration' => $this->duration,
            'cover_frame_timestamp' => $this->cover_frame_timestamp,
            'is_animation' => $this->is_animation,
        ];
    }
}
