<?php

declare(strict_types=1);

namespace Kuvardin\TelegramBotsApi\Types\RichBlock;

use Kuvardin\TelegramBotsApi\Types\RichBlock;
use RuntimeException;
use Kuvardin\TelegramBotsApi\Types\RichBlockCaption;
use Kuvardin\TelegramBotsApi\Types\Audio as TelegramAudio;

/**
 * A block with a music file, corresponding to the HTML tag "&lt;audio&gt;".
 *
 * @package Kuvardin\TelegramBotsApi
 * @author Maxim Kuvardin <maxim@kuvard.in>
 */
class Audio extends RichBlock
{
    /**
     * @param TelegramAudio $audio The audio
     * @param RichBlockCaption|null $caption Caption of the block
     */
    public function __construct(
        public TelegramAudio $audio,
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
            throw new RuntimeException("Wrong rich block type: {$data['type']}");
        }

        return new self(
            audio: TelegramAudio::makeByArray($data['audio']),
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





