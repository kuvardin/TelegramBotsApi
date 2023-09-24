<?php

declare(strict_types=1);

namespace Kuvardin\TelegramBotsApi\Types;

use Kuvardin\TelegramBotsApi\Type;

/**
 * This object represents a message about a forwarded story in the chat. Currently holds no information.
 *
 * @package Kuvardin\TelegramBotsApi
 * @author Maxim Kuvardin <maxim@kuvard.in>
 */
class Story extends Type
{
    /**
     */
    public function __construct(
    )
    {

    }

    public static function makeByArray(array $data): self
    {
        $result = new self(
        );

        return $result;
    }

    public function getRequestData(): array
    {
        return [
        ];
    }
}
