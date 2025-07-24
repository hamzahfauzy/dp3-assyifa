<?php

use Core\Event;
use Core\Page;
use Core\Request;
use Modules\Crud\Libraries\Repositories\CrudRepository;

// init table fields
$tableName  = 'standard_parameters';
$id         = $_GET['id'];
$table      = tableFields($tableName);
$fields     = $table->getFields();
$module     = $table->getModule();

$crudRepository = new CrudRepository($tableName);
$data = $crudRepository->find([
    'id' => $id
]);
$crudRepository->setModule($module);
$crudRepository->delete([
    'id' => $id
]);

$title      = _ucwords(__("$module.label.$tableName"));

set_flash_msg(['success'=>"$title berhasil dihapus"]);

header('location:/assessment/pokja/parameters/index');
die();
