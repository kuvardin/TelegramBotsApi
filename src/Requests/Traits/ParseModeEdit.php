<?php

declare(strict_types=1);

namespace Kuvardin\TelegramBotsApi\Requests\Traits;

/**
 * Trait ParseModeEdit
 *
 * @package Kuvardin\TelegramBotsApi
*/
trait ParseModeEdit
{
    /**
     * @param string $parse_mode
     * @return $this
     */
    public function setParseMode(string $parse_mode): self
    {
        $this->params['parse_mode'] = $parse_mode;
        return $this;
    }
}
