

<?php

$password = "123456";

// Tạo hai hash khác nhau từ cùng một mật khẩu
$hash1 = password_hash($password, PASSWORD_BCRYPT);
$hash2 = password_hash($password, PASSWORD_BCRYPT);

echo "Hash 1: " . $hash1 . PHP_EOL;
echo "Hash 2: " . $hash2 . PHP_EOL;

// So sánh hai hash (chúng sẽ không bằng nhau)
var_dump($hash1 === $hash2); // Kết quả: false

// Sử dụng password_verify
$isValid1 = password_verify($password, $hash1); // Kết quả: true
$isValid2 = password_verify($password, $hash2); // Kết quả: true

echo "Verify hash 1: " . ($isValid1 ? 'Valid' : 'Invalid') . PHP_EOL;
echo "Verify hash 2: " . ($isValid2 ? 'Valid' : 'Invalid') . PHP_EOL;?>
