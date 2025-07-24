<?php

use Core\Database;

$db = new Database;
$data = $_POST;
unset($data['_token']);
$data['user_id'] = auth()->id;
$db->insert('performance_comments', $data);

header('location: '.routeTo('assessment/performances/detail',['id' => $data['performance_id']]));
die;