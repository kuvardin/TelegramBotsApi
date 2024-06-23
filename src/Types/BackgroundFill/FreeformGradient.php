<?php

declare(strict_types=1);

namespace Kuvardin\TelegramBotsApi\Types\BackgroundFill;

use Kuvardin\TelegramBotsApi\Types\BackgroundFill;
use RuntimeException;

/**
 * The background is a freeform gradient that rotates after every message in the chat.
 *
 * @package Kuvardin\TelegramBotsApi
 * @author Maxim Kuvardin <maxim@kuvard.in>
 */
class FreeformGradient extends BackgroundFill
{
    /**
     * @param int[] $colors A list of the 3 or 4 base colors that are used to generate the freeform gradient in the
     *     RGB24 format
     */
    public function __construct(
        public array $colors,
    )
    {

    }

    public static function getType(): string
    {
        return 'freeform_gradient';
    }

    public static function makeByArray(array $data): static
    {
        if ($data['type'] !== self::getType()) {
            throw new RuntimeException("Wrong background fill type: {$data['type']}");
        }

        return new self(
            colors: $data['colors'],
        );
    }

    public function getRequestData(): array
    {
        return [
            'type' => self::getType(),
            'colors' => $this->colors,
        ];
    }
}
