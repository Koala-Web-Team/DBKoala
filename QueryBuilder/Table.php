<?php

require_once("Connection/ConnectionFactory.php");

class Table
{
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

	public function create( $columns = [] ) {
		$keys = implode(', ', array_keys($columns));
		$values = array_values($columns);

		$bind_params = "";
		for ( $i = 0; $i < count($columns); $i++ ) {
			$bind_params .= "?";
			if ( count($columns) - $i > 1 ) {
				$bind_params .= ", ";
			}
		}

		$sql = "INSERT INTO $this->table ($keys) VALUES ($bind_params)";
		$stmt = $this->pdo->prepare($sql);
		$stmt->execute($values);
	}

	public function update( $columns = [], $id = null ) {
		$keys = implode(', ', $this->arrayMap(function ( $key, $value ) {
			return "$key = ?";
		}, $columns));

		$values = array_values($columns);

        array_unshift($this->queryValues, ...$values);

		if ( $id != null ) {
            $this->queryValues[] = $id;
			$this->query = "UPDATE $this->table SET $keys WHERE id = ?";
		}else{
		    $this->update = "UPDATE $this->table SET $keys";
		    $this->buildQuery();
        }
		$stmt = $this->pdo->prepare($this->query);
		$stmt->execute($this->queryValues);
	}

	public function delete( $id = null ) {
//		if ( $this->whereIsCalled ) {
//			$this->query = 'DELETE FROM' . $this->table . " " . $this->query;
//		} else {
//			$this->query = 'DELETE FROM ' . $this->table;
//			if ( $id ) {
//				$this->whereIsCalled = true;
//				$this->queryValues[] = $id;
//				$this->query .= " WHERE id = ?";
//			}
//		}
//		return $this;

        if ( $id != null ) {
            $this->queryValues[] = $id;
            $this->query = "DELETE FROM $this->table WHERE id = ?";
        }else{
            $this->delete = "DELETE FROM $this->table";
            $this->buildQuery();
        }
        $stmt = $this->pdo->prepare($this->query);
        $stmt->execute($this->queryValues);
	}

	public function truncate() {
		$this->query = "TRUNCATE TABLE $this->table";
        $stmt = $this->pdo->prepare($this->query);
        $stmt->execute();
	}

	public function select( $columns = ['*'] ) {
		$columns_implode = implode(',', $columns);
		$this->selectIsCalled = true;
		$this->select = 'SELECT ' . $columns_implode;
		return $this;
	}

	public function selectlang( $language, array $columns = [] ) {
		$columnsToFetch = [];

		if ( is_array($language) ) {
			foreach ( $language as $lang ) {
				$columnsToFetch = array_merge($columnsToFetch, $this->selectOneLang($lang, $columns));
			}
		} else {
			$columnsToFetch = $this->selectOneLang($language, $columns);
		}

		$columnsToFetch = implode(', ', $columnsToFetch);

		$this->selectIsCalled = true;
		$this->select = 'SELECT ' . $columnsToFetch;
		return $this;
	}

	private function selectOneLang( string $language, $columns ) {
		$tableColumns = $this->getTableColumns();
		$columnsToFetch = [];

		if ( count($columns) > 0 ) {
			foreach ( $columns as $column ) {
				if ( (array_search($column . '_' . $language, $tableColumns)) ) {
					$columnsToFetch[] = $column . '_' . $language;
				} else {
					$columnsToFetch[] = $column;
				}
			}
		} else {
			$columnsWithLang = [];
			foreach ( $tableColumns as $column ) {
				$columnsToFetch[] = $column;
				if ( strpos($column, '_' . $language) ) {
					$columnsWithLang[] = str_replace("_" . $language, "", $column);
				}
			}
			foreach ( $columnsToFetch as $column ) {
				foreach ( $columnsWithLang as $columnWithLang ) {
					if ( strpos($column, $columnWithLang . "_") && !strpos($column, $columnWithLang . "_" . $language) ) {
						$key = array_search($column, $columnsToFetch);
						unset($columnsToFetch[$key]);
						break;
					}
				}
			}
		}
		return $columnsToFetch;
	}

	public function selectExcept( array $columns ) {
		$tableColumns = $this->getTableColumns();

		/**
		 * TODO: TBD
		 */
		foreach ( $columns as $column ) {
			if ( ($key = array_search($column, $tableColumns)) != null ) {
				unset($tableColumns[$key]);
			}
		}

		$columns_implode = implode(', ', $tableColumns);
		$this->selectIsCalled = true;
		$this->select = 'SELECT ' . $columns_implode . $this->from;
		return $this;
	}

	private function getTableColumns() {
		$sql = 'SELECT COLUMN_NAME FROM `INFORMATION_SCHEMA`.`COLUMNS` WHERE `TABLE_SCHEMA`="' . $_ENV['DB_DATABASE'] . '" AND `TABLE_NAME`="' . $this->table . '"';
		$stmt = $this->pdo->prepare($sql);
		$stmt->execute();
		$result = $stmt->fetchAll();

		$table_columns = [];

		foreach ( $result as $res ) {
			$table_columns[] = $res['COLUMN_NAME'];
		}

		return $table_columns;
	}

	public function distinct( $columns = ['*'] ) {
		$columns_implode = implode(',', $columns);
		$this->selectIsCalled = true;
        $this->select = 'SELECT DISTINCT ' . $columns_implode;
		return $this;
	}

	public function where( $column, $value , $operator = '=', $linker = 'AND' , $wherecolumn = false) {
		if ( $this->whereIsCalled ) {
			$this->where .= " " . $linker . " ";
		} else {
			$this->whereIsCalled = true;
			$this->where = " WHERE ";
		}

		if ( is_array($column) ) {
			foreach ( $column as $i => $val ) {
				$columnName = $val[0];
				$columnsOperator = $val[1];
				$columnValue = $val[2];

				if ( count($column) != ($i + 1) ) {
					$linker = 'AND ';
				} else {
					$linker = '';
				}
				if($wherecolumn){
                    $this->where .= " $columnName $columnsOperator $columnValue $linker";
                }
				else {
                    $this->queryValues[] = $columnValue;
                    $this->where .= " $columnName $columnsOperator ? $linker";
                }
			}
		} else {
		    if($wherecolumn){
                $this->where .= " $column $operator $value";
            }
		    else{
                $this->queryValues[] = $value;
                $this->where .= " $column $operator ?";
            }
		}
		return $this;
	}

	public function orWhere( $column, $value, $operator = '=' ) {
		$this->where($column, $value, $operator, 'OR');
		return $this;
	}

	public function whereBetween( $column, $values = [], $linker = 'AND', $not = false ) {
		array_push($this->queryValues, ...$values);

		$bind_params = "";
		for ( $i = 0; $i < count($values); $i++ ) {
			$bind_params .= "?";
			if ( count($values) - $i > 1 ) {
				$bind_params .= " AND ";
			}
		}

		$type = $not ? 'NOT BETWEEN' : 'BETWEEN';

		if ( $this->whereIsCalled ) {
			$this->where .= " $linker $column $type $bind_params";
		} else {
			$this->whereIsCalled = true;
			$this->where = " WHERE $column $type $bind_params";
		}
		return $this;
	}

	public function orWhereBetween( $column, $values = [] ) {
		$this->whereBetween($column, $values, 'OR');
		return $this;
	}

	public function whereNotBetween( $column, $values = [], $linker = 'AND' ) {
		$this->whereBetween($column, $values, $linker, true);
		return $this;
	}

	public function orWhereNotBetween( $column, $values = [] ) {
		$this->whereBetween($column, $values, 'OR', true);
		return $this;
	}

	public function whereIn( $column, $values = [], $linker = 'AND', $not = false ) {
		array_push($this->queryValues, ...$values);

		$bind_params = implode(',', $this->arrayMap(function ( $key, $value ) {
			return "?";
		}, $values));

		$type = $not ? 'NOT IN' : 'IN';

		if ( $this->whereIsCalled ) {
			$this->where .= " $linker $column $type ($bind_params)";
		} else {
			$this->whereIsCalled = true;
			$this->where = " WHERE $column $type ($bind_params)";
		}
		return $this;
	}

	public function orWhereIn( $column, $values = [] ) {
		$this->whereIn($column, $values, 'OR');
		return $this;
	}

	public function whereNotIn( $column, $values = [], $linker = 'AND' ) {
		$this->whereIn($column, $values, $linker, true);
		return $this;
	}

	public function orWhereNotIn( $column, $values = [] ) {
		$this->whereIn($column, $values, 'OR', true);
		return $this;
	}

	public function whereColumn( $firstColumn, $secondColumn, $operator = '=' , $linker = 'AND' ) {
		$this->where($firstColumn , $secondColumn , $operator ,$linker , true);
		return $this;
	}

	public function orWhereColumn( $firstColumn, $secondColumn , $operator = '=' ) {
		$this->whereColumn($firstColumn, $secondColumn, $operator,'OR');
		return $this;
	}

	public function whereNull( $column, $linker = 'AND', $not = false ) {
		$type = $not ? 'IS NOT NULL' : 'IS NULL';
		if ( $this->whereIsCalled ) {
			$this->where .= " $linker $column $type";
		} else {
			$this->whereIsCalled = true;
			$this->where = " WHERE $column $type";
		}
		return $this;
	}

	public function whereNotNull( $column, $linker = 'AND' ) {
		$this->whereNull($column, $linker, true);
		return $this;
	}

	public function orWhereNull( $column ) {
		$this->whereNull($column, 'OR');
		return $this;
	}

	public function orWhereNotNull( $column ) {
		$this->whereNull($column, 'OR', true);
		return $this;
	}

	public function whereDate( $column, $value, $operator = '=', $linker = 'AND' ) {
		$this->queryValues[] = $value;

		if ( $this->whereIsCalled ) {
			$this->where .= " $linker DATE('$column') $operator ?";
		} else {
			$this->whereIsCalled = true;
			$this->where = " WHERE DATE('$column') $operator ?";
		}
		return $this;
	}

	public function orWhereDate( $column, $value, $operator = '=' ) {
		$this->whereDate($column, $value, $operator, 'OR');
		return $this;
	}

	public function whereTime( $column, $value, $operator = '=', $linker = 'AND' ) {
		$this->queryValues[] = $value;

		if ( $this->whereIsCalled ) {
			$this->where .= " $linker TIME('$column') $operator ?";
		} else {
			$this->whereIsCalled = true;
			$this->where = " WHERE TIME('$column') $operator ?";
		}
		return $this;
	}

	public function orWhereTime( $column, $value, $operator = '=' ) {
		$this->whereTime($column, $value, $operator, 'OR');
		return $this;
	}

	public function whereMonth( $column, $value, $operator = '=', $linker = 'AND' ) {
		$this->queryValues[] = $value;

		if ( $this->whereIsCalled ) {
			$this->where .= " $linker MONTH('$column') $operator ?";
		} else {
			$this->whereIsCalled = true;
			$this->where = " WHERE MONTH('$column') $operator ?";
		}
		return $this;
	}

	public function orWhereMonth( $column, $value, $operator = '=' ) {
		$this->whereMonth($column, $value, $operator, 'OR');
		return $this;
	}

	public function whereYear( $column, $value, $operator = '=', $linker = 'AND' ) {
		$this->queryValues[] = $value;

		if ( $this->whereIsCalled ) {
			$this->where .= " $linker YEAR('$column') $operator ?";
		} else {
			$this->whereIsCalled = true;
			$this->where = " WHERE YEAR('$column') $operator ?";
		}
		return $this;
	}

	public function orWhereYear( $column, $value, $operator = '=' ) {
		$this->whereYear($column, $value, $operator, 'OR');
		return $this;
	}

	public function whereDay( $column, $value, $operator = '=', $linker = 'AND' ) {
		$this->queryValues[] = $value;

		if ( $this->whereIsCalled ) {
			$this->where .= " $linker DAY('$column') $operator ?";
		} else {
			$this->whereIsCalled = true;
			$this->where = " WHERE DAY('$column') $operator ?";
		}
		return $this;
	}

	public function orWhereDay( $column, $value, $operator = '=' ) {
		$this->whereDay($column, $value, $operator, 'OR');
		return $this;
	}

	public function whereExists( callable $callback , $linker = 'AND' , $not = false){
        $query = new Table($this->table);
        call_user_func($callback, $query);
        $condition = $query->query;
        $type = $not ? 'NOT EXISTS' : 'EXISTS';
        if ( $this->whereIsCalled ) {
            $this->where .= " $linker $type($condition)";
        } else {
            $this->whereIsCalled = true;
            $this->where = " WHERE $type($condition)";
        }
        return $this;
    }

    public function whereNotExists( callable $callback , $linker = 'AND'){
        $this->whereExists($callback , $linker , true);
        return $this;
    }

    public function orWhereExists( callable $callback ){
        $this->whereExists($callback ,'OR');
        return $this;
    }

    public function orWhereNotExists( callable $callback ){
        $this->whereExists($callback , 'OR' , true);
        return $this;
    }


    public function whereSub(callable $callback , $operator = '=' , $value = null ,$column = null , $linker = 'AND'){
	    $query = new Table($this->table);
        call_user_func($callback, $query);
        $subquery = $query->query;
        if ( $this->whereIsCalled ) {
            $this->where .= " " . $linker . " ";
        } else {
            $this->whereIsCalled = true;
            $this->where = " WHERE ";
        }

        if( $column == null ) {
            $this->queryValues[] = $value;
            $this->where .= "($subquery) $operator ?";
        }
        else{
            $this->where .= "($subquery) $operator $column";
        }
        return $this;
    }

    public function orWhereSub(callable $callback , $operator = '=' , $value = null ,$column = null){
        $this->whereSub($callback,$operator,$value,$column,'OR');
        return $this;
    }

    public function whereGroup( callable $callback , $linker = 'AND' ){
        $query = new Table($this->table);
        $query->selectIsCalled = true;
        $query->wheregroup = true;
        call_user_func($callback, $query);
        $wheres = $query->query;
        if ( $this->whereIsCalled ) {
            $this->where .= " $linker ($wheres)";
        } else {
            $this->whereIsCalled = true;
            $this->where = " WHERE ($wheres)";
        }
        return $this;
    }

    public function having( $column, $value = null, $operator = '=', $linker = 'and' ) {
        if ( $this->havingIsCalled ) {
            $this->having .= " ".$linker . " ";
        } else {
            $this->havingIsCalled = true;
            $this->having .= " HAVING " . " ";
        }

        $this->queryValues[] = $value;
        $this->having .= " $column $operator ?";

        return $this;
    }

    public function orHaving( $column, $value, $operator = '=' ) {
        $this->having($column, $value, $operator, 'OR');
        return $this;
    }

    public function havingBetween( $column, $values = [], $linker = 'AND', $not = false ) {
        array_push($this->queryValues, ...$values);

        $bind_params = "";
        for ( $i = 0; $i < count($values); $i++ ) {
            $bind_params .= "?";
            if ( count($values) - $i > 1 ) {
                $bind_params .= " AND ";
            }
        }

        $type = $not ? 'NOT BETWEEN' : 'BETWEEN';

        if ( $this->havingIsCalled ) {
            $this->having .= " $linker $column $type $bind_params";
        } else {
            $this->havingIsCalled = true;
            $this->having .= " HAVING $column $type $bind_params";
        }
        return $this;
    }

	public function exists() {
		return count($this->get()) > 0;
	}

	public function doesntExist() {
		return !$this->exists();
	}

	public function count( $column = '*' ) {
        $this->selectIsCalled = true;
        $this->select = "SELECT COUNT($column)";
		return $this->aggregate();
	}

	public function max( $column ) {
		return $this->SQLFunction("MAX", $column);
	}

	public function min( $column ) {
		return $this->SQLFunction("MIN", $column);
	}

	public function avg( $column ) {
		return $this->SQLFunction("AVG", $column);
	}

	public function sum( $column ) {
		return $this->SQLFunction("SUM", $column);
	}

	private function SQLFunction( $function, $column ) {
		$this->selectIsCalled = true;
        $this->select = "SELECT $function($column)";
		return $this->aggregate();
	}

	public function raw( $query ) {
		$this->query = $query;
		return $this;
	}

	public function selectRaw( $query ) {
		$this->selectIsCalled = true;
		$this->select = "SELECT $query";
		return $this;
	}

    public function whereRaw( $sql , $linker = 'AND' ) {
        if ( $this->whereIsCalled ) {
            $this->where .= $linker . " " . $sql;
        } else {
            $this->whereIsCalled = true;
            $this->where .= " WHERE " . " " . $sql;
        }
        return $this;
    }

    public function orWhereRaw( $sql ) {
        $this->whereRaw($sql , 'OR');
        return $this;
    }

    public function havingRaw( $sql , $linker = "AND") {
        if ( $this->havingIsCalled ) {
            $this->having .= $linker . " " . $sql;
        } else {
            $this->havingIsCalled = true;
            $this->having .= " HAVING " . " " . $sql;
        }
        return $this;
    }

    public function orHavingRaw( $sql ) {
	    $this->havingRaw($sql , 'OR');
        return $this;
    }

    public function orderByRaw( $sql ) {
        if ( $this->orderBy == null ) {
            $this->orderBy = " ORDER BY $sql";
        } else {
            $this->orderBy .= " , $sql ";
        }
        return $this;
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

    public function join( $table , $first , $second , $operator = "=" , $type = "INNER" ) {
	    $this->join = " $type JOIN $table ON $first $operator $second";
        return $this;
    }

    public function crossjoin( $table , $first , $second , $operator = "=" ) {
        $this->join($table , $first , $second , $operator , "CROSS");
        return $this;
    }

    public function innerjoin( $table , $first , $second , $operator = "=" ) {
        $this->join($table , $first , $second , $operator , "INNER");
        return $this;
    }

    public function leftjoin( $table , $first , $second , $operator = "=" ) {
        $this->join($table , $first , $second , $operator , "LEFT");
        return $this;
    }

    public function rightjoin( $table , $first , $second , $operator = "=" ) {
        $this->join($table , $first , $second , $operator , "RIGHT");
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
