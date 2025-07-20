<?php

if(isset($_GET['filter']) && isset($_GET['filter']['organization_user_id']))
{
    $data['organization_user_id'] = $_GET['filter']['organization_user_id'];
}