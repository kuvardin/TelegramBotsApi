<?php

declare(strict_types=1);

namespace Kuvardin\TelegramBotsApi\Types\InlineQueryResult;

use Kuvardin\TelegramBotsApi\Types\InlineKeyboardMarkup;
use Kuvardin\TelegramBotsApi\Types\InlineQueryResult;
use Kuvardin\TelegramBotsApi\Types\InputMessageContent;
use RuntimeException;

/**
 * Represents a venue. By default, the venue will be sent by the user. Alternatively, you can use
 * <em>input_message_content</em> to send a message with the specified content instead of the venue.
 *
 * @package Kuvardin\TelegramBotsApi
 * @author Maxim Kuvardin <maxim@kuvard.in>
 */
class Venue extends InlineQueryResult
{
    /**
     * @var string $id Unique identifier for this result, 1-64 Bytes
     */
    public string $id;

    /**
     * @var float $latitude Latitude of the venue location in degrees
     */
    public float $latitude;

    /**
     * @var float $longitude Longitude of the venue location in degrees
     */
    public float $longitude;

    /**
     * @var string $title Title of the venue
     */
    public string $title;

    /**
     * @var string $address Address of the venue
     */
    public string $address;

    /**
     * @var string|null $foursquare_id Foursquare identifier of the venue if known
     */
    public ?string $foursquare_id = null;

    /**
     * @var string|null $foursquare_type Foursquare type of the venue, if known. (For example,
     *     “arts_entertainment/default”, “arts_entertainment/aquarium” or “food/icecream”.)
     */
    public ?string $foursquare_type = null;

    /**
     * @var string|null $google_place_id Google Places identifier of the venue
     */
    public ?string $google_place_id = null;

    /**
     * @var string|null $google_place_type Google Places type of the venue. (See <a
     *     href="https://developers.google.com/places/web-service/supported_types">supported types</a>.)
     */
    public ?string $google_place_type = null;

    /**
     * @var InlineKeyboardMarkup|null $reply_markup <a
     *     href="https://core.telegram.org/bots#inline-keyboards-and-on-the-fly-updating">Inline keyboard</a> attached
     *     to the message
     */
    public ?InlineKeyboardMarkup $reply_markup = null;

    /**
     * @var InputMessageContent|null $input_message_content Content of the message to be sent instead of the venue
     */
    public ?InputMessageContent $input_message_content = null;

    /**
     * @var string|null $thumb_url Url of the thumbnail for the result
     */
    public ?string $thumb_url = null;

    /**
     * @var int|null $thumb_width Thumbnail width
     */
    public ?int $thumb_width = null;

    /**
     * @var int|null $thumb_height Thumbnail height
     */
    public ?int $thumb_height = null;

    public static function getType(): string
    {
        return 'venue';
    }

    public static function makeByArray(array $data): static
    {
        $result = new self;

        if ($data['type'] !== self::getType()) {
            throw new RuntimeException("Wrong inline query result type: {$data['type']}");
        }

        $result->id = $data['id'];
        $result->latitude = $data['latitude'];
        $result->longitude = $data['longitude'];
        $result->title = $data['title'];
        $result->address = $data['address'];
        $result->foursquare_id = $data['foursquare_id'] ?? null;
        $result->foursquare_type = $data['foursquare_type'] ?? null;
        $result->google_place_id = $data['google_place_id'] ?? null;
        $result->google_place_type = $data['google_place_type'] ?? null;
        $result->reply_markup = isset($data['reply_markup'])
            ? InlineKeyboardMarkup::makeByArray($data['reply_markup'])
            : null;
        $result->input_message_content = isset($data['input_message_content'])
            ? InputMessageContent::makeByArray($data['input_message_content'])
            : null;
        $result->thumb_url = $data['thumb_url'] ?? null;
        $result->thumb_width = $data['thumb_width'] ?? null;
        $result->thumb_height = $data['thumb_height'] ?? null;
        return $result;
    }

    public function getRequestData(): array
    {
        return [
            'type' => self::getType(),
            'id' => $this->id,
            'latitude' => $this->latitude,
            'longitude' => $this->longitude,
            'title' => $this->title,
            'address' => $this->address,
            'foursquare_id' => $this->foursquare_id,
            'foursquare_type' => $this->foursquare_type,
            'google_place_id' => $this->google_place_id,
            'google_place_type' => $this->google_place_type,
            'reply_markup' => $this->reply_markup,
            'input_message_content' => $this->input_message_content,
            'thumb_url' => $this->thumb_url,
            'thumb_width' => $this->thumb_width,
            'thumb_height' => $this->thumb_height,
        ];
    }
}
