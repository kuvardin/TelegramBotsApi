<?php

declare(strict_types=1);

namespace Kuvardin\TelegramBotsApi\Types\InlineQueryResult;

use Kuvardin\TelegramBotsApi;
use Kuvardin\TelegramBotsApi\Exceptions\Error;
use Kuvardin\TelegramBotsApi\Types;
use Kuvardin\TelegramBotsApi\Types\InlineQueryResult;

/**
 * Represents a link to an MP3 audio file. By default, this audio file will be sent by the user. Alternatively,
 * you can use input_message_content to send a message with the specified content instead of the audio.
 *
 * @package Kuvardin\TelegramBotsApi
 * @author Maxim Kuvardin <maxim@kuvard.in>
 */
class Audio extends InlineQueryResult implements TelegramBotsApi\Types\TypeInterface
{
    public const TYPE = InlineQueryResult::TYPE_AUDIO;

    /**
     * @var string Unique identifier for this result, 1-64 bytes
     */
    public string $id;

    /**
     * @var string A valid URL for the audio file
     */
    public string $audio_url;

    /**
     * @var string Title
     */
    public string $title;

    /**
     * @var string|null Caption, 0-1024 characters
     */
    public ?string $caption = null;

    /**
     * @var string|null Send Markdown or HTML, if you want Telegram apps to show bold, italic, fixed-width
     * text or inline URLs in the media caption.
     */
    public ?string $parse_mode = null;

    /**
     * @var string|null Performer
     */
    public ?string $performer = null;

    /**
     * @var int|null Audio duration in seconds
     */
    public ?int $audio_duration = null;

    /**
     * @var Types\InlineKeyboardMarkup|null Inline keyboard attached to the message
     */
    public ?Types\InlineKeyboardMarkup $reply_markup = null;

    /**
     * @var Types\InputMessageContent|null Content of the message to be sent instead of the audio
     */
    public ?Types\InputMessageContent $input_message_content = null;

    /**
     * Audio constructor.
     *
     * @param array $data
     * @throws Error
     */
    public function __construct(array $data)
    {
        parent::__construct($data);

        if ($data['type'] !== self::TYPE) {
            throw new Error("Unknown type: {$data['type']} (must be self::TYPE");
        }

        $this->id = $data['id'];
        $this->audio_url = $data['audio_url'];
        $this->title = $data['title'];

        if (isset($data['caption'])) {
            $this->caption = $data['caption'];
        }

        if (isset($data['parse_mode'])) {
            $this->parse_mode = $data['parse_mode'];
        }

        if (isset($data['performer'])) {
            $this->performer = $data['performer'];
        }

        if (isset($data['audio_duration'])) {
            $this->audio_duration = $data['audio_duration'];
        }

        if (isset($data['reply_markup'])) {
            $this->reply_markup = $data['reply_markup'] instanceof Types\InlineKeyboardMarkup
                ? $data['reply_markup']
                : new Types\InlineKeyboardMarkup($data['reply_markup']);
        }

        if (isset($data['input_message_content'])) {
            $this->input_message_content = $data['input_message_content'] instanceof Types\InputMessageContent
                ? $data['input_message_content']
                : Types\InputMessageContent::constructChild($data['input_message_content']);
        }
    }

    /**
     * @param string $id Unique identifier for this result, 1-64 bytes
     * @param string $audio_url A valid URL for the audio file
     * @param string $title Title
     * @return self
     * @throws Error
     */
    public static function make(string $id, string $audio_url, string $title): self
    {
        return new self([
            'type' => self::TYPE,
            'id' => $id,
            'audio_url' => $audio_url,
            'title' => $title,
        ]);
    }

    /**
     * @return array
     */
    public function getRequestArray(): array
    {
        return [
            'type' => self::TYPE,
            'id' => $this->id,
            'audio_url' => $this->audio_url,
            'title' => $this->title,
            'caption' => $this->caption,
            'parse_mode' => $this->parse_mode,
            'performer' => $this->performer,
            'audio_duration' => $this->audio_duration,
            'reply_markup' => $this->reply_markup,
            'input_message_content' => $this->input_message_content,
        ];
    }
}
