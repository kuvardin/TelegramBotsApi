<?php

declare(strict_types=1);

namespace Kuvardin\TelegramBotsApi\Types\InlineQueryResult;

use JetBrains\PhpStorm\Deprecated;
use Kuvardin\TelegramBotsApi\Types\InlineKeyboardMarkup;
use Kuvardin\TelegramBotsApi\Types\InlineQueryResult;
use Kuvardin\TelegramBotsApi\Types\InputMessageContent;
use RuntimeException;

/**
 * Represents a venue. By default, the venue will be sent by the user. Alternatively, you can use
 * "input_message_content" to send a message with the specified content instead of the venue.
 *
 * @package Kuvardin\TelegramBotsApi
 * @author Maxim Kuvardin <maxim@kuvard.in>
 */
class Venue extends InlineQueryResult
{
    /**
     * @param float $latitude Latitude of the venue location in degrees
     * @param float $longitude Longitude of the venue location in degrees
     * @param string $title Title of the venue
     * @param string $address Address of the venue
     * @param string|null $foursquare_id Foursquare identifier of the venue if known
     * @param string|null $foursquare_type Foursquare type of the venue, if known. (For example,
     *     “arts_entertainment/default”, “arts_entertainment/aquarium” or “food/icecream”.)
     * @param string|null $google_place_id Google Places identifier of the venue
     * @param string|null $google_place_type Google Places type of the venue. (See supported types.)
     * @param InlineKeyboardMarkup|null $reply_markup Inline keyboard attached to the message
     * @param InputMessageContent|null $input_message_content Content of the message to be sent instead of the venue
     * @param string|null $thumbnail_url Url of the thumbnail for the result
     * @param int|null $thumbnail_width Thumbnail width
     * @param int|null $thumbnail_height Thumbnail height
     */
    public function __construct(
        public string $id,
        public float $latitude,
        public float $longitude,
        public string $title,
        public string $address,
        public ?string $foursquare_id = null,
        public ?string $foursquare_type = null,
        public ?string $google_place_id = null,
        public ?string $google_place_type = null,
        public ?InlineKeyboardMarkup $reply_markup = null,
        public ?InputMessageContent $input_message_content = null,
        public ?string $thumbnail_url = null,
        public ?int $thumbnail_width = null,
        public ?int $thumbnail_height = null,

        #[Deprecated] public ?string $thumb_url = null,
        #[Deprecated] public ?int $thumb_width = null,
        #[Deprecated] public ?int $thumb_height = null,
    )
    {
        $this->thumb_url ??= $this->thumbnail_url;
        $this->thumbnail_url ??= $this->thumb_url;

        $this->thumb_width ??= $this->thumbnail_width;
        $this->thumbnail_width ??= $this->thumb_width;

        $this->thumb_height ??= $this->thumbnail_height;
        $this->thumbnail_height ??= $this->thumb_height;
    }

    public static function getType(): string
    {
        return 'venue';
    }

    public static function makeByArray(array $data): static
    {
        if ($data['type'] !== self::getType()) {
            throw new RuntimeException("Wrong inline query result type: {$data['type']}");
        }

        return new self(
            id: $data['id'],
            latitude: $data['latitude'],
            longitude: $data['longitude'],
            title: $data['title'],
            address: $data['address'],
            foursquare_id: $data['foursquare_id'] ?? null,
            foursquare_type: $data['foursquare_type'] ?? null,
            google_place_id: $data['google_place_id'] ?? null,
            google_place_type: $data['google_place_type'] ?? null,
            reply_markup: isset($data['reply_markup'])
                ? InlineKeyboardMarkup::makeByArray($data['reply_markup'])
                : null,
            input_message_content: isset($data['input_message_content'])
                ? InputMessageContent::makeByArray($data['input_message_content'])
                : null,
            thumbnail_url: $data['thumbnail_url'] ?? null,
            thumbnail_width: $data['thumbnail_width'] ?? null,
            thumbnail_height: $data['thumbnail_height'] ?? null,
        );
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
            'thumbnail_url' => $this->thumbnail_url,
            'thumbnail_width' => $this->thumbnail_width,
            'thumbnail_height' => $this->thumbnail_height,
        ];
    }
}
