<?php

namespace TelegramBotsApi;

/**
 * Class Username
 * @package TelegramBotsApi
 * @author Maxim Kuvardin <kuvard.in@mail.ru>
 */
class Username
{
    public const URL_FORMAT_T_ME = 'https://t.me/%s';
    public const URL_FORMAT_T_DO_RU = 'https://t-do.ru/%s';
    public const URL_FORMAT_TLGG_RU = 'https://tlgg.ru/%s';
    public const URL_FORMAT_TELEG_RUN = 'https://teleg.run/%s';
    public const URL_FORMAT_TELE_CLICK = 'https://tele.click/%s';
    public const URL_FORMAT_DEFAULT = self::URL_FORMAT_T_ME;

    /**
     * @var string
     */
    private $username;

    /**
     * Username constructor.
     * @param $username
     */
    public function __construct($username)
    {
        $this->username = ltrim($username, '@');
    }

    /**
     * @return string
     */
    public function getLower(): string
    {
        return strtolower($this->username);
    }

    /**
     * @return string
     */
    public function getUpper(): string
    {
        return strtoupper($this->username);
    }

    /**
     * @return string
     */
    public function getShort(): string
    {
        return $this->username;
    }

    /**
     * @return string
     */
    public function getFull(): string
    {
        return '@' . $this->username;
    }

    /**
     * @param string $url_format
     * @return string
     */
    public function getUrl(string $url_format = self::URL_FORMAT_DEFAULT): string
    {
        return sprintf($url_format, $this->username);
    }
}