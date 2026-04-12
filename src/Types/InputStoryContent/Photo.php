<?php

declare(strict_types=1);

namespace Kuvardin\TelegramBotsApi\Types\InputStoryContent;

use Kuvardin\TelegramBotsApi\Types\InputFile;
use Kuvardin\TelegramBotsApi\Types\InputStoryContent;
use RuntimeException;

/**
 * Describes a photo to post as a story.
 *
 * @package Kuvardin\TelegramBotsApi
 * @author Maxim Kuvardin <maxim@kuvard.in>
 */
class Photo extends InputStoryContent
{
    /**
     * @param InputFile $photo The photo to post as a story. The photo must be of the size 1080x1920 and must not
     *     exceed 10 MB. The photo can't be reused and can only be uploaded as a new file, so you can pass
     *     “attach://&lt;file_attach_name&gt;” if the photo was uploaded using multipart/form-data under
     *     &lt;file_attach_name&gt;.
     */
    public function __construct(
        public InputFile $photo,
    )
    {
        if ($this->photo->getAttachName() === null) {
            throw new RuntimeException('Input file attach name must be not empty');
        }
    }

    public static function getType(): string
    {
        return 'photo';
    }

    public static function makeByArray(array $data): static
    {
        if ($data['type'] !== self::getType()) {
            throw new RuntimeException("Wrong input story content type: {$data['type']}");
        }

        return new self(
            photo: InputFile::makeByString($data['photo']),
        );
    }

    public function getRequestData(): array
    {
        return [
            'type' => self::getType(),
            'photo' => $this->photo,
        ];
    }
}
