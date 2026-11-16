<?php

declare(strict_types=1);

namespace Kuvardin\TelegramBotsApi\Types;

use Kuvardin\TelegramBotsApi\Type;

/**
 * Describes a service message about a chat or a bot being removed from a community. Currently holds no information.
 *
 * @package Kuvardin\TelegramBotsApi
 * @author Maxim Kuvardin <maxim@kuvard.in>
 */
class CommunityChatRemoved extends Type
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

