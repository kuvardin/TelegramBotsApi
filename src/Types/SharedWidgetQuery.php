<?php

declare(strict_types=1);

namespace Kuvardin\TelegramBotsApi\Types;

use Kuvardin\TelegramBotsApi\Type;

/**
 * This object represents an incoming query from a forwarded message with a shared widget created by the bot. Use
 * answerWidgetQuery() to answer the query. Each user can send at most 5 queries per 5 seconds to the bot from all its
 * widgets.
 *
 * @package Kuvardin\TelegramBotsApi
 * @author Maxim Kuvardin <maxim@kuvard.in>
 */
class SharedWidgetQuery extends Type
{
    /**
     * @param string $id Unique identifier for this query
     * @param User $from Sender
     * @param WidgetQueryType $type Type of the query
     * @param string $data Data of the query, 1-64 bytes
     * @param string $widget_id Unique identifier of the shared widget, which sent the query
     */
    public function __construct(
        public string $id,
        public User $from,
        public WidgetQueryType $type,
        public string $data,
        public string $widget_id,
    )
    {

    }

    public static function makeByArray(array $data): self
    {
        return new self(
            id: $data['id'],
            from: User::makeByArray($data['from']),
            type: WidgetQueryType::makeByArray($data['type']),
            data: $data['data'],
            widget_id: $data['widget_id'],
        );
    }

    public function getRequestData(): array
    {
        return [
            'id' => $this->id,
            'from' => $this->from,
            'type' => $this->type,
            'data' => $this->data,
            'widget_id' => $this->widget_id,
        ];
    }
}





