<?php

declare(strict_types=1);

namespace Kuvardin\TelegramBotsApi\Exceptions;

use Exception;
use Kuvardin\TelegramBotsApi\Types\ResponseParameters;
use Throwable;

class TelegramBotsApiException extends Exception
{
    public ?ResponseParameters $parameters = null;

    public function __construct(
        int $code,
        string $message,
        ?ResponseParameters $parameters,
        Throwable $previous = null,
    )
    {
        parent::__construct($message, $code, $previous);
        $this->parameters = $parameters;
    }

    public function isMigrated(): bool
    {
        return $this->parameters !== null && $this->parameters->migrate_to_chat_id !== null;
    }

    public function isAntiflood(): bool
    {
        return $this->parameters !== null && $this->parameters->retry_after !== null;
    }
}