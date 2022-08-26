<?php

declare(strict_types=1);

namespace Kuvardin\TelegramBotsApi\Types;

use Kuvardin\TelegramBotsApi\Type;

/**
 * Represents a location to which a chat is connected.
 *
 * @package Kuvardin\TelegramBotsApi
 * @author Maxim Kuvardin <maxim@kuvard.in>
 */
class ChatLocation extends Type
{
    /**
     * @param Location $location The location to which the supergroup is connected. Can't be a live location.
     * @param string $address Location address; 1-64 characters, as defined by the chat owner
     */
    public function __construct(
        public Location $location,
        public string $address,
    )
    {

    }

    public static function makeByArray(array $data): self
    {
        return new self(
            location: Location::makeByArray($data['location']),
            address: $data['address'],
        );
    }

    public function getRequestData(): array
    {
        return [
            'location' => $this->location,
            'address' => $this->address,
        ];
    }
}
