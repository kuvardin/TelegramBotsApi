<?php

declare(strict_types=1);

namespace Kuvardin\TelegramBotsApi\Types;

use Kuvardin\TelegramBotsApi\Type;

/**
 * This object represents the audios displayed on a user's profile.
 *
 * @package Kuvardin\TelegramBotsApi
 * @author Maxim Kuvardin <maxim@kuvard.in>
 */
class UserProfileAudios extends Type
{
    /**
     * @param int $total_count Total number of profile audios for the target user
     * @param Audio[] $audios Requested profile audios
     */
    public function __construct(
        public int $total_count,
        public array $audios,
    )
    {

    }

    public static function makeByArray(array $data): self
    {
        return new self(
            total_count: $data['total_count'],
            audios: array_map(
                static fn(array $audio_data) => Audio::makeByArray($audio_data),
                $data['audios'],
            ),
        );
    }

    public function getRequestData(): array
    {
        return [
            'total_count' => $this->total_count,
            'audios' => $this->audios,
        ];
    }
}
