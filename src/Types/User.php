<?php

declare(strict_types=1);

namespace Kuvardin\TelegramBotsApi\Types;

use Kuvardin\TelegramBotsApi\Type;
use Kuvardin\TelegramBotsApi\Username;

/**
 * This object represents a Telegram user or bot.
 *
 * @package Kuvardin\TelegramBotsApi
 * @author Maxim Kuvardin <maxim@kuvard.in>
 */
class User extends Type
{
    /**
     * @var int $id Unique identifier for this user or bot. This number may have more than 32 significant bits and some
     *     programming languages may have difficulty/silent defects in interpreting it. But it has at most 52
     *     significant bits, so a 64-bit integer or double-precision float type are safe for storing this identifier.
     */
    public int $id;

    /**
     * @var bool $is_bot <em>True</em>, if this user is a bot
     */
    public bool $is_bot;

    /**
     * @var string $first_name User's or bot's first name
     */
    public string $first_name;

    /**
     * @var string|null $last_name User's or bot's last name
     */
    public ?string $last_name = null;

    /**
     * @var Username|null $username User's or bot's username
     */
    public ?Username $username = null;

    /**
     * @var string|null $language_code <a href="https://en.wikipedia.org/wiki/IETF_language_tag">IETF language tag</a>
     *     of the user's language
     */
    public ?string $language_code = null;

    /**
     * @var bool|null $can_join_groups <em>True</em>, if the bot can be invited to groups. Returned only in <a
     *     href="https://core.telegram.org/bots/api#getme">getMe</a>.
     */
    public ?bool $can_join_groups = null;

    /**
     * @var bool|null $can_read_all_group_messages <em>True</em>, if <a
     *     href="https://core.telegram.org/bots#privacy-mode">privacy mode</a> is disabled for the bot. Returned only
     *     in <a href="https://core.telegram.org/bots/api#getme">getMe</a>.
     */
    public ?bool $can_read_all_group_messages = null;

    /**
     * @var bool|null $supports_inline_queries <em>True</em>, if the bot supports inline queries. Returned only in <a
     *     href="https://core.telegram.org/bots/api#getme">getMe</a>.
     */
    public ?bool $supports_inline_queries = null;

    public static function makeByArray(array $data): self
    {
        $result = new self;
        $result->id = $data['id'];
        $result->is_bot = $data['is_bot'];
        $result->first_name = $data['first_name'];
        $result->last_name = $data['last_name'] ?? null;
        $result->username = isset($data['username'])
            ? new Username($data['username'])
            : null;
        $result->language_code = $data['language_code'] ?? null;
        $result->can_join_groups = $data['can_join_groups'] ?? null;
        $result->can_read_all_group_messages = $data['can_read_all_group_messages'] ?? null;
        $result->supports_inline_queries = $data['supports_inline_queries'] ?? null;
        return $result;
    }

    public function getRequestData(): array
    {
        return [
            'id' => $this->id,
            'is_bot' => $this->is_bot,
            'first_name' => $this->first_name,
            'last_name' => $this->last_name,
            'username' => $this->username?->getShort(),
            'language_code' => $this->language_code,
            'can_join_groups' => $this->can_join_groups,
            'can_read_all_group_messages' => $this->can_read_all_group_messages,
            'supports_inline_queries' => $this->supports_inline_queries,
        ];
    }
}
