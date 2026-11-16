<?php

declare(strict_types=1);

namespace Kuvardin\TelegramBotsApi\Types;

use Kuvardin\TelegramBotsApi\Type;

/**
 * Describes a media element embedded in an outgoing rich message.
 *
 * @package Kuvardin\TelegramBotsApi
 * @author Maxim Kuvardin <maxim@kuvard.in>
 */
class InputRichMessageMedia extends Type
{
    /**
     * @param string $id Unique identifier of the media used in a "tg://photo?id=", "tg://video?id=",
     *     "tg://document?id=", or "tg://audio?id=" link. 1-64 characters, only "A-Z", "a-z", "0-9", "_" and "-" are
     *     allowed.
     * @param InputMedia\Animation|InputMedia\Audio|InputMedia\Document|InputMedia\Photo|InputMedia\Video|InputMedia\VoiceNote $media The
     *     media to be sent. Everything except the media itself and its properties is ignored.
     */
    public function __construct(
        public string $id,
        public InputMedia\Animation|InputMedia\Audio|InputMedia\Document|InputMedia\Photo|InputMedia\Video|InputMedia\VoiceNote $media,
    )
    {

    }

    public static function makeByArray(array $data): self
    {
        return new self(
            id: $data['id'],
            media: $data['media'],
        );
    }

    public function getRequestData(): array
    {
        return [
            'id' => $this->id,
            'media' => $this->media,
        ];
    }
}





