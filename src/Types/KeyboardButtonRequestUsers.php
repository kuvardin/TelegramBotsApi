<?php

declare(strict_types=1);

namespace Kuvardin\TelegramBotsApi\Types;

use Kuvardin\TelegramBotsApi\Type;

/**
 * This object defines the criteria used to request suitable users. The identifiers of the selected users will be shared
 * with the bot when the corresponding button is pressed.
 *
 * @package Kuvardin\TelegramBotsApi
 * @author Maxim Kuvardin <maxim@kuvard.in>
 */
class KeyboardButtonRequestUsers extends Type
{
    /**
     * @param int $request_id Signed 32-bit identifier of the request that will be received back in the UsersShared
     *     object. Must be unique within the message
     * @param bool|null $user_is_bot Pass True to request bots, pass False to request regular users. If not specified,
     *     no additional restrictions are applied.
     * @param bool|null $user_is_premium Pass True to request premium users, pass False to request non-premium users.
     *     If not specified, no additional restrictions are applied.
     * @param int|null $max_quantity The maximum number of users to be selected; 1-10. Defaults to 1.
     * @param bool|null $request_name Pass True to request the users' first and last names
     * @param bool|null $request_username Pass True to request the users' usernames
     * @param bool|null $request_photo Pass True to request the users' photos
     */
    public function __construct(
        public int $request_id,
        public ?bool $user_is_bot = null,
        public ?bool $user_is_premium = null,
        public ?int $max_quantity = null,
        public ?bool $request_name = null,
        public ?bool $request_username = null,
        public ?bool $request_photo = null,
    )
    {

    }

    public static function makeByArray(array $data): self
    {
        return new self(
            request_id: $data['request_id'],
            user_is_bot: $data['user_is_bot'] ?? null,
            user_is_premium: $data['user_is_premium'] ?? null,
            max_quantity: $data['max_quantity'] ?? null,
            request_name: $data['request_name'] ?? null,
            request_username: $data['request_username'] ?? null,
            request_photo: $data['request_photo'] ?? null,
        );
    }

    public function getRequestData(): array
    {
        return [
            'request_id' => $this->request_id,
            'user_is_bot' => $this->user_is_bot,
            'user_is_premium' => $this->user_is_premium,
            'max_quantity' => $this->max_quantity,
            'request_name' => $this->request_name,
            'request_username' => $this->request_username,
            'request_photo' => $this->request_photo,
        ];
    }
}
