<?php

declare(strict_types=1);

namespace Kuvardin\TelegramBotsApi\Types;

use Kuvardin\TelegramBotsApi\Type;

/**
 * This object represent a user&#39;s profile pictures.
 *
 * @package Kuvardin\TelegramBotsApi
 * @author Maxim Kuvardin <maxim@kuvard.in>
 */
class UserProfilePhotos extends Type
{
    /**
     * @param int $total_count Total number of profile pictures the target user has
     * @param PhotoSize[][] $photos Requested profile pictures (in up to 4 sizes each)
     */
    public function __construct(
        public int $total_count,
        public array $photos,
    )
    {

    }

    public static function makeByArray(array $data): self
    {
        $result = new self(
            total_count: $data['total_count'],
            photos: [],
        );

        foreach ($data['photos'] as $photo_sizes_data) {
            $photo_sizes = [];
            foreach ($photo_sizes_data as $photo_size_data) {
                $photo_sizes[] = PhotoSize::makeByArray($photo_size_data);
            }
            $result->photos[] = $photo_sizes;
        }
        return $result;
    }

    public function getRequestData(): array
    {
        return [
            'total_count' => $this->total_count,
            'photos' => $this->photos,
        ];
    }
}
