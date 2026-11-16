<?php

declare(strict_types=1);

namespace Kuvardin\TelegramBotsApi\Types;

use Kuvardin\TelegramBotsApi\Type;
use RuntimeException;

/**
 * This object represents a block in a rich formatted message. Currently, it can be any of the following types:
 *
 * @package Kuvardin\TelegramBotsApi
 * @author Maxim Kuvardin <maxim@kuvard.in>
 */
abstract class RichBlock extends Type
{
    abstract public static function getType(): string;

    public static function makeByArray(array $data): static
    {
        return match ($data['type']) {
            RichBlock\Anchor::getType() => RichBlock\Anchor::makeByArray($data),
            RichBlock\Animation::getType() => RichBlock\Animation::makeByArray($data),
            RichBlock\Audio::getType() => RichBlock\Audio::makeByArray($data),
            RichBlock\BlockQuotation::getType() => RichBlock\BlockQuotation::makeByArray($data),
            RichBlock\Buttons::getType() => RichBlock\Buttons::makeByArray($data),
            RichBlock\Collage::getType() => RichBlock\Collage::makeByArray($data),
            RichBlock\Details::getType() => RichBlock\Details::makeByArray($data),
            RichBlock\Divider::getType() => RichBlock\Divider::makeByArray($data),
            RichBlock\Document::getType() => RichBlock\Document::makeByArray($data),
            RichBlock\ExpandableBlockQuotation::getType() => RichBlock\ExpandableBlockQuotation::makeByArray($data),
            RichBlock\Footer::getType() => RichBlock\Footer::makeByArray($data),
            RichBlock\ListItems::getType() => RichBlock\ListItems::makeByArray($data),
            RichBlock\Map::getType() => RichBlock\Map::makeByArray($data),
            RichBlock\MathematicalExpression::getType() => RichBlock\MathematicalExpression::makeByArray($data),
            RichBlock\Paragraph::getType() => RichBlock\Paragraph::makeByArray($data),
            RichBlock\Photo::getType() => RichBlock\Photo::makeByArray($data),
            RichBlock\Preformatted::getType() => RichBlock\Preformatted::makeByArray($data),
            RichBlock\PullQuotation::getType() => RichBlock\PullQuotation::makeByArray($data),
            RichBlock\SectionHeading::getType() => RichBlock\SectionHeading::makeByArray($data),
            RichBlock\Slideshow::getType() => RichBlock\Slideshow::makeByArray($data),
            RichBlock\Table::getType() => RichBlock\Table::makeByArray($data),
            RichBlock\Thinking::getType() => RichBlock\Thinking::makeByArray($data),
            RichBlock\Video::getType() => RichBlock\Video::makeByArray($data),
            RichBlock\VoiceNote::getType() => RichBlock\VoiceNote::makeByArray($data),
            default => throw new RuntimeException("Unknown rich block type: {$data['type']}"),
        };
    }

    abstract public function getRequestData(): array;
}
