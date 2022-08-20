<?php

declare(strict_types=1);

namespace Kuvardin\TelegramBotsApi\Types;

use Kuvardin\TelegramBotsApi\Type;
use RuntimeException;

/**
 * This object represents one result of an inline query. Telegram clients currently support results of the following 20
 * types: InlineQueryResult\*
 *
 * @package Kuvardin\TelegramBotsApi
 * @author Maxim Kuvardin <maxim@kuvard.in>
 */
abstract class InlineQueryResult extends Type
{
    abstract public static function getType(): string;

    public static function makeByArray(array $data): static
    {
        return match ($data['type']) {
            InlineQueryResult\Article::getType() => InlineQueryResult\Article::makeByArray($data),
            InlineQueryResult\Audio::getType() => isset($data['audio_file_id'])
                ? InlineQueryResult\CachedAudio::makeByArray($data)
                : InlineQueryResult\Audio::makeByArray($data),
            InlineQueryResult\Contact::getType() => InlineQueryResult\Contact::makeByArray($data),
            InlineQueryResult\Document::getType() => isset($data['document_file_id'])
                ? InlineQueryResult\CachedDocument::makeByArray($data)
                : InlineQueryResult\Document::makeByArray($data),
            InlineQueryResult\Game::getType() => InlineQueryResult\Game::makeByArray($data),
            InlineQueryResult\Gif::getType() => isset($data['gif_file_id'])
                ? InlineQueryResult\CachedGif::makeByArray($data)
                : InlineQueryResult\Gif::makeByArray($data),
            InlineQueryResult\Location::getType() => InlineQueryResult\Location::makeByArray($data),
            InlineQueryResult\Mpeg4Gif::getType() => isset($data['mpeg4_file_id'])
                ? InlineQueryResult\CachedMpeg4Gif::makeByArray($data)
                : InlineQueryResult\Mpeg4Gif::makeByArray($data),
            InlineQueryResult\Photo::getType() => isset($data['photo_file_id'])
                ? InlineQueryResult\CachedPhoto::makeByArray($data)
                : InlineQueryResult\Photo::makeByArray($data),
            InlineQueryResult\CachedSticker::getType() => InlineQueryResult\CachedSticker::makeByArray($data),
            InlineQueryResult\Venue::getType() => InlineQueryResult\Venue::makeByArray($data),
            InlineQueryResult\Video::getType() => isset($data['video_file_id'])
                ? InlineQueryResult\CachedVideo::makeByArray($data)
                : InlineQueryResult\Video::makeByArray($data),
            InlineQueryResult\Voice::getType() => isset($data['voice_file_id'])
                ? InlineQueryResult\CachedVoice::makeByArray($data)
                : InlineQueryResult\Voice::makeByArray($data),
            default => throw new RuntimeException("Unknown inline query result type: {$data['type']}"),
        };
    }

    abstract public function getRequestData(): array;
}
