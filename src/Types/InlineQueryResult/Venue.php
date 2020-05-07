<?php

declare(strict_types=1);

namespace TelegramBotsApi\Types\InlineQueryResult;

use TelegramBotsApi;
use TelegramBotsApi\Exceptions\Error;
use TelegramBotsApi\Types;
use TelegramBotsApi\Types\InlineQueryResult;

/**
 * Represents a venue. By default, the venue will be sent by the user. Alternatively, you can use
 * input_message_content to send a message with the specified content instead of the venue.
 *
 * @package TelegramBotsApi
 * @author Maxim Kuvardin <maxim@kuvard.in>
 */
class Venue extends InlineQueryResult implements TelegramBotsApi\Types\TypeInterface
{
    public const TYPE = InlineQueryResult::TYPE_VENUE;

    /**
     * @var string Unique identifier for this result, 1-64 Bytes
     */
    public string $id;

    /**
     * @var float Latitude of the venue location in degrees
     */
    public float $latitude;

    /**
     * @var float Longitude of the venue location in degrees
     */
    public float $longitude;

    /**
     * @var string Title of the venue
     */
    public string $title;

    /**
     * @var string Address of the venue
     */
    public string $address;

    /**
     * @var string|null Foursquare identifier of the venue if known
     */
    public ?string $foursquare_id = null;

    /**
     * @var string|null Foursquare type of the venue, if known. (For example, “arts_entertainment/default”, “arts_entertainment/aquarium” or “food/icecream”.)
     */
    public ?string $foursquare_type = null;

    /**
     * @var Types\InlineKeyboardMarkup|null Inline keyboard attached to the message
     */
    public ?Types\InlineKeyboardMarkup $reply_markup = null;

    /**
     * @var Types\InputMessageContent|null Content of the message to be sent instead of the venue
     */
    public ?Types\InputMessageContent $input_message_content = null;

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
     * Venue constructor.
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
        $this->address = $data['address'];

        if (isset($data['foursquare_id'])) {
            $this->foursquare_id = $data['foursquare_id'];
        }

        if (isset($data['foursquare_type'])) {
            $this->foursquare_type = $data['foursquare_type'];
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
     * @param float $latitude Latitude of the venue location in degrees
     * @param float $longitude Longitude of the venue location in degrees
     * @param string $title Title of the venue
     * @param string $address Address of the venue
     * @return self
     * @throws Error
     */
    public static function make(string $id, float $latitude, float $longitude, string $title, string $address): self
    {
        return new self([
            'type' => self::TYPE,
            'id' => $id,
            'latitude' => $latitude,
            'longitude' => $longitude,
            'title' => $title,
            'address' => $address,
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
            'address' => $this->address,
            'foursquare_id' => $this->foursquare_id,
            'foursquare_type' => $this->foursquare_type,
            'reply_markup' => $this->reply_markup,
            'input_message_content' => $this->input_message_content,
            'thumb_url' => $this->thumb_url,
            'thumb_width' => $this->thumb_width,
            'thumb_height' => $this->thumb_height,
        ];
    }
}
