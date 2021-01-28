<?php

require_once("QueryBuilder/Table.php");

$user = new Table('users');

$result = $user->distinct(['name'])->get();

print_r($result);




//function arrayMap( $callback , $array ){
//    $r = array();
//    foreach ($array as $key=>$value) {
//        $r[$key] = $callback($key, $value);
//    }
//    return $r;
//}
//
//for($i = 0;$i<= count($result);$i++)
//{
//   print_r(implode(' ',$result[$i]));
//   die();
//}


//$impArray = [];
//
//$sampleArray = [
//    ['status', '=', '1'],
//    ['subscribed', '<>', '1']
//];
//
//$c = 1;
//
//
//foreach($sampleArray as $key => $val) {
//
//    $count = count($val);
//    $first = $val[0];
//    $second = $val[1];
//    $last = "'$val[2]'";
//
//    if(count($sampleArray) != $c) {
//        $linker = 'and ';
//    }
//    else {
//        $linker = ' ';
//    }
//
//    $c++;
//
//    $impArray = array($first, $second, $last , $linker);
//
//    echo implode(' ', $impArray);
//}



















