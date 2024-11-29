<?php

require "../connect.php";
$name = $_POST['tensanpham'];
$gia = $_POST['gia'];
$mota = $_POST['mota'];
$anh = $_FILES['anh'];
$trangthai = $_POST['trangthai'];


if ($anh['error'] === UPLOAD_ERR_OK) {
    $chuaanh = '../images/';
    if (!is_dir($chuaanh)) {
        mkdir($chuaanh, 0777, true);
    }
    $duongdan = $chuaanh . basename($anh['name']);
    if (move_uploaded_file($anh['tmp_name'], $duongdan)) {
        $img_path = 'images/' . basename($anh['name']);
        $sql = "INSERT INTO products (name, price, description, image, status) VALUES('$name', '$gia', '$mota', '$img_path', '$trangthai')";
        if ($conn->query($sql) === true) {
            echo "Thêm sản phẩm thành công";
            header("Location: ../trangchu.php");
            exit();
        } else {
            echo "Thêm sản phẩm không thành công";
        }
    }else{
        echo"không thể tải lên file ảnh";
    }
}else{
    echo"lỗi upload";
}


$conn->close();
