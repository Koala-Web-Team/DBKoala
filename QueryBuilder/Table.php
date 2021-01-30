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
    private static $orderBy;



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

    public function delete($id = null){

        if( self::$state == null ) {
            if($id) {
                $this->queryValues[] = $id;
                $this->query = "delete from $this->table where id = ?";
            }
            else {
                $this->query = 'delete from ' . $this->table;
            }
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


    public function select( $columns = ['*'] ){

        $columns_implode = implode(',',$columns);

        self::$select = true;

        if( self::$state == null ) {
            $this->query = 'select ' . $columns_implode . ' from ' . $this->table;
        }
        else {
            $this->query = 'select '.$columns_implode.' from '.$this->table." ".$this->query;
        }
        return $this;
    }

    public function distinct( $columns = ['*'] ){

        $columns_implode = implode(',',$columns);

        self::$select = true;

        if( self::$state == null ) {
            $this->query = 'select distinct ' . $columns_implode . ' from ' . $this->table;
        }
        else {
            $this->query = 'select distinct '.$columns_implode.' from '.$this->table." ".$this->query;
        }
        return $this;
    }

    public function where( $column,$value = null,$operator = '=' ,$linker = 'and'){

        $this->queryValues[] = $value;
        $c = 1;
        $impArray = [];

        if( self::$state == null ) {
            self::$state = 'called';
            if(is_array($column))
            {
                foreach($column as $key => $val) {
                    $count = count($val);
                    $first = $val[0];
                    $second = $val[1];
                    $last = $val[2];

                    if (count($column) != $c) {
                        $linker = 'and ';
                    } else {
                        $linker = ' ';
                    }
                    $this->queryValues[] = $last;
                    $c++;
                    array_push($impArray , ...array($first, $second, '?', $linker));
                }
                $this->query .= "where ".implode(' ', $impArray);
            }
            else {
                $this->query .= " where $column $operator ?";
            }
        }
        else {
            if(is_array($column))
            {
                foreach($column as $key => $val) {
                    $count = count($val);
                    $first = $val[0];
                    $second = $val[1];
                    $last = $val[2];

                    if (count($column) != $c) {
                        $linker = 'and ';
                    } else {
                        $linker = ' ';
                    }
                    $this->queryValues[] = $last;
                    $c++;
                    array_push($impArray , ...array($first, $second, '?', $linker));
                }
                $this->query .= " and ".implode(' ', $impArray);
            }
            else {
                $this->query .= " $linker $column $operator ?";
            }
        }
        return $this;
    }

    public function orWhere( $column,$value ,$operator = '=' ){
        $this->queryValues[] = $value;
        $this->where($column,$value,$operator,'or');
        return $this;
    }

    public function whereBetween( $column,$values = [] ,$linker = 'and',$not = false){

        array_push($this->queryValues , ...$values);

        $bind_params = implode(' and ',$this->arrayMap(function($key,$value){return "?";},$values));

        $type = $not ? 'not between' : 'between';

        if( self::$state == null ) {
            self::$state = 'called';
            $this->query .= " where $column $type $bind_params";
        }
        else {
            $this->query .= " $linker $column $type $bind_params";
        }
        return $this;
    }

    public function orWhereBetween( $column,$values = [] ){
        $this->whereBetween($column,$values,'or');
        return $this;
    }

    public function whereNotBetween( $column,$values = [],$linker = 'and' ){
        $this->whereBetween($column,$values,'and',true);
        return $this;
    }

    public function orWhereNotBetween( $column,$values = [] ){
        $this->whereBetween($column,$values,'or',true);
        return $this;
    }


    public function whereIn( $column,$values = [],$linker = 'and',$not = false ){

        array_push($this->queryValues , ...$values);

        $bind_params = implode(',',$this->arrayMap(function($key,$value){return "?";},$values));

        $type = $not ? 'not in' : 'in';

        if( self::$state == null ) {
            self::$state = 'called';
            $this->query .= " where $column $type ($bind_params)";
        }
        else {
            $this->query .= " $linker $column $type ($bind_params)";
        }
        return $this;
    }

    public function orWhereIn( $column,$values = [] ){
        $this->whereIn($column,$values,'or');
        return $this;
    }

    public function whereNotIn( $column,$values = [],$linker = 'and' ){
        $this->whereIn($column,$values,'and',true);
        return $this;
    }

    public function orWhereNotIn( $column,$values = [] ){
        $this->whereIn($column,$values,'or',true);
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
        $this->whereColumn($firstColumn,$secondColumn,'or');
        return $this;
    }

    public function whereNull($column,$linker = 'and',$not = true){

        $type = $not ? 'not null' : 'null';
        if( self::$state == null ) {
            self::$state = 'called';
            $this->query .= " where $column $type";
        }
        else {
            $this->query .= " $linker $column $type";
        }
        return $this;
    }

    public function whereNotNull($column,$linker = 'and'){
        $this->whereNull($column,'and',true);
        return $this;
    }


    public function orWhereNull( $column ){
        $this->whereNull($column,'or');
        return $this;
    }


    public function orWhereNotNull( $column ){
        $this->whereNull($column,'or',true);
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
        $this->whereDate($column,$value,$operator,'or');
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
        $this->whereTime($column,$value,$operator,'or');
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
        $this->whereMonth($column,$value,$operator,'or');
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
        $this->whereYear($column,$value,$operator,'or');
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
        $this->whereDay($column,$value,$operator,'or');
        return $this;
    }

    public function exists(){
        if ( count($this->get()) > 0 ) {
            return true;
        }
        return false;
    }

    public function doesntExist(){
        return ! $this->exists();
    }

    public function count($column = '*'){
        self::$select = 'called';
        if( self::$state == null ) {
            $this->query = "select count($column)  from  $this->table";
        }
        else {
            $this->query = "select count($column) from $this->table $this->query";
        }
        return $this->aggregate();
    }

    public function max($column){
        self::$select = 'called';
        if( self::$state == null ) {
            $this->query = "select max($column)  from  $this->table";
        }
        else {
            $this->query = "select max($column) from $this->table $this->query";
        }
        return $this->aggregate();
    }

    public function min($column){
        self::$select = 'called';
        if( self::$state == null ) {
            $this->query = "select min($column)  from  $this->table";
        }
        else {
            $this->query = "select min($column) from $this->table $this->query";
        }
        return $this->aggregate();
    }

    public function avg($column){
        self::$select = 'called';
        if( self::$state == null ) {
            $this->query = "select avg($column)  from  $this->table";
        }
        else {
            $this->query = "select avg($column) from $this->table $this->query";
        }
        return $this->aggregate();
    }

    public function sum($column){
        self::$select = 'called';
        if( self::$state == null ) {
            $this->query = "select sum($column)  from  $this->table";
        }
        else {
            $this->query = "select sum($column) from $this->table $this->query";
        }
        return $this->aggregate();
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

        if($this->query == null) {
            throw new Exception('no query executed to be get');
        }
        else {
            if( self::$select == false) {
                $this->query = " select * from $this->table $this->query";
            }

            $stmt = $this->connection->prepare($this->query);
            $stmt->execute($this->queryValues);
            $result = $stmt->fetchAll();
            return $result;
        }
    }

    public function aggregate(){

        if($this->query == null) {
            throw new Exception('no query executed to be get');
        }
        else {
            if( self::$select == false) {
                $this->query = " select * from $this->table $this->query";
            }

            $stmt = $this->connection->prepare($this->query);
            $stmt->execute($this->queryValues);
            $result = $stmt->fetchColumn();
            return $result;
        }
    }

    public function first(){

        if($this->query == null) {
            throw new Exception('no query executed to be get');
        }
        else {
            if (self::$select == false) {
                $this->query = " select * from $this->table $this->query";
            }

            $stmt = $this->connection->prepare($this->query);
            $stmt->execute($this->queryValues);
            $result = $stmt->fetch(PDO::FETCH_OBJ);
            return $result;
        }
    }

    public  function orderBy($column , $filter='asc'){
        if( self::$orderBy == null ){
            self::$orderBy='called';
            $this->query.= " order by '$column'  $filter";
        }
        else{
            $this->query.= " , '$column' $filter ";
        }
            return $this;
    }
    
    
    public function latest($column='id'){
        return $this->orderBy($column, 'desc');
    }
        public function oldest($column='id'){
            return $this->orderBy($column, 'asc');
        }
    public function find($id){
        $result = $this->where('id',$id)->first();
        return $result;
    }

    public function all(){
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
