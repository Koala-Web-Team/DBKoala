<?php


trait Aggregates
{
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
}
