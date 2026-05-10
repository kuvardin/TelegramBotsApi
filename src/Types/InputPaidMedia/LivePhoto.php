<?php

declare(strict_types=1);

namespace Kuvardin\TelegramBotsApi\Types\InputPaidMedia;

use Kuvardin\TelegramBotsApi\Types\InputFile;
use Kuvardin\TelegramBotsApi\Types\InputPaidMedia;
use RuntimeException;

/**
 * The paid media to send is a live photo.
 *
 * @package Kuvardin\TelegramBotsApi
 * @author Maxim Kuvardin <maxim@kuvard.in>
 */
class LivePhoto extends InputPaidMedia
{
    /**
     * @param InputFile|string $media Video of the live photo to send. Sending live photos by a URL is currently
     *     unsupported.
     * @param InputFile|string $photo The static photo to send. Sending live photos by a URL is currently unsupported.
     */
    public function __construct(
        public InputFile|string $media,
        public InputFile|string $photo,
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
            throw new RuntimeException("Wrong input paid media type: {$data['type']}");
        }

        return new self(
            media: $data['media'],
            photo: $data['photo'],
        );
    }

    public function getRequestData(): array
    {
        return [
            'type' => self::getType(),
            'media' => $this->media,
            'photo' => $this->photo,
        ];
    }
}





