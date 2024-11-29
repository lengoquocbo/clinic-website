<?php

require_once __DIR__.'\..\Models\usermodel.php';
class lichhen{
    private $usermodel;
    public function __construct(){
        $this->usermodel= new UserModel();
    }
    public function getlichhen(){
        $userID = $_SESSION['userID']; 
        $lichhen = $this->usermodel->getAppointment($userID);
        require_once __DIR__.'\..\Views\index.php';

}
}
?>