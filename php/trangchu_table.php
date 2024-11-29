<?php
session_start();
if (!isset($_SESSION['username'])) {
    header("Location: dangnhap_dangky/index.php");
    exit();
}

?>

<!doctype html>
<html lang="en">

<head>
    <title>Trang chủ</title>
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
</head>

<body>
    <header>
        <nav class="navbar navbar-expand-lg bg-body-tertiary">
            <div class="container-fluid">

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                        <li class="nav-itema">
                            <a class="nav-link active" aria-current="page" href="sanpham/nhapsanpham.php">Thêm sản phẩm</a>
                        </li>
                        <li class="nav-itemb">
                            <a class="nav-link active" aria-current="page" href="trangchu.php">Danh sách sản phẩm</a>
                        </li>
                    </ul>
                    <form class="d-flex" action="trangchu_table.php" method="GET" role="search">
                        <input class="form-control me-2" type="search" name="search" placeholder="Search theo tiêu đề" aria-label="Search">
                        <button class="btn btn-outline-success" type="submit">Search</button>
                    </form>


                    <button class="btn dx btn-outline-success" id="dx">Đăng xuất</button>
                </div>
            </div>
        </nav>
    </header>
    <main>
        <ul class="navbar-nav1">
            <li class="nav-item1">
                <a class="nav-link active" aria-current="page" href="trangchu_table.php">Dạng bảng</a>
            </li>
            <li class="nav-item1">
                <a class="nav-link active" aria-current="page" href="trangchu.php">Dạng sản phẩm</a>
            </li>
        </ul>
        <?php
        require "connect.php";
        $timkiem = isset($_GET['search']) ? $_GET['search'] : '';

        if (!empty($timkiem)) {
            $sql = "SELECT * FROM products WHERE name LIKE ?";
            $kt = $conn->prepare($sql);
            $timkiemsql = "%{$timkiem}%";
            $kt->bind_param("s", $timkiemsql);
            $kt->execute();
            $kq = $kt->get_result();
        } else {
            $sql = "SELECT * FROM products";
            $kq = $conn->query($sql);
        }

        $sps = [];
        if ($kq->num_rows > 0) {
            $sps = $kq->fetch_all(MYSQLI_ASSOC);
        }
        ?>
        <H1>DANH SÁCH SẢN PHẨM ĐÃ THÊM</H1>
        <div class="chuacontent">
            <div class="container mt-3">
                <h2>Striped Rows</h2>
                <p>The .table-striped class adds zebra-stripes to a table:</p>
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>Tên sản phẩm</th>
                            <th>Giá</th>
                            <th>Mô tả</th>
                            <th>Trạng thái</th>
                            <th>Thao tác</th>

                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($sps as $sp) { ?>
                            <tr>
                                <td><?php echo $sp['name'] ?></td>
                                <td><?php echo $sp['price'] ?></td>
                                <td><?php echo $sp['description'] ?></td>
                                <td> <?= ($sp['status'] == 1) ? 'Hiển thị' : (($sp['status'] == 2) ? 'Ẩn' : 'Đã khóa') ?></td>
                                <td>
                                    <div class="chuabtn">
                                        <a class="btn1" href="edit.php?id=<?php echo $sp['id'] ?>">Sửa</a>
                                        <a class="btn1 xoa" href="#" data-id=<?php echo $sp['id'] ?>>Xóa</a>
                                    </div>
                                </td>

                            </tr>
                        <?php
                        }
                        ?>
                    </tbody>
                </table>
                <div id="chuaxoa">
                    <p>Bạn có muốn xóa không?</p>
                    <div class="chuaxn">
                        <button class="btn1" id="xacnhan">Có</button>
                        <button class="btn1" id="huy">Không</button>
                    </div>
                </div>
                <div id="chuadx">
                    <p>Bạn có muốn đăng xuất không?</p>
                    <div class="chuaxn">
                        <button class="btn1" id="xacnhandx">Có</button>
                        <button class="btn1" id="huydx">Không</button>
                    </div>
                </div>
            </div>
        </div>

    </main>
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
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            var btnxoa = document.getElementById('xoa')
            var huy = document.getElementById('huy')
            var xn = document.getElementById('xacnhan')
            var form_xoa = document.getElementById('chuaxoa')
            var id_form = null
            document.querySelectorAll('.xoa').forEach(btn => {
                btn.addEventListener('click', (e) => {
                    id_form = e.target.getAttribute('data-id')
                    form_xoa.style.display = 'block';

                })
            })

            xn.addEventListener('click', () => {
                if (id_form) {
                    window.location.href = `delete.php?id=${id_form}`
                }
            })


            huy.addEventListener('click', () => {
                form_xoa.style.display = 'none'
                id_form = null
            })

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
        .d-flex {
            margin-right: 10px;
        }

        .nav-itemb {
            color: #000 !important;
            font-weight: bold;
        }

        .navbar-nav1 {
            display: flex;
            gap: 10px;
            list-style: none;
        }

        .nav-item1:first-child {
            background-color: green;
            color: #fff;
        }

        .nav-item1 {
            padding: 4px;
            border-radius: 4px;
            border: 1px solid gray;
            max-width: 150px;
            margin-top: 10px;
        }

        #dang {
            max-width: 100px;
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
            width: 400px;
            height: 150px;
            z-index: 1001;
        }

        #chuaxoa {
            position: fixed;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            display: none;
            padding: 20px;
            background: #fff;
            border: 1px solid #000;
            border-radius: 8px;
            width: 400px;
            height: 200px;
        }

        #chuaxoa p {
            font-size: 25px;
            font-weight: bold;
            text-align: center;
        }

        .chuaxn {
            display: flex;
            justify-content: center;
            align-items: center;
            gap: 10px;
        }

        .chuaxn a {
            text-decoration: none;
        }

        .chuaspall {
            display: grid;
            grid-template-columns: 1fr 1fr 1fr;
            gap: 20px;
            max-width: 90vw;

        }

        /* From Uiverse.io by yaasiinaxmed */
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

        .mt-3 {
            border: 1px solid gray;
            border-radius: 4px;
            padding: 8px;
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


        .chuasanpham {
            padding: 10px;
            border: 1px solid gray;
            border-radius: 8px;
            display: flex;
            flex-direction: column;
        }

        .chuachu {
            border: 1px solid gray;
            border-radius: 8px;
            padding: 20px;
        }

        .chuachu textarea {
            border: none;
            min-width: 350px;
        }

        .chuasanpham img {
            max-height: 300px;
            border-radius: 8px;
            border: 1px solid white;

        }

        .chuaanh {
            display: flex;
            justify-content: center;
            align-items: center;
            padding: 10px;
            border-radius: 8px;
            background-color: rgba(128, 128, 128, 0.1);
            margin-bottom: 10px;
            min-height: 400px;
            max-height: 400px;
        }

        .chuacontent {
            display: flex;
            justify-content: center;
            align-items: center;
            margin-top: 24px;
            padding: 10px;
        }

        main h1 {
            text-align: center;
        }

        .chuabtn {
            padding: 10px;
            margin-bottom: 10px;

        }

        #btn {
            background-color: #4CAF50;
            color: white;
            padding: 10px 20px;
            text-decoration: none;
            cursor: pointer;
        }
    </style>
</body>

</html>