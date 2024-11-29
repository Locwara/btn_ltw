<?php
require "connect.php";
$id = $_GET["id"];

$sql = "SELECT * FROM products WHERE id = $id";
$rs = $conn->query($sql);
if ($rs->num_rows > 0) :
    $sps = $rs->fetch_all(MYSQLI_ASSOC);
    $sp = $sps[0];
    $Description = isset($sp['description']) ? $sp['description'] : '';
    $Image = isset($sp['image']) ? $sp['image'] : '';
?>

    <?php
    // Lấy giá trị mô tả sản phẩm từ mảng $sp

    ?>

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
    <style>
        #image {
            width: 400px;
            height: auto;
        }

        body {
            font-family: Arial, sans-serif;
            background-color: #f0f0f0;
            margin: 0;
            padding: 0;
            height: 100vh;
        }

        .container1 {
            display: flex;
            justify-content: center;
            background: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            max-width: 500px;
            width: 100%;
            margin: 20px;
        }

        .container1 h1 {
            margin-bottom: 20px;
            font-size: 24px;
            color: #333;
            text-align: center;
        }

        .form-group {
            margin-bottom: 15px;
        }

        .form-group input,
        .form-group textarea {
            width: 100%;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 4px;
            font-size: 16px;
            box-sizing: border-box;
        }

        .form-group textarea {
            resize: vertical;
            min-height: 100px;
        }

        .form-group img {
            display: block;
            max-width: 100%;
            height: auto;
            margin-top: 10px;
            border: 1px solid #ddd;
            border-radius: 4px;
        }

        .form-label {
            display: block;
            margin-bottom: 5px;
            font-weight: bold;
            color: #555;
        }



        main {
            display: flex;
            justify-content: center;
        }
    </style>

    <body>
        <header>
            <nav class="navbar navbar-expand-lg bg-body-tertiary">
                <div class="container-fluid">

                    <div class="collapse navbar-collapse" id="navbarSupportedContent">
                        <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                            <li class="nav-item">
                                <a class="nav-link active" aria-current="page" href="sanpham/nhapsanpham.php">Thêm sản phẩm</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link active" aria-current="page" href="trangchu.php">Danh sách sản phẩm</a>
                            </li>
                        </ul>


                        <button class="btn dx btn-outline-success" onclick="window.location.href='dangnhap_dangky/dangxuat.php'">Đăng xuất</button>
                    </div>
                </div>
            </nav>
        </header>
        <main>
            <div class="container1">
                <form method="post" action="sanpham/edit_sanpham.php?id=<?= $sp['id'] ?>" id="dang_nhap_form" enctype="multipart/form-data">
                    <h1>Chỉnh sửa sản phẩm: <?php echo $sp['id'] ?></h1>
                    <div class="mb-3">
                        <input type="text" class="form-control" id="name" name="name" placeholder="Tên sản phẩm" onkeyup=" return themten()" value="<?= $sp['name'] ?>">
                        <p id="tensanpam_mess"></p>
                    </div>
                    <div class="mb-3">
                        <input type="text" class="form-control" id="price" name="price" placeholder="Giá" onkeyup="return hiengia()" value="<?= $sp['price'] ?>">
                        <p id="gia_mess"></p>
                    </div>
                    <div class="mb-3">
                        <textarea name="description" id="description" placeholder="Nhập mô tả sản phẩm" onkeyup="return hienmota()"><?= htmlspecialchars($Description) ?></textarea>
                        <p id="mota_mess"></p>
                    </div>
                    <div class="mb-3">
                        <label id="tdm" class="form-label">Ảnh sản phẩm cũ:</label>
                        <img id="imagehien" src="<?= htmlspecialchars($Image) ?>" alt="Sản phẩm">
                        <label for="exampleInputPassword1" class="form-label">Chọn ảnh mới để update:</label>
                        <input type="file" name="image" id="image">
                        <p id="anh_mess"></p>
                    </div>
                    <select class="form-select" id="trangthai" name="trangthai" aria-label="Default select example" require onkeyup="return batloigioitinh()">
                        <option selected disabled value="">Trạng thái</option>
                        <option value="1">Hiển thị</option>
                        <option value="2">Ẩn</option>
                        <option value="3">Khóa</option>
                    </select>
                    <div class="chuanut">
                        <button type="submit" name="edit" class="btn-update">Update</button>
                    </div>

                </form>
            </div>
            <style>
                #trangthai {
                    margin-bottom: 10px;
                }
            </style>
        </main>
        <script>
            function hienanh() {
                var im = document.getElementById('image')
                var hien = document.getElementById('imagehien')
                var tdm = document.getElementById('tdm')
                if (im.files && im.files[0]) {
                    var rd = new FileReader()
                    rd.onload = function(e) {
                        hien.src = e.target.result
                        tdm.innerText = 'Ảnh mới: '
                    }
                    rd.readAsDataURL(im.files[0]);
                }
            }
            document.getElementById('image').addEventListener('change', hienanh)
        </script>
        <style>
            /* From Uiverse.io by yaasiinaxmed */
            .btn-update {
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

            .btn-update::before {
                position: absolute;
                content: "";
                background: var(--color);
                width: 150px;
                height: 200px;
                z-index: -1;
                border-radius: 50%;
            }

            .btn-update:hover {
                color: white;
            }

            .btn-update:before {
                top: 100%;
                left: 100%;
                transition: 0.3s all;
            }

            .btn-update:hover::before {
                top: -30px;
                left: -30px;
            }

            .chuanut {
                display: flex;
                justify-content: center;
                align-items: center;
            }
        </style>
    </body>

<?php endif;
?>