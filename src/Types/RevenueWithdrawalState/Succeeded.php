<?php

declare(strict_types=1);

namespace Kuvardin\TelegramBotsApi\Types\RevenueWithdrawalState;

use Kuvardin\TelegramBotsApi\Types\RevenueWithdrawalState;
use RuntimeException;

/**
 * The withdrawal succeeded.
 *
 * @package Kuvardin\TelegramBotsApi
 * @author Maxim Kuvardin <maxim@kuvard.in>
 */
class Succeeded extends RevenueWithdrawalState
{
    /**
     * @param int $date Date the withdrawal was completed in Unix time
     * @param string $url An HTTPS URL that can be used to see transaction details
     */
    public function __construct(
        public int $date,
        public string $url,
    )
    {

    }

    public static function getType(): string
    {
        return 'succeeded';
    }

    public static function makeByArray(array $data): static
    {
        if ($data['type'] !== self::getType()) {
            throw new RuntimeException("Wrong revenue withdrawal state type: {$data['type']}");
        }

        return new self(
            date: $data['date'],
            url: $data['url'],
        );
    }

    public function getRequestData(): array
    {
        return [
            'type' => self::getType(),
            'date' => $this->date,
            'url' => $this->url,
        ];
    }
}
