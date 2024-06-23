<?php

declare(strict_types=1);

namespace Kuvardin\TelegramBotsApi\Types\BackgroundFill;

use Kuvardin\TelegramBotsApi\Types\BackgroundFill;
use RuntimeException;

/**
 * The background is a gradient fill.
 *
 * @package Kuvardin\TelegramBotsApi
 * @author Maxim Kuvardin <maxim@kuvard.in>
 */
class Gradient extends BackgroundFill
{
    /**
     * @param int $top_color Top color of the gradient in the RGB24 format
     * @param int $bottom_color Bottom color of the gradient in the RGB24 format
     * @param int $rotation_angle Clockwise rotation angle of the background fill in degrees; 0-359
     */
    public function __construct(
        public int $top_color,
        public int $bottom_color,
        public int $rotation_angle,
    )
    {

    }

    public static function getType(): string
    {
        return 'gradient';
    }

    public static function makeByArray(array $data): static
    {
        if ($data['type'] !== self::getType()) {
            throw new RuntimeException("Wrong background fill type: {$data['type']}");
        }

        return new self(
            top_color: $data['top_color'],
            bottom_color: $data['bottom_color'],
            rotation_angle: $data['rotation_angle'],
        );
    }

    public function getRequestData(): array
    {
        return [
            'type' => self::getType(),
            'top_color' => $this->top_color,
            'bottom_color' => $this->bottom_color,
            'rotation_angle' => $this->rotation_angle,
        ];
    }
}
