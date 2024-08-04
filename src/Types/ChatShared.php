<?php

declare(strict_types=1);

namespace Kuvardin\TelegramBotsApi\Types;

use Kuvardin\TelegramBotsApi\Type;
use Kuvardin\TelegramBotsApi\Username;

/**
 * This object contains information about a chat that was shared with the bot using a KeyboardButtonRequestChat button.
 *
 * @package Kuvardin\TelegramBotsApi
 * @author Maxim Kuvardin <maxim@kuvard.in>
 */
class ChatShared extends Type
{
    /**
     * @param int $request_id Identifier of the request
     * @param int $chat_id Identifier of the shared chat. This number may have more than 32 significant bits and some
     *     programming languages may have difficulty/silent defects in interpreting it. But it has at most 52
     *     significant bits, so a 64-bit integer or double-precision float type are safe for storing this identifier.
     *     The bot may not have access to the chat and could be unable to use this identifier, unless the chat is
     *     already known to the bot by some other means.
     * @param string|null $title Title of the chat, if the title was requested by the bot.
     * @param Username|null $username Username of the chat, if the username was requested by the bot and available.
     * @param PhotoSize[]|null $photo Available sizes of the chat photo, if the photo was requested by the bot
     */
    public function __construct(
        public int $request_id,
        public int $chat_id,
        public ?string $title = null,
        public ?Username $username = null,
        public ?array $photo = null,
    )
    {

    }

    public static function makeByArray(array $data): self
    {
        return new self(
            request_id: $data['request_id'],
            chat_id: $data['chat_id'],
            title: $data['title'] ?? null,
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
            'request_id' => $this->request_id,
            'chat_id' => $this->chat_id,
            'title' => $this->title,
            'username' => $this->username?->getShort(),
            'photo' => $this->photo,
        ];
    }
}
