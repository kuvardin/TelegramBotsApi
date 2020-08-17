<?php

declare(strict_types=1);

namespace Kuvardin\TelegramBotsApi\Requests\Traits;

/**
 * Trait NotificationDisablingEdit
 *
 * @package Kuvardin\TelegramBotsApi
 */
trait NotificationDisablingEdit
{
    /**
     * @param bool $disable
     * @return $this
     */
    public function setNotificationDisabling(bool $disable): self
    {
        $this->params['disable_notification'] = $disable;
        return $this;
    }
}
