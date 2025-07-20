<?php

return '
<a href="'.routeTo('crud/index',['table'=>'organization_presence_media','filter'=>['presence_id' => $data->id]]).'" class="btn btn-sm btn-info"><i class="fas fa-file fa-fw"></i> '.__('default.label.media').'</a>
';