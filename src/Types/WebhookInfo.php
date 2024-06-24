<?php

declare(strict_types=1);

namespace Kuvardin\TelegramBotsApi\Types;

use Kuvardin\TelegramBotsApi\Type;

/**
 * Describes the current status of a webhook.
 *
 * @package Kuvardin\TelegramBotsApi
 * @author Maxim Kuvardin <maxim@kuvard.in>
 */
class WebhookInfo extends Type
{
    /**
     * @param string $url Webhook URL, may be empty if webhook is not set up
     * @param bool $has_custom_certificate True, if a custom certificate was provided for webhook certificate
     *     checks
     * @param int $pending_update_count Number of updates awaiting delivery
     * @param string|null $ip_address Currently used webhook IP address
     * @param int|null $last_error_date Unix time for the most recent error that happened when trying to deliver an
     *     update via webhook
     * @param string|null $last_error_message Error message in human-readable format for the most recent error that
     *     happened when trying to deliver an update via webhook
     * @param int|null $last_synchronization_error_date Unix time of the most recent error that happened when trying to
     *     synchronize available updates with Telegram datacenters
     * @param int|null $max_connections Maximum allowed number of simultaneous HTTPS connections to the webhook for
     *     update delivery
     * @param string[]|null $allowed_updates A list of update types the bot is subscribed to. Defaults to all update
     *     types except chat_member
     */
    public function __construct(
        public string $url,
        public bool $has_custom_certificate,
        public int $pending_update_count,
        public ?string $ip_address = null,
        public ?int $last_error_date = null,
        public ?string $last_error_message = null,
        public ?int $last_synchronization_error_date = null,
        public ?int $max_connections = null,
        public ?array $allowed_updates = null,
    )
    {

    }

    public static function makeByArray(array $data): self
    {
        return new self(
            url: $data['url'],
            has_custom_certificate: $data['has_custom_certificate'],
            pending_update_count: $data['pending_update_count'],
            ip_address: $data['ip_address'] ?? null,
            last_error_date: $data['last_error_date'] ?? null,
            last_error_message: $data['last_error_message'] ?? null,
            last_synchronization_error_date: $data['last_synchronization_error_date'] ?? null,
            max_connections: $data['max_connections'] ?? null,
            allowed_updates: $data['allowed_updates'] ?? null,
        );
    }

    public function getRequestData(): array
    {
        return [
            'url' => $this->url,
            'has_custom_certificate' => $this->has_custom_certificate,
            'pending_update_count' => $this->pending_update_count,
            'ip_address' => $this->ip_address,
            'last_error_date' => $this->last_error_date,
            'last_error_message' => $this->last_error_message,
            'last_synchronization_error_date' => $this->last_synchronization_error_date,
            'max_connections' => $this->max_connections,
            'allowed_updates' => $this->allowed_updates,
        ];
    }
}
