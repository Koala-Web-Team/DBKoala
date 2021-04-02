<?php


require_once("AdvancedDatabase/Factory.php");
require_once("AdvancedDatabase/FileItem.php");
require_once("AdvancedDatabase/CSVFile.php");

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

    public function renderdata($result,$type = null)
    {
        if($type == 'array')
        {
            echo 'render array' . ' '.$result;
        }
        else
        {
            echo 'render json' . ' '.$result;
        }
    }

    public function rfg($result,$type = null)
    {
        if($type == 'array')
        {
            echo 'render array' . ' '.$result;
        }
        else
        {
            echo 'render json' . ' '.$result;
        }
    }
}
