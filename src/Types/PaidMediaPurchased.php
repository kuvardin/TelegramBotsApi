<?php

declare(strict_types=1);

namespace Kuvardin\TelegramBotsApi\Types;

use Kuvardin\TelegramBotsApi\Type;

/**
 * This object contains information about a paid media purchase.
 *
 * @package Kuvardin\TelegramBotsApi
 * @author Maxim Kuvardin <maxim@kuvard.in>
 */
class PaidMediaPurchased extends Type
{
    /**
     * @param User $from User who purchased the media
     * @param string $paid_media_payload Bot-specified paid media payload
     */
    public function __construct(
        public User $from,
        public string $paid_media_payload,
    )
    {

    }

    public static function makeByArray(array $data): self
    {
        return new self(
            from: User::makeByArray($data['from']),
            paid_media_payload: $data['paid_media_payload'],
        );
    }

    public function getRequestData(): array
    {
        return [
            'from' => $this->from,
            'paid_media_payload' => $this->paid_media_payload,
        ];
    }
}
