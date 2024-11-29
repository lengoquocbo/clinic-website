<?php

require_once __DIR__.'\..\Models\usermodel.php';

class Hoso{
    private $usermodel;
    
    public function __construct(){  
        $this->usermodel = new UserModel();
    }

    function Hoso(){
        $userID = $_SESSION['userID'];  
        $User = $this->usermodel->getByUserId($userID);
        require_once __DIR__.'\..\Views\index.php';
    }

    function detail($EXID){
        $dt = $this->usermodel->getByEXID($EXID);
        $medicineList = $this->usermodel->GetMedicine($EXID);
        require_once __DIR__."\..\Views\index.php";
    }
}
?>