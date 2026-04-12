<?php

declare(strict_types=1);

namespace Kuvardin\TelegramBotsApi\Types;

use Kuvardin\TelegramBotsApi\Type;

/**
 * This object represents a service message about the creation of a scheduled giveaway.
 *
 * @package Kuvardin\TelegramBotsApi
 * @author Maxim Kuvardin <maxim@kuvard.in>
 */
class GiveawayCreated extends Type
{
    /**
     * @param int|null $prize_star_count The number of Telegram Stars to be split between giveaway winners; for
     *     Telegram Star giveaways only
     */
    public function __construct(
        public ?int $prize_star_count = null,
    )
    {

    }

    public static function makeByArray(array $data): self
    {
        return new self(
            prize_star_count: $data['prize_star_count'] ?? null,
        );
    }

    public function getRequestData(): array
    {
        return [
            'prize_star_count' => $this->prize_star_count,
        ];
    }
}
