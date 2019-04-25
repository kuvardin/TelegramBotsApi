<?php

namespace TelegramBotsApi\Types;

use \TelegramBotsApi;
use \TelegramBotsApi\Exceptions\Error;

/**
 * Instance of this class describes the position on faces where a mask should be placed by default.
 * @package TelegramBotsApi\Types
 * @author Maxim Kuvardin <kuvard.in@mail.ru>
 */
class MaskPosition implements TypeInterface
{
    public const POINT_FOREHEAD = 'forehead';
    public const POINT_EYES = 'eyes';
    public const POINT_MOUNT = 'mouth';
    public const POINT_CHIN = 'chin';

    /**
     * @var string The part of the face relative to which the mask should be placed. One of self::POINT_* constants
     */
    public $point;

    /**
     * @var float Shift by X-axis measured in widths of the mask scaled to the face size, from left to right. For example, choosing -1.0 will place mask just to the left of the default mask position.
     */
    public $x_shift;

    /**
     * @var float Shift by Y-axis measured in heights of the mask scaled to the face size, from top to bottom. For example, 1.0 will place the mask just below the default mask position.
     */
    public $y_shift;

    /**
     * @var float Mask scaling coefficient. For example, 2.0 means double size.
     */
    public $scale;

    /**
     * MaskPosition constructor.
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
     * @param string $point
     * @return MaskPosition
     * @throws Error
     */
    private function setPoint(string $point): self
    {
        switch ($point) {
            case self::POINT_FOREHEAD:
            case self::POINT_EYES:
            case self::POINT_MOUNT:
            case self::POINT_CHIN:
                $this->point = $point;
                break;
            default:
                throw new Error("Unknown point: {$point}");
        }
        return $this;
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

    /**
     * @param string $point
     * @param float $x_shift
     * @param float $y_shift
     * @param float $scale
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
}