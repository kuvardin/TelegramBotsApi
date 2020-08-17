<?php

declare(strict_types=1);

namespace Kuvardin\TelegramBotsApi\Types\InlineQueryResult;

use Kuvardin\TelegramBotsApi;
use Kuvardin\TelegramBotsApi\Exceptions\Error;
use Kuvardin\TelegramBotsApi\Types;
use Kuvardin\TelegramBotsApi\Types\InlineQueryResult;

/**
 * Represents a link to an MP3 audio file stored on the Telegram servers. By default, this audio file will be sent by
 * the user. Alternatively, you can use input_message_content to send a message with the specified content instead of
 * the audio.
 *
 * @package Kuvardin\TelegramBotsApi
 * @author Maxim Kuvardin <maxim@kuvard.in>
 */
class CachedAudio extends InlineQueryResult implements TelegramBotsApi\Types\TypeInterface
{
    public const TYPE = InlineQueryResult::TYPE_AUDIO;

    /**
     * @var string Unique identifier for this result, 1-64 bytes
     */
    public string $id;

    /**
     * @var string A valid file identifier for the audio file
     */
    public string $audio_file_id;

    /**
     * @var string|null Caption, 0-1024 characters
     */
    public ?string $caption = null;

    /**
     * @var string|null Send Markdown or HTML, if you want Telegram apps to show bold, italic, fixed-width text or
     *     inline URLs in the media caption.
     */
    public ?string $parse_mode = null;

    /**
     * @var Types\InlineKeyboardMarkup|null Inline keyboard attached to the message
     */
    public ?Types\InlineKeyboardMarkup $reply_markup = null;

    /**
     * @var Types\InputMessageContent|null Content of the message to be sent instead of the audio
     */
    public ?Types\InputMessageContent $input_message_content = null;

    /**
     * CachedAudio constructor.
     *
     * @param array $data
     */
    public function __construct(array $data)
    {
        parent::__construct($data);

        if ($data['type'] !== self::TYPE) {
            throw new Error("Unknown type: {$data['type']} (must be self::TYPE)");
        }

        $this->id = $data['id'];
        $this->audio_file_id = $data['audio_file_id'];

        if (isset($data['caption'])) {
            $this->caption = $data['caption'];
        }

        if (isset($data['parse_mode'])) {
            $this->parse_mode = $data['parse_mode'];
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
     * @param string $audio_file_id A valid file identifier for the audio file
     * @return self
     */
    public static function make(string $id, string $audio_file_id): self
    {
        return new self([
            'type' => self::TYPE,
            'id' => $id,
            'audio_file_id' => $audio_file_id,
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
            'audio_file_id' => $this->audio_file_id,
            'caption' => $this->caption,
            'parse_mode' => $this->parse_mode,
            'reply_markup' => $this->reply_markup,
            'input_message_content' => $this->input_message_content,
        ];
    }
}
