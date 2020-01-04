<?php declare(strict_types=1);

namespace TelegramBotsApi\Types;

use TelegramBotsApi;
use TelegramBotsApi\Exceptions\Error;

/**
 * This object represents an incoming inline query. When the user sends an empty query, your bot could return
 * some default or trending results.
 *
 * @package TelegramBotsApi
 * @author Maxim Kuvardin <maxim@kuvard.in>
 */
class InlineQuery implements TypeInterface
{
    /**
     * @var string Unique identifier for this query
     */
    public string $id;

    /**
     * @var User Sender
     */
    public User $from;

    /**
     * @var Location|null Sender location, only for bots that request user location
     */
    public ?Location $location = null;

    /**
     * @var string Text of the query (up to 512 characters)
     */
    public string $query;

    /**
     * @var string Offset of the results to be returned, can be controlled by the bot
     */
    public string $offset;

    /**
     * InlineQuery constructor.
     *
     * @param array $data
     * @throws Error
     * @throws Error
     */
    public function __construct(array $data)
    {
        $this->id = $data['id'];
        $this->from = $data['from'] instanceof User
            ? $data['from']
            : new User($data['from']);

        if (isset($data['location'])) {
            $this->location = $data['location'] instanceof Location
                ? $data['location']
                : new Location($data['location']);
        }

        $this->query = $data['query'];
        $this->offset = $data['offset'];
    }

    /**
     * @param string $id Unique identifier for this query
     * @param User $from Sender
     * @param string $query Text of the query (up to 512 characters)
     * @param string $offset Offset of the results to be returned, can be controlled by the bot
     * @return InlineQuery
     * @throws Error
     * @throws Error
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
}