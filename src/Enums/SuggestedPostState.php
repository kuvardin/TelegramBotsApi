<?php

declare(strict_types=1);

namespace Kuvardin\TelegramBotsApi\Enums;

enum SuggestedPostState: string
{
    case Pending = 'pending';
    case Approved = 'approved';
    case Declined = 'declined';
}