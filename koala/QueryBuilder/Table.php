<?php

require_once("koala/helper.php");


class Table
{
    use SqlCommands,Conditionals,RawQuery,Aggregates,Joins,KoalaBuilder;

	private $table;
	private $query;
	private $queryValues = [];
	private $whereIsCalled;
    private $havingIsCalled;
	private $select;
	private $join;
	private $selectIsCalled;
	private $orderBy;
	private $take;
	private $from;
	private $wheregroup;
	private $groupby;
	private $offset;
	private $union;
	private $pdo;
	private $where;
	private $update;
	private $delete;
	private $having;
	private $raw;

	public function __construct( $table ) {
		$connect = new ConnectionFactory();
		$this->pdo = $connect->getPdo();
		$this->table = $table;
	}


	public function exists() {
		return count($this->get()) > 0;
	}

	public function doesntExist() {
		return !$this->exists();
	}

	public function from( $table, $as = null ) {
		if ( $as != null ) {
			$this->from = " FROM $table AS $as";
		} else {
			$this->from = " FROM $table";
		}
		return $this;
	}

    public function fromSub( callable $callback, $as ) {
        $query = new Table($this->table);
        call_user_func($callback, $query);
        $subquery = $query->query;
        if ( $as != null ) {
            $this->from = " FROM ($subquery) AS $as";
        } else {
            $this->from = " FROM ($subquery)";
        }
        return $this;
    }

	public function orderBy( $column , $filter = "ASC" ) {
		if ( $this->orderBy == null ) {
			$this->orderBy = " ORDER BY $column $filter";
		} else {
			$this->orderBy .= " , $column $filter ";
		}
		return $this;
	}

	public function latest( $column = 'id' ) {
		return $this->orderBy($column, 'DESC');
	}

	public function oldest( $column = 'id' ) {
		return $this->orderBy($column, 'ASC');
	}

	public function find( $id ) {
		return $this->where('id', $id)->first();
	}

    public function limit( $value ) {
        $this->take = "LIMIT $value";
        return $this;
    }

    public function take( $value ) {
        $this->limit($value);
        return $this;
    }

    public function offset( $value ) {
        $this->offset = "OFFSET $value";
        return $this;
    }

    public function skip( $value ) {
        $this->offset($value);
        return $this;
    }

    public function union( $query , $all = null) {
        $this->union = " UNION$all ($query)";
        return $this;
    }

    public function unionall( $query ) {
        $this->union($query,'All');
        return $this;
    }

    public function chunk( $number, callable $callback) {
        $iteration = 1;
        do {
            $tempQuery = $this->query;
            $this->query .= " LIMIT " . ($iteration * $number) . ", " . $number;
            $result = $this->get();

            if ( empty($result) ) {
                break;
            }

            call_user_func($callback, $result);
            $this->query = $tempQuery;
            $iteration++;
        } while ( true );
    }

    public function groupBy( $columns ) {

	    if(is_array($columns)) {
            $columns_implode = implode(',', $columns);
            if($this->groupby == null){
                $this->groupby = " GROUP BY " . $columns_implode;
            }
            else{
                $this->groupby .= " , $columns_implode ";
            }
        }
	    else{
            $this->groupby = " GROUP BY " . $columns;
        }
        return $this;
    }

}
