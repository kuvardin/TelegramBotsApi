<?php

declare(strict_types=1);

namespace Kuvardin\TelegramBotsApi\Types;

use Kuvardin\TelegramBotsApi\Type;

/**
 * This object represents a chat photo.
 *
 * @package Kuvardin\TelegramBotsApi
 * @author Maxim Kuvardin <maxim@kuvard.in>
 */
class ChatPhoto extends Type
{
    /**
     * @param string $small_file_id File identifier of small (160x160) chat photo. This file_id can be used only for
     *     photo download and only for as long as the photo is not changed.
     * @param string $small_file_unique_id Unique file identifier of small (160x160) chat photo, which is supposed to
     *     be the same over time and for different bots. Can't be used to download or reuse the file.
     * @param string $big_file_id File identifier of big (640x640) chat photo. This file_id can be used only for photo
     *     download and only for as long as the photo is not changed.
     * @param string $big_file_unique_id Unique file identifier of big (640x640) chat photo, which is supposed to be
     *     the same over time and for different bots. Can't be used to download or reuse the file.
     */
    public function __construct(
        public string $small_file_id,
        public string $small_file_unique_id,
        public string $big_file_id,
        public string $big_file_unique_id,
    )
    {

    }

    public static function makeByArray(array $data): self
    {
        return new self(
            small_file_id: $data['small_file_id'],
            small_file_unique_id: $data['small_file_unique_id'],
            big_file_id: $data['big_file_id'],
            big_file_unique_id: $data['big_file_unique_id'],
        );
    }

    public function getRequestData(): array
    {
        return [
            'small_file_id' => $this->small_file_id,
            'small_file_unique_id' => $this->small_file_unique_id,
            'big_file_id' => $this->big_file_id,
            'big_file_unique_id' => $this->big_file_unique_id,
        ];
    }
}
