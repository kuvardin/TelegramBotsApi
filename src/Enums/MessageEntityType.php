<?php

declare(strict_types=1);

namespace Kuvardin\TelegramBotsApi\Enums;

/**
 * @package Kuvardin\TelegramBotsApi
 * @author Maxim Kuvardin <maxim@kuvard.in>
 */
enum MessageEntityType: string
{
    /** &#64;username */
    case Mention = 'mention';

    /** #hashtag or #hashtag&#64;chatusername */
    case Hashtag = 'hashtag';

    /** $USD or $USD&#64;chatusername */
    case Cashtag = 'cashtag';

    /** /start&#64;jobs_bot */
    case BotCommand = 'bot_command';

    /** https://telegram.org */
    case Url = 'url';

    /** do-not-reply&#64;telegram.org */
    case Email = 'email';

    /** +1-212-555-0123 */
    case PhoneNumber = 'phone_number';

    /** bank card number */
    case BankCardNumber = 'bank_card_number';

    /** address in the TON blockchain */
    case TonAddress = 'ton_address';

    /** <strong>bold text</strong> */
    case Bold = 'bold';

    /** italic text */
    case Italic = 'italic';

    /** underlined text */
    case Underline = 'underline';

    /** strikethrough text */
    case Strikethrough = 'strikethrough';

    /** spoiler message */
    case Spoiler = 'spoiler';

    /** block quotation */
    case Blockquote = 'blockquote';

    /** collapsed-by-default block quotation */
    case ExpandableBlockquote = 'expandable_blockquote';

    /** monowidth string */
    case Code = 'code';

    /** monowidth block */
    case Pre = 'pre';

    /** for clickable text URLs */
    case TextLink = 'text_link';

    /** for users without usernames */
    case TextMention = 'text_mention';

    /** for inline custom emoji stickers */
    case CustomEmoji = 'custom_emoji';

    /** for formatted date and time */
    case DateTime = 'date_time';

}