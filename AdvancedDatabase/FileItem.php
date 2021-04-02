<?php


class FileItem
{
    private $type;
    private $filePath;

    const TYPE_CSV = 'csv';

    public function __construct (string $type) {
        $this->type = $type;
    }

    public function getType (): string {
        return $this->type;
    }

    public function getFilePath (): string {
        return $this->filePath;
    }
}
