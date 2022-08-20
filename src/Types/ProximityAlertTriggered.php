<?php

declare(strict_types=1);

namespace Kuvardin\TelegramBotsApi\Types;

use Kuvardin\TelegramBotsApi\Type;

/**
 * This object represents the content of a service message, sent whenever a user in the chat triggers a proximity alert
 * set by another user.
 *
 * @package Kuvardin\TelegramBotsApi
 * @author Maxim Kuvardin <maxim@kuvard.in>
 */
class ProximityAlertTriggered extends Type
{
    /**
     * @var User $traveler User that triggered the alert
     */
    public User $traveler;

    /**
     * @var User $watcher User that set the alert
     */
    public User $watcher;

    /**
     * @var int $distance The distance between the users
     */
    public int $distance;

    public static function makeByArray(array $data): self
    {
        $result = new self;
        $result->traveler = User::makeByArray($data['traveler']);
        $result->watcher = User::makeByArray($data['watcher']);
        $result->distance = $data['distance'];
        return $result;
    }

    public function getRequestData(): array
    {
        return [
            'traveler' => $this->traveler,
            'watcher' => $this->watcher,
            'distance' => $this->distance,
        ];
    }
}
