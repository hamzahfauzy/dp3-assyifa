<?php

if(isset($_GET['filter']) && isset($_GET['filter']['organization_user_id']))
{
    unset($fields['organization_user_id']);
    unset($fields['user_name']);
}

return $fields;