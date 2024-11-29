<?php
    require "../connect.php";

    if(isset($_POST['email'])){
        $email = mysqli_real_escape_string($conn, $_POST['email']);
        $check = "SELECT email FROM user WHERE email = ?";

        $nhap = $conn->prepare($check);
        $nhap->bind_param("s", $email);
        $nhap->execute();
        $kq = $nhap->get_result();
        if($kq->num_rows > 0){
            echo"tontai";
        }else{
            echo"chuatontai";
        }
    }
?>
