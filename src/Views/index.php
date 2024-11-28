<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Phòng Khám Sức Khỏe</title>
    <link rel="stylesheet" href="assets/css/UI.css">
    <link rel="stylesheet" href="assets/css/responsiveUI.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    
</head>
<body>
    <!-- header section start -->
    <?php
    require_once("header_footer/header.php")
    ?>
    <!-- header section end -->

    <!-- home section start -->
    <?php
        require_once 'dieuhuong.php';
    ?>
    <!-- home section end -->

    <!-- footer section start -->
    <?php
    require_once("header_footer/footer.php")
    ?>
    <!-- footer section end -->
     
    
</body>
</html>
<script src="assets/js/UI.js"></script>