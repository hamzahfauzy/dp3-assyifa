<?php

$having = "";

if(get_role(auth()->id)->role_id == 3)
{
    $filter['user_pelaksana'] = auth()->id;
}

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

$where = $where ." ". $having;

$this->db->query = "SELECT * FROM $this->table $where ORDER BY ".$col_order." ".$order[0]['dir'];
if(get_role(auth()->id)->role_id == 3)
{
    $this->db->query = "SELECT $this->table.*, (SELECT user_id FROM performance_users WHERE performance_id = performances.id AND user_id = ".auth()->id.") user_pelaksana FROM $this->table $where ORDER BY ".$col_order." ".$order[0]['dir'];
}

$total = $this->db->exec('exists');

$this->db->query .= " LIMIT $start,$length";
$data  = $this->db->exec('all');

return compact('total', 'data');