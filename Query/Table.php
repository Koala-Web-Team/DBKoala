<?php

require_once("Connection/ConnectionFactory.php");

class Table extends ConnectionFactory
{

    private $table;
    private $dbms;
    private $connection;
    private $query;
    private static $state;

    public function __construct( $table ){
        parent::__construct();
        $this->table = $table;
        $this->dbms = $this->setConnection();
        $this->connection = $this->dbms->createConnection();
    }


    public function create( $columns = [] ){

        $keys = implode(',',$this->arraymap(function($key,$value){return "$key";},$columns));

        $values = implode(',',$this->arraymap(function($key,$value){return "$value";},$columns));

        $bind_params = implode(',',$this->arraymap(function($key,$value){return "?";},$columns));

        $array_value = explode(',',$values);

        $sql = "INSERT INTO $this->table ($keys) VALUES ($bind_params)";

        $stmt= $this->connection->prepare($sql);

        $stmt->execute($array_value);
        
    }

    public function update( $id , $columns = [] ){

        $keys = implode(',',$this->arraymap(function($key,$value){return "$key = ?";},$columns));

        $values = implode(',',$this->arraymap(function($key,$value){return "$value";},$columns));

        $array_value = explode(',',$values);

        $sql = "UPDATE $this->table SET $keys WHERE id = $id";

        $stmt= $this->connection->prepare($sql);

        $stmt->execute($array_value);
    }

    public function delete($id){
        $stmt = $this->connection->prepare("DELETE FROM $this->table WHERE id=$id");
        $stmt->execute();
    }

    public function select( $columns = [] ){
        $columns_implode = implode(',',$columns);
        $this->query = 'select '.$columns_implode.' from '.$this->table;
        return $this;
    }

    public function where( $column,$value , $operator = '='){

        if( self::$state == null ) {
            self::$state = 'called';
            $this->query .= " where $column $operator '$value'";
        }
        else {
            $this->query .= " and $column $operator '$value'";
        }
        return $this;
    }

    public function orWhere( $column,$value ){

        if( self::$state == null ) {
            self::$state = 'called';
            $this->query .= " where $column = '$value'";
        }
        else {
            $this->query .= " or $column = '$value'";
        }
        return $this;
    }

    public function whereBetween( $column,$values = [] ){

        $range = implode(' and ',$values);

        if( self::$state == null ) {
            self::$state = 'called';
            $this->query .= " where $column between $range";
        }
        else {
            $this->query .= " and $column between $range";
        }
        return $this;
    }

    public function orWhereBetween( $column,$values = [] ){

        $range = implode(' and ',$values);

        if( self::$state == null ) {
            self::$state = 'called';
            $this->query .= " where $column between $range";
        }
        else {
            $this->query .= " or $column between $range";
        }
        return $this;
    }

    public function whereNotBetween( $column,$values = [] ){

        $range = implode(' and ',$values);

        if( self::$state == null ) {
            self::$state = 'called';
            $this->query .= " where $column not between $range";
        }
        else {
            $this->query .= " and $column not between $range";
        }
        return $this;
    }

    public function orWhereNotBetween( $column,$values = [] ){

        $range = implode(' and ',$values);

        if( self::$state == null ) {
            self::$state = 'called';
            $this->query .= " where $column not between $range";
        }
        else {
            $this->query .= " or $column not between $range";
        }
        return $this;
    }

    public function get(){

        $stmt = $this->connection->prepare($this->query);
        $stmt->execute();
        $result = $stmt->fetchAll();
        return $result;
    }

    public function all(){
        $this->query = "select * from $this->table";
        return $this->get();
    }


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
