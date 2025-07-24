<?php

use Core\Event;
use Core\Page;
use Core\Request;
use Modules\Crud\Libraries\Repositories\CrudRepository;

// init table fields
$tableName  = 'target_indicators';
$table      = tableFields($tableName);
$fields     = $table->getFields();
$module     = $table->getModule();
$title      = 'Target Indikator';
$error_msg  = get_flash_msg('error');
$old        = get_flash_msg('old');

$fields['parameter_id']['type'] = 'options-obj:standard_parameters,id,description|record_type,POKJA';

unset($fields['_userstamp']);

if(Request::isMethod('POST'))
{
    $data = isset($_POST[$tableName]) ? $_POST[$tableName] : [];
    $crudRepository = new CrudRepository($tableName);
    $crudRepository->setModule($module);
    $data['user_id'] = auth()->id;
    $data['record_type'] = 'POKJA';
    $create = $crudRepository->create($data);


    set_flash_msg(['success'=>"$title berhasil ditambahkan"]);

    header('location: /assessment/pokja/indicators/index');
    die();
}

// page section
Page::setActive("assessment.parameter_pokja");
Page::setTitle($title);
Page::setModuleName($title);
Page::setBreadcrumbs([
    [
        'url' => routeTo('/'),
        'title' => __('crud.label.home')
    ],
    [
        'url' => routeTo('assessment/pokja'),
        'title' => $title
    ],
    [
        'title' => __('crud.label.create')
    ]
]);

Page::pushHead('<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />');
Page::pushHead('<script src="https://cdn.tiny.cloud/1/rsb9a1wqmvtlmij61ssaqj3ttq18xdwmyt7jg23sg1ion6kn/tinymce/7/tinymce.min.js" referrerpolicy="origin"></script>');
Page::pushHead("<script>
tinymce.init({
  selector: 'textarea:not(.select2-search__field)',
  relative_urls : false,
  remove_script_host : false,
  convert_urls : true,
  plugins: 'anchor autolink charmap codesample emoticons image link lists media searchreplace table visualblocks wordcount',
  toolbar: 'undo redo | blocks fontfamily fontsize | bold italic underline strikethrough | link image media table | align lineheight | numlist bullist indent outdent | emoticons charmap | removeformat',
});
</script>");

Page::pushHead('<style>.select2,.select2-selection{height:38px!important;} .select2-container--default .select2-selection--single .select2-selection__rendered{line-height:38px!important;}.select2-selection__arrow{height:34px!important;}</style>');
Page::pushFoot('<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>');
Page::pushFoot("<script src='".asset('assets/crud/js/crud.js')."'></script>");

Page::pushHook('create');

return view('assessment/views/pokja/indicators/create', compact('fields', 'tableName', 'error_msg', 'old'));