<?php get_header() ?>
<div class="card">
    <div class="card-header d-flex flex-grow-1 align-items-center">
        <p class="h4 m-0"><?= __('crud.label.create') ?> <?php get_title() ?></p>
        <div class="right-button ms-auto">
            <a href="/assessment/pokja/parameters/index" class="btn btn-warning btn-sm">
                <?= __('crud.label.back') ?>
            </a>
        </div>
    </div>
    <div class="card-body">
        <?php if($error_msg): ?>
        <div class="alert alert-danger"><?=$error_msg?></div>
        <?php endif ?>
        <form action="" method="post" enctype="multipart/form-data">
            <?= csrf_field() ?>
            <?php 
            foreach($fields as $key => $field): 
                if($field == '_action_button') continue;
                $label = $field;
                $type  = "text";
                $attr  = ['class'=>"form-control"];
                if(is_array($field))
                {
                    $field_data = $field;
                    $field = $key;
                    $label = $field_data['label'];
                    if(isset($field_data['type']))
                    {
                        $type  = $field_data['type'];
                    }

                    if(isset($field_data['attr']))
                    {
                        $attr = array_merge($attr, $field_data['attr']);
                    }
                }
                $label = _ucwords($label);
                $fieldname = $type == 'file' ? $field : $tableName."[".$field."]";
                if(isset($old[$field]))
                {
                    $attr['value'] = $old[$field];
                }
                $attr = array_merge($attr, ["placeholder"=>$label]);
                if(isset($attr['multiple']))
                {
                    $fieldname .= "[]";
                }
            ?>
            <div class="form-group mb-3">
                <label class="mb-2"><?=$label?></label>
                <?= \Core\Form::input($type, $fieldname, $attr) ?>
            </div>
            <?php endforeach ?>
            <div class="form-group">
                <button class="btn btn-primary">Submit</button>
            </div>
        </form>
    </div>
</div>
<?php get_footer() ?>
