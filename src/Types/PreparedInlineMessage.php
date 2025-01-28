<?php

declare(strict_types=1);

namespace Kuvardin\TelegramBotsApi\Types;

use Kuvardin\TelegramBotsApi\Type;

/**
 * Describes an inline message to be sent by a user of a Mini App.
 *
 * @package Kuvardin\TelegramBotsApi
 * @author Maxim Kuvardin <maxim@kuvard.in>
 */
class PreparedInlineMessage extends Type
{
    /**
     * @param string $id Unique identifier of the prepared message
     * @param int $expiration_date Expiration date of the prepared message, in Unix time. Expired prepared messages can
     *     no longer be used
     */
    public function __construct(
        public string $id,
        public int $expiration_date,
    )
    {

    }

    public static function makeByArray(array $data): self
    {
        return new self(
            id: $data['id'],
            expiration_date: $data['expiration_date'],
        );
    }

    public function getRequestData(): array
    {
        return [
            'id' => $this->id,
            'expiration_date' => $this->expiration_date,
        ];
    }
}
