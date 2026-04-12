<?php

declare(strict_types=1);

namespace Kuvardin\TelegramBotsApi\Types;

use Kuvardin\TelegramBotsApi\Type;

/**
 * Describes a task in a checklist.
 *
 * @package Kuvardin\TelegramBotsApi
 * @author Maxim Kuvardin <maxim@kuvard.in>
 */
class ChecklistTask extends Type
{
    /**
     * @param int $id Unique identifier of the task
     * @param string $text Text of the task
     * @param MessageEntity[]|null $text_entities Special entities that appear in the task text
     * @param User|null $completed_by_user User that completed the task; omitted if the task wasn't completed by a user
     * @param Chat|null $completed_by_chat Chat that completed the task; omitted if the task wasn't completed by a chat
     * @param int|null $completion_date Point in time (Unix timestamp) when the task was completed; 0 if the task wasn't
     *     completed
     */
    public function __construct(
        public int $id,
        public string $text,
        public ?array $text_entities = null,
        public ?User $completed_by_user = null,
        public ?Chat $completed_by_chat = null,
        public ?int $completion_date = null,
    )
    {

    }

    public static function makeByArray(array $data): self
    {
        return new self(
            id: $data['id'],
            text: $data['text'],
            text_entities: isset($data['text_entities'])
                ? array_map(
                    static fn(array $entity_data) => MessageEntity::makeByArray($entity_data),
                    $data['text_entities'],
                )
                : null,
            completed_by_user: isset($data['completed_by_user'])
                ? User::makeByArray($data['completed_by_user'])
                : null,
            completed_by_chat: isset($data['completed_by_chat'])
                ? Chat::makeByArray($data['completed_by_chat'])
                : null,
            completion_date: $data['completion_date'] ?? null,
        );
    }

    public function getRequestData(): array
    {
        return [
            'id' => $this->id,
            'text' => $this->text,
            'text_entities' => $this->text_entities,
            'completed_by_user' => $this->completed_by_user,
            'completed_by_chat' => $this->completed_by_chat,
            'completion_date' => $this->completion_date,
        ];
    }
}
