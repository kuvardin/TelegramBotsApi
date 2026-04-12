<?php

declare(strict_types=1);

namespace Kuvardin\TelegramBotsApi\Types;

use Kuvardin\TelegramBotsApi\Type;

/**
 * This object describes the background of a gift.
 *
 * @package Kuvardin\TelegramBotsApi
 * @author Maxim Kuvardin <maxim@kuvard.in>
 */
class GiftBackground extends Type
{
    /**
     * @param int $center_color Center color of the background in RGB format
     * @param int $edge_color Edge color of the background in RGB format
     * @param int $text_color Text color of the background in RGB format
     */
    public function __construct(
        public int $center_color,
        public int $edge_color,
        public int $text_color,
    )
    {

    }

    public static function makeByArray(array $data): self
    {
        return new self(
            center_color: $data['center_color'],
            edge_color: $data['edge_color'],
            text_color: $data['text_color'],
        );
    }

    public function getRequestData(): array
    {
        return [
            'center_color' => $this->center_color,
            'edge_color' => $this->edge_color,
            'text_color' => $this->text_color,
        ];
    }
}
