<?php

declare(strict_types=1);

namespace Kuvardin\TelegramBotsApi\Types\BackgroundType;

use Kuvardin\TelegramBotsApi\Types\BackgroundFill;
use Kuvardin\TelegramBotsApi\Types\BackgroundType;
use RuntimeException;

/**
 * The background is automatically filled based on the selected colors.
 *
 * @package Kuvardin\TelegramBotsApi
 * @author Maxim Kuvardin <maxim@kuvard.in>
 */
class Fill extends BackgroundType
{
    /**
     * @param BackgroundFill $fill The background fill
     * @param int $dark_theme_dimming Dimming of the background in dark themes, as a percentage; 0-100
     */
    public function __construct(
        public BackgroundFill $fill,
        public int $dark_theme_dimming,
    )
    {

    }

    public static function getType(): string
    {
        return 'fill';
    }

    public static function makeByArray(array $data): static
    {
        if ($data['type'] !== self::getType()) {
            throw new RuntimeException("Wrong chat theme type: {$data['type']}");
        }

        return new self(
            fill: BackgroundFill::makeByArray($data['fill']),
            dark_theme_dimming: $data['dark_theme_dimming'],
        );
    }

    public function getRequestData(): array
    {
        return [
            'type' => self::getType(),
            'fill' => $this->fill,
            'dark_theme_dimming' => $this->dark_theme_dimming,
        ];
    }
}
