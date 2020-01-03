<?php

namespace TelegramBotsApi\Exceptions;

use Exception;
use Throwable;

/**
 * Class CurlError
 *
 * @package TelegramBotsApi\Exceptions
 * @author Maxim Kuvardin <maxim@kuvard.in>
 */
class CurlError extends Exception
{
    public const STATUS_OK = 0;

    /**
     * CurlError constructor.
     *
     * @param int $code
     * @param string $message
     * @param Throwable|null $previous
     */
    public function __construct(int $code, string $message, Throwable $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }

    /**
     * @param $ch
     * @param Throwable|null $previous
     * @return static
     * @throws Error
     */
    public static function make($ch, Throwable $previous = null): self
    {
        $code = curl_errno($ch);
        if ($code === self::STATUS_OK) {
            throw new Error("Status $code is not error");
        }

        $message = curl_error($ch);
        curl_close($ch);
        return new self($code, $message, $previous);
    }

    /**
     * @return bool
     */
    public function isTimeout(): bool
    {
        return $this->code === CURLE_OPERATION_TIMEDOUT;
    }
}