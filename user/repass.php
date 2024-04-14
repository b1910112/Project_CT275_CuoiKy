<?php
session_start();
include "../include/connect.php";
include "../include/header_user.php";
$thongbao = "";
$thanhcong = "";
if(!empty($_SESSION["id"])) {
    $id = $_SESSION["id"];
    $result_user = mysqli_query($conn, "SELECT * FROM user WHERE id = $id");
    $row_user = mysqli_fetch_assoc($result_user);
} else {
    header("location: login.php");
}

if (isset($_POST['submit'])){
    $pass = $_POST['pass'];
    $newpassword = $_POST['newpassword'];
    $repassword = $_POST['repassword'];

    // Kiểm tra mật khẩu hiện tại
    if ($pass != $row_user['pass']) {
        $thongbao = "Mật khẩu hiện tại không chính xác";
    }
    // Kiểm tra mật khẩu mới và nhập lại mật khẩu mới có khớp nhau không
    else if($newpassword != $repassword) {
        $thongbao = "Nhập lại mật khẩu mới không chính xác";
    }
    else {
        // Cập nhật mật khẩu mới vào cơ sở dữ liệu
        $sql_update = mysqli_query($conn, "UPDATE user SET pass= '".$newpassword."' WHERE id = $id");
        if ($sql_update) {
            $thanhcong = "Đổi mật khẩu thành không";
        } else {
            echo '<p style="color:red"> Đã xảy ra lỗi khi cập nhật mật khẩu</p>';
        }
    }
}
?>


<div class="container mt-4">
    <div class="text-center mb-4">
        <h3>Đổi mật khẩu</h3>
    </div>
    <?php
        if($thongbao != "") {?>
            <div class="alert alert-danger"><?=$thongbao?></div>
        <?php } ?>
        <?php
        if($thanhcong != "") {?>
            <div class="alert alert-success"><?=$thanhcong?></div>
        <?php } ?>
    <div class="container d-flex justify-content-center">

       
        <form action="" method="post" enctype="multipart/form-data" style="width:50vw; min-width:300px;">
            <div class="mb-3">
                <div class="col">
                    <label class="form-label">Mật khẩu hiện tại</label>
                    <input type="password" class="form-control" name="pass" id="pass">
                </div>
            </div>
            <div class="mb-3">
                <div class="col">
                    <label class="form-label">Mật khẩu mới</label>
                    <input type="password" class="form-control" name="newpassword" id="newpassword">
                </div>
            </div>
            <div class="mb-3">
                <div class="col">
                    <label class="form-label">Nhập lại mật khẩu mới</label>
                    <input type="password" class="form-control" name="repassword" id="repassword">
                </div>
            </div>
            
            <div class="mb-3">
                <button type="submit" class="btn btn-success" name="submit">Lưu</button>
                <a href="index.php" class="btn btn-danger">Hủy</a>
            </div>
        </form>
    </div>
</div>

<?php
mysqli_close($conn);
?>
