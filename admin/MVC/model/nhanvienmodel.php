<?php
require_once 'connectdb.php';

class Nhanvien {
    private $db;

    // Constructor để khởi tạo kết nối với database
    public function __construct() {
        $this->db = Database::getInstance()->getConection();
    }

    // Lấy danh sách tất cả nhân viên
    public function getAll() {
        $result = $this->db->query("SELECT * FROM staffs");
        return $result->fetch_all(MYSQLI_ASSOC);
    }

    // Lấy thông tin nhân viên theo ID
    public function getById($id) {
        $stmt = $this->db->prepare("SELECT * FROM staffs WHERE staffID = ?");
        $stmt->bind_param("s", $id);
        $stmt->execute();
        return $stmt->get_result()->fetch_assoc();
    }

    public function getByPosition($position) {
        $stmt = $this->db->prepare("SELECT * FROM staffs WHERE position = ?");
        $stmt->bind_param("s", $position);
        $stmt->execute();
        
        $result = $stmt->get_result();
        $staffs = array();
        
        // Lấy tất cả các dòng kết quả vào mảng
        while($row = $result->fetch_assoc()) {
            $staffs[] = $row;
        }
        
        return $staffs;
    }
    // Thêm mới nhân viên
    public function addStaff($data) {
        // Kiểm tra nếu không có hình ảnh được chọn
        $hinhanh = isset($data['hinhanh']) && !empty($data['hinhanh']) ? $data['hinhanh'] : null;
    
        // Chuẩn bị câu truy vấn với NULL cho cột 'hinhanh' nếu không có ảnh
        $stmt = $this->db->prepare("INSERT INTO staffs (staffID, fullname, position, phone, hinhanh, status) VALUES (?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("ssssss", $data['staffID'], $data['fullname'], $data['position'], $data['phone'], $hinhanh, $data['status']);
    
        return $stmt->execute();
    }
    
    // Chỉnh sửa thông tin nhân viên
    public function editStaff($id, $data) {
        // Kiểm tra nếu trường 'hinhanh' có giá trị, nếu có thì cập nhật, nếu không thì giữ nguyên
        if (!empty($data['hinhanh'])) {
            // Cập nhật tất cả các trường, bao gồm cả 'hinhanh'
            $stmt = $this->db->prepare("UPDATE staffs SET fullname = ?, position = ?, phone = ?, hinhanh = ?, status = ? WHERE staffID = ?");
            $stmt->bind_param("ssssss", $data['fullname'], $data['position'], $data['phone'], $data['hinhanh'], $data['status'], $id);
        } else {
            // Nếu không có hình ảnh mới, chỉ cập nhật các trường khác trừ 'hinhanh'
            $stmt = $this->db->prepare("UPDATE staffs SET fullname = ?, position = ?, phone = ?, status = ? WHERE staffID = ?");
            $stmt->bind_param("sssss", $data['fullname'], $data['position'], $data['phone'], $data['status'], $id);
        }

        return $stmt->execute();
    }

    // Xóa nhân viên theo ID
    public function delete_staff($staffID) {
        $stmt = $this->db->prepare("DELETE FROM staffs WHERE staffID = ?");
        $stmt->bind_param("s", $staffID);
        
        if (!$stmt->execute()) {
            // Nếu có lỗi xảy ra, in ra lỗi
            echo "Lỗi khi xóa: " . $stmt->error;
            return false; // Trả về false nếu có lỗi
        }
        return true; // Trả về true nếu thành công
    }
}
?>
