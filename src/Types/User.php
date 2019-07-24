<?php

namespace TelegramBotsApi\Types;

use \TelegramBotsApi;
use \TelegramBotsApi\Exceptions\Error;

/**
 * Instance of this object represents a Telegram user or bot.
 *
 * @package TelegramBotsApi\Types
 * @author Maxim Kuvardin <kuvard.in@mail.ru>
 */
class User implements TypeInterface
{

    /**
     * @var int
     */
    public $id;

    /**
     * @var bool
     */
    public $is_bot;

    /**
     * @var string
     */
    public $first_name;

    /**
     * @var string|null
     */
    public $last_name;

    /**
     * @var \TelegramBotsApi\Username|null
     */
    public $username;

    /**
     * @var string|null
     */
    public $language_code;

    /**
     * User constructor.
     *
     * @param array $data
     */
    public function __construct(array $data)
    {
        $this->id = (int)$data['id'];
        $this->first_name = $data['first_name'];
        $this->last_name = $data['last_name'] ?? null;
        $this->username = !empty($data['username']) ? new \TelegramBotsApi\Username($data['username']) : null;
        $this->is_bot = $data['is_bot'];
        $this->language_code = $data['language_code'] ?? null;
    }

    /**
     * @return string
     */
    public function getUrl(): string
    {
        return self::getUrlWithId($this->id);
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
            'username' => $this->username,
            'language_code' => $this->language_code,
        ];
    }

    /**
     * @param bool $with_link
     * @param bool $use_username
     * @param string $parse_mode
     * @param string $url_format
     * @return string
     * @throws Error
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
     * @param int $id
     * @return string
     */
    public static function getUrlWithId(int $id): string
    {
        return 'tg://user?id=' . $id;
    }

    /**
     * @param int $id
     * @param string $first_name
     * @param bool $is_bot
     * @return User
     */
    public static function make(int $id, string $first_name, bool $is_bot): self
    {
        return new self([
            'id' => $id,
            'first_name' => $first_name,
            'is_bot' => $is_bot,
        ]);
    }

}