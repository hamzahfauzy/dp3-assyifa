<?php

use Core\Database;
use Core\Page;
use Core\Request;
use Modules\Default\Libraries\Sdk\Media;

if(Request::isMethod('POST'))
{
    $uploadedFile = $_FILES['file'];
    $file = Media::singleUpload($uploadedFile);
    
    $db = new Database;
    $db->insert('performance_files', [
        'file_name' => $uploadedFile['name'],
        'file_url'  => $file->name,
        'performance_id' => $_POST['performance_id']
    ]);

    $db->insert('performance_logs',[
        'performance_id' => $_POST['performance_id'],
        'description' => auth()->name . ' telah mengunggah berkas '.$file->name.' pada '.date('j F Y, H:i')
    ]);

    header('location: '.routeTo('assessment/performances/detail',['id' => $_POST['performance_id']]));
    die();
}