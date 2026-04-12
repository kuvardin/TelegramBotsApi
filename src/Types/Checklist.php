<?php

declare(strict_types=1);

namespace Kuvardin\TelegramBotsApi\Types;

use Kuvardin\TelegramBotsApi\Type;

/**
 * Describes a checklist.
 *
 * @package Kuvardin\TelegramBotsApi
 * @author Maxim Kuvardin <maxim@kuvard.in>
 */
class Checklist extends Type
{
    /**
     * @param string $title Title of the checklist
     * @param ChecklistTask[] $tasks List of tasks in the checklist
     * @param MessageEntity[]|null $title_entities Special entities that appear in the checklist title
     * @param bool|null $others_can_add_tasks True, if users other than the creator of the list can add tasks to
     *     the list
     * @param bool|null $others_can_mark_tasks_as_done True, if users other than the creator of the list can mark
     *     tasks as done or not done
     */
    public function __construct(
        public string $title,
        public array $tasks,
        public ?array $title_entities = null,
        public ?bool $others_can_add_tasks = null,
        public ?bool $others_can_mark_tasks_as_done = null,
    )
    {

    }

    public static function makeByArray(array $data): self
    {
        return new self(
            title: $data['title'],
            tasks: array_map(
                static fn(array $task_data) => ChecklistTask::makeByArray($task_data),
                $data['tasks'],
            ),
            title_entities: isset($data['title_entities'])
                ? array_map(
                    static fn(array $entity_data) => MessageEntity::makeByArray($entity_data),
                    $data['title_entities'],
                )
                : null,
            others_can_add_tasks: $data['others_can_add_tasks'] ?? null,
            others_can_mark_tasks_as_done: $data['others_can_mark_tasks_as_done'] ?? null,
        );
    }

    public function getRequestData(): array
    {
        return [
            'title' => $this->title,
            'tasks' => $this->tasks,
            'title_entities' => $this->title_entities,
            'others_can_add_tasks' => $this->others_can_add_tasks,
            'others_can_mark_tasks_as_done' => $this->others_can_mark_tasks_as_done,
        ];
    }
}
