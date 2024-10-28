<?php

declare(strict_types=1);

namespace Kuvardin\TelegramBotsApi;

use Kuvardin\TelegramBotsApi\Types\InputFile;
use RuntimeException;

class AttachedFiles
{
    /**
     * @var array<string, string>
     */
    protected array $attached_by_paths = [];

    public function attachByPath(
        string $file_path,
        string $attach_name = null,
    ): InputFile
    {
        if ($attach_name === null) {
            do {
                $attach_name = 'file' . rand(1, 9999999);
            } while (array_key_exists($attach_name, $this->attached_by_paths));
        } elseif (array_key_exists($attach_name, $this->attached_by_paths)) {
            throw new RuntimeException("File $attach_name already attached");
        }

        $this->attached_by_paths[$attach_name] = $file_path;
        return InputFile::makeByAttachName($attach_name);
    }

    public function attachToRequest(Request $request): void
    {
        foreach ($this->attached_by_paths as $attach_name => $file_path) {
            $request->attachFileByPath($attach_name, $file_path);
        }
    }
}