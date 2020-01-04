<?php declare(strict_types=1);

namespace TelegramBotsApi\Types;

use TelegramBotsApi;
use TelegramBotsApi\Username;

/**
 * This object represents a Telegram user or bot.
 *
 * @package TelegramBotsApi
 * @author Maxim Kuvardin <maxim@kuvard.in>
 */
class User implements TypeInterface
{
    public const URL_FORMAT = 'tg://user?id=%d';

    /**
     * @var int Unique identifier for this user or bot
     */
    public int $id;

    /**
     * @var bool True, if this user is a bot
     */
    public bool $is_bot;

    /**
     * @var string User‘s or bot’s first name
     */
    public string $first_name;

    /**
     * @var string|null User‘s or bot’s last name
     */
    public ?string $last_name = null;

    /**
     * @var Username|null User‘s or bot’s username
     */
    public ?Username $username = null;

    /**
     * @var string|null IETF language tag of the user's language
     */
    public ?string $language_code = null;

    /**
     * User constructor.
     *
     * @param array $data
     * @throws TelegramBotsApi\Exceptions\Error
     */
    public function __construct(array $data)
    {
        $this->id = $data['id'];
        $this->is_bot = $data['is_bot'];
        $this->first_name = $data['first_name'];

        if (isset($data['last_name'])) {
            $this->last_name = $data['last_name'];
        }

        if (isset($data['username'])) {
            $this->username = new Username($data['username']);
        }

        if (isset($data['language_code'])) {
            $this->language_code = $data['language_code'];
        }
    }

    /**
     * @param int $id Unique identifier for this user or bot
     * @param bool $is_bot True, if this user is a bot
     * @param string $first_name User‘s or bot’s first name
     * @return User
     * @throws TelegramBotsApi\Exceptions\Error
     */
    public static function make(int $id, bool $is_bot, string $first_name): self
    {
        return new self([
            'id' => $id,
            'is_bot' => $is_bot,
            'first_name' => $first_name,
        ]);
    }

    /**
     * Links tg://user?id=<user_id> can be used to mention a user by their ID without using a username.
     * Please note:
     * These links will work only if they are used inside an inline link. For example, they will not work,
     * when used in an inline keyboard button or in a message text.
     * These mentions are only guaranteed to work if the user has contacted the bot in the past, has sent a
     * callback query to the bot via inline button or is a member in the group where he was mentioned.
     *
     * @return string
     */
    public function getUrl(): string
    {
        return self::getUrlWithId($this->id);
    }

    /**
     * @param int $id
     * @return string
     */
    public static function getUrlWithId(int $id): string
    {
        return sprintf(self::URL_FORMAT, $id);
    }

    /**
     * @param bool $with_link
     * @param bool $use_username
     * @param string $parse_mode
     * @param string $url_format
     * @return string
     * @throws TelegramBotsApi\Exceptions\Error
     */
    public function getFullName(bool $with_link = false, bool $use_username = false, string $parse_mode = TelegramBotsApi\Bot::PARSE_MODE_DEFAULT, string $url_format = TelegramBotsApi\Username::URL_FORMAT_DEFAULT): string
    {
        $full_name = $this->first_name;
        if ($this->last_name !== null) {
            $full_name .= ' ' . $this->last_name;
        }

        $full_name = TelegramBotsApi\Bot::filterString($full_name, $parse_mode);

        if ($with_link) {
            $link = $use_username && $this->username !== null ? $this->username->getUrl($url_format) : self::getUrlWithId($this->id);
            return TelegramBotsApi\Bot::genLink($link, $full_name, $parse_mode);
        }

        return $full_name;
    }

    /**
     * @return array
     */
    public function getRequestArray(): array
    {
        return [
            'id' => $this->id,
            'is_bot' => $this->is_bot,
            'first_name' => $this->first_name,
            'last_name' => $this->last_name,
            'username' => $this->username->getShort(),
            'language_code' => $this->language_code,
        ];
    }
}