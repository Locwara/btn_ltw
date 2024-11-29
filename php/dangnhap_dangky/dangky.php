<!doctype html>
<html lang="en">

<head>
    <title>Đăng ký</title>
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
            <form method="POST" action="insert_dangky.php" id="dang_ky_form">
                <h1>Đăng ký</h1>
                <div class="mb-3">
                    <label for="exampleInputEmail1" class="form-label">Username</label>
                    <input type="text" name="username" class="form-control" id="username"require onkeyup="return batloiusername()">
                    <p id="username_mess"></p>
                </div>
                <div class="mb-3">
                    <label for="exampleInputPassword1" class="form-label">Password</label>
                    <input type="password" name="password" class="form-control" id="password" require onkeyup=" return batloipassword()">
                    <p id="password_mess"></p>
                </div>
                <div class="mb-3">
                    <label for="exampleInputPassword1" class="form-label">Repeat Password</label>
                    <input type="password" name="rppassword" class="form-control" id="rppassword" require onkeyup="return batloirppassword()">
                    <p id="rppassword_mess"></p>
                </div>
                <div class="mb-3">
                    <label for="exampleInputEmail1" class="form-label">Email address</label>
                    <input type="email" name="email" class="form-control" id="email" aria-describedby="emailHelp" require onkeyup="return batloiemail()">
                    <p id="email_mess"></p>
                </div>
                <div class="mb-3">
                    <label for="" class="form-label" name="username">Name</label>
                    <input type="text" name="name" class="form-control" name="name" require id="name" onkeyup=" return batloiname()">
                    <p id="name_mess"></p>
                </div>
                <select class="form-select" id="gioitinh" name="gioitinh" aria-label="Default select example" require onkeyup="return batloigioitinh()">
                    <option selected disabled value="">Giới tính</option>
                    <option value="0">Nam</option>
                    <option value="1">Nữ</option>
                </select>
                <p id="gioitinh_mess"></p>
                <div class="chuanut">
                    <button type="submit" class="btn btn-primary">Đăng ký</button>
                </div>
                <div class="mb-3 qmk">
                    <a href="#">Quên mật khẩu</a>
                    <a href="index.php">Quay lại trang đăng nhập</a>
                </div>
            </form>
        </div>

    </main>
    <footer>
        <!-- place footer here -->
    </footer>
    <!-- Bootstrap JavaScript Libraries -->
    <script>
        function batloiusername() {
            var username = document.getElementById('username');
            var username_mess = document.getElementById('username_mess')
            rs = true
            if (username.value === '') {
                rs = false
                username.style.border = '1px solid red'
                username_mess.innerText = 'Username không được để trống!'
                username_mess.style.color = 'red'
                return rs
            } else if (username.value.length < 6 || username.value.length > 15) {
                rs = false
                username.style.border = '1px solid red'
                username_mess.innerText = 'Username từ 6-15 ký tự!'
                username_mess.style.color = 'red'
                return rs
            }
            $.ajax({
                url: 'check_username.php',
                type: 'POST',
                data: {
                    username: username.value
                },
                success: function(phanhoi) {
                    if (phanhoi === 'tontai') {
                        rs = false
                        username.style.border = '1px solid red'
                        username_mess.innerText = 'Username đã được sử dụng!'
                        username_mess.style.color = 'red'
                    } else {
                        username.style.border = '1px solid green'
                        username_mess.innerText = 'Username hợp lệ'
                        username_mess.style.color = 'green'
                    }
                },
            })
            return rs = true


        }
        document.getElementById('dang_ky_form').onsubmit = function(e) {
            if (!batloiusername()) {
                e.preventDefault()
            }
        }

        function batloiemail() {
            var email = document.getElementById('email')
            var email_mess = document.getElementById('email_mess')
            rs = true
            var checkemail = /^[a-zA-Z0-9._%+-]+@gmail\.com$/
            if (email.value === '') {
                rs = false
                email.style.border = '1px solid red'
                email_mess.innerText = 'Email không được để trống'
                email_mess.style.color = 'red'
                return rs
            } else if (!checkemail.test(email.value)) {
                rs = false
                email.style.border = '1px solid red'
                email_mess.innerText = 'Email phải có định dạng @gmail.com'
                email_mess.style.color = 'red'
                return rs
            }
            $.ajax({
                url: "check_email.php",
                type: 'POST',
                data: {
                    email: email.value
                },
                success: function(phanhoi) {
                    if (phanhoi === 'tontai') {
                        rs = false
                        email.style.border = '1px solid red'
                        email_mess.innerText = 'Email đã được sử dụng!'
                        email_mess.style.color = 'red'
                    } else {
                        email.style.border = '1px solid green'
                        email_mess.innerText = 'Email hợp lệ'
                        email_mess.style.color = 'green'
                    }
                },
            })
            return rs
        }

        function batloipassword() {
            password = document.getElementById('password')
            password_mess = document.getElementById('password_mess')
            rs = true
            if (password.value === '') {
                rs = false
                password.style.border = '1px solid red'
                password_mess.innerText = 'Password không được bỏ trống'
                password_mess.style.color = 'red'
                return rs
            } else if (password.value.length < 5 || password.value.length > 15) {
                rs = false
                password.style.border = '1px solid red'
                password_mess.innerText = 'Password phải từ 5-15 ký tự'
                password_mess.style.color = 'red'
            } else {
                password.style.border = '1px solid green'
                password_mess.innerText = 'Password hợp lệ'
                password_mess.style.color = 'green'
            }
        }

        function batloirppassword(){
            rppassword = document.getElementById('rppassword')
            rppassword_mess = document.getElementById('rppassword_mess')
            password = document.getElementById('password').value
            rs = true

            if(rppassword.value === ''){
                rs = false
                rppassword.style.border = '1px solid red'
                rppassword_mess.innerText = 'Nhập lại mật khẩu không được bỏ trống'
                rppassword_mess.style.color = 'red'
            }else if(rppassword.value != password){
                rs = false
                rppassword.style.border = '1px solid red'
                rppassword_mess.innerText = 'Nhập lại mật khẩu không đúng'
                rppassword_mess.style.color = 'red'
            }else{
                rppassword.style.border = '1px solid green'
                rppassword_mess.innerText = 'Nhập lại mật khẩu hợp lệ'
                rppassword_mess.style.color = 'green'
            }
              
        }


        function batloiname(){
            var name = document.getElementById('name')
            var name_mess = document.getElementById('name_mess')
            rs = true

            if(name.value === ''){
                rs = false
                name.style.border = '1px solid red'
                name_mess.innerText = 'Name không được bỏ trống'
                name_mess.style.color = 'red'
            }else if(name.value.length < 5){
                rs = false
                name.style.border = '1px solid red'
                name_mess.innerText = 'Username phải lớn hơn 5 ký tự'
                name_mess.style.color = 'red'
            }else{
                name.style.border = '1px solid green'
                name_mess.innerText = 'Name hợp lệ'
                name_mess.style.color = 'green'
            }
        }


        function batloigioitinh(){
            var gioitinh = document.getElementById('gioitinh')
            var gioitinh_mess = document.getElementById('gioitinh_mess')
            rs = true
            if(gioitinh.value === ''){
                rs = false
                gioitinh.style.border = '1px solid red'
                gioitinh_mess.innerText = 'Giới tính không được bỏ trống'
                gioitinh_mess.style.color = 'red'
            }else{
                gioitinh.style.border = '1px solid green'
                gioitinh_mess.innerText = 'Giới tính hợp lệ'
                gioitinh_mess.style.color = 'green'
            }
        }
    </script>
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