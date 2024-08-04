<?php

declare(strict_types=1);

namespace Kuvardin\TelegramBotsApi\Types;

use Kuvardin\TelegramBotsApi\Type;
use Kuvardin\TelegramBotsApi\Username;

/**
 * This object contains information about a user that was shared with the bot using a KeyboardButtonRequestUsers button.
 *
 * @package Kuvardin\TelegramBotsApi
 * @author Maxim Kuvardin <maxim@kuvard.in>
 */
class SharedUser extends Type
{
    /**
     * @param int $user_id Identifier of the shared user. This number may have more than 32 significant bits and some
     *     programming languages may have difficulty/silent defects in interpreting it. But it has at most 52
     *     significant bits, so 64-bit integers or double-precision float types are safe for storing these identifiers.
     *     The bot may not have access to the user and could be unable to use this identifier, unless the user is
     *     already known to the bot by some other means.
     * @param string|null $first_name First name of the user, if the name was requested by the bot
     * @param string|null $last_name Last name of the user, if the name was requested by the bot
     * @param Username|null $username Username of the user, if the username was requested by the bot
     * @param PhotoSize[]|null $photo Available sizes of the chat photo, if the photo was requested by the bot
     */
    public function __construct(
        public int $user_id,
        public ?string $first_name = null,
        public ?string $last_name = null,
        public ?Username $username = null,
        public ?array $photo = null,
    )
    {

    }

    public static function makeByArray(array $data): self
    {
        return new self(
            user_id: $data['user_id'],
            first_name: $data['first_name'] ?? null,
            last_name: $data['last_name'] ?? null,
            username: empty($data['username']) ? null : new Username($data['username']),
            photo: isset($data['photo'])
                ? array_map(
                    static fn(array $photo_size_data) => PhotoSize::makeByArray($photo_size_data),
                    $data['photo'],
                )
                : null,
        );
    }

    public function getRequestData(): array
    {
        return [
            'user_id' => $this->user_id,
            'first_name' => $this->first_name,
            'last_name' => $this->last_name,
            'username' => $this->username?->getShort(),
            'photo' => $this->photo,
        ];
    }
}
