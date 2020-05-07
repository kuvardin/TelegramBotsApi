<?php

declare(strict_types=1);

namespace TelegramBotsApi\Requests\Traits;

/**
 * Trait ParseModeEdit
 *
 * @package TelegramBotsApi\Requests\Traits
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
