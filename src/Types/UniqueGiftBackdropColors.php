<?php

declare(strict_types=1);

namespace Kuvardin\TelegramBotsApi\Types;

use Kuvardin\TelegramBotsApi\Type;

/**
 * This object describes the colors of the backdrop of a unique gift.
 *
 * @package Kuvardin\TelegramBotsApi
 * @author Maxim Kuvardin <maxim@kuvard.in>
 */
class UniqueGiftBackdropColors extends Type
{
    /**
     * @param int $center_color The color in the center of the backdrop in RGB format
     * @param int $edge_color The color on the edges of the backdrop in RGB format
     * @param int $symbol_color The color to be applied to the symbol in RGB format
     * @param int $text_color The color for the text on the backdrop in RGB format
     */
    public function __construct(
        public int $center_color,
        public int $edge_color,
        public int $symbol_color,
        public int $text_color,
    )
    {

    }

    public static function makeByArray(array $data): self
    {
        return new self(
            center_color: $data['center_color'],
            edge_color: $data['edge_color'],
            symbol_color: $data['symbol_color'],
            text_color: $data['text_color'],
        );
    }

    public function getRequestData(): array
    {
        return [
            'center_color' => $this->center_color,
            'edge_color' => $this->edge_color,
            'symbol_color' => $this->symbol_color,
            'text_color' => $this->text_color,
        ];
    }
}
