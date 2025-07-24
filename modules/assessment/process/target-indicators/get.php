<?php

use Core\Database;
use Core\Response;

$db = new Database;
$filter = isset($_GET['filter']) ? $_GET['filter'] : [];
$targetIndicators = $db->all('target_indicators', $filter);

return Response::json($targetIndicators, 'data retrieved');