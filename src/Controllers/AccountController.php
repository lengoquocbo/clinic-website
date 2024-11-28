<?php

require_once __DIR__.'\..\Models\usermodel.php';

class Account{
    private $usermodel;

    public function __construct(){  
        $this->usermodel = new UserModel();
    }

    public function profile(){
        $userID = $_SESSION['userID']; 
        $userdata = $this->usermodel->findUserByUserID($userID);

        require_once __DIR__.'\..\Views\index.php';
    }
}
?>