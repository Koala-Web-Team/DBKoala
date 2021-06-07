<?php

require_once("QueryBuilder/Table.php");
require_once("AdvancedDatabase/Database.php");
require_once("AdvancedDatabase/FileFactory.php");



//$users = new Table('users');
//$member = new Table('members');
//    $first = $member->whereNotNull('first_name')->koalaSql();
//
//$result = $users->orderBy('dfd')
//    ->union($first)
//    ->take(3)
//    ->groupByRaw('fgfdg , dfsdf')
//    ->join('contacts', 'users.id', 'contacts.user_id','=')
//    ->whereSub(function ($query){
//    $query->where('dfsf','dsfds')->where('sdfs','fd')->koalaSql();
//},'=','fgnfd')->orwhereSub(
//    function ($query){
//        $query->orwhereBetween('dfsf',[2,10])->orwhere('sdfs','fd')->koalaSql();
//    },'>',null , 'sdfdf')
//    ->whereGroup(function ($q){
//        $q->where('target_language', 'fdg')->orWhere('source_language', 'dsf')->
//            whereExists(function ($query) {
//                $query->from('members')
//                ->select(['dfd','dfs'])
//                    ->where('orders.user_id', 'users.id')->koalaSql();
//            })->koalaSql();
//    })->whereExists(function ($query) {
//        $query->from('orders')
//            ->where('orders.user_id', 'users.id')->koalaSql();
//    })
//    ->whereColumn('fdsf','dfsdf','>')
//    ->WhereColumn('fdsf','dfsdf','<')
//    ->koalaSql();


$query = new Table('user');
$sql = $query->where('fname','hggj')->koalaSql();
$users = new FileFactory();

//$user->create([
//    'name' => 'mohamed osama',
//    'email' => 'mohamedosama@gmail.com',
//    'password' => 'Monster1234',
//    'image' => 'dfd.jpg',
//    'department_id' => 1,
//    'type' => 'mido',
//    'verified' => 'no'
//]);

$type = new FileItem('csv');

$file = $users->create_file($type);

$file->export('table',$sql);


