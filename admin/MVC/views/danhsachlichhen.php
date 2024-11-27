<?php
require_once __DIR__ . '../../model/lichhenmodel.php';

$confirm = isset($_GET['confirm']) ? intval($_GET['confirm']) : 0;

$lichhenmodel = new Appointment();
$lichhen_list = $lichhenmodel->getByStatus($confirm);

// Trả về HTML danh sách lịch hẹn
foreach ($lichhen_list as $lichhen) { ?>
    <tr>
        <td><?= $lichhen['appointmentID'] ?></td>
        <td><?= $lichhen['ordernumber'] ?></td>
        <td><?= htmlspecialchars($lichhen['fullname']) ?></td>
        <td><?= htmlspecialchars($lichhen['appointmentday']) ?></td>
        <td><?= htmlspecialchars($lichhen['phone']) ?></td>
        <td><?= htmlspecialchars($lichhen['servicename']) ?></td>
        <td><?= htmlspecialchars($lichhen['description']) ?></td>
        <td>
            <?= $lichhen['confirm'] == 1 ? '<span style="color:green;">ĐÃ DUYỆT</span>' : '<span style="color:red;">CHƯA DUYỆT</span>' ?>
        </td>
        <td>
            <?php if ($lichhen['confirm'] == 0): ?>
                <a href="index.php?mod=lichhen&act=xacnhan&id=<?= $lichhen['appointmentID'] ?>" class="medicine-list__action-btn">Duyệt</a>
                <a style="background-color:#f6c23e;" 
                   href="index.php?mod=lichhen&act=huy&id=<?= $lichhen['appointmentID'] ?>" 
                   onclick="return confirm('Bạn có chắc muốn hủy lịch hẹn này không?')" 
                   class="medicine-list__action-btn">Hủy</a>
            <?php else: ?>
                <a href="index.php?mod=lichhen&act=khambenh&id=<?= $lichhen['appointmentID'] ?>&p=<?=$lichhen['patientID'] ?>" class="medicine-list__action-btn">Khám bệnh</a>
                <a style="background-color:#f6c23e;" 
                   href="index.php?mod=lichhen&act=huy&id=<?= $lichhen['appointmentID'] ?>" 
                   onclick="return confirm('Bạn có chắc muốn hủy lịch hẹn này không?')" 
                   class="medicine-list__action-btn">Hủy</a>
            <?php endif; ?>
        </td>
    </tr>
<?php } ?>
