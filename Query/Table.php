<?php

require_once("Connection/ConnectionFactory.php");

class Table extends ConnectionFactory
{

    private $table;
    private $dbms;
    private $connection;

    public function __construct( $table ){
        parent::__construct();
        $this->table = $table;
        $this->dbms = $this->setConnection();
        $this->connection = $this->dbms->createConnection();
    }


    public function create( $columns = [] ){

//        foreach ( $columns as $key => $value ) {
//            if(!$this->columnexist($key)) {
//                throw new InvalidArgumentException('lkfds');
//            }
//        }

        $keys = implode(',',$this->arraymap(function($k,$v){return "$k";},$columns));

        $values = implode(',',$this->arraymap(function($k,$v){return "$v";},$columns));

        $array_value = explode(',',$values);

        $sql = "INSERT INTO users ($keys) VALUES (?,?,?)";

        $stmt= $this->connection->prepare($sql);

        $stmt->execute($array_value);
        
    }

    public function update( $id , $columns = [] ){

//        foreach ( $columns as $key => $value ) {
//            if(!$this->columnexist($key)) {
//                throw new \http\Exception\InvalidArgumentException('dkfjdnsfn');
//            }
//        }

        $keys = implode(',',$this->arraymap(function($k,$v){return "$k = ?";},$columns));

        $values = implode(',',$this->arraymap(function($k,$v){return "$v";},$columns));

        $array_value = explode(',',$values);

        $sql = "UPDATE users SET $keys WHERE id = $id";

        $stmt= $this->connection->prepare($sql);

        $stmt->execute($array_value);

    }

    public function delete($id){
        $stmt = $this->connection->prepare("DELETE FROM $this->table WHERE id=$id");
        $stmt->execute();
    }

    public function select( $columns = [] ){

        $columns_implode = implode(',',$columns);

        $stmt = $this->connection->prepare('select '.$columns_implode.' from '.$this->table);

        $stmt->execute();

        $result = $stmt->fetchAll();

        return $result;
    }

//    private function columnexist( $column ){
//
//        $count = $this->select([$column]);
//
//        if(count($count) > 0) {
//            return true;
//        }
//        else {
//            return false;
//        }
//
//    }

    public function arraymap( $callback , $array ){

        $r = array();

        foreach ($array as $key=>$value) {
            $r[$key] = $callback($key, $value);
        }

        return $r;
    }


    public function getTable(){
        return $this->table;
    }


    public function setTable($table){
        $this->table = $table;
    }

}
