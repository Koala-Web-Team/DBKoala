<?php

trait RawQuery
{
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
}
