<?php
require_once __DIR__ .'../../../model/benhnhanmodel.php';

require_once __DIR__ . '/../../../../vendor/tecnickcom/tcpdf/tcpdf.php';

if (isset($_GET['id'])) {
    $patientID = $_GET['id'];
    
    try {
        // Xóa mọi output buffer
        while (ob_get_level()) {
            ob_end_clean();
        }
        
        // Khởi tạo TCPDF với encoding UTF-8
        $pdf = new TCPDF('P', 'mm', 'A4', true, 'UTF-8');
        
        // Xóa header và footer mặc định
        $pdf->setPrintHeader(false);
        $pdf->setPrintFooter(false);
        
        // Set margins
        $pdf->SetMargins(15, 15, 15);
        
        // Đặt font là Times
        $pdf->SetFont('dejavusans', '', 12);
        
        // Thêm trang mới
        $pdf->AddPage();
        
        // Lấy dữ liệu bệnh nhân
        $benhnhan = new benhnhan();
        $data = $benhnhan->getByid($patientID);
        
        if (!empty($data)) {
            // CSS styles
            $style = '
            <style>
                .header {
                    width: 100%;
                    margin-bottom: 50px;
                }
                .header-left {
                    font-size: 14px;
                    font-weight: bold;
                    color: #333;
                }
                .header-right {
                    text-align: center;
                }
                .header-right h3 {
                    font-size: 18px;
                    margin: 0;
                }
                .header-right h6 {
                    font-size: 14px;
                    font-style: italic;
                    margin: 5px 0;
                }
                .title {
                    text-align: center;
                    color: #2e5cb8;
                    font-size: 24px;
                    font-weight: bold;
                    margin: 20px 0;
                    margin-top: 20px;
                }
                .section-title {
                    font-size: 20px;
                    color: #444;
                    margin: 15px 0 10px;
                    font-weight: bold;
                }
                .info-label {
                    font-weight: bold;
                    margin-right: 10px;
                }
                table {
                    width: 100%;
                    border-collapse: collapse;
                    margin-top: 10px;
                }
                th {
                    background-color: #08a808;
                    color: white;
                    padding: 10px;
                    text-align: left;
                }
                td {
                    padding: 10px;
                    border: 1px solid #ddd;
                }
            </style>';

            // Build the HTML content
            $html = $style . '
            <table class="header" cellpadding="5">
                <tr>
                    <td class="header-left" width="30%">VINMECLATEST</td>
                    <td class="header-right" width="80%">
                        <h3>CỘNG HÒA XÃ HỘI CHỦ NGHĨA VIỆT NAM</h3>
                        <h6>Độc lập - Tự do - Hạnh phúc</h6>
                        <h6 style="margin-top: 10px;">Ngày: ' . date('d/m/Y') . '</h6> <!-- Ngày tháng năm -->
                    </td>
                </tr>
            </table>

            <div  class="title">BẢN TÓM TẮT HỒ SƠ BỆNH ÁN</div>

            <h3 class="section-title">I. HÀNH CHÍNH</h3>
            <table cellpadding="5" border="0">
                <tr>
                    <td width="30%"><span class="info-label">Họ và tên:</span></td>
                    <td width="70%">' . $data[0]['fullname'] . '</td>
                </tr>
                <tr>
                    <td><span class="info-label">Sinh nhật:</span></td>
                    <td>' . $data[0]['birthdate'] . '</td>
                </tr>
                <tr>
                    <td><span class="info-label">Giới tính:</span></td>
                    <td>' . $data[0]['sex'] . '</td>
                </tr>
                <tr>
                    <td><span class="info-label">Địa chỉ cư trú:</span></td>
                    <td>' . $data[0]['address'] . '</td>
                </tr>
            </table>

            <h3 class="section-title">II. KHÁM BỆNH</h3>
            <table cellpadding="5" border="0">
                <tr>
                    <td width="30%"><span class="info-label">Bác sĩ khám bệnh:</span></td>
                    <td width="70%">' . $data[0]['staffName'] . '</td>
                </tr>
                <tr>
                    <td><span class="info-label">Ngày khám:</span></td>
                    <td>' . $data[0]['exdaytime'] . '</td>
                </tr>
                <tr>
                    <td><span class="info-label">Khám về:</span></td>
                    <td>' . $data[0]['servicename'] . '</td>
                </tr>
                <tr>
                    <td><span class="info-label">Hình thức khám:</span></td>
                    <td>' . $data[0]['visittype'] . '</td>
                </tr>
                <tr>
                    <td><span class="info-label">Chuẩn đoán:</span></td>
                    <td>' . $data[0]['diagnose'] . '</td>
                </tr>
                <tr>
                    <td><span class="info-label">Kết luận:</span></td>
                    <td>' . $data[0]['results'] . '</td>
                </tr>
            </table>

            <h3 class="section-title">III. PHƯƠNG PHÁP ĐIỀU TRỊ</h3>';
            $html.='Ghi chú :......................................................................';
                $html.='...............................................................................';
                $html.='...............................................................................';
                $html.='...............................................................................';
                $html.='..............................................................................';
            // Lấy danh sách thuốc
            $medicineList = $benhnhan->getmedicine($data[0]['userviceID']);
            if (!empty($medicineList)) {
                $html .= '
                <table cellpadding="5">
                    <tr>
                        <th width="40%">Tên thuốc</th>
                        <th width="20%">Số lượng</th>
                        <th width="40%">Liều lượng</th>
                    </tr>';
                
                foreach ($medicineList as $medicine) {
                    $html .= '
                    <tr>
                        <td>' . $medicine['name'] . '</td>
                        <td>' . $medicine['SOLUONG'] . '</td>
                        <td>' . $medicine['note'] . '</td>
                    </tr>';
                }
                $html .= '</table>';
                
            } else {
                $html .= '<p>Không có thông tin thuốc</p>';
            }

            // Ghi nội dung vào PDF
            $pdf->writeHTML($html, true, false, true, false, '');
            
            // Thêm phần ký tên bác sĩ
            $pdf->Ln(20); // Dòng trống trước khi ký tên
            $pdf->Cell(0, 10, 'Ngày ........ tháng ........ năm ........', 0, 1, 'R');
            $pdf->Cell(0, 10, 'Bác sĩ ký tên', 0, 1, 'R');
            $pdf->Cell(0, 10, '(Ký và ghi rõ họ tên)', 0, 1, 'R');
            
            // Set headers
            header('Content-Type: application/pdf');
            header('Cache-Control: public, must-revalidate, max-age=0');
            header('Pragma: public');
            header('Content-Disposition: inline; filename="HOSOBENHAN_' . $patientID . '.pdf"');
            
            // Output PDF
            $pdf->Output('HOSOBENHAN_' . $patientID . '.pdf', 'I');
            exit();
        } else {
            throw new Exception("Không tìm thấy thông tin bệnh nhân.");
        }
    } catch (Exception $e) {
        echo 'Lỗi: ' . $e->getMessage();
    }
} else {
    echo "Không có mã bệnh nhân!";
}
?>
