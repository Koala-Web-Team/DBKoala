<?php


abstract class Factory
{

    protected $pdo;
    public function __construct(){
        $connect = new ConnectionFactory();
        $this->pdo = $connect->getPdo();
    }

    protected abstract function create_file (FileItem $item) : FileInterface;
    protected abstract function renderdata ($type,$result);
}
