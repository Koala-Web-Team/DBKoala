<?php

require_once("koala/helper.php");


class Table
{
    use SqlCommands,Conditionals,RawQuery,Aggregates,Joins;

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

    public function groupByRaw( $sql ) {
        if( $this->groupby == null ) {
            $this->groupby = " GROUP BY " . $sql;
        }
        else{
            $this->groupby .= ", $sql ";
        }
        return $this;
    }

	/**
	 * TODO TBD
	 */
	public function get( $format = 'assoc' ) {

        $this->buildQuery();

        $stmt = $this->pdo->prepare($this->query);
        $stmt->execute($this->queryValues);

        if ( $format == "json" ) {
            $result = json_encode($stmt->fetchAll());
        } elseif ( $format == "object" ) {
            $result = $stmt->fetchAll(PDO::FETCH_OBJ);
        } elseif ( $format == "both" ) {
            $result = $stmt->fetchAll(PDO::FETCH_BOTH);
        } else {
            $result = $stmt->fetchAll();
        }

        return $result;
	}

    public function koalaSql( $format = 'assoc' ) {
        $this->buildQuery();
        return $this->query;
    }

	private function aggregate() {
        $this->buildQuery();
        $stmt = $this->pdo->prepare($this->query);
        $stmt->execute($this->queryValues);
        $result = $stmt->fetchColumn();
        return $result;
	}

	public function first() {

        $this->buildQuery();

        $stmt = $this->pdo->prepare($this->query);
        $stmt->execute($this->queryValues);
        $result = $stmt->fetch(PDO::FETCH_OBJ);
        return $result;
	}

	public function all() {
		return $this->get();
	}

	public function arrayMap( $callback, $array ) {
		$r = array();
		foreach ( $array as $key => $value ) {
			$r[$key] = $callback($key, $value);
		}
		return $r;
	}

	public function getTable() {
		return $this->table;
	}

	public function setTable( $table ) {
		$this->table = $table;
	}

	private function buildQuery(){
        $this->query = $this->where." ".$this->groupby." ".$this->having;

        if ( $this->selectIsCalled == false ) {
            $this->select = "SELECT *";
        }

        if( $this->from != null ){
            $this->select .= $this->from;
        }
        else {
            if($this->wheregroup == false) {
                $this->select .= " FROM $this->table";
            }
        }

        if( $this->join != null ) {
            $this->query = " $this->select $this->join $this->query";
        }
        else{
            if( $this->update != null ){
                $this->query = "$this->update $this->query";
            }
            elseif( $this->delete != null ){
                $this->query = "$this->delete $this->query";
            }
            else{
                $this->query = " $this->select $this->query";
            }
        }

        $this->query .= $this->orderBy." ".$this->take." ".$this->offset;

        if( $this->union != null ){
            $this->query = "(".$this->query.")".$this->union;
        }

    }
}
