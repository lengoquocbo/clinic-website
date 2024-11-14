<?php
require_once __DIR__ .'../../../../model/paymentmodel.php';
require_once __DIR__ . '../../../../../../vendor/tecnickcom/tcpdf/tcpdf.php';
date_default_timezone_set('Asia/Ho_Chi_Minh');

if (isset($_GET['p'])) {
    $patientID = $_GET['p'];
    
    try {
        while (ob_get_level()) {
            ob_end_clean();
        }
        
        $pdf = new TCPDF('P', 'mm', 'A4', true, 'UTF-8');
        $pdf->setPrintHeader(false);
        $pdf->setPrintFooter(false);
        $pdf->SetMargins(15, 15, 15);
        $pdf->SetFont('dejavusans', '', 12);
        $pdf->AddPage();
        
        $thanhtoan = new PaymentModel();
        $data = $thanhtoan->getPaymentDetailsByPatient($patientID);
        
        if (!empty($data)) {
            // Lấy danh sách thuốc và tính tổng tiền thuốc
            $examinationFee= $data[0]['priceservice'] ;
            $totalAmount= $data[0]['priceexamine'] ;
            $totalMedicineCost = $totalAmount -$examinationFee;
            $style = '
            <style>
                .header {
                    text-align: center;
                    margin-bottom: 20px;
                }
                .title {
                    font-size: 20px;
                    font-weight: bold;
                    margin: 20px 0;
                }
                .info-label {
                    font-weight: bold;
                    margin-right: 10px;
                }
                table {
                    width: 100%;
                    margin-top: 20px;
                }
                td {
                    padding: 8px;
                }
                .payment-details {
                    margin-top: 30px;
                    border-top: 1px solid #ddd;
                    padding-top: 20px;
                }
                .total {
                    font-weight: bold;
                    font-size: 14px;
                    margin-top: 10px;
                    border-top: 2px solid #000;
                    padding-top: 10px;
                }
            </style>';

            $html = $style . '
            <div class="header">
                <h2>HÓA ĐƠN THANH TOÁN</h2>
                <p>VINMECLATEST</p>
            </div>

            <table cellpadding="5" border="0">
                <tr>
                    <td width="30%"><span class="info-label">Mã bệnh nhân:</span></td>
                    <td width="70%">' . $patientID . '</td>
                </tr>
                <tr>
                    <td><span class="info-label">Họ và tên:</span></td>
                    <td>' . $data[0]['fullname'] . '</td>
                </tr>
                <tr>
                    <td><span class="info-label">ngày giờ khám:</span></td>
                    <td>' . $data[0]['exdaytime'] . '</td>
                </tr>
                <tr>
                    <td><span class="info-label">Ngày thanh toán:</span></td>
                    <td>' . date('d/m/Y H:i') . '</td>
                </tr>
            </table>

            <div class="payment-details">
                <h3>CHI TIẾT THANH TOÁN</h3>
                <table cellpadding="5" border="0">
                    <tr>
                        <td width="70%">Tiền khám:</td>
                        <td width="30%" style="text-align: right;">' . number_format($examinationFee, 0, ',', '.') . ' VNĐ</td>
                    </tr>
                    <tr>
                        <td>Tiền thuốc:</td>
                        <td style="text-align: right;">' . number_format($totalMedicineCost, 0, ',', '.') . ' VNĐ</td>
                    </tr>
                    <tr class="total">
                        <td>TỔNG CỘNG:</td>
                        <td style="text-align: right;">' . number_format($totalAmount, 0, ',', '.') . ' VNĐ</td>
                    </tr>
                </table>
            </div>

            <table style="margin-top: 50px;">
                <tr>
                    <td width="50%" style="text-align: center;">
                        Người thanh toán
                        <br><br><br>
                        (Ký và ghi rõ họ tên)
                    </td>
                    <td width="50%" style="text-align: center;">
                        Thu ngân
                        <br><br><br>
                        (Ký và ghi rõ họ tên)
                    </td>
                </tr>
            </table>';

            $pdf->writeHTML($html, true, false, true, false, '');
            
            header('Content-Type: application/pdf');
            header('Cache-Control: public, must-revalidate, max-age=0');
            header('Pragma: public');
            header('Content-Disposition: inline; filename="HOADON_' . $patientID . '.pdf"');
            
            $pdf->Output('HOADON_' . $patientID . '.pdf', 'I');
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