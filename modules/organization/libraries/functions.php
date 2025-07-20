<?php

use Core\Database;

// \Modules\Default\Libraries\Sdk\Dashboard::add('organizationDashboardStatistic');

function organizationDashboardStatistic()
{
    $db = new Database;

    $data = [];
    $data['organisasi'] = $db->exists('organizations');
    $data['jabatan'] = $db->exists('organization_positions');
    $data['member'] = $db->exists('organization_users');
    $data['kehadiran'] = $db->exists('organization_presences');


    return view('organization/views/dashboard/statistic', compact('data'));
}