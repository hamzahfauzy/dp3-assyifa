<?php

use Core\Database;

$db = new Database;
$performance = $db->single('performances', [
    'id' => $_GET['id']
]);
$db->update('performances', [
    'status' => $_GET['status'],
], [
    'id' => $_GET['id']
]);

$db->insert('performance_logs', [
    'performance_id' => $performance->id,
    'description' => 'Status Kinerja Tambahan diubah dari '.$performance->status.' menjadi '.$_GET['status'].' oleh '.auth()->name.' pada '.date('j F Y, H:i')
]);

header('location: '.routeTo('assessment/performances/detail',['id' => $_GET['id']]));