<?php

declare(strict_types=1);

namespace Kuvardin\TelegramBotsApi\Types;

use Kuvardin\TelegramBotsApi\Type;

/**
 * This object represents a service message about General forum topic unhidden in the chat.
 * Currently holds no information.
 *
 * @package Kuvardin\TelegramBotsApi
 * @author Maxim Kuvardin <maxim@kuvard.in>
 */
class GeneralForumTopicUnhidden extends Type
{
    public function __construct()
    {

    }

    public static function makeByArray(array $data): self
    {
        return new self();
    }

    public function getRequestData(): array
    {
        return [

        ];
    }
}
