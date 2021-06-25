<?php


Interface FileInterface
{
    public function export( $type = null , $value = null );

    public function import( $filepath, $value = null );
}
