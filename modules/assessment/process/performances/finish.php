<?php

use Core\Database;

$db = new Database;
$performance = $db->single('performances', [
    'id' => $_POST['performance_id']
]);
$db->update('performances', [
    'status' => 'SELESAI EVALUASI',
    'actual_value' => $_POST['actual_value']
], [
    'id' => $_POST['performance_id']
]);

$db->insert('performance_logs', [
    'performance_id' => $performance->id,
    'description' => 'Status Kinerja Tambahan diubah dari '.$performance->status.' menjadi SELESAI DI EVALUASI oleh '.auth()->name.' pada '.date('j F Y, H:i')
]);

header('location: '.routeTo('assessment/performances/detail',['id' => $performance->id]));