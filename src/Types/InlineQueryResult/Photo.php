<?php declare(strict_types=1);

namespace TelegramBotsApi\Types\InlineQueryResult;

use TelegramBotsApi;
use TelegramBotsApi\Exceptions\Error;
use TelegramBotsApi\Types;
use TelegramBotsApi\Types\InlineQueryResult;

/**
 * Represents a link to a photo. By default, this photo will be sent by the user with optional caption.
 * Alternatively, you can use input_message_content to send a message with the specified content instead
 * of the photo.
 *
 * @package TelegramBotsApi
 * @author Maxim Kuvardin <maxim@kuvard.in>
 */
class Photo extends InlineQueryResult implements TelegramBotsApi\Types\TypeInterface
{
    public const TYPE = InlineQueryResult::TYPE_PHOTO;

    /**
     * @var string Unique identifier for this result, 1-64 bytes
     */
    public string $id;

    /**
     * @var string A valid URL of the photo. Photo must be in jpeg format. Photo size must not exceed 5MB
     */
    public string $photo_url;

    /**
     * @var string URL of the thumbnail for the photo
     */
    public string $thumb_url;

    /**
     * @var int|null Width of the photo
     */
    public ?int $photo_width;

    /**
     * @var int|null Height of the photo
     */
    public ?int $photo_height;

    /**
     * @var string|null Title for the result
     */
    public ?string $title;

    /**
     * @var string|null Short description of the result
     */
    public ?string $description;

    /**
     * @var string|null Caption of the photo to be sent, 0-1024 characters
     */
    public ?string $caption;

    /**
     * @var string|null Send Markdown or HTML, if you want Telegram apps to show bold, italic, fixed-width text or inline URLs in the media caption.
     */
    public ?string $parse_mode;

    /**
     * @var Types\InlineKeyboardMarkup|null Inline keyboard attached to the message
     */
    public ?Types\InlineKeyboardMarkup $reply_markup;

    /**
     * @var Types\InputMessageContent|null Content of the message to be sent instead of the photo
     */
    public ?Types\InputMessageContent $input_message_content;

    /**
     * Photo constructor.
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
        $this->photo_url = $data['photo_url'];
        $this->thumb_url = $data['thumb_url'];

        if (isset($data['photo_width'])) {
            $this->photo_width = $data['photo_width'];
        }

        if (isset($data['photo_height'])) {
            $this->photo_height = $data['photo_height'];
        }

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
     * @param string $photo_url A valid URL of the photo. Photo must be in jpeg format. Photo size must not exceed 5MB
     * @param string $thumb_url URL of the thumbnail for the photo
     * @return self
     * @throws Error
     */
    public static function make(string $id, string $photo_url, string $thumb_url): self
    {
        return new self([
            'type' => self::TYPE,
            'id' => $id,
            'photo_url' => $photo_url,
            'thumb_url' => $thumb_url,
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
            'photo_url' => $this->photo_url,
            'thumb_url' => $this->thumb_url,
            'photo_width' => $this->photo_width,
            'photo_height' => $this->photo_height,
            'title' => $this->title,
            'description' => $this->description,
            'caption' => $this->caption,
            'parse_mode' => $this->parse_mode,
            'reply_markup' => $this->reply_markup,
            'input_message_content' => $this->input_message_content,
        ];
    }
}