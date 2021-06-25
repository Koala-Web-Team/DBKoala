<?php

require_once("koala/helper.php");

$users = new Table('users');
$member = new Table('members');
$first = $member->whereRaw('name = dss')->koalaSql();
//
$result = $users->orderBy('name')
    ->take(3)
    ->groupByRaw('city, state')
    ->whereSub(function ($query){
    $query->where('age','60','>')->whereRaw('name LIKE \'a%\'')->koalaSql();
},'=','fgnfd')->whereGroup(function ($q){
        $q->where('target_language', 'arabic')->orWhere('source_language', 'english')->
            whereExists(function ($query) {
                $query->from('members')
                ->selectRaw('price * 1.023 as price_with_tax')
                    ->havingRaw('orders.user_id = users.id')->koalaSql();
            })->koalaSql();
    })->koalaSql();

//$result = $users->selectRaw('price * 1.025 as price_with_tax')
//    ->from('members')
//    ->get();
//$users->selectRaw('count(*) as user_count, status')
//    ->where('status', '1', '<>')
//    ->groupBy('status')
//    ->get();

//$query = new Table('user');
//$sql = $query->where('fname','hggj')->koalaSql();
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


//$type = new FileItem('csv');
//
//$file = $users->create_file($type);
//
//$file->export('table',$sql);

//$backup = new Database();
//
//$backup->backup();

//$news = new Table('news');
//
//$result = $news->where('id',1)->get('json');


print_r($result);
