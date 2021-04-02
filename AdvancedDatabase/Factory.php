<?php


abstract class Factory extends ConnectionFactory
{

    public function __construct(){
        parent::__construct();
    }

    protected abstract function create_file (FileItem $item) : FileInterface;
    protected abstract function renderdata ($type,$result);
}
