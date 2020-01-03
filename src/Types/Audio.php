<?php declare(strict_types=1);

namespace TelegramBotsApi\Types;

use TelegramBotsApi;

/**
 * This object represents an audio file to be treated as music by the Telegram clients.
 *
 * @package TelegramBotsApi
 * @author Maxim Kuvardin <maxim@kuvard.in>
 */
class Audio implements TypeInterface
{
    /**
     * @var string Identifier for this file, which can be used to download or reuse the file
     */
    public string $file_id;

    /**
     * @var string Unique identifier for this file, which is supposed to be the same over time and for
     * different bots. Can't be used to download or reuse the file.
     */
    public string $file_unique_id;

    /**
     * @var int Duration of the audio in seconds as defined by sender
     */
    public int $duration;

    /**
     * @var string|null Performer of the audio as defined by sender or by audio tags
     */
    public ?string $performer;

    /**
     * @var string|null Title of the audio as defined by sender or by audio tags
     */
    public ?string $title;

    /**
     * @var string|null MIME type of the file as defined by sender
     */
    public ?string $mime_type;

    /**
     * @var int|null File size
     */
    public ?int $file_size;

    /**
     * @var PhotoSize|null Thumbnail of the album cover to which the music file belongs
     */
    public ?PhotoSize $thumb;

    /**
     * Audio constructor.
     *
     * @param array $data
     */
    public function __construct(array $data)
    {
        $this->file_id = $data['file_id'];
        $this->file_unique_id = $data['file_unique_id'];
        $this->duration = $data['duration'];
        if (isset($data['performer'])) {
            $this->performer = $data['performer'];
        }

        if (isset($data['title'])) {
            $this->title = $data['title'];
        }

        if (isset($data['mime_type'])) {
            $this->mime_type = $data['mime_type'];
        }

        if (isset($data['file_size'])) {
            $this->file_size = $data['file_size'];
        }

        if (isset($data['thumb'])) {
            $this->thumb = $data['thumb'] instanceof PhotoSize
                ? $data['thumb']
                : new PhotoSize($data['thumb']);
        }

    }

    /**
     * @param string $file_id Identifier for this file, which can be used to download or reuse the file
     * @param string $file_unique_id Unique identifier for this file, which is supposed to be the same
     * over time and for different bots. Can't be used to download or reuse the file.
     * @param int $duration Duration of the audio in seconds as defined by sender
     * @return Audio
     */
    public static function make(string $file_id, string $file_unique_id, int $duration): self
    {
        return new self([
            'file_id' => $file_id,
            'file_unique_id' => $file_unique_id,
            'duration' => $duration,
        ]);
    }

    /**
     * @return array
     */
    public function getRequestArray(): array
    {
        return [
            'file_id' => $this->file_id,
            'file_unique_id' => $this->file_unique_id,
            'duration' => $this->duration,
            'performer' => $this->performer,
            'title' => $this->title,
            'mime_type' => $this->mime_type,
            'file_size' => $this->file_size,
            'thumb' => $this->thumb,
        ];
    }
}