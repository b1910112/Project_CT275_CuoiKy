<?php
    include "../include/connect.php";

    if(isset($_POST['submit'])){
        $name = $_POST['name'];
        $username = $_POST['username'];
        $pass = $_POST['pass'];
        $quyentruycap = $_POST['quyentruycap'];
      
     
        

        $sql = "INSERT INTO `user`(`id`, `name`, `username`, `pass`, `quyentruycap`)
        VALUES (NULL,'$name', '$username', '$pass','$quyentruycap')";
        $result = mysqli_query($conn, $sql);

        if($result) {
            header("Location: quanlythanhvien.php?msg= Truyện mới được thêm thành công");
        } else{
            echo "Failed: " . mysqli_error($conn);
        }
    }
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <title>Thêm nhân viên mới</title>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>
<body>
    <div class="container">
        <div class="text-center mb-4 mt-3">
            <h3>Thêm Thành Viên Quản Trị</h3>
            <p class="text-muted">(Hoàn thành biểu mẫu sau để thêm thành viên quản trị mới)</p>
        </div>

        <div class="container d-flex justify-content-center">
            <form action="" method="post" enctype="multipart/form-data" style="width:50vw; min-width:300px;">
                <div class="mb-3">
                    <div class="col">
                        <label class="form-label">Tên thành viên</label>
                        <input type="text" class="form-control" name="name" placeholder="nhập thông tin">
                    </div>
                </div>
                <div class="mb-3">
                    <div class="col">
                        <label class="form-label">Quyền truy cập</label>
                        <select class="form-select" name="quyentruycap">
                            <option value="admin">admin</option>
                        </select>
                    </div>
                </div>
                <div class="mb-3">
                    <div class="col">
                        <label class="form-label">Tài khoản</label>
                        <input type="text" class="form-control" name="username">
                    </div>
                </div>
                <div class="mb-3">
                    <div class="col">
                        <label class="form-label">Mật khẩu</label>
                        <input type="text" class="form-control"  name="pass">
                    </div>
                </div>
                <div>
                    <button type="submit" class="btn btn-success" name="submit">Lưu</button>
                    <a href="quanlythanhvien.php" class="btn btn-danger">Hủy</a>
                </div>
            </form>
        </div>
    </div>
    <!-- Bootstrap -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
</body>
</html>
