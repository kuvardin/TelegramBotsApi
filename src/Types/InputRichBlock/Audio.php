<?php

declare(strict_types=1);

namespace Kuvardin\TelegramBotsApi\Types\InputRichBlock;

use Kuvardin\TelegramBotsApi\Types\InputRichBlock;
use RuntimeException;
use Kuvardin\TelegramBotsApi\Types\InputMedia\Audio as InputMediaAudio;
use Kuvardin\TelegramBotsApi\Types\RichBlockCaption;

/**
 * A block with a music file, corresponding to the HTML tag "&lt;audio&gt;".
 *
 * @package Kuvardin\TelegramBotsApi
 * @author Maxim Kuvardin <maxim@kuvard.in>
 */
class Audio extends InputRichBlock
{
    /**
     * @param InputMediaAudio $audio The audio. Caption is ignored.
     * @param RichBlockCaption|null $caption Caption of the block
     */
    public function __construct(
        public InputMediaAudio $audio,
        public ?RichBlockCaption $caption = null,
    )
    {

    }

    public static function getType(): string
    {
        return 'audio';
    }

    public static function makeByArray(array $data): static
    {
        if ($data['type'] !== self::getType()) {
            throw new RuntimeException("Wrong input rich block type: {$data['type']}");
        }

        return new self(
            audio: InputMediaAudio::makeByArray($data['audio']),
            caption: isset($data['caption'])
                ? RichBlockCaption::makeByArray($data['caption'])
                : null,
        );
    }

    public function getRequestData(): array
    {
        return [
            'type' => self::getType(),
            'audio' => $this->audio,
            'caption' => $this->caption,
        ];
    }
}





