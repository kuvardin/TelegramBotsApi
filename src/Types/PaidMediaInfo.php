<?php

declare(strict_types=1);

namespace Kuvardin\TelegramBotsApi\Types;

use Kuvardin\TelegramBotsApi\Type;

/**
 * Describes the paid media added to a message.
 *
 * @package Kuvardin\TelegramBotsApi
 * @author Maxim Kuvardin <maxim@kuvard.in>
 */
class PaidMediaInfo extends Type
{
    /**
     * @param int $star_count The number of Telegram Stars that must be paid to buy access to the media
     * @param PaidMedia[] $paid_media Information about the paid media
     */
    public function __construct(
        public int $star_count,
        public array $paid_media,
    )
    {

    }

    public static function makeByArray(array $data): self
    {
        return new self(
            star_count: $data['star_count'],
            paid_media: array_map(
                static fn(array $paid_media_data) => PaidMedia::makeByArray($paid_media_data),
                $data['paid_media'],
            ),
        );
    }

    public function getRequestData(): array
    {
        return [
            'star_count' => $this->star_count,
            'paid_media' => $this->paid_media,
        ];
    }
}
