<?php

require_once("Connection/ConnectionFactory.php");

class Table extends ConnectionFactory
{

    private $table;
    private $dbms;
    private $connection;
    private $query;
    private $queryValues = [];
    private static $state;
    private static $select;


//    TODO::list

//    array of conditions


    public function __construct( $table ){
        parent::__construct();
        $this->table = $table;
        $this->dbms = $this->setConnection();
        $this->connection = $this->dbms->createConnection();
    }


    public function create( $columns = [] ){

        $keys = implode(',',$this->arrayMap(function($key,$value){return "$key";},$columns));

        $values = implode(',',$this->arrayMap(function($key,$value){return "$value";},$columns));

        $bind_params = implode(',',$this->arrayMap(function($key,$value){return "?";},$columns));

        $array_value = explode(',',$values);

        $sql = "INSERT INTO $this->table ($keys) VALUES ($bind_params)";

        $stmt= $this->connection->prepare($sql);

        $stmt->execute($array_value);
        
    }

    public function update( $id , $columns = [] ){

        $keys = implode(',',$this->arrayMap(function($key,$value){return "$key = ?";},$columns));

        $values = implode(',',$this->arrayMap(function($key,$value){return "$value";},$columns));

        $array_value = explode(',',$values);

        $sql = "UPDATE $this->table SET $keys WHERE id = $id";

        $stmt= $this->connection->prepare($sql);

        $stmt->execute($array_value);
    }

    public function delete(){

        if( self::$state == null ) {
            $this->query = 'delete from '.$this->table;
        }
        else {
            $this->query = 'delete from '.$this->table." ".$this->query;
        }
        return $this;
    }

    public function truncate( $table ){

        if( $table ) {
            $this->query = "TRUNCATE TABLE $table";
        }
        else {
            $this->query = "TRUNCATE TABLE $this->table";
        }
        return $this;
    }


    public function select( $columns = [] ){

        $columns_implode = implode(',',$columns);

        self::$select = true;

        if( self::$state == null ) {
            if( count($columns) > 0 ) {
                $this->query = 'select ' . $columns_implode . ' from ' . $this->table;
            }
            else {
                $this->query = 'select * from ' . $this->table;
            }
        }
        else {
            if( count($columns) > 0 ) {
                $this->query = 'select '.$columns_implode.' from '.$this->table." ".$this->query;
            }
            else {
                $this->query = 'select * from '.$this->table." ".$this->query;
            }
        }
        return $this;
    }

    public function distinct( $columns = [] ){

        $columns_implode = implode(',',$columns);

        self::$select = true;

        if( self::$state == null ) {
            if(count($columns) > 0) {
                $this->query = 'select distinct' . $columns_implode . ' from ' . $this->table;
            }
            else {
                $this->query = 'select distinct * from ' . $this->table;
            }
        }
        else {
            if( count($columns) > 0 ) {
                $this->query = 'select distinct '.$columns_implode.' from '.$this->table." ".$this->query;
            }
            else {
                $this->query = 'select distinct * from '.$this->table." ".$this->query;
            }
        }
        return $this;
    }

    public function where( $column,$value,$operator = '=' ,$linker = 'and'){

        $this->queryValues[] = $value;

        if( self::$state == null ) {
            self::$state = 'called';

            $this->query .= " where $column $operator ?";
//
//            if(is_array($column))
//            {
//                $nestedwhere = null;
//                $c = 0;
//                foreach ($column as $col)
//                {
//                    $columns = implode(' ',$col);
//                    $nestedwhere .= " where $columns";
//                }
//
//                $this->query .= " where $nestedwhere";
//            }
//            else {
//                $this->query .= " where $column $operator ?";
//            }
        }
        else {
            $this->query .= " $linker $column $operator ?";
        }
        return $this;
    }

    public function orWhere( $column,$value ,$operator = '=' ){

        $this->queryValues[] = $value;

        if( self::$state == null ) {
            self::$state = 'called';
            $this->query .= " where $column $operator ?";
        }
        else {
            $this->query .= " or $column $operator ?";
        }
        return $this;
    }

    public function whereBetween( $column,$values = [] ,$linker = 'and'){

//        if(count($values) != 2)
//        {
//            throw new \http\Exception\InvalidArgumentException('2 values omly must be added to the array of values');
//        }
        array_push($this->queryValues , ...$values);

        $bind_params = implode(' and ',$this->arrayMap(function($key,$value){return "?";},$values));

        if( self::$state == null ) {
            self::$state = 'called';
            $this->query .= " where $column between $bind_params";
        }
        else {
            $this->query .= " $linker $column between $bind_params";
        }
        return $this;
    }

    public function orWhereBetween( $column,$values = [] ){

        array_push($this->queryValues , ...$values);

        $bind_params = implode(' and ',$this->arrayMap(function($key,$value){return "?";},$values));

        if( self::$state == null ) {
            self::$state = 'called';
            $this->query .= " where $column between $bind_params";
        }
        else {
            $this->query .= " or $column between $bind_params";
        }
        return $this;
    }

    public function whereNotBetween( $column,$values = [],$linker = 'and' ){

        array_push($this->queryValues , ...$values);

        $bind_params = implode(' and ',$this->arrayMap(function($key,$value){return "?";},$values));

        if( self::$state == null ) {
            self::$state = 'called';
            $this->query .= " where $column not between $bind_params";
        }
        else {
            $this->query .= " $linker $column not between $bind_params";
        }
        return $this;
    }

    public function orWhereNotBetween( $column,$values = [] ){

        array_push($this->queryValues , ...$values);

        $bind_params = implode(' and ',$this->arrayMap(function($key,$value){return "?";},$values));

        if( self::$state == null ) {
            self::$state = 'called';
            $this->query .= " where $column not between $bind_params";
        }
        else {
            $this->query .= " or $column not between $bind_params";
        }
        return $this;
    }


    public function whereIn( $column,$values = [],$linker = 'and' ){

        array_push($this->queryValues , ...$values);

        $bind_params = implode(',',$this->arrayMap(function($key,$value){return "?";},$values));

        if( self::$state == null ) {
            self::$state = 'called';
            $this->query .= " where $column in ($bind_params)";
        }
        else {
            $this->query .= " $linker $column in ($bind_params)";
        }
        return $this;
    }

    public function orWhereIn( $column,$values = [] ){

        array_push($this->queryValues , ...$values);

        $bind_params = implode(',',$this->arrayMap(function($key,$value){return "?";},$values));

        if( self::$state == null ) {
            self::$state = 'called';
            $this->query .= " where $column in ($bind_params)";
        }
        else {
            $this->query .= " or $column in ($bind_params)";
        }
        return $this;
    }

    public function whereNotIn( $column,$values = [],$linker = 'and' ){

        array_push($this->queryValues , ...$values);

        $bind_params = implode(',',$this->arrayMap(function($key,$value){return "?";},$values));

        if( self::$state == null ) {
            self::$state = 'called';
            $this->query .= " where $column not in ($bind_params)";
        }
        else {
            $this->query .= " $linker $column not in ($bind_params)";
        }
        return $this;
    }

    public function orWhereNotIn( $column,$values = [] ){

        array_push($this->queryValues , ...$values);

        $bind_params = implode(',',$this->arrayMap(function($key,$value){return "?";},$values));

        if( self::$state == null ) {
            self::$state = 'called';
            $this->query .= " where $column not in ($bind_params)";
        }
        else {
            $this->query .= " or $column not in ($bind_params)";
        }
        return $this;
    }

    public function whereColumn( $firstColumn,$secondColumn,$linker = 'and' ){

        if( self::$state == null ) {
            self::$state = 'called';
            $this->query .= " where $firstColumn = $secondColumn";
        }
        else {
            $this->query .= " $linker $firstColumn = $secondColumn";
        }
        return $this;
    }

    public function orWhereColumn( $firstColumn,$secondColumn){

        if( self::$state == null ) {
            self::$state = 'called';
            $this->query .= " where $firstColumn = $secondColumn";
        }
        else {
            $this->query .= " or $firstColumn = $secondColumn";
        }
        return $this;
    }

    public function whereNull($column,$linker = 'and'){
        if( self::$state == null ) {
            self::$state = 'called';
            $this->query .= " where $column is null";
        }
        else {
            $this->query .= " $linker $column is null";
        }
        return $this;
    }

    public function whereNotNull($column,$linker = 'and'){
        if( self::$state == null ) {
            self::$state = 'called';
            $this->query .= " where $column is not null";
        }
        else {
            $this->query .= " $linker $column is not null";
        }
        return $this;
    }


    public function orWhereNull( $column ){
        if( self::$state == null ) {
            self::$state = 'called';
            $this->query .= " where $column is null";
        }
        else {
            $this->query .= " or $column is null";
        }
        return $this;
    }


    public function orWhereNotNull( $column ){
        if( self::$state == null ) {
            self::$state = 'called';
            $this->query .= " where $column is not null";
        }
        else {
            $this->query .= " or $column is not null";
        }
        return $this;
    }

    public function whereDate( $column,$value ,$operator = '=',$linker = 'and'){

        $this->queryValues[] = $value;

        if( self::$state == null ) {
            self::$state = 'called';
            $this->query .= " where date('$column') $operator ?";
        }
        else {
            $this->query .= " $linker date('$column') $operator ?";
        }
        return $this;
    }

    public function orWhereDate( $column,$value ,$operator = '='){

        $this->queryValues[] = $value;

        if( self::$state == null ) {
            self::$state = 'called';
            $this->query .= " where date('$column') $operator ?";
        }
        else {
            $this->query .= " or date('$column') $operator ?";
        }
        return $this;
    }

    public function whereTime( $column,$value ,$operator = '=',$linker = 'and'){

        $this->queryValues[] = $value;

        if( self::$state == null ) {
            self::$state = 'called';
            $this->query .= " where time('$column') $operator ?";
        }
        else {
            $this->query .= " $linker time('$column') $operator ?";
        }
        return $this;
    }

    public function orWhereTime( $column,$value ,$operator = '='){

        $this->queryValues[] = $value;

        if( self::$state == null ) {
            self::$state = 'called';
            $this->query .= " where time('$column') $operator ?";
        }
        else {
            $this->query .= " or time('$column') $operator ?";
        }
        return $this;
    }

    public function whereMonth( $column,$value ,$operator = '=',$linker = 'and'){

        $this->queryValues[] = $value;

        if( self::$state == null ) {
            self::$state = 'called';
            $this->query .= " where month('$column') $operator ?";
        }
        else {
            $this->query .= " $linker month('$column') $operator ?";
        }
        return $this;
    }

    public function orWhereMonth( $column,$value ,$operator = '='){

        $this->queryValues[] = $value;

        if( self::$state == null ) {
            self::$state = 'called';
            $this->query .= " where month('$column') $operator ?";
        }
        else {
            $this->query .= " or month('$column') $operator ?";
        }
        return $this;
    }

    public function whereYear( $column,$value ,$operator = '=',$linker = 'and'){

        $this->queryValues[] = $value;

        if( self::$state == null ) {
            self::$state = 'called';
            $this->query .= " where year('$column') $operator ?";
        }
        else {
            $this->query .= " $linker year('$column') $operator ?";
        }
        return $this;
    }

    public function orWhereYear( $column,$value ,$operator = '='){

        $this->queryValues[] = $value;

        if( self::$state == null ) {
            self::$state = 'called';
            $this->query .= " where year('$column') $operator ?";
        }
        else {
            $this->query .= " or year('$column') $operator ?";
        }
        return $this;
    }

    public function whereDay( $column,$value ,$operator = '=',$linker = 'and'){

        $this->queryValues[] = $value;

        if( self::$state == null ) {
            self::$state = 'called';
            $this->query .= " where day('$column') $operator ?";
        }
        else {
            $this->query .= " $linker day('$column') $operator ?";
        }
        return $this;
    }

    public function orWhereDay( $column,$value ,$operator = '='){

        $this->queryValues[] = $value;

        if( self::$state == null ) {
            self::$state = 'called';
            $this->query .= " where day('$column') $operator ?";
        }
        else {
            $this->query .= " or day('$column') $operator ?";
        }
        return $this;
    }

	public function raw($CustomQuery){
		$this->query.= $CustomQuery;
		return $this;
	}

	public function selectRaw($CustomQuery){
		$this->query='select'." ".$CustomQuery." ".'from'." ".$this->table;
		return $this;
	}
    public function from( $table,$as ){

        if( $as ) {
            $this->query .= " from $table as $as";
        }
        else {
            $this->query .= " from $table";
        }
        return $this;
    }

    public function get(){

        if( self::$select == false) {
            $this->query = " select * from $this->table $this->query";
        }
        $stmt = $this->connection->prepare($this->query);
        $stmt->execute($this->queryValues);
        $result = $stmt->fetchAll();
        return $result;
    }

    public function first(){

        if( self::$select == false) {
            $this->query = " select * from $this->table $this->query";
        }

        $stmt = $this->connection->prepare($this->query);
        $stmt->execute($this->queryValues);
        $result = $stmt->fetch(PDO::FETCH_OBJ);
        return $result;
    }

    public function find($id){
        $result = $this->where('id',$id)->first();
        return $result;
    }

    public function all(){
        $this->query = "select * from $this->table";
        return $this->get();
    }


    public function arrayMap( $callback , $array ){
        $r = array();
        foreach ($array as $key=>$value) {
            $r[$key] = $callback($key, $value);
        }
        return $r;
    }

    public function getTable(){
        return $this->table;
    }

    public function setTable( $table ){
        $this->table = $table;
    }

}
