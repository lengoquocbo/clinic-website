<?php
require_once __DIR__ .'../../../model/benhnhanmodel.php';
if(isset($_GET['id'])){
    $patientID = $_GET['id'];
    $patient = new  benhnhan();
    if ($patient->delete_patients($patientID)){
        echo "<script>
                alert('Xóa bệnh nhân thành công!');
                window.location.href = 'index.php?mod=benhnhan&act=list';
              </script>";
        exit;
    }else{
        "<script> alert('Lỗi: " . $this->db->error . "'); window.history.back(); </script>";
    }
}
?>