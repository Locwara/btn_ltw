<?php
require "../connect.php";
if (isset($_POST['username'])) {
    $username = $_POST['username'];
    $check = "SELECT username FROM user WHERE username = ?";

    $nhap  = $conn->prepare($check);
    $nhap->bind_param("s", $username);
    $nhap->execute();
    $ketqua = $nhap->get_result();
    if ($ketqua->num_rows > 0) {
        echo "tontai";
    }else{
        echo "chuatontai";
    }
}
