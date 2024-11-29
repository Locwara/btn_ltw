<?php
session_start();
if (!isset($_SESSION['username'])) {
    header("Location: ../dangnhap_dangky/index.php");
    exit();
}
?>
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
    <link rel="stylesheet" href="../../css/themsanpham.css">
</head>

<body>
    <header>
        <nav class="navbar navbar-expand-lg bg-body-tertiary">
            <div class="container-fluid">

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                        <li class="nav-itema">
                            <a class="nav-link active" aria-current="page" href="nhapsanpham.php">Thêm sản phẩm</a>
                        </li>
                        <li class="nav-itemb">
                            <a class="nav-link active" aria-current="page" href="../trangchu.php">Danh sách sản phẩm</a>
                        </li>
                    </ul>

                    <button class="btn dx btn-outline-success" id="dx">Đăng xuất</button>
                </div>
            </div>
        </nav>
    </header>

    <main>
        <div class="container1">
            <form method="post" action="insert_sanpham.php" id="dang_nhap_form" enctype="multipart/form-data">
                <h1>Thêm sản phẩm</h1>
                <div class="mb-3">
                    <input type="text" class="form-control" id="tensanpham" name="tensanpham" placeholder="Tên sản phẩm" onkeyup=" return themten()">
                    <p id="tensanpam_mess"></p>
                </div>
                <div class="mb-3">
                    <input type="text" class="form-control" id="gia" name="gia" placeholder="Giá" onkeyup="return hiengia()">
                    <p id="gia_mess"></p>
                </div>
                <div class="mb-3">
                    <textarea name="mota" id="mota" placeholder="Nhập mô tả sản phẩm" onkeyup=" return hienmota()"></textarea>
                    <p id="mota_mess"></p>
                </div>
                <div class="mb-3">
                    <label for="exampleInputPassword1" class="form-label">Ảnh sản phẩm:</label>
                    <input type="file" name="anh" id="anh">
                    <p id="anh_mess"></p>
                </div>
                <select class="form-select" id="trangthai" name="trangthai" aria-label="Default select example" require onkeyup="return batloigioitinh()">
                    <option selected disabled value="">Trạng thái</option>
                    <option value="1">Hiển thị</option>
                    <option value="2">Ẩn</option>
                    <option value="3">Khóa</option>
                </select>
                <button type="submit" class="btn btn-primary">Thêm</button>
            </form>
        </div>
        <div class="chuasanpham">
            <h3>Xem trước</h3>
            <div class="chuaanh">
                <img alt="">
            </div>
            <div class="chuachu">
                <h4 id="hientensanpham"> Tên sản phẩm: </h4>
                <p id="hiengia"> Giá: </p>
                <textarea disabled id="hienmota"> Mô tả: </textarea>
            </div>
        </div>
        <div id="chuadx">
            <p>Bạn có muốn đăng xuất không?</p>
            <div class="chuaxn">
                <button class="btn1" id="xacnhandx">Có</button>
                <button class="btn1" id="huydx">Không</button>
            </div>
        </div>  
    </main>
    <style>
        #trangthai {
            margin-bottom: 10px;
        }
        .btn1 {
            text-decoration: none;
            line-height: 2.6em;
            text-align: center;
        }

        .btn1 {
            --color: #0077ff;
            font-family: inherit;
            display: inline-block;
            width: 6em;
            height: 2.6em;
            line-height: 2.5em;
            overflow: hidden;
            cursor: pointer;
            margin: 20px;
            font-size: 17px;
            z-index: 1;
            color: var(--color);
            border: 2px solid var(--color);
            border-radius: 6px;
            position: relative;
        }

        .btn1::before {
            position: absolute;
            content: "";
            background: var(--color);
            width: 150px;
            height: 200px;
            z-index: -1;
            border-radius: 50%;
        }

        .btn1:hover {
            color: white;
        }

        .btn1:before {
            top: 100%;
            left: 100%;
            transition: 0.3s all;
        }

        .btn1:hover::before {
            top: -30px;
            left: -30px;
        }

    </style>
    <script>
        function themten() {
            var tensanpham = document.getElementById('tensanpham').value
            var hientensanpham = document.getElementById('hientensanpham')
            hientensanpham.innerText = 'Tên sản phẩm: ' + tensanpham
        }

        function hiengia() {
            var gia = document.getElementById('gia').value
            var hiengia = document.getElementById('hiengia')
            hiengia.innerText = 'Giá: ' + gia
        }

        function hienmota() {
            var mota = document.getElementById('mota').value
            var hienmota = document.getElementById('hienmota')
            hienmota.innerText = 'Mô tả: ' + mota
        }

        function hienanh() {
            var anh = document.getElementById('anh')
            var hienthianh = document.querySelector('.chuaanh img')

            if (anh.files && anh.files[0]) {
                var rd = new FileReader();
                rd.onload = function(e) {
                    hienthianh.src = e.target.result;
                }
                rd.readAsDataURL(anh.files[0]);
            }
        }
        document.getElementById('anh').addEventListener('change', hienanh)


        document.addEventListener('DOMContentLoaded', () =>{
            var btndx = document.getElementById('dx')
            var huydx = document.getElementById('huydx')
            var xndx = document.getElementById('xacnhandx')
            var form_dx = document.getElementById('chuadx')


            btndx.addEventListener('click', () => {
                form_dx.style.display = 'block'
            })

            xndx.addEventListener('click', () => {
                window.location.href = 'dangnhap_dangky/dangxuat.php'
            })
            huydx.addEventListener('click', () => {
                form_dx.style.display = 'none'
            })
        })
    </script>
    <style>
        .nav-itema {
            color: #000 !important;
            font-weight: bold;
        }
        #chuadx {
            position: fixed;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            display: none;
            padding: 20px;
            background: #fff;
            border: 1px solid #000;
            border-radius: 8px;
            width: 350px;
            height: 150px;
            z-index: 1001;
        }
    </style>
    <footer>
        <!-- place footer here -->
    </footer>
    <!-- Bootstrap JavaScript Libraries -->
    <script
        src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"
        integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r"
        crossorigin="anonymous"></script>

    <script
        src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js"
        integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+"
        crossorigin="anonymous"></script>
</body>

</html>