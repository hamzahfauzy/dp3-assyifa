<?php

use Core\Database;

$db = new Database;
$users = $_POST['users'];

foreach($users as $user){
    $db->insert('performance_users', [
        'performance_id' => $data->id,
        'user_id' => $user
    ]);
}

$db->insert('performance_logs', [
    'performance_id' => $data->id,
    'description' => 'Kinerja Tambahan dibuat oleh '.auth()->name.' pada '.date('j F Y, H:i')
]);