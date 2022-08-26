<?php

declare(strict_types=1);

namespace Kuvardin\TelegramBotsApi\Enums;

/**
 * @package Kuvardin\TelegramBotsApi
 * @author Maxim Kuvardin <maxim@kuvard.in>
 */
enum MessageEntityType: string
{
    /** @username */
    case Mention = 'mention';

    /** #hashtag */
    case Hashtag = 'hashtag';

    /** $USD */
    case Cashtag = 'cashtag';

    /** /start@jobs_bot */
    case BotCommand = 'bot_command';

    /** https://telegram.org */
    case Url = 'url';

    /** do-not-reply@telegram.org */
    case Email = 'email';

    /** +1-212-555-0123 */
    case PhoneNumber = 'phone_number';

    /** <strong>bold text</strong> */
    case Bold = 'bold';

    /** <em>italic text</em> */
    case Italic = 'italic';

    /** underlined text */
    case Underline = 'underline';

    /** strikethrough text */
    case Strikethrough = 'strikethrough';

    /** spoiler message */
    case Spoiler = 'spoiler';

    /** monowidth string */
    case Code = 'code';

    /** monowidth block */
    case Pre = 'pre';

    /** for clickable text URLs */
    case Text_link = 'text_link';

    /** for users <a href="https://telegram.org/blog/edit#new-mentions">without usernames</a> */
    case Text_mention = 'text_mention';
}