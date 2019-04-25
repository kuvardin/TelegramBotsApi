<?php

namespace TelegramBotsApi\Types;

use \TelegramBotsApi;
use \TelegramBotsApi\Exceptions\Error;

class InlineQueryResult
{
    public const TYPE_ARTICLE = 'article';
    public const TYPE_PHOTO = 'photo';
    public const TYPE_GIF = 'gif';
    public const TYPE_MPEG4_GIF = 'mpeg4_gif';
    public const TYPE_VIDEO = 'video';
    public const TYPE_AUDIO = 'audio';
    public const TYPE_VOICE = 'voice';
    public const TYPE_DOCUMENT = 'document';
    public const TYPE_LOCATION = 'location';
    public const TYPE_VENUE = 'venue';
    public const TYPE_CONTACT = 'contact';
    public const TYPE_GAME = 'game';
    public const TYPE_STICKER = 'sticker';

    /**
     * InlineQueryResult constructor.
     */
    private function __construct()
    {

    }

    /**
     * @param array $data
     * @return object
     * @throws Error
     */
    public static function new(array $data): object
    {
        switch ($data['type']) {
            case self::TYPE_PHOTO:
                return isset($data['photo_file_id']) ? new InlineQueryResult\CachedPhoto($data) : new InlineQueryResult\Photo($data);
            case self::TYPE_GIF:
                return isset($data['gif_file_id']) ? new InlineQueryResult\CachedGif($data) : new InlineQueryResult\Gif($data);
            case self::TYPE_MPEG4_GIF:
                return isset($data['mpeg4_file_id']) ? new InlineQueryResult\CachedMpeg4Gif($data) : new InlineQueryResult\Mpeg4Gif($data);
            case self::TYPE_VIDEO:
                return isset($data['video_file_id']) ? new InlineQueryResult\CachedVideo($data) : new InlineQueryResult\Video($data);
            case self::TYPE_AUDIO:
                return isset($data['audio_file_id']) ? new InlineQueryResult\CachedAudio($data) : new InlineQueryResult\Audio($data);
            case self::TYPE_VOICE:
                return isset($data['voice_file_id']) ? new InlineQueryResult\CachedVoice($data) : new InlineQueryResult\Voice($data);
            case self::TYPE_DOCUMENT:
                return isset($data['document_file_id']) ? new InlineQueryResult\CachedDocument($data) : new InlineQueryResult\Document($data);
            case self::TYPE_ARTICLE:
                return new InlineQueryResult\Article($data);
            case self::TYPE_LOCATION:
                return new InlineQueryResult\Location($data);
            case self::TYPE_VENUE:
                return new InlineQueryResult\Venue($data);
            case self::TYPE_CONTACT:
                return new InlineQueryResult\Contact($data);
            case self::TYPE_GAME:
                return new InlineQueryResult\Game($data);
            default:
                throw new Error("Unknown type: {$data['type']}");
        }
    }

    /**
     * This method cannot be created in this class
     */
    // public static function make(): self {}
}