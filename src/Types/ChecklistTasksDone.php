<?php

declare(strict_types=1);

namespace Kuvardin\TelegramBotsApi\Types;

use Kuvardin\TelegramBotsApi\Type;

/**
 * Describes a service message about checklist tasks marked as done or not done.
 *
 * @package Kuvardin\TelegramBotsApi
 * @author Maxim Kuvardin <maxim@kuvard.in>
 */
class ChecklistTasksDone extends Type
{
    /**
     * @param Message|null $checklist_message Message containing the checklist whose tasks were marked as done or not
     *     done. Note that the Message object in this field will not contain the reply_to_message field even if it
     *     itself is a reply.
     * @param int[]|null $marked_as_done_task_ids Identifiers of the tasks that were marked as done
     * @param int[]|null $marked_as_not_done_task_ids Identifiers of the tasks that were marked as not done
     */
    public function __construct(
        public ?Message $checklist_message = null,
        public ?array $marked_as_done_task_ids = null,
        public ?array $marked_as_not_done_task_ids = null,
    )
    {

    }

    public static function makeByArray(array $data): self
    {
        return new self(
            checklist_message: isset($data['checklist_message'])
                ? Message::makeByArray($data['checklist_message'])
                : null,
            marked_as_done_task_ids: $data['marked_as_done_task_ids'] ?? null,
            marked_as_not_done_task_ids: $data['marked_as_not_done_task_ids'] ?? null,
        );
    }

    public function getRequestData(): array
    {
        return [
            'checklist_message' => $this->checklist_message,
            'marked_as_done_task_ids' => $this->marked_as_done_task_ids,
            'marked_as_not_done_task_ids' => $this->marked_as_not_done_task_ids,
        ];
    }
}
