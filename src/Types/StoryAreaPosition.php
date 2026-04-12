<?php

declare(strict_types=1);

namespace Kuvardin\TelegramBotsApi\Types;

use Kuvardin\TelegramBotsApi\Type;

/**
 * Describes the position of a clickable area within a story.
 *
 * @package Kuvardin\TelegramBotsApi
 * @author Maxim Kuvardin <maxim@kuvard.in>
 */
class StoryAreaPosition extends Type
{
    /**
     * @param float $x_percentage The abscissa of the area's center, as a percentage of the media width
     * @param float $y_percentage The ordinate of the area's center, as a percentage of the media height
     * @param float $width_percentage The width of the area's rectangle, as a percentage of the media width
     * @param float $height_percentage The height of the area's rectangle, as a percentage of the media height
     * @param float $rotation_angle The clockwise rotation angle of the rectangle, in degrees; 0-360
     * @param float $corner_radius_percentage The radius of the rectangle corner rounding, as a percentage of the media
     *     width
     */
    public function __construct(
        public float $x_percentage,
        public float $y_percentage,
        public float $width_percentage,
        public float $height_percentage,
        public float $rotation_angle,
        public float $corner_radius_percentage,
    )
    {

    }

    public static function makeByArray(array $data): self
    {
        return new self(
            x_percentage: $data['x_percentage'],
            y_percentage: $data['y_percentage'],
            width_percentage: $data['width_percentage'],
            height_percentage: $data['height_percentage'],
            rotation_angle: $data['rotation_angle'],
            corner_radius_percentage: $data['corner_radius_percentage'],
        );
    }

    public function getRequestData(): array
    {
        return [
            'x_percentage' => $this->x_percentage,
            'y_percentage' => $this->y_percentage,
            'width_percentage' => $this->width_percentage,
            'height_percentage' => $this->height_percentage,
            'rotation_angle' => $this->rotation_angle,
            'corner_radius_percentage' => $this->corner_radius_percentage,
        ];
    }
}
