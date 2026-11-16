<?php

declare(strict_types=1);

namespace Kuvardin\TelegramBotsApi\Enums;

enum SubscriptionState: string
{
    case Canceled = 'pending';
    case Active = 'active';
    case Declined = 'declined';
}