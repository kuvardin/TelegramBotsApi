<?php

declare(strict_types=1);

namespace Kuvardin\TelegramBotsApi\Types\BackgroundType;

use Kuvardin\TelegramBotsApi\Types\BackgroundType;
use Kuvardin\TelegramBotsApi\Types\Document;
use RuntimeException;

/**
 * The background is a wallpaper in the JPEG format.
 *
 * @package Kuvardin\TelegramBotsApi
 * @author Maxim Kuvardin <maxim@kuvard.in>
 */
class Wallpaper extends BackgroundType
{
    /**
     * @param Document $document Document with the wallpaper
     * @param int $dark_theme_dimming Dimming of the background in dark themes, as a percentage; 0-100
     * @param bool|null $is_blurred "True", if the wallpaper is downscaled to fit in a 450x450 square and then
     *     box-blurred with radius 12
     * @param bool|null $is_moving "True", if the background moves slightly when the device is tilted
     */
    public function __construct(
        public Document $document,
        public int $dark_theme_dimming,
        public ?bool $is_blurred = null,
        public ?bool $is_moving = null,
    )
    {

    }

    public static function getType(): string
    {
        return 'wallpaper';
    }

    public static function makeByArray(array $data): static
    {
        if ($data['type'] !== self::getType()) {
            throw new RuntimeException("Wrong chat theme type: {$data['type']}");
        }

        return new self(
            document: Document::makeByArray($data['document']),
            dark_theme_dimming: $data['dark_theme_dimming'],
            is_blurred: $data['is_blurred'] ?? null,
            is_moving: $data['is_moving'] ?? null,
        );
    }

    public function getRequestData(): array
    {
        return [
            'type' => self::getType(),
            'document' => $this->document,
            'dark_theme_dimming' => $this->dark_theme_dimming,
            'is_blurred' => $this->is_blurred,
            'is_moving' => $this->is_moving,
        ];
    }
}
