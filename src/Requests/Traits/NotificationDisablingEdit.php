<?php declare(strict_types=1);

namespace TelegramBotsApi\Requests\Traits;

/**
 * Trait NotificationDisablingEdit
 *
 * @package TelegramBotsApi\Requests\Traits
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