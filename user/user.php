<?php
session_start();
include "../include/connect.php";
include "../include/header_user.php";

if(!empty($_SESSION["id"])) {
    $id = $_SESSION["id"];
    $result_user = mysqli_query($conn, "SELECT * FROM user WHERE id = $id");
    $row_user = mysqli_fetch_assoc($result_user);
} else {
    header("location: login.php");
}

?>

<div class="container mt-5">
    <div class="card col-md-8 mx-auto">
        <div class="card-body">
            <div class="book-info">
                <div class="row align-items-center">
                    <div class="col-md-3">
                        <img src="imgs/<?php echo $row_user['avatar']; ?>" alt="Ảnh đại diện" class="img-thumbnail">
                    </div>
                    <div class="col-md-9">
                        <p class="card-text"><strong>ID:</strong> <?php echo $row_user["id"]; ?></p>
                        <p class="card-text"><strong>Họ và tên:</strong> <?php echo $row_user["name"]; ?></p>
                        <p class="card-text"><strong>Tên đăng nhập:</strong> <?php echo $row_user["username"]; ?></p>
                        <a href="update_info.php" class="btn btn-success">Cập nhật thông tin</a>
                    </div>
                </div>
            </div>
        </div>
        <div class="card-footer text-end">
            <a href="index.php" class="btn btn-secondary">Quay lại</a>
        </div>
    </div>
</div>
