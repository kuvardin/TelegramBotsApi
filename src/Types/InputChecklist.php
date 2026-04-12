<?php

declare(strict_types=1);

namespace Kuvardin\TelegramBotsApi\Types;

use Kuvardin\TelegramBotsApi\Type;

/**
 * Describes a checklist to create.
 *
 * @package Kuvardin\TelegramBotsApi
 * @author Maxim Kuvardin <maxim@kuvard.in>
 */
class InputChecklist extends Type
{
    /**
     * @param string $title Title of the checklist; 1-255 characters after entities parsing
     * @param InputChecklistTask[] $tasks List of 1-30 tasks in the checklist
     * @param string|null $parse_mode Mode for parsing entities in the title.
     * @param MessageEntity[]|null $title_entities List of special entities that appear in the title, which can be
     *     specified instead of parse_mode. Currently, only "bold", "italic", "underline", "strikethrough", "spoiler",
     *     "custom_emoji", and "date_time" entities are allowed.
     * @param bool|null $others_can_add_tasks Pass True if other users can add tasks to the checklist
     * @param bool|null $others_can_mark_tasks_as_done Pass True if other users can mark tasks as done or not done in
     *     the checklist
     */
    public function __construct(
        public string $title,
        public array $tasks,
        public ?string $parse_mode = null,
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
                static fn(array $task_data) => InputChecklistTask::makeByArray($task_data),
                $data['tasks'],
            ),
            parse_mode: $data['parse_mode'] ?? null,
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
            'parse_mode' => $this->parse_mode,
            'title_entities' => $this->title_entities,
            'others_can_add_tasks' => $this->others_can_add_tasks,
            'others_can_mark_tasks_as_done' => $this->others_can_mark_tasks_as_done,
        ];
    }
}
