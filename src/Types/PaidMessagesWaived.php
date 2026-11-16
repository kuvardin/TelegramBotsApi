<?php

declare(strict_types=1);

namespace Kuvardin\TelegramBotsApi\Types;

use Kuvardin\TelegramBotsApi\Type;

/**
 * Describes a service message about the sender of the message using a link of the other user, which allows sending
 * messages to the user without paying Telegram Stars. Currently holds no information.
 *
 * @package Kuvardin\TelegramBotsApi
 * @author Maxim Kuvardin <maxim@kuvard.in>
 */
class PaidMessagesWaived extends Type
{
    public function __construct(

    )
    {

    }

    public static function makeByArray(array $data): self
    {
        return new self(

        );
    }

    public function getRequestData(): array
    {
        return [

        ];
    }
}

