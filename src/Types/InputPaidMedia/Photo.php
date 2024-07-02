<?php

declare(strict_types=1);

namespace Kuvardin\TelegramBotsApi\Types\InputPaidMedia;

use Kuvardin\TelegramBotsApi\Types\InputFile;
use Kuvardin\TelegramBotsApi\Types\InputPaidMedia;
use RuntimeException;

/**
 * The paid media to send is a photo.
 *
 * @package Kuvardin\TelegramBotsApi
 * @author Maxim Kuvardin <maxim@kuvard.in>
 */
class Photo extends InputPaidMedia
{
    /**
     * @param InputFile $media File to send. Pass a file_id to send a file that exists on the Telegram servers
     *     (recommended), pass an HTTP URL for Telegram to get a file from the Internet, or pass
     *     “attach://&lt;file_attach_name&gt;” to upload a new one using multipart/form-data under
     *     &lt;file_attach_name&gt; name.
     */
    public function __construct(
        public InputFile $media,
    )
    {

    }

    public static function getType(): string
    {
        return 'photo';
    }

    public static function makeByArray(array $data): static
    {
        if ($data['type'] !== self::getType()) {
            throw new RuntimeException("Wrong input paid media type: {$data['type']}");
        }

        return new self(
            media: InputFile::makeByString($data['media']),
        );
    }

    public function getRequestData(): array
    {
        return [
            'type' => self::getType(),
            'media' => $this->media,
        ];
    }
}
