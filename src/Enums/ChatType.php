<?php

declare(strict_types=1);

namespace Kuvardin\TelegramBotsApi\Enums;

/**
 * @package Kuvardin\TelegramBotsApi
 * @author Maxim Kuvardin <maxim@kuvard.in>
 */
enum ChatType: string
{
    case Private = 'private';
    case Group = 'group';
    case Supergroup = 'supergroup';
    case Channel = 'channel';
}