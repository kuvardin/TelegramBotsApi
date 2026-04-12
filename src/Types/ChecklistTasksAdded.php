<?php

declare(strict_types=1);

namespace Kuvardin\TelegramBotsApi\Types;

use Kuvardin\TelegramBotsApi\Type;

/**
 * Describes a service message about tasks added to a checklist.
 *
 * @package Kuvardin\TelegramBotsApi
 * @author Maxim Kuvardin <maxim@kuvard.in>
 */
class ChecklistTasksAdded extends Type
{
    /**
     * @param ChecklistTask[] $tasks List of tasks added to the checklist
     * @param Message|null $checklist_message Message containing the checklist to which the tasks were added. Note that
     *     the Message object in this field will not contain the reply_to_message field even if it itself is a reply.
     */
    public function __construct(
        public array $tasks,
        public ?Message $checklist_message = null,
    )
    {

    }

    public static function makeByArray(array $data): self
    {
        return new self(
            tasks: array_map(
                static fn(array $task_data) => ChecklistTask::makeByArray($task_data),
                $data['tasks'],
            ),
            checklist_message: isset($data['checklist_message'])
                ? Message::makeByArray($data['checklist_message'])
                : null,
        );
    }

    public function getRequestData(): array
    {
        return [
            'tasks' => $this->tasks,
            'checklist_message' => $this->checklist_message,
        ];
    }
}
