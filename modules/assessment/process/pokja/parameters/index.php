<?php

use Core\Page;
use Modules\Crud\Libraries\Repositories\CrudRepository;

$_GET['filter']['record_type'] = 'POKJA';
$_GET['filter']['user_id'] = auth()->id;

$tableName  = 'standard_parameters';
$table      = tableFields($tableName, isset($module) ? $module : false);
$fields     = $table->getFields();
$module     = isset($module) ? $module : $table->getModule();
$success_msg = get_flash_msg('success');
$error_msg   = get_flash_msg('error');

// page section
$title = _ucwords(__("$module.label.$tableName"));
Page::setActive("assessment.parameter_pokja");
Page::setTitle($title);
Page::setModuleName($title);
Page::setBreadcrumbs([
    [
        'url' => routeTo('/'),
        'title' => __('crud.label.home')
    ],
    [
        'url' => routeTo('assessment/pokja/parameters/index'),
        'title' => $title
    ],
    [
        'title' => 'Index'
    ]
]);

Page::pushFoot("<script src='".asset('assets/crud/js/crud.js')."'></script>");

Page::pushHook('index');

// get data
$crudRepository = new CrudRepository($tableName);
$crudRepository->setModule($module);

if(isset($_GET['draw']))
{
    return $crudRepository->dataTable($fields);
}

return view('assessment/views/pokja/parameters/index', compact('fields', 'tableName', 'success_msg', 'error_msg', 'crudRepository'));