<?php
require_once 'C:\xampp\htdocs\clinic-website\admin\MVC\model\benhnhanmodel.php';

$name = $_GET['name'];
$benhnhanmodel = new benhnhan();
$benhnhan_list = $benhnhanmodel->searchByName($name);

foreach ($benhnhan_list as $benhnhan) {
    echo "<tr>
            <td>{$benhnhan['patientID']}</td>
            <td>{$benhnhan['fullname']}</td>
            <td>{$benhnhan['birthdate']}</td>
            <td>{$benhnhan['sex']}</td>
            <td>{$benhnhan['phone']}</td>
            <td>{$benhnhan['address']}</td>
            <td>
                <a href='index.php?mod=benhnhan&act=edit&id={$benhnhan['patientID']}' class='medicine-list__action-btn'>Xem</a>
                <a href='index.php?mod=benhnhan&act=edit&id={$benhnhan['patientID']}' class='medicine-list__action-btn'>Sửa</a>
                <a href='index.php?mod=benhnhan&act=delete&id={$benhnhan['patientID']}' onclick='return confirm(\"Bạn có chắc muốn xóa người này?\")' class='medicine-list__action-btn'>Xóa</a>
            </td>
        </tr>";
}
?>
