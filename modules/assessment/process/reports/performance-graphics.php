<?php

use Core\Database;
use Core\Page;

$db = new Database();
$db->query = "SELECT 
    sp.description AS label,
    AVG(p.actual_value) AS average_value
FROM 
    standard_parameters sp
LEFT JOIN 
    performances p ON p.parameter_id = sp.id
WHERE sp.record_type = 'IKT'
GROUP BY 
    sp.id, sp.description
ORDER BY 
    sp.description";

$data = $db->exec('all');
$labels = [];
$values = [];

foreach ($data as $row) {
    $labels[] = strip_tags($row->label);
    $values[] = round($row->average_value, 2); // dibulatkan 2 desimal
}

Page::setTitle("Laporan Kinerja");
Page::setActive("assessment.performance_report");
Page::setModuleName("Report");
Page::setBreadcrumbs([
    [
        'url' => routeTo('/'),
        'title' => __('crud.label.home')
    ],
    [
        'title' => 'Laporan Kinerja'
    ]
]);

return view('assessment/views/reports/performance-graphics', [
    'labels' => $labels,
    'values' => $values,
]);