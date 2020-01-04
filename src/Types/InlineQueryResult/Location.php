<?php declare(strict_types=1);

namespace TelegramBotsApi\Types\InlineQueryResult;

use TelegramBotsApi;
use TelegramBotsApi\Exceptions\Error;
use TelegramBotsApi\Types;
use TelegramBotsApi\Types\InlineQueryResult;

/**
 * Represents a location on a map. By default, the location will be sent by the user. Alternatively, you can use
 * input_message_content to send a message with the specified content instead of the location.
 *
 * @package TelegramBotsApi
 * @author Maxim Kuvardin <maxim@kuvard.in>
 */
class Location extends InlineQueryResult implements TelegramBotsApi\Types\TypeInterface
{
    public const TYPE = InlineQueryResult::TYPE_LOCATION;

    /**
     * @var string Unique identifier for this result, 1-64 Bytes
     */
    public string $id;

    /**
     * @var float Location latitude in degrees
     */
    public float $latitude;

    /**
     * @var float Location longitude in degrees
     */
    public float $longitude;

    /**
     * @var string Location title
     */
    public string $title;

    /**
     * @var int|null Period in seconds for which the location can be updated, should be between 60 and 86400.
     */
    public ?int $live_period = null;

    /**
     * @var Types\InlineKeyboardMarkup|null Inline keyboard attached to the message
     */
    public ?Types\InlineKeyboardMarkup $reply_markup;

    /**
     * @var Types\InputMessageContent|null Content of the message to be sent instead of the location
     */
    public ?Types\InputMessageContent $input_message_content;

    /**
     * @var string|null Url of the thumbnail for the result
     */
    public ?string $thumb_url = null;

    /**
     * @var int|null Thumbnail width
     */
    public ?int $thumb_width = null;

    /**
     * @var int|null Thumbnail height
     */
    public ?int $thumb_height = null;

    /**
     * Location constructor.
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
        $this->latitude = $data['latitude'];
        $this->longitude = $data['longitude'];
        $this->title = $data['title'];

        if (isset($data['live_period'])) {
            $this->live_period = $data['live_period'];
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

        if (isset($data['thumb_url'])) {
            $this->thumb_url = $data['thumb_url'];
        }

        if (isset($data['thumb_width'])) {
            $this->thumb_width = $data['thumb_width'];
        }

        if (isset($data['thumb_height'])) {
            $this->thumb_height = $data['thumb_height'];
        }
    }

    /**
     * @param string $id Unique identifier for this result, 1-64 Bytes
     * @param float $latitude Location latitude in degrees
     * @param float $longitude Location longitude in degrees
     * @param string $title Location title
     * @return self
     * @throws Error
     */
    public static function make(string $id, float $latitude, float $longitude, string $title): self
    {
        return new self([
            'type' => self::TYPE,
            'id' => $id,
            'latitude' => $latitude,
            'longitude' => $longitude,
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
            'latitude' => $this->latitude,
            'longitude' => $this->longitude,
            'title' => $this->title,
            'live_period' => $this->live_period,
            'reply_markup' => $this->reply_markup,
            'input_message_content' => $this->input_message_content,
            'thumb_url' => $this->thumb_url,
            'thumb_width' => $this->thumb_width,
            'thumb_height' => $this->thumb_height,
        ];
    }
}