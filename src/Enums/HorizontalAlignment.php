<?php

declare(strict_types=1);

namespace Kuvardin\TelegramBotsApi\Enums;

/**
 * @package Kuvardin\TelegramBotsApi
 * @author Maxim Kuvardin <maxim@kuvard.in>
 */
enum HorizontalAlignment: string
{
    case Left = 'left';
    case Center = 'center';
    case Right = 'right';
}