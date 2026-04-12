<?php

declare(strict_types=1);

namespace Kuvardin\TelegramBotsApi\Types;

use Kuvardin\TelegramBotsApi\Type;

/**
 * Contains the list of gifts received and owned by a user or a chat.
 *
 * @package Kuvardin\TelegramBotsApi
 * @author Maxim Kuvardin <maxim@kuvard.in>
 */
class OwnedGifts extends Type
{
    /**
     * @param int $total_count The total number of gifts owned by the user or the chat
     * @param OwnedGift[] $gifts The list of gifts
     * @param string|null $next_offset Offset for the next request. If empty, then there are no more results
     */
    public function __construct(
        public int $total_count,
        public array $gifts,
        public ?string $next_offset = null,
    )
    {

    }

    public static function makeByArray(array $data): self
    {
        return new self(
            total_count: $data['total_count'],
            gifts: array_map(
                static fn(array $gift_data) => OwnedGift::makeByArray($gift_data),
                $data['gifts'],
            ),
            next_offset: $data['next_offset'] ?? null,
        );
    }

    public function getRequestData(): array
    {
        return [
            'total_count' => $this->total_count,
            'gifts' => $this->gifts,
            'next_offset' => $this->next_offset,
        ];
    }
}
