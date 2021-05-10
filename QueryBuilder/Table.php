<?php

require_once("Connection/ConnectionFactory.php");

class Table
{
	private $table;
	private $query;
	private $queryValues = [];
	private $whereIsCalled;
	private $select;
	private $selectIsCalled;
	private $orderBy;
	private $pdo;

	// TODO
	// exist
	// doesnt exist
	// absy tasks
	// updates

	public function __construct( $table ) {
		$connect = new ConnectionFactory();
		$this->pdo = $connect->getPdo();
		$this->table = $table;
	}

	public function create( $columns = [] ) {
		$keys = implode(', ', array_keys( $columns ) );
		$values = array_values( $columns );

		$bind_params = "";
		for ($i = 0; $i < count($columns); $i++) {
			$bind_params .= "?";
			if (count($columns) - $i > 1 ) {
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

		$values = array_values( $columns );

		$sql = "UPDATE $this->table SET $keys";
		if ($id != null) {
			$sql .= " WHERE id = $id";
		}
		$stmt = $this->pdo->prepare($sql);
		$stmt->execute($values);
	}

	public function delete( $id = null ) {
		if ( $this->whereIsCalled ) {
			$this->query = 'DELETE FROM' . $this->table . " " . $this->query;
		} else {
			$this->query = 'DELETE FROM ' . $this->table;
			if ( $id ) {
				$this->whereIsCalled = true;
				$this->queryValues[] = $id;
				$this->query .= " WHERE id = ?";
			}
		}
		return $this;
	}

	public function truncate() {
		$this->query = "TRUNCATE TABLE $this->table";
		return $this;
	}

	public function select( $columns = ['*'] ) {
		$columns_implode = implode(',', $columns);
		$this->selectIsCalled = true;
		$this->query = 'SELECT ' . $columns_implode . ' FROM ' . $this->table . " " . $this->query;
		return $this;
	}

	/**
	 * TODO TBD
	 */
	public function selectlang( $lang, $languages, $columns = [] ) {
		if ( !is_array($columns) ) {
			throw new Exception('dfdsfdf');
		}

		$sql = 'SELECT COLUMN_NAME FROM `INFORMATION_SCHEMA`.`COLUMNS` WHERE `TABLE_SCHEMA`="' . $_ENV['DB_DATABASE'] . '" AND `TABLE_NAME`="' . $this->table . '"';
		$stmt = $this->pdo->prepare($sql);
		$stmt->execute();
		$result = $stmt->fetchAll();

		$table_columns = [];
		$lang_columns = [];

		foreach ( $result as  $res ) {
			$table_columns[] = $res['COLUMN_NAME'];
		}

		/**
		 * TODO: TBD
		 */
		if ( count( $columns ) > 0 ) {
			foreach ( $columns as $column ) {
				if ( ( array_search($column . '_' . $lang, $table_columns) ) !== false ) {
					$lang_columns[] =  $column . '_' . $lang;
				} else {
					$lang_columns[] = $column;
				}
			}
		} else {
			foreach ( $table_columns as $column ) {
				foreach ( $languages as $lang ) {
					if ( strpos($column, '_' . $lang) == true || strpos($column, '_' . $lang) == false ) {
						$lang_columns[] = $column;
					}
				}
			}
		}

		$columns_implode = implode(', ', $lang_columns);
		$this->selectIsCalled = true;
		$this->query = 'SELECT ' . $columns_implode . ' FROM ' . $this->table . " " . $this->query;
		return $this;
	}

	public function selectExcept( $columns ) {
		if ( !is_array($columns) ) {
			throw new Exception('dfdsfdf');
		}

		$sql = 'SELECT COLUMN_NAME FROM `INFORMATION_SCHEMA`.`COLUMNS` WHERE `TABLE_SCHEMA`="' . $_ENV['DB_DATABASE'] . '" AND `TABLE_NAME`="' . $this->table . '"';
		$stmt = $this->pdo->prepare($sql);
		$stmt->execute();
		$result = $stmt->fetchAll();

		$table_columns = [];

		foreach ( $result as $res ) {
			$table_columns[] = $res['COLUMN_NAME'];
		}

		/**
		 * TODO: TBD
		 */
		foreach ( $columns as $column ) {
			if ( ($key = array_search($column, $table_columns)) !== false ) {
				unset($table_columns[$key]);
			}
		}

		$columns_implode = implode(', ', $table_columns);
		$this->selectIsCalled = true;
		$this->query = 'SELECT ' . $columns_implode . ' FROM ' . $this->table . " " . $this->query;
		return $this;
	}

	public function distinct( $columns = ['*'] ) {
		$columns_implode = implode(',', $columns);
		$this->selectIsCalled = true;
		$this->query = 'SELECT DISTINCT ' . $columns_implode . ' FROM ' . $this->table . " " . $this->query;
		return $this;
	}

	/**
	 * TODO TBD
	 */
	public function where( $column, $value = null, $operator = '=', $linker = 'AND' ) {
		$this->queryValues[] = $value;
		$impArray = [];

		/**
		 * TODO: TBD
		 */
		if ( !$this->whereIsCalled ) {
			$this->whereIsCalled = true;
			if ( is_array($column) ) {
				foreach ( $column as $i => $val ) {
					$first = $val[0];
					$second = $val[1];
					$last = $val[2];

					if ( count($column) != ($i + 1) ) {
						$linker = 'AND ';
					} else {
						$linker = ' ';
					}
					$this->queryValues[] = $last;
					array_push($impArray, ...array($first, $second, '?', $linker));
				}
				$this->query .= "WHERE " . implode(' ', $impArray);
			} else {
				$this->query .= " WHERE $column $operator ?";
			}
		} else {
			if ( is_array($column) ) {
				foreach ( $column as $i => $val ) {
					$first = $val[0];
					$second = $val[1];
					$last = $val[2];

					if ( count($column) != ($i + 1) ) {
						$linker = 'AND ';
					} else {
						$linker = ' ';
					}
					$this->queryValues[] = $last;
					array_push($impArray, ...array($first, $second, '?', $linker));
				}
				$this->query .= " AND " . implode(' ', $impArray);
			} else {
				$this->query .= " $linker $column $operator ?";
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
		for ($i = 0; $i < count($values); $i++) {
			$bind_params .= "?";
			if (count($values) - $i > 1 ) {
				$bind_params .= " AND ";
			}
		}

		$type = $not ? 'NOT BETWEEN' : 'BETWEEN';

		if ( $this->whereIsCalled ) {
			$this->query .= " $linker $column $type $bind_params";
		} else {
			$this->whereIsCalled = true;
			$this->query .= " WHERE $column $type $bind_params";
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
			$this->query .= " $linker $column $type ($bind_params)";
		} else {
			$this->whereIsCalled = true;
			$this->query .= " WHERE $column $type ($bind_params)";
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

	public function whereColumn( $firstColumn, $secondColumn, $linker = 'AND' ) {
		if ( $this->whereIsCalled ) {
			$this->query .= " $linker $firstColumn = $secondColumn";
		} else {
			$this->whereIsCalled = true;
			$this->query .= " WHERE $firstColumn = $secondColumn";
		}
		return $this;
	}

	public function orWhereColumn( $firstColumn, $secondColumn ) {
		$this->whereColumn($firstColumn, $secondColumn, 'OR');
		return $this;
	}

	public function whereNull( $column, $linker = 'AND', $not = false ) {
		$type = $not ? 'NOT NULL' : 'NULL';
		if ( $this->whereIsCalled ) {
			$this->query .= " $linker $column $type";
		} else {
			$this->whereIsCalled = true;
			$this->query .= " WHERE $column $type";
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
			$this->query .= " $linker DATE('$column') $operator ?";
		} else {
			$this->whereIsCalled = true;
			$this->query .= " WHERE DATE('$column') $operator ?";
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
			$this->query .= " $linker TIME('$column') $operator ?";
		} else {
			$this->whereIsCalled = true;
			$this->query .= " WHERE TIME('$column') $operator ?";
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
			$this->query .= " $linker MONTH('$column') $operator ?";
		} else {
			$this->whereIsCalled = true;
			$this->query .= " WHERE MONTH('$column') $operator ?";
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
			$this->query .= " $linker YEAR('$column') $operator ?";
		} else {
			$this->whereIsCalled = true;
			$this->query .= " WHERE YEAR('$column') $operator ?";
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
			$this->query .= " $linker DAY('$column') $operator ?";
		} else {
			$this->whereIsCalled = true;
			$this->query .= " WHERE DAY('$column') $operator ?";
		}
		return $this;
	}

	public function orWhereDay( $column, $value, $operator = '=' ) {
		$this->whereDay($column, $value, $operator, 'OR');
		return $this;
	}

	public function exists() {
		return count( $this->get() ) > 0;
	}

	public function doesntExist() {
		return !$this->exists();
	}

	public function count( $column = '*' ) {
		$this->selectIsCalled = true;
		if ( $this->whereIsCalled ) {
			$this->query = "SELECT count($column) FROM $this->table $this->query";
		} else {
			$this->query = "SELECT count($column) FROM $this->table";
		}
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

	private function SQLFunction($function, $column) {
		$this->select = 'called';
		if ( $this->whereIsCalled ) {
			$this->query = "SELECT $function($column) FROM $this->table $this->query";
		} else {
			$this->query = "SELECT $function($column)  FROM  $this->table";
		}
		return $this->aggregate();
	}

	public function raw( $CustomQuery ) {
		$this->query = $CustomQuery;
		return $this;
	}

	public function selectRaw( $CustomQuery ) {
		$this->select = true;
		$this->query = "SELECT $CustomQuery FROM $this->table $this->query";
		return $this;
	}

	public function from( $table, $as ) {
		if ( $as ) {
			$this->query .= " FROM $table AS $as";
		} else {
			$this->query .= " FROM $table";
		}
		return $this;
	}

	public function orderBy( $column, $filter = 'ASC' ) {
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

	/**
	 * TODO TBD
	 */
	public function get( $format = 'array' ) {
		if ( $this->query == null ) {
			throw new Exception('no query executed to be get');
		} else {
			$this->query .= $this->orderBy;

			if ( $this->select == false ) {
				$this->query = " SELECT * FROM $this->table $this->query";
			}

			$stmt = $this->pdo->prepare($this->query);
			$stmt->execute($this->queryValues);
			$result = $stmt->fetchAll();

			if ( $format == "json" ) {
				$result = json_encode($result);
			} elseif ( $format == "object" ) {
				$result = (object)$result;
			}

			return $result;
		}
	}

	private function aggregate() {
		if ( $this->query == null ) {
			throw new Exception('no query executed to be get');
		} else {
			$stmt = $this->pdo->prepare($this->query);
			$stmt->execute($this->queryValues);
			$result = $stmt->fetchColumn();
			return $result;
		}
	}

	public function first() {
		if ( $this->query == null ) {
			throw new Exception('no query executed to be get');
		} else {
			$this->query .= $this->orderBy;

			if ( $this->orderBy == false ) {
				$this->query = " SELECT * FROM $this->table $this->query";
			}

			$stmt = $this->pdo->prepare($this->query);
			$stmt->execute($this->queryValues);
			$result = $stmt->fetch(PDO::FETCH_OBJ);
			return $result;
		}
	}

	public function all() {
		$this->query = " ";
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
}
