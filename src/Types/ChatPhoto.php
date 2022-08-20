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
     * @var string $small_file_id File identifier of small (160x160) chat photo. This file_id can be used only for
     *     photo download and only for as long as the photo is not changed.
     */
    public string $small_file_id;

    /**
     * @var string $small_file_unique_id Unique file identifier of small (160x160) chat photo, which is supposed to be
     *     the same over time and for different bots. Can't be used to download or reuse the file.
     */
    public string $small_file_unique_id;

    /**
     * @var string $big_file_id File identifier of big (640x640) chat photo. This file_id can be used only for photo
     *     download and only for as long as the photo is not changed.
     */
    public string $big_file_id;

    /**
     * @var string $big_file_unique_id Unique file identifier of big (640x640) chat photo, which is supposed to be the
     *     same over time and for different bots. Can't be used to download or reuse the file.
     */
    public string $big_file_unique_id;

    public static function makeByArray(array $data): self
    {
        $result = new self;
        $result->small_file_id = $data['small_file_id'];
        $result->small_file_unique_id = $data['small_file_unique_id'];
        $result->big_file_id = $data['big_file_id'];
        $result->big_file_unique_id = $data['big_file_unique_id'];
        return $result;
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
