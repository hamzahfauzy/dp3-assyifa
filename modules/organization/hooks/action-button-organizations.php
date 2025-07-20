<?php

return '
<a href="'.routeTo('crud/index',['table'=>'organization_users','filter'=>['organization_id' => $data->id]]).'" class="btn btn-sm btn-info"><i class="fas fa-users"></i> '.__('organization.label.member').'</a> 
';