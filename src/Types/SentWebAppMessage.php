<?php

declare(strict_types=1);

namespace Kuvardin\TelegramBotsApi\Types;

use Kuvardin\TelegramBotsApi\Type;

/**
 * Describes an inline message sent by a Web App on behalf of a user.
 *
 * @package Kuvardin\TelegramBotsApi
 * @author Maxim Kuvardin <maxim@kuvard.in>
 */
class SentWebAppMessage extends Type
{
    /**
     * @param string|null $inline_message_id Identifier of the sent inline message. Available only if there is an <a
     *     href="https://core.telegram.org/bots/api#inlinekeyboardmarkup">inline keyboard</a> attached to the message.
     */
    public function __construct(
        public ?string $inline_message_id = null,
    )
    {

    }

    public static function makeByArray(array $data): self
    {
        return new self(
            inline_message_id: $data['inline_message_id'] ?? null,
        );
    }

    public function getRequestData(): array
    {
        return [
            'inline_message_id' => $this->inline_message_id,
        ];
    }
}
