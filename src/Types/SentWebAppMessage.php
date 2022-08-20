<?php

declare(strict_types=1);

namespace Kuvardin\TelegramBotsApi\Types;

use Kuvardin\TelegramBotsApi\Type;

/**
 * Contains information about an inline message sent by a <a href="https://core.telegram.org/bots/webapps">Web App</a>
 * on behalf of a user.
 *
 * @package Kuvardin\TelegramBotsApi
 * @author Maxim Kuvardin <maxim@kuvard.in>
 */
class SentWebAppMessage extends Type
{
    /**
     * @var string|null $inline_message_id Identifier of the sent inline message. Available only if there is an <a
     *     href="https://core.telegram.org/bots/api#inlinekeyboardmarkup">inline keyboard</a> attached to the message.
     */
    public ?string $inline_message_id = null;

    public static function makeByArray(array $data): self
    {
        $result = new self;
        $result->inline_message_id = $data['inline_message_id'] ?? null;
        return $result;
    }

    public function getRequestData(): array
    {
        return [
            'inline_message_id' => $this->inline_message_id,
        ];
    }
}
