<?php

declare(strict_types=1);

namespace Kuvardin\TelegramBotsApi\Types;

use Kuvardin\TelegramBotsApi\Type;

/**
 * At most <strong>one</strong> of the optional fields can be present in any given object.
 *
 * @package Kuvardin\TelegramBotsApi
 * @author Maxim Kuvardin <maxim@kuvard.in>
 */
class PollMedia extends Type
{
    /**
     * @param Animation|null $animation Media is an animation, information about the animation
     * @param Audio|null $audio Media is an audio file, information about the file; currently, can't be received in a
     *     poll option
     * @param Document|null $document Media is a general file, information about the file; currently, can't be received
     *     in a poll option
     * @param LivePhoto|null $live_photo Media is a live photo, information about the live photo
     * @param Location|null $location Media is a shared location, information about the location
     * @param PhotoSize[]|null $photo Media is a photo, available sizes of the photo
     * @param Sticker|null $sticker Media is a sticker, information about the sticker; currently, for poll options only
     * @param Venue|null $venue Media is a venue, information about the venue
     * @param Video|null $video Media is a video, information about the video
     */
    public function __construct(
        public ?Animation $animation = null,
        public ?Audio $audio = null,
        public ?Document $document = null,
        public ?LivePhoto $live_photo = null,
        public ?Location $location = null,
        public ?array $photo = null,
        public ?Sticker $sticker = null,
        public ?Venue $venue = null,
        public ?Video $video = null,
    )
    {

    }

    public static function makeByArray(array $data): self
    {
        return new self(
            animation: isset($data['animation'])
                ? Animation::makeByArray($data['animation'])
                : null,
            audio: isset($data['audio'])
                ? Audio::makeByArray($data['audio'])
                : null,
            document: isset($data['document'])
                ? Document::makeByArray($data['document'])
                : null,
            live_photo: isset($data['live_photo'])
                ? LivePhoto::makeByArray($data['live_photo'])
                : null,
            location: isset($data['location'])
                ? Location::makeByArray($data['location'])
                : null,
            photo: isset($data['photo'])
                ? array_map(
                    static fn(array $photo_data) => PhotoSize::makeByArray($photo_data),
                    $data['photo'],
                )
                : null,
            sticker: isset($data['sticker'])
                ? Sticker::makeByArray($data['sticker'])
                : null,
            venue: isset($data['venue'])
                ? Venue::makeByArray($data['venue'])
                : null,
            video: isset($data['video'])
                ? Video::makeByArray($data['video'])
                : null,
        );
    }

    public function getRequestData(): array
    {
        return [
            'animation' => $this->animation,
            'audio' => $this->audio,
            'document' => $this->document,
            'live_photo' => $this->live_photo,
            'location' => $this->location,
            'photo' => $this->photo,
            'sticker' => $this->sticker,
            'venue' => $this->venue,
            'video' => $this->video,
        ];
    }
}





