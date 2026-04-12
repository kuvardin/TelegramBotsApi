<?php

declare(strict_types=1);

namespace Kuvardin\TelegramBotsApi\Types\InputProfilePhoto;

use Kuvardin\TelegramBotsApi\Types\InputFile;
use Kuvardin\TelegramBotsApi\Types\InputProfilePhoto;
use RuntimeException;

/**
 * A static profile photo in the .JPG format.
 *
 * @package Kuvardin\TelegramBotsApi
 * @author Maxim Kuvardin <maxim@kuvard.in>
 */
class StaticPhoto extends InputProfilePhoto
{
    /**
     * @param InputFile $photo The static profile photo. Profile photos can't be reused and can only be uploaded as
     *     a new file, so you can pass “attach://&lt;file_attach_name&gt;” if the photo was uploaded using multipart/form-data
     *     under &lt;file_attach_name&gt;.
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
        return 'static';
    }

    public static function makeByArray(array $data): static
    {
        if ($data['type'] !== self::getType()) {
            throw new RuntimeException("Wrong input profile photo type: {$data['type']}");
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
