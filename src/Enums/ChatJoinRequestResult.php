<?php

declare(strict_types=1);

namespace Kuvardin\TelegramBotsApi\Enums;

/**
 * Result of the chat join request query
 *
 * @package Kuvardin\TelegramBotsApi
 * @author Maxim Kuvardin <maxim@kuvard.in>
 */
enum ChatJoinRequestResult: string
{
    /**
     * Allow the user to join the chat
     */
    case Approve = 'approve';

    /**
     * Disallow the user to join the chat
     */
    case Decline = 'decline';

    /**
     * Leave the decision to other administrators
     */
    case Queue = 'queue';
}