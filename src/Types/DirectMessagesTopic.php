<?php

declare(strict_types=1);

namespace Kuvardin\TelegramBotsApi\Types;

use Kuvardin\TelegramBotsApi\Type;

/**
 * Describes a topic of a direct messages chat.
 *
 * @package Kuvardin\TelegramBotsApi
 * @author Maxim Kuvardin <maxim@kuvard.in>
 */
class DirectMessagesTopic extends Type
{
    /**
     * @param int $topic_id Unique identifier of the topic. This number may have more than 32 significant bits and some
     *     programming languages may have difficulty/silent defects in interpreting it. But it has at most 52
     *     significant bits, so a 64-bit integer or double-precision float type are safe for storing this identifier.
     * @param User|null $user Information about the user that created the topic. Currently, it is always present
     */
    public function __construct(
        public int $topic_id,
        public ?User $user = null,
    )
    {

    }

    public static function makeByArray(array $data): self
    {
        return new self(
            topic_id: $data['topic_id'],
            user: isset($data['user'])
                ? User::makeByArray($data['user'])
                : null,
        );
    }

    public function getRequestData(): array
    {
        return [
            'topic_id' => $this->topic_id,
            'user' => $this->user,
        ];
    }
}
