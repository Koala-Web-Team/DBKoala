<?php


trait Joins
{
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
}
