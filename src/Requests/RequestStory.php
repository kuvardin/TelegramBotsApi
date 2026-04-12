<?php

declare(strict_types=1);

namespace Kuvardin\TelegramBotsApi\Requests;

use Kuvardin\TelegramBotsApi\Request;
use Kuvardin\TelegramBotsApi\Types\Story;

/**
 * In response to this request, Story object will be received.
 *
 * @package Kuvardin\TelegramBotsApi
 * @author Maxim Kuvardin <maxim@kuvard.in>
 */
class RequestStory extends Request
{
    public function sendRequest(int $attempts = 1): Story
    {
        return Story::makeByArray($this->request($attempts));
    }
}