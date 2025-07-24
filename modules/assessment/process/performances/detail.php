<?php

use Core\Database;
use Core\Page;

$db = new Database;
$id = $_GET['id'];
$db->query = "SELECT 
                p.*,
                ti.description ti_description,
                sp.description sp_description
              FROM performances p 
              LEFT JOIN target_indicators ti ON ti.id = p.indicator_id
              LEFT JOIN standard_parameters sp ON sp.id = p.parameter_id
              WHERE p.id = $id";

$performance = $db->exec('single');

$isPelaksana = $db->exists('performance_users', [
    'user_id' => auth()->id,
    'performance_id' => $id
]);

$db->query = "SELECT users.name nama_pelaksana FROM performance_users LEFT JOIN users ON users.id = performance_users.user_id WHERE performance_id = $id";
$pelaksana = $db->exec('all');

$db->query = "SELECT * FROM performance_files WHERE performance_id = $id";
$files = $db->exec('all');

$db->query = "SELECT performance_comments.*, commenter.name as commenter_name FROM performance_comments JOIN users commenter ON commenter.id = performance_comments.user_id WHERE performance_comments.performance_id = $id";
$comments = $db->exec('all');

$logs = $db->all('performance_logs', [
    'performance_id' => $id
]);

// page section
$title = 'Detail Kinerja Tambahan';
Page::setActive("assessment.performances");
Page::setTitle($title);
Page::setModuleName($title);
Page::setBreadcrumbs([
    [
        'url' => routeTo('/'),
        'title' => __('crud.label.home')
    ],
    [
        'url' => routeTo('crud/index', ['table' => 'performances']),
        'title' => 'Kinerja Tambahan'
    ],
    [
        'title' => $title
    ]
]);

return view('assessment/views/performances/detail', [
    'performance' => $performance,
    'comments' => $comments,
    'isPelaksana' => $isPelaksana,
    'pelaksana' => $pelaksana,
    'files' => $files,
    'logs' => $logs
]);