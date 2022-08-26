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
     * @param User $traveler User that triggered the alert
     * @param User $watcher User that set the alert
     * @param int $distance The distance between the users
     */
    public function __construct(
        public User $traveler,
        public User $watcher,
        public int $distance,
    )
    {

    }

    public static function makeByArray(array $data): self
    {
        return new self(
            traveler: User::makeByArray($data['traveler']),
            watcher: User::makeByArray($data['watcher']),
            distance: $data['distance'],
        );
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
