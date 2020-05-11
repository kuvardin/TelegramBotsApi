<?php

declare(strict_types=1);

namespace Kuvardin\TelegramBotsApi\Requests\Traits;

/**
 * Trait WebPagePreviewSendingEdit
 *
 * @package Kuvardin\TelegramBotsApi
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
