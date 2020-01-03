<?php declare(strict_types=1);

namespace TelegramBotsApi\Requests\Traits;

/**
 * Trait WebPagePreviewSendingEdit
 *
 * @package TelegramBotsApi\Requests\Traits
 */
trait WebPagePreviewSendingEdit
{
    /**
     * @param bool $enable
     * @return $this
     */
    public function setWebPagePreviewSending(bool $enable): self
    {
        $this->params['disable_web_page_preview'] = !$enable;
        return $this;
    }
}