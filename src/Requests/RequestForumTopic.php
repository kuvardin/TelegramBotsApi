<?php

declare(strict_types=1);

namespace Kuvardin\TelegramBotsApi\Requests;

use Kuvardin\TelegramBotsApi\Request;
use Kuvardin\TelegramBotsApi\Types\ForumTopic;

/**
 * In response to this request, ForumTopic object will be received.
 *
 * @package Kuvardin\TelegramBotsApi
 * @author Maxim Kuvardin <maxim@kuvard.in>
 */
class RequestForumTopic extends Request
{
    public function sendRequest(int $attempts = 1): ForumTopic
    {
        return ForumTopic::makeByArray($this->request($attempts));
    }
}