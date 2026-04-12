<?php

declare(strict_types=1);

namespace Kuvardin\TelegramBotsApi\Types;

use Kuvardin\TelegramBotsApi\Type;

/**
 * This object contains information about one answer option in a poll.
 *
 * @package Kuvardin\TelegramBotsApi
 * @author Maxim Kuvardin <maxim@kuvard.in>
 */
class PollOption extends Type
{
    /**
     * @param string $text Option text, 1-100 characters
     * @param int $voter_count Number of users who voted for this option; may be 0 if unknown
     * @param string $persistent_id Unique identifier of the option, persistent on option addition and deletion
     * @param MessageEntity[]|null $text_entities Special entities that appear in the option "text". Currently, only
     *     custom emoji entities are allowed in poll option texts
     * @param User|null $added_by_user User who added the option; omitted if the option wasn't added by a user after
     *     poll creation
     * @param Chat|null $added_by_chat Chat that added the option; omitted if the option wasn't added by a chat after
     *     poll creation
     * @param int|null $addition_date Point in time (Unix timestamp) when the option was added; omitted if the option
     *     existed in the original poll
     */
    public function __construct(
        public string $text,
        public int $voter_count,
        public string $persistent_id,
        public ?array $text_entities = null,
        public ?User $added_by_user = null,
        public ?Chat $added_by_chat = null,
        public ?int $addition_date = null,
    )
    {

    }

    public static function makeByArray(array $data): self
    {
        return new self(
            text: $data['text'],
            voter_count: $data['voter_count'],
            persistent_id: $data['persistent_id'],
            text_entities: isset($data['text_entities'])
                ? array_map(
                    static fn(array $text_entities_data) => MessageEntity::makeByArray($text_entities_data),
                    $data['text_entities'],
                )
                : null,
            added_by_user: isset($data['added_by_user'])
                ? User::makeByArray($data['added_by_user'])
                : null,
            added_by_chat: isset($data['added_by_chat'])
                ? Chat::makeByArray($data['added_by_chat'])
                : null,
            addition_date: $data['addition_date'] ?? null,
        );
    }

    public function getRequestData(): array
    {
        return [
            'text' => $this->text,
            'voter_count' => $this->voter_count,
            'persistent_id' => $this->persistent_id,
            'text_entities' => $this->text_entities,
            'added_by_user' => $this->added_by_user,
            'added_by_chat' => $this->added_by_chat,
            'addition_date' => $this->addition_date,
        ];
    }
}
