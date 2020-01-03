<?php declare(strict_types=1);

namespace TelegramBotsApi\Types\InlineQueryResult;

use TelegramBotsApi;
use TelegramBotsApi\Exceptions\Error;
use TelegramBotsApi\Types;
use TelegramBotsApi\Types\InlineQueryResult;

/**
 * Represents a link to a video file stored on the Telegram servers. By default, this video file will be sent by
 * the user with an optional caption. Alternatively, you can use input_message_content to send a message with
 * the specified content instead of the video.
 *
 * @package TelegramBotsApi
 * @author Maxim Kuvardin <maxim@kuvard.in>
 */
class CachedVideo extends InlineQueryResult implements TelegramBotsApi\Types\TypeInterface
{
    public const TYPE = InlineQueryResult::TYPE_VIDEO;

    /**
     * @var string Unique identifier for this result, 1-64 bytes
     */
    public string $id;

    /**
     * @var string A valid file identifier for the video file
     */
    public string $video_file_id;

    /**
     * @var string Title for the result
     */
    public string $title;

    /**
     * @var string|null Short description of the result
     */
    public ?string $description;

    /**
     * @var string|null Caption of the video to be sent, 0-1024 characters
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
     * @var Types\InputMessageContent|null Content of the message to be sent instead of the video
     */
    public ?Types\InputMessageContent $input_message_content;

    /**
     * InlineQueryResultCachedVideo constructor.
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
        $this->video_file_id = $data['video_file_id'];
        $this->title = $data['title'];

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
     * @param string $type Type of the result, must be video
     * @param string $id Unique identifier for this result, 1-64 bytes
     * @param string $video_file_id A valid file identifier for the video file
     * @param string $title Title for the result
     * @return self
     * @throws Error
     */
    public static function make(string $type, string $id, string $video_file_id, string $title): self
    {
        return new self([
            'type' => $type,
            'id' => $id,
            'video_file_id' => $video_file_id,
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
            'video_file_id' => $this->video_file_id,
            'title' => $this->title,
            'description' => $this->description,
            'caption' => $this->caption,
            'parse_mode' => $this->parse_mode,
            'reply_markup' => $this->reply_markup,
            'input_message_content' => $this->input_message_content,
        ];
    }
}