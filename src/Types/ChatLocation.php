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
     * @var Location $location The location to which the supergroup is connected. Can't be a live location.
     */
    public Location $location;

    /**
     * @var string $address Location address; 1-64 characters, as defined by the chat owner
     */
    public string $address;

    public static function makeByArray(array $data): self
    {
        $result = new self;
        $result->location = Location::makeByArray($data['location']);
        $result->address = $data['address'];
        return $result;
    }

    public function getRequestData(): array
    {
        return [
            'location' => $this->location,
            'address' => $this->address,
        ];
    }
}
