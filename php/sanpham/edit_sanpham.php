<?php

require "../connect.php";   

if (isset($_POST['edit'])) { 
    $name = $_POST['name']; 
    $price = $_POST['price'];
    $description = $_POST['description'];
    $trangthai = $_POST['trangthai'];
    $id = $_GET['id'];

    // Xử lý tệp hình ảnh
    if (isset($_FILES['image']) && $_FILES['image']['error'] == 0) {
        $target_dir = "../images/";
        
        // Kiểm tra và tạo thư mục nếu chưa tồn tại
        if (!is_dir($target_dir)) {
            mkdir($target_dir, 0777, true);
        }

        $target_file = $target_dir . basename($_FILES["image"]["name"]);

        // Upload tệp
        move_uploaded_file($_FILES["image"]["tmp_name"], $target_file);
        
        // Cập nhật hình ảnh mới
        $image = 'images/' . basename($_FILES["image"]["name"]);
    } else {
        // Giữ nguyên hình ảnh cũ nếu không có hình mới
        $image = $sp['image'];
    }

    // Cập nhật thông tin sản phẩm vào cơ sở dữ liệu
    $sql = "UPDATE products SET name = '$name', price = '$price', description = '$description', image = '$image', status = '$trangthai' WHERE id = $id";

    if ($conn->query($sql) === TRUE) {
        echo "Record updated successfully";
        header("Location: ../trangchu.php");
    } else {
        echo "Error updating record: " . $conn->error;
    }
}
