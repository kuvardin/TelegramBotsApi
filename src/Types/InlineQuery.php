<?php

namespace TelegramBotsApi\Types;

use \TelegramBotsApi;
use \TelegramBotsApi\Exceptions\Error;

/**
 * This object represents an incoming inline query. When the user sends an empty query, your bot could return some default or trending results.
 * @package TelegramBotsApi\Types
 * @author Maxim Kuvardin <kuvard.in@mail.ru>
 */
class InlineQuery implements TypeInterface
{

    /**
     * @var string Unique identifier for this query
     */
    public $id;

    /**
     * @var User Sender
     */
    public $from;

    /**
     * @var Location|null Sender location, only for bots that request user location
     */
    public $location;

    /**
     * @var string Text of the query (up to 512 characters)
     */
    public $query;

    /**
     * @var string Offset of the results to be returned, can be controlled by the bot
     */
    public $offset;

    /**
     * InlineQuery constructor.
     * @param array $data
     */
    public function __construct(array $data)
    {
        $this->id = $data['id'];
        $this->from = $data['from'] instanceof User ? $data['from'] : new User($data['from']);

        if (isset($data['location'])) {
            $this->location = $data['location'] instanceof Location ? $data['location'] : new Location($data['location']);
        }

        $this->query = $data['query'];
        $this->offset = $data['offset'];
    }

    /**
     * @return array
     */
    public function getRequestArray(): array
    {
        return [
            'id' => $this->id,
            'from' => $this->from,
            'location' => $this->location,
            'query' => $this->query,
            'offset' => $this->offset,
        ];
    }

    /**
     * @param string $id
     * @param User $from
     * @param string $query
     * @param string $offset
     * @return InlineQuery
     */
    public static function make(string $id, User $from, string $query, string $offset): self
    {
        return new self([
            'id' => $id,
            'from' => $from,
            'query' => $query,
            'offset' => $offset,
        ]);
    }
}