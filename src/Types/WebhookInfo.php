<?php

namespace TelegramBotsApi\Types;

use \TelegramBotsApi;
use \TelegramBotsApi\Exceptions\Error;

/**
 * Contains information about the current status of a webhook.
 * @package TelegramBotsApi\Types
 * @author Maxim Kuvardin <kuvard.in@mail.ru>
 */
class WebhookInfo implements TypeInterface
{
    /**
     * @var string Webhook URL, may be empty if webhook is not set up
     */
    public $url;

    /**
     * @var bool True, if a custom certificate was provided for webhook certificate checks
     */
    public $has_custom_certificate;

    /**
     * @var int Number of updates awaiting delivery
     */
    public $pending_update_count;

    /**
     * @var int|null Unix time for the most recent error that happened when trying to deliver an update via webhook
     */
    public $last_error_date;

    /**
     * @var string|null Error message in human-readable format for the most recent error that happened when trying to deliver an update via webhook
     */
    public $last_error_message;

    /**
     * @var int|null Maximum allowed number of simultaneous HTTPS connections to the webhook for update delivery
     */
    public $max_connections;

    /**
     * @var string[]|null A list of update types the bot is subscribed to. Defaults to all update types
     */
    public $allowed_updates;

    /**
     * WebhookInfo constructor.
     * @param array $data
     */
    public function __construct(array $data)
    {
        $this->url = $data['url'];
        $this->has_custom_certificate = $data['has_custom_certificate'];
        $this->pending_update_count = $data['pending_update_count'];
        $this->last_error_date = $data['last_error_date'] ?? null;
        $this->last_error_message = $data['last_error_message'] ?? null;
        $this->max_connections = $data['max_connections'] ?? null;
        $this->allowed_updates = $data['allowed_updates'] ?? null;
    }

    /**
     * @return array
     */
    public function getRequestArray(): array
    {
        return [
            'url' => $this->url,
            'has_custom_certificate' => $this->has_custom_certificate,
            'pending_update_count' => $this->pending_update_count,
            'last_error_date' => $this->last_error_date,
            'last_error_message' => $this->last_error_message,
            'max_connections' => $this->max_connections,
            'allowed_updates' => $this->allowed_updates,
        ];
    }

    /**
     * @param string $url
     * @param bool $has_custom_certificate
     * @param int $pending_update_count
     * @return WebhookInfo
     */
    public static function make(string $url, bool $has_custom_certificate, int $pending_update_count): self
    {
        return new self([
            'url' => $url,
            'has_custom_certificate' => $has_custom_certificate,
            'pending_update_count' => $pending_update_count,
        ]);
    }
}