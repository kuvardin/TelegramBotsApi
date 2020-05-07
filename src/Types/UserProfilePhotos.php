<?php

declare(strict_types=1);

namespace TelegramBotsApi\Types;

use TelegramBotsApi;

/**
 * This object represent a user's profile pictures.
 *
 * @package TelegramBotsApi
 * @author Maxim Kuvardin <maxim@kuvard.in>
 */
class UserProfilePhotos implements TypeInterface
{
    /**
     * @var int Total number of profile pictures the target user has
     */
    public int $total_count;

    /**
     * @var PhotoSize[][] Requested profile pictures (in up to 4 sizes each)
     */
    public array $photos = [];

    /**
     * UserProfilePhotos constructor.
     *
     * @param array $data
     */
    public function __construct(array $data)
    {
        $this->total_count = $data['total_count'];

        foreach ($data['photos'] as $photo_sizes) {
            $photos = [];
            foreach ($photo_sizes as $photo_size) {
                $photos[] = $photo_size instanceof PhotoSize ? $photo_size : new PhotoSize($photo_size);
            }
            $this->photos[] = $photos;
        }
    }

    /**
     * @param int $total_count Total number of profile pictures the target user has
     * @param PhotoSize[][] $photos Requested profile pictures (in up to 4 sizes each)
     * @return UserProfilePhotos
     */
    public static function make(int $total_count, array $photos): self
    {
        return new self([
            'total_count' => $total_count,
            'photos' => $photos,
        ]);
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
}
