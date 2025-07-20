<?php

if(isset($_GET['filter']) && isset($_GET['filter']['organization_id']))
{
    unset($fields['organization_id']);
}

return $fields;