<?php

$having = "";

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

$this->db->query = "SELECT 
                        $this->table.*, 
                        users.name user_name 
                    FROM $this->table 
                    JOIN organization_users ON organization_users.id = $this->table.organization_user_id 
                    JOIN users ON users.id = organization_users.user_id 
                    $where 
                    ORDER BY ".$col_order." ".$order[0]['dir']." LIMIT $start,$length";
$data  = $this->db->exec('all');

$total = $this->db->exists($this->table,$where,[
    $col_order => $order[0]['dir']
]);

return compact('data', 'total');