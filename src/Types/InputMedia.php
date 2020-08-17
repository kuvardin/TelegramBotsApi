<?php

declare(strict_types=1);

namespace Kuvardin\TelegramBotsApi\Types;

use Kuvardin\TelegramBotsApi\Exceptions\Error;

/**
 * This object represents the content of a media message to be sent. It should be one of
 *
 * @package Kuvardin\TelegramBotsApi
 * @author Maxim Kuvardin <maxim@kuvard.in>
 */
class InputMedia
{
    public const TYPE_ANIMATION = 'animation';
    public const TYPE_DOCUMENT = 'document';
    public const TYPE_AUDIO = 'audio';
    public const TYPE_PHOTO = 'photo';
    public const TYPE_VIDEO = 'video';

    /**
     * InputMedia constructor.
     *
     * @param array $data
     */
    protected function __construct(array $data)
    {
    }

    /**
     * @param array $data
     * @return InputMedia
     */
    public static function constructChild(array $data): InputMedia
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
                throw new Error("Unknown type: {$data['type']} (must be self::TYPE_*");
        }
    }
}
