<?php

namespace TelegramBotsApi\Types;

use \TelegramBotsApi;
use \TelegramBotsApi\Exceptions\Error;

/**
 * Instance of this object represents an audio file to be treated as music by the Telegram clients.
 * @package TelegramBotsApi\Types
 * @author Maxim Kuvardin <kuvard.in@mail.ru>
 */
class Audio implements TypeInterface
{
    /**
     * @var string Unique identifier for this file
     */
    public $file_id;

    /**
     * @var int Duration of the audio in seconds as defined by sender
     */
    public $duration;

    /**
     * @var string|null Performer of the audio as defined by sender or by audio tags
     */
    public $performer;

    /**
     * @var string|null Title of the audio as defined by sender or by audio tags
     */
    public $title;

    /**
     * @var string|null MIME type of the file as defined by sender
     */
    public $mime_type;

    /**
     * @var int|null File size
     */
    public $file_size;

    /**
     * @var PhotoSize|null Thumbnail of the album cover to which the music file belongs
     */
    public $thumb;

    /**
     * Audio constructor.
     * @param array $data
     */
    public function __construct(array $data)
    {
        $this->file_id = $data['file_id'];
        $this->duration = $data['duration'];
        $this->performer = $data['performer'] ?? null;
        $this->title = $data['title'] ?? null;
        $this->mime_type = $data['mime_type'] ?? null;
        $this->file_size = $data['file_size'] ?? null;
        if (isset($data['thumb'])) {
            $this->thumb = $data['thumb'] instanceof PhotoSize ? $data['thumb'] : new PhotoSize($data['thumb']);
        }
    }

    /**
     * @return array
     */
    public function getRequestArray(): array
    {
        return [
            'file_id' => $this->file_id,
            'duration' => $this->duration,
            'performer' => $this->performer,
            'title' => $this->title,
            'mime_type' => $this->mime_type,
            'file_size' => $this->file_size,
            'thumb' => $this->thumb,
        ];
    }

    /**
     * @param string $file_id
     * @param int $duration
     * @return Audio
     */
    public static function make(string $file_id, int $duration): self
    {
        return new self([
            'file_id' => $file_id,
            'duration' => $duration,
        ]);
    }
}