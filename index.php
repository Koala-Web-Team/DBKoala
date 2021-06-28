<?php

require_once("koala/helper.php");

//$result = $companies->join("states","packaging_companies.stateId","states.id")
//    ->orderBy('name_en')
//    ->where("states.name", 'active')
//    ->koalaSql();

//$result = $events
//    ->where("title","999 OR 1=1","=")
//    ->get();
//$member = new Table('members');
//$first = $member->whereRaw('name = dss')->koalaSql();

//$courses = new Table('courses');
//
//$result = $courses->orderBy('sdfd','DESC')
//    ->groupBy(['dfdsf','ghgh'])
//    ->havingBetween('svf',[2,23])
//    ->take(5)
//    ->where('name_ar','ekea')
//    ->whereIn('mido',[1,2,3,4])
//    ->orwhereNotBetween('dsfs',[2,12])
//    ->leftjoin("states as a", "packaging_companies.stateId", "states.id")
//    ->rightjoin("users as s", "phones.userId", "users.id")
//    ->whereGroup(function ($query) {
//    $query->whereNull('details')
//        ->WhereNull('image')->koalaSql();
//})->whereSub(function ($query) {
//        $query->where('name_ar', 'sdfdf')->orWhere('name_en', 'dfs')->koalaSql();
//    },'=',null , 'name_en')
//    ->orwhereNotExists(function ($query) {
//        $query->fromSub(function ($query) {
//            $query->select(['dsvsdfs'])->from('dido')->where('name_ar', 'sdfdf')->orWhere('name_en', 'dfs')->koalaSql();
//        },'osama')->where('target_language', 'sdfdf')->orWhere('source_language', 'dfs')->
//            orwhereSub(function ($query) {
//                $query->where('name_ar', 'sdfdf')->orWhere('name_en', 'dfs')->koalaSql();
//            },'=','dfdf')
//            ->koalaSql();
//    })->orwhereSub(function ($query) {
//        $query->select(['dsvsdfs'])->where('name_ar', 'sdfdf')->orWhere('name_en', 'dfs')->fromRaw('mido as mi')->koalaSql();
//    },'=','ddf')->whereColumn('name_en','name_ar','>')->having('dsfsf','dsf','>')
//    ->HavingBetween('dsfdfdsf',[2,12])
//    ->koalaSql();
//


// $result = $courses->whereRaw('title = ?','AND',['c++ course'])
//     ->orHavingRaw('title = ?',['java course'])
//     ->groupBy(['description','hours'])
//     ->groupByRaw('title dsfs')
//     ->groupBy(['sdfd'])
//     ->koalaSql();
//$users->selectRaw('count(*) as user_count, status')
//    ->where('status', '1', '<>')
//    ->groupBy('status')
//    ->get();

//$events = new Table('events');
//$sql = $events->where('title','mido')->koalaSql();
//$users = new FileFactory();

//$user->create([
//    'name' => 'mohamed osama',
//    'email' => 'mohamedosama@gmail.com',
//    'password' => 'Monster1234',
//    'image' => 'dfd.jpg',
//    'department_id' => 1,
//    'type' => 'mido',
//    'verified' => 'no'
//]);

//$language = ';;';
//
//$result = $users->whereGroup(function ($q) use ($language) {
//    $q->where('target_language', 'dfs')->orWhere('source_language', 'dfs');
//})->wheresub(function ($query) {
//    $query->selectRaw('price * 1.023 as price_with_tax')
//        ->from('membership')
//        ->whereColumn('membership.user_id', 'users.id')
//        ->limit(1);
//})->koalaSql();

//$factory = new FileFactory();
//
//$type = new FileItem('csv');
//
//$file = $factory->create_file($type);
//
////$file->import('export.csv','events');
//
//$file->export('table','events');

//$backup = new Database();
//
//$backup->backup();

//$news = new Table('news');
//
//$result = $news->where('id',1)->get('json');

print_r($result);
