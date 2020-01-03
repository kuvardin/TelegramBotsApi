<?php declare(strict_types=1);

namespace TelegramBotsApi\Types;

use TelegramBotsApi;

/**
 * Contains information about the current status of a webhook.
 *
 * @package TelegramBotsApi
 * @author Maxim Kuvardin <maxim@kuvard.in>
 */
class WebhookInfo implements TypeInterface
{
    /**
     * @var string Webhook URL, may be empty if webhook is not set up
     */
    public string $url;

    /**
     * @var bool True, if a custom certificate was provided for webhook certificate checks
     */
    public bool $has_custom_certificate;

    /**
     * @var int Number of updates awaiting delivery
     */
    public int $pending_update_count;

    /**
     * @var int|null Unix time for the most recent error that happened when trying to deliver an update
     * via webhook
     */
    public ?int $last_error_date;

    /**
     * @var string|null Error message in human-readable format for the most recent error that happened when
     * trying to deliver an update via webhook
     */
    public ?string $last_error_message;

    /**
     * @var int|null Maximum allowed number of simultaneous HTTPS connections to the webhook for update delivery
     */
    public ?int $max_connections;

    /**
     * @var string[]|null A list of update types the bot is subscribed to. Defaults to all update types
     */
    public ?array $allowed_updates;

    /**
     * WebhookInfo constructor.
     *
     * @param array $data
     */
    public function __construct(array $data)
    {
        $this->url = $data['url'];
        $this->has_custom_certificate = $data['has_custom_certificate'];
        $this->pending_update_count = $data['pending_update_count'];

        if (isset($data['last_error_date'])) {
            $this->last_error_date = $data['last_error_date'];
        }

        if (isset($data['last_error_message'])) {
            $this->last_error_message = $data['last_error_message'];
        }

        if (isset($data['max_connections'])) {
            $this->max_connections = $data['max_connections'];
        }

        if (isset($data['allowed_updates'])) {
            foreach ($data['allowed_updates'] as $item) {
                $this->allowed_updates[] = $item;
            }
        }
    }

    /**
     * @param string $url Webhook URL, may be empty if webhook is not set up
     * @param bool $has_custom_certificate True, if a custom certificate was provided for webhook
     * certificate checks
     * @param int $pending_update_count Number of updates awaiting delivery
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
}