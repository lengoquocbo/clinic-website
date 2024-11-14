<?php
require_once 'connectdb.php';

class PaymentModel {
    private $db;
    
    public function __construct()
    {
        $this->db = Database::getInstance()->getConection();
    }
    
    public function getPaymentDetailsByPatient($patientID) {
        $sql = "SELECT p.fullname, e.exdaytime, e.price AS priceexamine, s.price AS priceservice 
                FROM examine e 
                LEFT JOIN payments pa ON pa.EXID = e.EXID 
                LEFT JOIN patients p ON p.patientID = e.patientID 
                LEFT JOIN useservices us ON us.EXID = e.EXID 
                LEFT JOIN services s ON s.serviceID = us.serviceID
                WHERE e.patientID = ?;";

        $stmt = $this->db->prepare($sql);
        
        // Bind the parameter
        $stmt->bind_param("s", $patientID); // 's' for string
        
        // Execute the statement
        $stmt->execute();
        
        // Get the result
        $result = $stmt->get_result();
        
        // Fetch all rows as an associative array
        $data = $result->fetch_all(MYSQLI_ASSOC);
        
        $stmt->close();
        
        return $data;
    }
}
?>
