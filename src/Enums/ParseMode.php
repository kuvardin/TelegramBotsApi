<?php

declare(strict_types=1);

namespace Kuvardin\TelegramBotsApi\Enums;

enum ParseMode: string
{
    case HTML = 'HTML';
    case Markdown = 'Markdown';
    case MarkdownV2 = 'MarkdownV2';
}