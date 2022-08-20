<?php

declare(strict_types=1);

namespace Kuvardin\TelegramBotsApi\Types;

use Kuvardin\TelegramBotsApi\Type;

/**
 * Contains information about the current status of a webhook.
 *
 * @package Kuvardin\TelegramBotsApi
 * @author Maxim Kuvardin <maxim@kuvard.in>
 */
class WebhookInfo extends Type
{
    /**
     * @var string $url Webhook URL, may be empty if webhook is not set up
     */
    public string $url;

    /**
     * @var bool $has_custom_certificate <em>True</em>, if a custom certificate was provided for webhook certificate
     *     checks
     */
    public bool $has_custom_certificate;

    /**
     * @var int $pending_update_count Number of updates awaiting delivery
     */
    public int $pending_update_count;

    /**
     * @var string|null $ip_address Currently used webhook IP address
     */
    public ?string $ip_address = null;

    /**
     * @var int|null $last_error_date Unix time for the most recent error that happened when trying to deliver an
     *     update via webhook
     */
    public ?int $last_error_date = null;

    /**
     * @var string|null $last_error_message Error message in human-readable format for the most recent error that
     *     happened when trying to deliver an update via webhook
     */
    public ?string $last_error_message = null;

    /**
     * @var int|null $last_synchronization_error_date Unix time of the most recent error that happened when trying to
     *     synchronize available updates with Telegram datacenters
     */
    public ?int $last_synchronization_error_date = null;

    /**
     * @var int|null $max_connections Maximum allowed number of simultaneous HTTPS connections to the webhook for
     *     update delivery
     */
    public ?int $max_connections = null;

    /**
     * @var string[]|null $allowed_updates A list of update types the bot is subscribed to. Defaults to all update
     *     types except <em>chat_member</em>
     */
    public ?array $allowed_updates = null;

    public static function makeByArray(array $data): self
    {
        $result = new self;
        $result->url = $data['url'];
        $result->has_custom_certificate = $data['has_custom_certificate'];
        $result->pending_update_count = $data['pending_update_count'];
        $result->ip_address = $data['ip_address'] ?? null;
        $result->last_error_date = $data['last_error_date'] ?? null;
        $result->last_error_message = $data['last_error_message'] ?? null;
        $result->last_synchronization_error_date = $data['last_synchronization_error_date'] ?? null;
        $result->max_connections = $data['max_connections'] ?? null;
        $result->allowed_updates = $data['allowed_updates'] ?? null;
        return $result;
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
