<?php

declare(strict_types=1);

namespace Kuvardin\TelegramBotsApi\Types\InputRichBlock;

use Kuvardin\TelegramBotsApi\Types\InputRichBlock;
use Kuvardin\TelegramBotsApi\Types\InputMedia\VoiceNote as InputMediaVoiceNote;
use Kuvardin\TelegramBotsApi\Types\RichBlockCaption;
use RuntimeException;

/**
 * A block with a voice note, corresponding to the HTML tag "&lt;audio&gt;".
 *
 * @package Kuvardin\TelegramBotsApi
 * @author Maxim Kuvardin <maxim@kuvard.in>
 */
class VoiceNote extends InputRichBlock
{
    /**
     * @param InputMediaVoiceNote $voice_note The voice note. Caption is ignored.
     * @param RichBlockCaption|null $caption Caption of the block
     */
    public function __construct(
        public InputMediaVoiceNote $voice_note,
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
            throw new RuntimeException("Wrong input rich block type: {$data['type']}");
        }

        return new self(
            voice_note: InputMediaVoiceNote::makeByArray($data['voice_note']),
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

