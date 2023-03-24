<?php

declare(strict_types=1);

namespace Kuvardin\TelegramBotsApi\Types;

use Kuvardin\TelegramBotsApi\Type;

/**
 * This object defines the criteria used to request a suitable user. The identifier of the selected user will be
 * shared with the bot when the corresponding button is pressed.<br><br>
 * <a href="https://core.telegram.org/bots/features#chat-and-user-selection">More about requesting users »</a>
 *
 * @package Kuvardin\TelegramBotsApi
 * @author Maxim Kuvardin <maxim@kuvard.in>
 */
class KeyboardButtonRequestUser extends Type
{
    /**
     * @param int $request_id Signed 32-bit identifier of the request, which will be received back in the
     *     UserShared object. Must be unique within the message
     * @param bool|null $user_is_bot Pass <em>True</em> to request a bot, pass <em>False</em> to request a regular user.
     *     If not specified, no additional restrictions are applied.
     * @param bool|null $user_is_premium Pass <em>True</em> to request a premium user, pass <em>False</em> to request
     *     a non-premium user. If not specified, no additional restrictions are applied.
     */
    public function __construct(
        public int $request_id,
        public ?bool $user_is_bot = null,
        public ?bool $user_is_premium = null,
    )
    {

    }

    public static function makeByArray(array $data): self
    {
        return new self(
            request_id: $data['request_id'],
            user_is_bot: $data['user_is_bot'] ?? null,
            user_is_premium: $data['user_is_premium'] ?? null,
        );
    }

    public function getRequestData(): array
    {
        return [
            'request_id' => $this->request_id,
            'user_is_bot' => $this->user_is_bot,
            'user_is_premium' => $this->user_is_premium,
        ];
    }
}
