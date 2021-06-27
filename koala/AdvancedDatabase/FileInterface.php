<?php


Interface FileInterface
{
    public function export( $type , $value , $queryvalues = null );

    public function import( $filepath, $table , $columns = []);
}
