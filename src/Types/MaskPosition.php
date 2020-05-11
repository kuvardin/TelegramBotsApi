<?php

declare(strict_types=1);

namespace Kuvardin\TelegramBotsApi\Types;

use Kuvardin\TelegramBotsApi\Exceptions\Error;

/**
 * This object describes the position on faces where a mask should be placed by default.
 *
 * @package Kuvardin\TelegramBotsApi
 * @author Maxim Kuvardin <maxim@kuvard.in>
 */
class MaskPosition implements TypeInterface
{
    public const POINT_FOREHEAD = 'forehead';
    public const POINT_EYES = 'eyes';
    public const POINT_MOUNT = 'mouth';
    public const POINT_CHIN = 'chin';

    /**
     * @var float Shift by X-axis measured in widths of the mask scaled to the face size, from left to right.
     * For example, choosing -1.0 will place mask just to the left of the default mask position.
     */
    public float $x_shift;

    /**
     * @var float Shift by Y-axis measured in heights of the mask scaled to the face size, from top to bottom.
     * For example, 1.0 will place the mask just below the default mask position.
     */
    public float $y_shift;

    /**
     * @var float Mask scaling coefficient. For example, 2.0 means double size.
     */
    public float $scale;

    /**
     * @var string The part of the face relative to which the mask should be placed. One of self::POINT_*
     */
    protected string $point;

    /**
     * MaskPosition constructor.
     *
     * @param array $data
     * @throws Error
     */
    public function __construct(array $data)
    {
        $this->setPoint($data['point']);
        $this->x_shift = $data['x_shift'];
        $this->y_shift = $data['y_shift'];
        $this->scale = $data['scale'];
    }

    /**
     * @param string $point The part of the face relative to which the mask should be placed. One of self::POINT_*
     * @param float $x_shift Shift by X-axis measured in widths of the mask scaled to the face size, from left
     * to right. For example, choosing -1.0 will place mask just to the left of the default mask position.
     * @param float $y_shift Shift by Y-axis measured in heights of the mask scaled to the face size, from top
     * to bottom. For example, 1.0 will place the mask just below the default mask position.
     * @param float $scale Mask scaling coefficient. For example, 2.0 means double size.
     * @return MaskPosition
     * @throws Error
     */
    public static function make(string $point, float $x_shift, float $y_shift, float $scale): self
    {
        return new self([
            'point' => $point,
            'x_shift' => $x_shift,
            'y_shift' => $y_shift,
            'scale' => $scale,
        ]);
    }

    /**
     * @param string $point
     * @return bool
     */
    public static function checkPoint(string $point): bool
    {
        return $point === self::POINT_CHIN ||
            $point === self::POINT_EYES ||
            $point === self::POINT_FOREHEAD ||
            $point === self::POINT_MOUNT;
    }

    /**
     * @return string
     */
    public function getPoint(): string
    {
        return $this->point;
    }

    /**
     * @param string $point
     * @throws Error
     */
    public function setPoint(string $point): void
    {
        if (!self::checkPoint($point)) {
            throw new Error("Unknown point: $point");
        }
        $this->point = $point;
    }

    /**
     * @return array
     */
    public function getRequestArray(): array
    {
        return [
            'point' => $this->point,
            'x_shift' => $this->x_shift,
            'y_shift' => $this->y_shift,
            'scale' => $this->scale,
        ];
    }
}
