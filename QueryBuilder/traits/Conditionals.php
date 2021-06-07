<?php


trait Conditionals
{
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
}
