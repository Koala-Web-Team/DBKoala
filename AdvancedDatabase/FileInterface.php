<?php


Interface FileInterface
{
    public function export($type);

    public function import($type,$filepath);
}
