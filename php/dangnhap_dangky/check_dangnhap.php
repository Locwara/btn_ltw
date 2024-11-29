<?php
    require "../connect.php";
    session_start();
    if(isset($_POST['username'], $_POST['password'])){
        $username = $_POST['username'];
        $password = $_POST['password'];
    }
    $check = "SELECT username, password FROM user WHERE username = ? AND password = ?";
    

    $kt = $conn->prepare($check);
    $kt->bind_param("ss", $username ,$password);
    $kt->execute();
    $kq = $kt->get_result();
    if($kq->num_rows > 0){
        echo "co";
        $_SESSION['username'] = $username;
    }else{
        echo"khong";
    }
?>