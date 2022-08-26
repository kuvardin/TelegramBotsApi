<?php

declare(strict_types=1);

namespace Kuvardin\TelegramBotsApi;

/**
 * @package Kuvardin\TelegramBotsApi
 * @author Maxim Kuvardin <maxim@kuvard.in>
 */
class Username
{
    public const URL_FORMAT_DEFAULT = 'https://t.me/%s';
    public const URL_FORMAT_T_DO_RU = 'https://t-do.ru/%s';
    public const URL_FORMAT_TLGG_RU = 'https://tlgg.ru/%s';
    public const URL_FORMAT_TELEG_RUN = 'https://teleg.run/%s';
    public const URL_FORMAT_TELE_CLICK = 'https://tele.click/%s';

    protected string $value;

    public function __construct(string $value)
    {
        $this->value = ltrim($value, '@');
    }

    public static function checkValidity(string $value): bool
    {
        return !str_contains($value, '__') && preg_match('/^([a-zA-Z])(\w{4,31})$/', $value);
    }

    public function getLower(): string
    {
        return strtolower($this->value);
    }

    public function getUpper(): string
    {
        return strtoupper($this->value);
    }

    public function getShort(): string
    {
        return $this->value;
    }

    public function getFull(): string
    {
        return '@' . $this->value;
    }

    public function getUrl(string $url_format = null): string
    {
        return sprintf($url_format ?? self::URL_FORMAT_DEFAULT, $this->value);
    }
}