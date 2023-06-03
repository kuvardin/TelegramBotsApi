<?php

declare(strict_types=1);

namespace Kuvardin\TelegramBotsApi\Enums;

/**
 * @package Kuvardin\TelegramBotsApi
 * @author Maxim Kuvardin <maxim@kuvard.in>
 */
enum StickerFormat: string
{
    case Static = 'static';
    case Animated = 'animated';
    case Video = 'video';
}