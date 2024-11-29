<?php
require "../connect.php";

$username = $_POST['username'];
$password = $_POST['password'];
$email = $_POST['email'];
$name = $_POST['name'];
$gioitinh = $_POST['gioitinh'];

$sql = "INSERT INTO user (username, password, email, name, role) VALUES ('$username', '$password', '$email', '$name', '$gioitinh')";

if ($conn->query($sql) === TRUE) {
    echo "Đăng ký thành công";
    header("Location: ../trangchu.php");
} else {
    echo "Lỗi: " . $sql . "<br>" . $conn->error;
}

$conn->close();
