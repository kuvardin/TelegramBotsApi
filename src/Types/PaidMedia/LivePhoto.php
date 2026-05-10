<?php

declare(strict_types=1);

namespace Kuvardin\TelegramBotsApi\Types\PaidMedia;

use Kuvardin\TelegramBotsApi\Types\PaidMedia;
use Kuvardin\TelegramBotsApi\Types\LivePhoto as LivePhotoType;
use RuntimeException;

/**
 * The paid media is a live photo.
 *
 * @package Kuvardin\TelegramBotsApi
 * @author Maxim Kuvardin <maxim@kuvard.in>
 */
class LivePhoto extends PaidMedia
{
    /**
     * @param LivePhotoType $live_photo The photo
     */
    public function __construct(
        public LivePhotoType $live_photo,
    )
    {

    }

    public static function getType(): string
    {
        return 'live_photo';
    }

    public static function makeByArray(array $data): static
    {
        if ($data['type'] !== self::getType()) {
            throw new RuntimeException("Wrong paid media type: {$data['type']}");
        }

        return new self(
            live_photo: LivePhotoType::makeByArray($data['live_photo']),
        );
    }

    public function getRequestData(): array
    {
        return [
            'type' => self::getType(),
            'live_photo' => $this->live_photo,
        ];
    }
}





