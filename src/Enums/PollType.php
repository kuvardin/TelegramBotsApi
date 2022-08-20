<?php

declare(strict_types=1);

namespace Kuvardin\TelegramBotsApi\Enums;

enum PollType: string
{
    case Quiz = 'quiz';
    case Regular = 'regular';
}