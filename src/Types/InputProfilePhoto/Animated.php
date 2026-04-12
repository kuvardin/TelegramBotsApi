<?php

declare(strict_types=1);

namespace Kuvardin\TelegramBotsApi\Types\InputProfilePhoto;

use Kuvardin\TelegramBotsApi\Types\InputFile;
use Kuvardin\TelegramBotsApi\Types\InputProfilePhoto;
use RuntimeException;

/**
 * An animated profile photo in the MPEG4 format.
 *
 * @package Kuvardin\TelegramBotsApi
 * @author Maxim Kuvardin <maxim@kuvard.in>
 */
class Animated extends InputProfilePhoto
{
    /**
     * @param InputFile $animation The animated profile photo. Profile photos can't be reused and can only be uploaded
     *     as a new file, so you can pass “attach://&lt;file_attach_name&gt;” if the photo was uploaded using
     *     multipart/form-data under &lt;file_attach_name&gt;.
     * @param float|null $main_frame_timestamp Timestamp in seconds of the frame that will be used as the static
     *     profile photo. Defaults to 0.0.
     */
    public function __construct(
        public InputFile $animation,
        public ?float $main_frame_timestamp = null,
    )
    {
        if ($this->animation->getAttachName() === null) {
            throw new RuntimeException('Input file attach name must be not empty');
        }
    }

    public static function getType(): string
    {
        return 'animated';
    }

    public static function makeByArray(array $data): static
    {
        if ($data['type'] !== self::getType()) {
            throw new RuntimeException("Wrong input profile photo type: {$data['type']}");
        }

        return new self(
            animation: InputFile::makeByString($data['animation']),
            main_frame_timestamp: $data['main_frame_timestamp'] ?? null,
        );
    }

    public function getRequestData(): array
    {
        return [
            'type' => self::getType(),
            'animation' => $this->animation,
            'main_frame_timestamp' => $this->main_frame_timestamp,
        ];
    }
}
