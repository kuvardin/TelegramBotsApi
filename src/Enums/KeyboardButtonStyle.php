<?php

declare(strict_types=1);

namespace Kuvardin\TelegramBotsApi\Enums;

enum KeyboardButtonStyle: string
{
    case Danger = 'danger';
    case Success = 'success';
    case Primary = 'primary';
}