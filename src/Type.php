<?php

declare(strict_types=1);

namespace Kuvardin\TelegramBotsApi;

abstract class Type
{
    abstract public function getRequestData(): mixed;
}