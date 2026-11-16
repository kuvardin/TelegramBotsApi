<?php

declare(strict_types=1);

namespace Kuvardin\TelegramBotsApi\Types;

use Kuvardin\TelegramBotsApi\Type;

/**
 * Represents a community (a group of chats).
 *
 * @package Kuvardin\TelegramBotsApi
 * @author Maxim Kuvardin <maxim@kuvard.in>
 */
class Community extends Type
{
    /**
     * @param int $id Unique identifier for this community. This number may have more than 32 significant bits and some
     *     programming languages may have difficulty/silent defects in interpreting it. But it has at most 52
     *     significant bits, so a signed 64-bit integer or double-precision float type are safe for storing this
     *     identifier.
     * @param string $name Name of the community
     */
    public function __construct(
        public int $id,
        public string $name,
    )
    {

    }

    public static function makeByArray(array $data): self
    {
        return new self(
            id: $data['id'],
            name: $data['name'],
        );
    }

    public function getRequestData(): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
        ];
    }
}
