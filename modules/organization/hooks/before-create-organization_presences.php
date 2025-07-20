<?php

if(isset($_GET['filter']) && isset($_GET['filter']['record_type']))
{
    $data['record_type'] = $_GET['filter']['record_type'];
}

$user = $db->single('organization_users',['user_id' => $data['user_id']]);
if($user->organization_id)
{
    $data['organization_id'] = $user->organization_id;
}