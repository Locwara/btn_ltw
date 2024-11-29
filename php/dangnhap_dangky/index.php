<!doctype html>
<html lang="en">

<head>
    <title>Title</title>
    <!-- Required meta tags -->
    <meta charset="utf-8" />
    <meta
        name="viewport"
        content="width=device-width, initial-scale=1, shrink-to-fit=no" />

    <!-- Bootstrap CSS v5.2.1 -->
    <link
        href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css"
        rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN"
        crossorigin="anonymous" />
        <link rel="stylesheet" href="../../css/styles.css">
</head>

<body>
    <header>
        <!-- place navbar here -->
    </header>
    <main>
        <div class="container">
            <form method="post" action="" onsubmit=" return batloi()" id="dang_nhap_form">
                <h1>Đăng nhập</h1>
                <div class="mb-3">
                    <label for="exampleInputEmail1" class="form-label" name= "username">Username</label>
                    <input type="text" class="form-control" id="username" name="username">
                </div>
                <div class="mb-3">
                    <label for="exampleInputPassword1" class="form-label">Password</label>
                    <input type="password" class="form-control" id="password" name="password">
                </div>
                <p id="tb"></p>
                <button type="submit"  class="btn btn-primary">đăng nhập</button>
                <div class="mb-3 qmk">
                    <a href="#">Quên mật khẩu</a>

                </div>
                <div class="mb-3 dk">
                    <p>Chưa có tài khoản? <a href="dangky.php">Đăng ký</a></p>
                </div>
            </form>
        </div>
    </main>
    <script>
        function batloi(){
            var username = document.getElementById('username')
            var password = document.getElementById('password')
            var tb = document.getElementById('tb')
            rs = true
            $.ajax({
                url: 'check_dangnhap.php',
                type: 'POST',
                data: {
                    username: username.value, 
                    password: password.value
                },
                success: function(phanhoi){
                    if(phanhoi === 'co'){
                        username.style.border = '1px solid green'
                        password.style.border = '1px solid green'
                        tb.innerText = 'hợp lệ'
                        tb.style.color = 'green'
                        window.location.href = '../trangchu.php'
                    }else{
                        rs = false
                        username.style.border = '1px solid red'
                        password.style.border = '1px solid red'
                        tb.innerText = 'Tài khoản hoặc mật khẩu không chính xác!'
                        tb.style.color = 'red'
                        return rs
                    }
                },
            })
            
            
        }
        document.getElementById('dang_nhap_form').onsubmit = function(e){
            if(!batloi()){
                e.preventDefault()
            }
        }
    </script>
    <footer>
        <!-- place footer here -->
    </footer>
    <!-- Bootstrap JavaScript Libraries -->
    <script
        src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"
        integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r"
        crossorigin="anonymous"></script>
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script
        src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js"
        integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+"
        crossorigin="anonymous"></script>
</body>

</html>