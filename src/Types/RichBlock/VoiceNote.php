<?php

declare(strict_types=1);

namespace Kuvardin\TelegramBotsApi\Types\RichBlock;

use Kuvardin\TelegramBotsApi\Types\RichBlock;
use RuntimeException;
use Kuvardin\TelegramBotsApi\Types\Voice;
use Kuvardin\TelegramBotsApi\Types\RichBlockCaption;
/**
 * A block with a voice note, corresponding to the HTML tag "&lt;audio&gt;".
 *
 * @package Kuvardin\TelegramBotsApi
 * @author Maxim Kuvardin <maxim@kuvard.in>
 */
class VoiceNote extends RichBlock
{
    /**
     * @param Voice $voice_note The voice note
     * @param RichBlockCaption|null $caption Caption of the block
     */
    public function __construct(
        public Voice $voice_note,
        public ?RichBlockCaption $caption = null,
    )
    {

    }

    public static function getType(): string
    {
        return 'voice_note';
    }

    public static function makeByArray(array $data): static
    {
        if ($data['type'] !== self::getType()) {
            throw new RuntimeException("Wrong rich block type: {$data['type']}");
        }

        return new self(
            voice_note: Voice::makeByArray($data['voice_note']),
            caption: isset($data['caption'])
                ? RichBlockCaption::makeByArray($data['caption'])
                : null,
        );
    }

    public function getRequestData(): array
    {
        return [
            'type' => self::getType(),
            'voice_note' => $this->voice_note,
            'caption' => $this->caption,
        ];
    }
}





