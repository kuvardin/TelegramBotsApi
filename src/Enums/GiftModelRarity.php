<?php

declare(strict_types=1);

namespace Kuvardin\TelegramBotsApi\Enums;

enum GiftModelRarity: string
{
    case Uncommon = 'uncommon';
    case Rare = 'rare';
    case Epic = 'epic';
    case Legendary = 'legendary';
}