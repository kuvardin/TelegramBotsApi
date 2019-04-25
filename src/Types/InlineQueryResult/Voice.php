<?php

namespace TelegramBotsApi\Types\InlineQueryResult;

use \TelegramBotsApi;
use \TelegramBotsApi\Exceptions\Error;

/**
 * Represents a link to a voice recording in an .ogg container encoded with OPUS. By default, this voice recording will be sent by the user. Alternatively, you can use input_message_content to send a message with the specified content instead of the the voice message.
 * @package TelegramBotsApi\Types\InlineQueryResult
 * @author Maxim Kuvardin <kuvard.in@mail.ru>
 */
class Voice extends TelegramBotsApi\Types\InlineQueryResult implements TelegramBotsApi\Types\TypeInterface
{
    public const TYPE = TelegramBotsApi\Types\InlineQueryResult::TYPE_VOICE;

    /**
     * @var string Type of the result, must be self::TYPE
     */
    public $type = self::TYPE;

    /**
     * @var string Unique identifier for this result, 1-64 bytes
     */
    public $id;

    /**
     * @var string A valid URL for the voice recording
     */
    public $voice_url;

    /**
     * @var string Recording title
     */
    public $title;

    /**
     * @var string|null Caption, 0-1024 characters
     */
    public $caption;

    /**
     * @var string|null Send Markdown or HTML, if you want Telegram apps to show bold, italic, fixed-width text or inline URLs in the media caption.
     */
    public $parse_mode;

    /**
     * @var int|null Recording duration in seconds
     */
    public $voice_duration;

    /**
     * @var TelegramBotsApi\Types\InlineKeyboardMarkup|null Inline keyboard attached to the message
     */
    public $reply_markup;

    /**
     * @var TelegramBotsApi\Types\InputMessageContent|null Content of the message to be sent instead of the voice recording
     */
    public $input_message_content;

    /**
     * Voice constructor.
     * @param array $data
     * @throws Error
     */
    public function __construct(array $data)
    {
        if (isset($data['type'])) {
            if ($data['type'] !== self::TYPE) {
                throw new Error("Unknown type: {$data['type']}. Type must be self::TYPE.");
            }
            $this->type = $data['type'];
        }

        $this->id = $data['id'];
        $this->voice_url = $data['voice_url'];
        $this->title = $data['title'];
        $this->caption = $data['caption'] ?? null;

        if (isset($data['parse_mode'])) {
            if (!TelegramBotsApi\Bot::checkParseMode($data['parse_mode'])) {
                throw new Error("Unknown parse mode: {$data['parse_mode']}");
            }
            $this->parse_mode = $data['parse_mode'];
        }

        $this->voice_duration = $data['voice_duration'] ?? null;
        if (isset($data['reply_markup'])) {
            $this->reply_markup = $data['reply_markup'] instanceof TelegramBotsApi\Types\InlineKeyboardMarkup ? $data['reply_markup'] : new TelegramBotsApi\Types\InlineKeyboardMarkup($data['reply_markup']);
        }

        if (isset($data['input_message_content'])) {
            $this->input_message_content = $data['input_message_content'] instanceof TelegramBotsApi\Types\InputMessageContent ? $data['input_message_content'] : TelegramBotsApi\Types\InputMessageContent::new($data['input_message_content']);
        }
    }

    /**
     * @return array
     */
    public function getRequestArray(): array
    {
        return [
            'type' => $this->type,
            'id' => $this->id,
            'voice_url' => $this->voice_url,
            'title' => $this->title,
            'caption' => $this->caption,
            'parse_mode' => $this->parse_mode,
            'voice_duration' => $this->voice_duration,
            'reply_markup' => $this->reply_markup,
            'input_message_content' => $this->input_message_content,
        ];
    }

    /**
     * @param string $id
     * @param string $voice_url
     * @param string $title
     * @return Voice
     * @throws Error
     */
    public static function make(string $id, string $voice_url, string $title): self
    {
        return new self([
            'id' => $id,
            'voice_url' => $voice_url,
            'title' => $title,
        ]);
    }
}