<?php

declare(strict_types=1);

namespace Kuvardin\TelegramBotsApi\Enums;

enum ChatType: string
{
    case Private = 'private';
    case Group = 'group';
    case Supergroup = 'supergroup';
    case Channel = 'channel';
}