<?php

declare(strict_types=1);

namespace Kuvardin\TelegramBotsApi\Types;

use Kuvardin\TelegramBotsApi\Type;

/**
 * This object describes the position on faces where a mask should be placed by default.
 *
 * @package Kuvardin\TelegramBotsApi
 * @author Maxim Kuvardin <maxim@kuvard.in>
 */
class MaskPosition extends Type
{
    /**
     * @var string $point The part of the face relative to which the mask should be placed. One of “forehead”, “eyes”,
     *     “mouth”, or “chin”.
     */
    public string $point;

    /**
     * @var float $x_shift Shift by X-axis measured in widths of the mask scaled to the face size, from left to right.
     *     For example, choosing -1.0 will place mask just to the left of the default mask position.
     */
    public float $x_shift;

    /**
     * @var float $y_shift Shift by Y-axis measured in heights of the mask scaled to the face size, from top to bottom.
     *     For example, 1.0 will place the mask just below the default mask position.
     */
    public float $y_shift;

    /**
     * @var float $scale Mask scaling coefficient. For example, 2.0 means double size.
     */
    public float $scale;

    public static function makeByArray(array $data): self
    {
        $result = new self;
        $result->point = $data['point'];
        $result->x_shift = $data['x_shift'];
        $result->y_shift = $data['y_shift'];
        $result->scale = $data['scale'];
        return $result;
    }

    public function getRequestData(): array
    {
        return [
            'point' => $this->point,
            'x_shift' => $this->x_shift,
            'y_shift' => $this->y_shift,
            'scale' => $this->scale,
        ];
    }
}
