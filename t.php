


<?php
// สร้างการเชื่อมต่อฐานข้อมูล
$servername = "localhost";
$username = "root";
$password = "";
$db = "project65";
$conn = new mysqli($servername, $username, $password, $db);

// ตรวจสอบการเชื่อมต่อ
if ($conn->connect_error) {
    die("การเชื่อมต่อล้มเหลว: " . $conn->connect_error);
}


$sql = "SELECT COUNT(*) as row_count FROM admin_user";
$result = $conn->query($sql);

// ตรวจสอบผลลัพธ์
if ($result->num_rows > 0) {
    // อ่านข้อมูลแถวแรก
    $row = $result->fetch_assoc();
    $row_count = $row["row_count"];

    // สร้างโค้ด HTML
    echo "<p>จำนวนแถว: $row_count</p>";
} else {
    echo "ไม่พบข้อมูล";
}

// ปิดการเชื่อมต่อ
$conn->close();
?>