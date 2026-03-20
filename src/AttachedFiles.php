<?php

declare(strict_types=1);

namespace Kuvardin\TelegramBotsApi;

use Kuvardin\TelegramBotsApi\Types\InputFile;
use RuntimeException;

class AttachedFiles
{
    /**
     * @var array<string, AttachedFile>
     */
    protected array $attached_files = [];

    public function attachByPath(
        string $file_path,
        ?string $attach_name = null,
        ?string $filename = null,
    ): InputFile
    {
        if ($attach_name === null) {
            do {
                $attach_name = 'file' . rand(1, 9999999);
            } while (array_key_exists($attach_name, $this->attached_files));
        } elseif (array_key_exists($attach_name, $this->attached_files)) {
            throw new RuntimeException("File $attach_name already attached");
        }

        $this->attached_files[$attach_name] = new AttachedFile($file_path, $filename, $attach_name);
        return InputFile::makeByAttachName($attach_name);
    }

    public function attachToRequest(Request $request): void
    {
        foreach ($this->attached_files as $attached_file) {
            $request->attachFileByPath(
                $attached_file->attach_name,
                $attached_file->file_path,
                $attached_file->filename,
            );
        }
    }
}