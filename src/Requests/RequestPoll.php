<?php

declare(strict_types=1);

namespace Kuvardin\TelegramBotsApi\Requests;

use GuzzleHttp\Exception\GuzzleException;
use Kuvardin\TelegramBotsApi\Exceptions\TelegramBotsApiException;
use Kuvardin\TelegramBotsApi\Request;
use Kuvardin\TelegramBotsApi\Types\Poll;

/**
 * In response to this request, Poll object will be received.
 *
 * @author Maxim Kuvardin <maxim@kuvard.in>
 */
class RequestPoll extends Request
{
    /**
     * @throws GuzzleException
     * @throws TelegramBotsApiException
     */
    public function sendRequest(int $attempts = 1): Poll
    {
        return Poll::makeByArray($this->request($attempts));
    }
}