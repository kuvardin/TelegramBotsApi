<?php

declare(strict_types=1);

namespace Kuvardin\TelegramBotsApi\Types;

use JetBrains\PhpStorm\Deprecated;

/**
 * Renamed to AreaPosition, because it is now also used to describe the position of stickers on TON wallet cards.
 *
 * @package Kuvardin\TelegramBotsApi
 * @author Maxim Kuvardin <maxim@kuvard.in>
 */
#[Deprecated] class StoryAreaPosition extends AreaPosition
{

}
