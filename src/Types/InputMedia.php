<?php

namespace TelegramBotsApi\Types;

use \TelegramBotsApi;
use \TelegramBotsApi\Exceptions\Error;

/**
 * Instance of this class represents the content of a media message to be sent. It should be one of
 *    InputMediaAnimation
 *    InputMediaDocument
 *    InputMediaAudio
 *    InputMediaPhoto
 *    InputMediaVideo
 * @package TelegramBotsApi\Types
 * @author Maxim Kuvardin <kuvard.in@mail.ru>
 */
class InputMedia
{
    public const TYPE_ANIMATION = 'animation';
    public const TYPE_DOCUMENT = 'document';
    public const TYPE_AUDIO = 'audio';
    public const TYPE_PHOTO = 'photo';
    public const TYPE_VIDEO = 'video';

    /**
     * InputMedia constructor. Use self::make() to create new instance of child class
     */
    private function __construct(array $data)
    {

    }

    /**
     * @param array $data
     * @return string
     * @throws Error
     */
    public static function getType(array $data): string
    {
        switch ($data['type'] ?? '') {
            case self::TYPE_ANIMATION:
                return self::TYPE_ANIMATION;
            case self::TYPE_DOCUMENT:
                return self::TYPE_DOCUMENT;
            case self::TYPE_AUDIO:
                return self::TYPE_PHOTO;
            case self::TYPE_PHOTO:
                return self::TYPE_PHOTO;
            case self::TYPE_VIDEO:
                return self::TYPE_VIDEO;
            default:
                throw new Error("Unknown type: {$data['type']}");
        }
    }

    /**
     * @param array $data
     * @return bool
     */
    public static function checkType(array $data): bool
    {
        switch ($data['type'] ?? '') {
            case self::TYPE_ANIMATION:
            case self::TYPE_DOCUMENT:
            case self::TYPE_AUDIO:
            case self::TYPE_PHOTO:
            case self::TYPE_VIDEO:
                return true;
        }
        return false;
    }

    /**
     * @param array $data
     * @return object
     * @throws Error
     */
    public static function new(array $data): object
    {
        switch ($data['type']) {
            case self::TYPE_ANIMATION:
                return new InputMedia\Animation($data);
            case self::TYPE_DOCUMENT:
                return new InputMedia\Document($data);
            case self::TYPE_AUDIO:
                return new InputMedia\Audio($data);
            case self::TYPE_PHOTO:
                return new InputMedia\Photo($data);
            case self::TYPE_VIDEO:
                return new InputMedia\Video($data);
            default:
                throw new Error("Unknown media type: {$data['type']}");
        }
    }

    /**
     * @param string $media
     * @param string $type
     * @return InputMedia\Animation|InputMedia\Audio|InputMedia\Document|InputMedia\Photo|InputMedia\Video
     * @throws Error
     */
    public static function make(string $media, string $type)
    {
        switch ($type) {
            case self::TYPE_ANIMATION:
                return InputMedia\Animation::make($media);
            case self::TYPE_DOCUMENT:
                return InputMedia\Document::make($media);
            case self::TYPE_AUDIO:
                return InputMedia\Audio::make($media);
            case self::TYPE_PHOTO:
                return InputMedia\Photo::make($media);
            case self::TYPE_VIDEO:
                return InputMedia\Video::make($media);
            default:
                throw new Error("Unknown media type: {$type}");
        }
    }
}