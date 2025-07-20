<?php 

use Core\Database;
use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Spreadsheet;

$db = new Database;

if (isset($_FILES['file'])) {
    $file = $_FILES['file'];
    
    // Jenis file yang diizinkan
    $allowedTypes = ['application/vnd.ms-excel', 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet'];
    
    if (!in_array($file['type'], $allowedTypes)) {
        set_flash_msg(['error'=> 'Silakan unggah file Excel']);
    }
    else
    {

        $fileExtension = pathinfo($file['name'], PATHINFO_EXTENSION);
        
        if (in_array($fileExtension, ['xls', 'xlsx'])) {
            $spreadsheet = IOFactory::load($file['tmp_name']);
            $sheet = $spreadsheet->getActiveSheet();
    
            foreach ($sheet->getRowIterator(2) as $row) {
                $name = $sheet->getCell('A' . $row->getRowIndex())->getFormattedValue();
                $status = $sheet->getCell('B' . $row->getRowIndex())->getFormattedValue();
                $description = $sheet->getCell('C' . $row->getRowIndex())->getFormattedValue();
                $start_at = $sheet->getCell('D' . $row->getRowIndex())->getFormattedValue();
                $start_at = date_parse($start_at);
                $end_at = $sheet->getCell('E' . $row->getRowIndex())->getFormattedValue();
                $end_at = date_parse($end_at);

                // check username
                $user = $db->single('users', ['name' => $name]);
                if(!$user)
                {
                    continue;
                }

                $data = [
                    'description' => $description,
                    'record_type' => $status == 'YA' ? 'ATTENDANCE' : 'LEAVES',
                    'user_id' => $user->id,
                    'start_at' => $start_at['year'].'-'.$start_at['month'].'-'.$start_at['day'],
                    'end_at' => $end_at['year'].'-'.$end_at['month'].'-'.$end_at['day']
                ];

                $organizationUser = $db->single('organization_users',['user_id' => $user->id]);
                if($organizationUser->organization_id)
                {
                    $data['organization_id'] = $organizationUser->organization_id;
                }
                
                // save presences
                $db->insert('organization_presences', $data);
            }
        }
           
        set_flash_msg(['success'=> 'Data berhasil di Import']);
    }
    
} else {
    set_flash_msg(['error'=> 'Silakan unggah file Excel atau CSV.']);
}

header('Location: '.routeTo('crud/index',['table' => 'organization_presences', 'filter' => ['record_type' => 'ATTENDANCE']]));
die();
