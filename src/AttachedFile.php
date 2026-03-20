<?php

declare(strict_types=1);

namespace Kuvardin\TelegramBotsApi;

class AttachedFile
{
    public function __construct(
        public readonly string $attach_name,
        public readonly string $file_path,
        public readonly ?string $filename = null,
    )
    {

    }
}