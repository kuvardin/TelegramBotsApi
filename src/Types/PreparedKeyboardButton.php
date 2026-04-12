<?php

declare(strict_types=1);

namespace Kuvardin\TelegramBotsApi\Types;

use Kuvardin\TelegramBotsApi\Type;

/**
 * Describes a keyboard button to be used by a user of a Mini App.
 *
 * @package Kuvardin\TelegramBotsApi
 * @author Maxim Kuvardin <maxim@kuvard.in>
 */
class PreparedKeyboardButton extends Type
{
    /**
     * @param string $id Unique identifier of the keyboard button
     */
    public function __construct(
        public string $id,
    )
    {

    }

    public static function makeByArray(array $data): self
    {
        return new self(
            id: $data['id'],
        );
    }

    public function getRequestData(): array
    {
        return [
            'id' => $this->id,
        ];
    }
}
