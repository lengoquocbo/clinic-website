<?php
require_once __DIR__.'\..\..\admin\MVC\model\dichvumodel.php';
require_once __DIR__.'\..\..\admin\MVC\model\nhanvienmodel.php';

class Home{
    private $dichvu;
    private $nhanvien;

    public function __construct(){
        $this->dichvu = new Services();
        $this->nhanvien = new NhanVien();
    }

    function list(){
        $data_dichvu = $this->dichvu->getAll();
        $data_nhanvien = $this->nhanvien->getByPosition('Bác sĩ');
        require_once __DIR__.'\..\Views\home.php';

    }
}


require_once __DIR__.'\..\Views\index.php';

?>