<?php

declare(strict_types=1);

namespace Kuvardin\TelegramBotsApi;

/**
 * @package Kuvardin\TelegramBotsApi
 * @author Maxim Kuvardin <maxim@kuvard.in>
 */
abstract class Type
{
    abstract public function getRequestData(): mixed;
}