<?php


require_once("koala/AdvancedDatabase/Factory.php");
require_once("koala/AdvancedDatabase/FileItem.php");
require_once("koala/AdvancedDatabase/CSVFile.php");

class FileFactory extends Factory {

    public function __construct(){
        parent::__construct();
    }

    public function create_file (FileItem $item) : FileInterface
    {
        switch ($item->getType()) {
            case FileItem::TYPE_CSV:
                return new CSVFile($this->pdo);
                break;
            default:
                throw new InvalidArgumentException("Wrong file type provided: {$item->getType()}");
                break;
        }
    }
}
