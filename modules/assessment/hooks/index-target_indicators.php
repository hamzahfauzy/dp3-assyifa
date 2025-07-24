<?php

$having = "";
$route = \Core\Request::getRoute();

if($filter)
{
    $filter_query = [];
    foreach($filter as $f_key => $f_value)
    {
        $filter_query[] = "$f_key = '$f_value'";
    }

    $filter_query = implode(' AND ', $filter_query);

    $having = (empty($having) ? 'HAVING ' : ' AND ') . $filter_query;
}

if($route == 'assessment/pokja/indicators/index')
{
    $where .= (empty($where) ? ' WHERE ' : ' AND ') . " parameter_id IN (SELECT id FROM standard_parameters WHERE user_id = " . auth()->id . ")";
}
$where = $where ." ". $having;

$this->db->query = "SELECT * FROM $this->table $where ORDER BY ".$col_order." ".$order[0]['dir'];

$total = $this->db->exec('exists');

$this->db->query .= " LIMIT $start,$length";
$data  = $this->db->exec('all');

return compact('total', 'data');