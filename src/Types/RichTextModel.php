<?php

declare(strict_types=1);

namespace Kuvardin\TelegramBotsApi\Types;

use Kuvardin\TelegramBotsApi\Type;
use RuntimeException;

/**
 * This object represents a rich formatted text. Currently, it can be either a String for plain text, an Array of RichTextModel, or any of the following types:
 *
 * @package Kuvardin\TelegramBotsApi
 * @author Maxim Kuvardin <maxim@kuvard.in>
 */
abstract class RichTextModel extends Type
{
    abstract public static function getType(): string;

    public static function makeByArray(array $data): static
    {
        return match ($data['type']) {
            RichTextModel\Anchor::getType() => RichTextModel\Anchor::makeByArray($data),
            RichTextModel\AnchorLink::getType() => RichTextModel\AnchorLink::makeByArray($data),
            RichTextModel\BankCardNumber::getType() => RichTextModel\BankCardNumber::makeByArray($data),
            RichTextModel\Bold::getType() => RichTextModel\Bold::makeByArray($data),
            RichTextModel\BotCommand::getType() => RichTextModel\BotCommand::makeByArray($data),
            RichTextModel\Button::getType() => RichTextModel\Button::makeByArray($data),
            RichTextModel\Cashtag::getType() => RichTextModel\Cashtag::makeByArray($data),
            RichTextModel\Code::getType() => RichTextModel\Code::makeByArray($data),
            RichTextModel\CustomEmoji::getType() => RichTextModel\CustomEmoji::makeByArray($data),
            RichTextModel\DateTime::getType() => RichTextModel\DateTime::makeByArray($data),
            RichTextModel\EmailAddress::getType() => RichTextModel\EmailAddress::makeByArray($data),
            RichTextModel\Hashtag::getType() => RichTextModel\Hashtag::makeByArray($data),
            RichTextModel\Italic::getType() => RichTextModel\Italic::makeByArray($data),
            RichTextModel\Marked::getType() => RichTextModel\Marked::makeByArray($data),
            RichTextModel\MathematicalExpression::getType() => RichTextModel\MathematicalExpression::makeByArray($data),
            RichTextModel\Mention::getType() => RichTextModel\Mention::makeByArray($data),
            RichTextModel\PhoneNumber::getType() => RichTextModel\PhoneNumber::makeByArray($data),
            RichTextModel\Reference::getType() => RichTextModel\Reference::makeByArray($data),
            RichTextModel\ReferenceLink::getType() => RichTextModel\ReferenceLink::makeByArray($data),
            RichTextModel\Spoiler::getType() => RichTextModel\Spoiler::makeByArray($data),
            RichTextModel\Strikethrough::getType() => RichTextModel\Strikethrough::makeByArray($data),
            RichTextModel\Subscript::getType() => RichTextModel\Subscript::makeByArray($data),
            RichTextModel\Superscript::getType() => RichTextModel\Superscript::makeByArray($data),
            RichTextModel\TextMention::getType() => RichTextModel\TextMention::makeByArray($data),
            RichTextModel\TonAddress::getType() => RichTextModel\TonAddress::makeByArray($data),
            RichTextModel\Underline::getType() => RichTextModel\Underline::makeByArray($data),
            RichTextModel\Url::getType() => RichTextModel\Url::makeByArray($data),
            default => throw new RuntimeException("Unknown rich text type: {$data['type']}"),
        };
    }

    abstract public function getRequestData(): array;
}





