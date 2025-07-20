<?php

use Modules\Default\Libraries\Sdk\Media;

$media = Media::singleUpload($_FILES['file']);

$data['media_id'] = $media->id;
$data['presence_id'] = $_GET['filter']['presence_id'];
$data['status'] = 'PURPOSE';
$data['updated_by'] = auth()->id;