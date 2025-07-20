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
                $email = $sheet->getCell('B' . $row->getRowIndex())->getFormattedValue();
                $organization = $sheet->getCell('C' . $row->getRowIndex())->getFormattedValue();
                $position = $sheet->getCell('D' . $row->getRowIndex())->getFormattedValue();
                $start_at = $sheet->getCell('E' . $row->getRowIndex())->getFormattedValue();
                $start_at = date_parse($start_at);
                $end_at = $sheet->getCell('F' . $row->getRowIndex())->getFormattedValue();
                $end_at = date_parse($end_at);

                // check username
                $user = $db->single('users', ['username' => $email]);
                if(!$user)
                {
                    $user = $db->insert('users', [
                        'name' => $name,
                        'username' => $email,
                        'password' => md5(123456)
                    ]);

                    $db->insert('user_roles', [
                        'user_id' => $user->id,
                        'role_id' => env('USER_ROLE_ID')
                    ]);
                }

                // check organization
                $organization = $db->single('organizations', ['name' => $organization]);
                if(!$organization)
                {
                    continue;
                }
                
                // insert member
                $member = $db->insert('organization_users', [
                    'organization_id' => $organization->id,
                    'user_id' => $user->id
                ]);
                
                // check position
                $position = $db->single('organization_positions',['name' => $position]);
                if(!$position)
                {
                    continue;
                }
                
                // assign position
                $db->insert('organization_user_positions', [
                    'organization_user_id' => $member->id,
                    'position_id' => $position->id,
                    'start_at' => $start_at['year'].'-'.$start_at['month'].'-'.$start_at['day'],
                    'end_at' => $end_at['year'].'-'.$end_at['month'].'-'.$end_at['day']
                ]);
            }
        }
           
        set_flash_msg(['success'=> 'Data berhasil di Import']);
    }
    
} else {
    set_flash_msg(['error'=> 'Silakan unggah file Excel atau CSV.']);
}

header('Location: '.routeTo('crud/index',['table' => 'organization_users']));
die();
