<?php

declare(strict_types=1);

namespace Kuvardin\TelegramBotsApi\Types;

use Kuvardin\TelegramBotsApi\Type;

/**
 * Contains information about the location of a Telegram Business account.
 *
 * @package Kuvardin\TelegramBotsApi
 * @author Maxim Kuvardin <maxim@kuvard.in>
 */
class BusinessLocation extends Type
{
    /**
     * @param string $address Address of the business
     * @param Location|null $location Location of the business
     */
    public function __construct(
        public string $address,
        public ?Location $location = null,
    )
    {

    }

    public static function makeByArray(array $data): self
    {
        return new self(
            address: $data['address'],
            location: isset($data['location'])
                ? Location::makeByArray($data['location'])
                : null,
        );
    }

    public function getRequestData(): array
    {
        return [
            'address' => $this->address,
            'location' => $this->location,
        ];
    }
}
