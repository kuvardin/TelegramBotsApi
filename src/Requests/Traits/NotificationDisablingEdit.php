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
     * @param bool $enable
     * @return $this
     */
    public function setNotificationDisabling(bool $enable): self
    {
        $this->params['disable_notification'] = $enable;
        return $this;
    }
}