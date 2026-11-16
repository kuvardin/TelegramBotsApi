<?php

declare(strict_types=1);

namespace Kuvardin\TelegramBotsApi\Types;

use Kuvardin\TelegramBotsApi\Type;

/**
 * This object represents a disabled button which does nothing. Currently holds no information.
 *
 * @package Kuvardin\TelegramBotsApi
 * @author Maxim Kuvardin <maxim@kuvard.in>
 */
class DisabledButton extends Type
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





