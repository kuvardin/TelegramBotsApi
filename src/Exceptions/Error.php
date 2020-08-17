<?php

declare(strict_types=1);

namespace Kuvardin\TelegramBotsApi\Exceptions;

use Throwable;

/**
 * Class Error
 *
 * @package Kuvardin\TelegramBotsApi\Exceptions
 * @author Maxim Kuvardin <maxim@kuvard.in>
 */
class Error extends \Error
{
    /**
     * Error constructor.
     *
     * @param string $message
     * @param int $code
     * @param Throwable|null $previous
     */
    public function __construct(string $message, int $code = 0, Throwable $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }
}
