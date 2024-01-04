<?php

declare(strict_types=1);

namespace Kuvardin\TelegramBotsApi\Types;

use Kuvardin\TelegramBotsApi\Type;

/**
 * Represents a reaction added to a message along with the number of times it was added.
 *
 * @package Kuvardin\TelegramBotsApi
 * @author Maxim Kuvardin <maxim@kuvard.in>
 */
class ReactionCount extends Type
{
    /**
     * @param ReactionType $type Type of the reaction
     * @param int $total_count Number of times the reaction was added
     */
    public function __construct(
        public ReactionType $type,
        public int $total_count,
    )
    {

    }

    public static function makeByArray(array $data): self
    {
        return new self(
            type: ReactionType::makeByArray($data['type']),
            total_count: $data['total_count'],
        );
    }

    public function getRequestData(): array
    {
        return [
            'type' => $this->type,
            'total_count' => $this->total_count,
        ];
    }
}
