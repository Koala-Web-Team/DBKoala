<?php

trait RawQuery
{
    public function raw( $query , $bindings = [] ) {
        array_push($this->queryValues, ...$bindings);
        $this->raw = $query;
        return $this;
    }

    public function selectRaw( $query , $bindings = [] ) {
        array_push($this->queryValues, ...$bindings);
        $this->selectIsCalled = true;
        $this->select = "SELECT $query";
        return $this;
    }

    public function whereRaw( $sql , $linker = 'AND' , $bindings = [] ) {
        array_push($this->queryValues, ...$bindings);
        if ( $this->whereIsCalled ) {
            $this->where .= " ".$linker . " " . $sql;
        } else {
            $this->whereIsCalled = true;
            $this->where .= " WHERE " . " " . $sql;
        }
        return $this;
    }

    public function orWhereRaw( $sql , $bindings = []) {
        array_push($this->queryValues, ...$bindings);
        $this->whereRaw($sql , 'OR');
        return $this;
    }

    public function havingRaw( $sql , $linker = "AND" , $bindings = []) {
        array_push($this->queryValues, ...$bindings);
        if ( $this->havingIsCalled ) {
            $this->having .= " ".$linker . " " . $sql;
        } else {
            $this->havingIsCalled = true;
            $this->having .= " HAVING " . " " . $sql;
        }
        return $this;
    }

    public function orHavingRaw( $sql ,$bindings = [] ) {
        array_push($this->queryValues, ...$bindings);
        $this->havingRaw($sql , 'OR');
        return $this;
    }

    public function orderByRaw( $sql , $bindings = [] ) {
        array_push($this->queryValues, ...$bindings);
        if ( $this->orderBy == null ) {
            $this->orderBy = " ORDER BY $sql";
        } else {
            $this->orderBy .= " , $sql ";
        }
        return $this;
    }

    public function groupByRaw( $sql , $bindings = [] ) {
        array_push($this->queryValues, ...$bindings);
        if( $this->groupby == null ) {
            $this->groupby = " GROUP BY " . $sql;
        }
        else{
            $this->groupby .= " , $sql ";
        }
        return $this;
    }

    public function fromRaw( $expression , $bindings = [] ) {
        array_push($this->queryValues, ...$bindings);
        $this->from = " FROM $expression";
        return $this;
    }
}
