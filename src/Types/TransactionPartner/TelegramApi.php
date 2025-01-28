<?php

declare(strict_types=1);

namespace Kuvardin\TelegramBotsApi\Types\TransactionPartner;

use Kuvardin\TelegramBotsApi\Types\TransactionPartner;
use RuntimeException;

/**
 * Describes a transaction with payment for paid broadcasting.
 *
 * @package Kuvardin\TelegramBotsApi
 * @author Maxim Kuvardin <maxim@kuvard.in>
 */
class TelegramApi extends TransactionPartner
{
    /**
     * @param int $request_count The number of successful requests that exceeded regular limits and were therefore
     *     billed
     */
    public function __construct(
        public int $request_count,
    )
    {

    }

    public static function getType(): string
    {
        return 'telegram_api';
    }


    public static function makeByArray(array $data): static
    {
        if ($data['type'] !== self::getType()) {
            throw new RuntimeException("Wrong transaction partner type: {$data['type']}");
        }

        return new self(
            request_count: $data['request_count'],
        );
    }

    public function getRequestData(): array
    {
        return [
            'type' => self::getType(),
            'request_count' => $this->request_count,
        ];
    }
}
