<?php

namespace TelegramBotsApi\Types\InlineQueryResult;

use \TelegramBotsApi;
use \TelegramBotsApi\Exceptions\Error;

/**
 * Represents a location on a map. By default, the location will be sent by the user. Alternatively, you can use input_message_content to send a message with the specified content instead of the location.
 * @package TelegramBotsApi\Types\InlineQueryResult
 * @author Maxim Kuvardin <kuvard.in@mail.ru>
 */
class Location extends TelegramBotsApi\Types\InlineQueryResult implements TelegramBotsApi\Types\TypeInterface
{
    public const TYPE = TelegramBotsApi\Types\InlineQueryResult::TYPE_LOCATION;

    /**
     * @var string Type of the result, must be self::TYPE
     */
    public $type = self::TYPE;

    /**
     * @var string Unique identifier for this result, 1-64 Bytes
     */
    public $id;

    /**
     * @var float Location latitude in degrees
     */
    public $latitude;

    /**
     * @var float Location longitude in degrees
     */
    public $longitude;

    /**
     * @var string Location title
     */
    public $title;

    /**
     * @var int|null Period in seconds for which the location can be updated, should be between 60 and 86400.
     */
    public $live_period;

    /**
     * @var TelegramBotsApi\Types\InlineKeyboardMarkup|null Inline keyboard attached to the message
     */
    public $reply_markup;

    /**
     * @var TelegramBotsApi\Types\InputMessageContent|null Content of the message to be sent instead of the location
     */
    public $input_message_content;

    /**
     * @var string|null Url of the thumbnail for the result
     */
    public $thumb_url;

    /**
     * @var int|null Thumbnail width
     */
    public $thumb_width;

    /**
     * @var int|null Thumbnail height
     */
    public $thumb_height;

    /**
     * Location constructor.
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
        $this->latitude = $data['latitude'];
        $this->longitude = $data['longitude'];
        $this->title = $data['title'];
        $this->live_period = $data['live_period'] ?? null;

        if (isset($data['reply_markup'])) {
            $this->reply_markup = $data['reply_markup'] instanceof TelegramBotsApi\Types\InlineKeyboardMarkup ? $data['reply_markup'] : new TelegramBotsApi\Types\InlineKeyboardMarkup($data['reply_markup']);
        }

        if (isset($data['input_message_content'])) {
            $this->input_message_content = $data['input_message_content'] instanceof TelegramBotsApi\Types\InputMessageContent ? $data['input_message_content'] : TelegramBotsApi\Types\InputMessageContent::new($data['input_message_content']);
        }

        $this->thumb_url = $data['thumb_url'] ?? null;
        $this->thumb_width = $data['thumb_width'] ?? null;
        $this->thumb_height = $data['thumb_height'] ?? null;
    }

    /**
     * @return array
     */
    public function getRequestArray(): array
    {
        return [
            'type' => $this->type,
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

    /**
     * @param string $id
     * @param float $latitude
     * @param float $longitude
     * @param string $title
     * @return Location
     * @throws Error
     */
    public static function make(string $id, float $latitude, float $longitude, string $title): self
    {
        return new self([
            'id' => $id,
            'latitude' => $latitude,
            'longitude' => $longitude,
            'title' => $title,
        ]);
    }
}