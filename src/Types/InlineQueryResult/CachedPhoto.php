<?php

declare(strict_types=1);

namespace TelegramBotsApi\Types\InlineQueryResult;

use TelegramBotsApi;
use TelegramBotsApi\Exceptions\Error;
use TelegramBotsApi\Types;
use TelegramBotsApi\Types\InlineQueryResult;

/**
 * Represents a link to a photo stored on the Telegram servers. By default, this photo will be sent by the user
 * with an optional caption. Alternatively, you can use input_message_content to send a message with
 * the specified content instead of the photo.
 *
 * @package TelegramBotsApi
 * @author Maxim Kuvardin <maxim@kuvard.in>
 */
class CachedPhoto extends InlineQueryResult implements TelegramBotsApi\Types\TypeInterface
{
    public const TYPE = InlineQueryResult::TYPE_PHOTO;

    /**
     * @var string Unique identifier for this result, 1-64 bytes
     */
    public string $id;

    /**
     * @var string A valid file identifier of the photo
     */
    public string $photo_file_id;

    /**
     * @var string|null Title for the result
     */
    public ?string $title = null;

    /**
     * @var string|null Short description of the result
     */
    public ?string $description = null;

    /**
     * @var string|null Caption of the photo to be sent, 0-1024 characters
     */
    public ?string $caption = null;

    /**
     * @var string|null Send Markdown or HTML, if you want Telegram apps to show bold, italic, fixed-width
     * text or inline URLs in the media caption.
     */
    public ?string $parse_mode = null;

    /**
     * @var Types\InlineKeyboardMarkup|null Inline keyboard attached to the message
     */
    public ?Types\InlineKeyboardMarkup $reply_markup = null;

    /**
     * @var Types\InputMessageContent|null Content of the message to be sent instead of the photo
     */
    public ?Types\InputMessageContent $input_message_content = null;

    /**
     * CachedPhoto constructor.
     *
     * @param array $data
     * @throws Error
     */
    public function __construct(array $data)
    {
        parent::__construct($data);

        if ($data['type'] !== self::TYPE) {
            throw new Error("Unknown type: {$data['type']} (must be self::TYPE)");
        }

        $this->id = $data['id'];
        $this->photo_file_id = $data['photo_file_id'];

        if (isset($data['title'])) {
            $this->title = $data['title'];
        }

        if (isset($data['description'])) {
            $this->description = $data['description'];
        }

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
     * @param string $photo_file_id A valid file identifier of the photo
     * @return self
     * @throws Error
     */
    public static function make(string $id, string $photo_file_id): self
    {
        return new self([
            'type' => self::TYPE,
            'id' => $id,
            'photo_file_id' => $photo_file_id,
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
            'photo_file_id' => $this->photo_file_id,
            'title' => $this->title,
            'description' => $this->description,
            'caption' => $this->caption,
            'parse_mode' => $this->parse_mode,
            'reply_markup' => $this->reply_markup,
            'input_message_content' => $this->input_message_content,
        ];
    }
}
