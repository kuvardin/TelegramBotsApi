<?php

declare(strict_types=1);

namespace Kuvardin\TelegramBotsApi\Types\PaidMedia;

use Kuvardin\TelegramBotsApi\Types\PaidMedia;
use Kuvardin\TelegramBotsApi\Types\PhotoSize;
use RuntimeException;

/**
 * The paid media is a photo.
 *
 * @package Kuvardin\TelegramBotsApi
 * @author Maxim Kuvardin <maxim@kuvard.in>
 */
class Photo extends PaidMedia
{
    /**
     * @param PhotoSize[] $photo The photo
     */
    public function __construct(
        public array $photo,
    )
    {

    }

    public static function getType(): string
    {
        return 'photo';
    }

    public static function makeByArray(array $data): static
    {
        if ($data['type'] !== self::getType()) {
            throw new RuntimeException("Wrong paid media type: {$data['type']}");
        }

        return new self(
            photo: array_map(
                static fn(array $photo_data) => PhotoSize::makeByArray($photo_data),
                $data['photo'],
            ),
        );
    }

    public function getRequestData(): array
    {
        return [
            'type' => self::getType(),
            'photo' => $this->photo,
        ];
    }
}
