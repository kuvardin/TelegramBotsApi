<?php

declare(strict_types=1);

namespace Kuvardin\TelegramBotsApi\Types\BackgroundFill;

use Kuvardin\TelegramBotsApi\Types\BackgroundFill;
use RuntimeException;

/**
 * The background is filled using the selected color.
 *
 * @package Kuvardin\TelegramBotsApi
 * @author Maxim Kuvardin <maxim@kuvard.in>
 */
class Solid extends BackgroundFill
{
    /**
     * @param int $color The color of the background fill in the RGB24 format
     */
    public function __construct(
        public int $color,
    )
    {

    }

    public static function getType(): string
    {
        return 'solid';
    }

    public static function makeByArray(array $data): static
    {
        if ($data['type'] !== self::getType()) {
            throw new RuntimeException("Wrong background fill type: {$data['type']}");
        }

        return new self(
            color: $data['color'],
        );
    }

    public function getRequestData(): array
    {
        return [
            'type' => self::getType(),
            'color' => $this->color,
        ];
    }
}
