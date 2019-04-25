<?php

namespace TelegramBotsApi\Types;

use \TelegramBotsApi;
use \TelegramBotsApi\Exceptions\Error;

/**
 * Instance of this object represent a user's profile pictures
 * @package TelegramBotsApi\Types
 * @author Maxim Kuvardin <kuvard.in@mail.ru>
 */
class UserProfilePhotos implements TypeInterface
{
    /**
     * @var int Total number of profile pictures the target user has
     */
    public $total_count;

    /**
     * @var PhotoSize[][] Requested profile pictures (in up to 4 sizes each)
     */
    public $photos;

    /**
     * UserProfilePhotos constructor.
     * @param array $data
     */
    public function __construct(array $data)
    {
        $this->total_count = $data['total_count'];
        $this->photos = [];

        foreach ($data['photos'] as $photos) {
            $photos_items = [];
            foreach ($photos as $photo_size) {
                $photos_items[] = $photo_size instanceof PhotoSize ? $photo_size : new PhotoSize($photo_size);
            }
            $this->photos[] = $photos_items;
        }
    }

    /**
     * @return array
     */
    public function getRequestArray(): array
    {
        return [
            'total_count' => $this->total_count,
            'photos' => $this->photos,
        ];
    }

    /**
     * @param int $total_count
     * @param array $photos
     * @return UserProfilePhotos
     */
    public static function make(int $total_count, array $photos): self
    {
        return new self([
            'total_count' => $total_count,
            'photos' => $photos,
        ]);
    }
}