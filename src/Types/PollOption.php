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
     * @param int $voter_count Number of users that voted for this option
     * @param MessageEntity[]|null $text_entities Special entities that appear in the option text.
     *     Currently, only custom emoji entities are allowed in poll option texts
     */
    public function __construct(
        public string $text,
        public int $voter_count,
        public ?array $text_entities = null,
    )
    {

    }

    public static function makeByArray(array $data): self
    {
        return new self(
            text: $data['text'],
            voter_count: $data['voter_count'],
            text_entities: isset($data['text_entities'])
                ? array_map(
                    static fn(array $text_entities_data) => MessageEntity::makeByArray($text_entities_data),
                    $data['text_entities'],
                )
                : null,
        );
    }

    public function getRequestData(): array
    {
        return [
            'text' => $this->text,
            'text_entities' => $this->text_entities,
            'voter_count' => $this->voter_count,
        ];
    }
}
