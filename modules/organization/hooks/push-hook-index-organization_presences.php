<?php

use Core\Page;

if(isset($_GET['filter']) && isset($_GET['filter']['record_type']))
{
    Page::set_title(__('organization.label.'.$_GET['filter']['record_type']));
}