<?php
session_start();
include "../include/connect.php";

if(!empty($_SESSION["id"])) {
    $id = $_SESSION["id"];
    $result_user = mysqli_query($conn, "SELECT * FROM user WHERE id = $id");
    $row_user = mysqli_fetch_assoc($result_user);
} else {
    header("location: login.php");
}
if(isset($_POST['submit'])) {
    
    // Lấy dữ liệu từ form
    $name = $_POST['name'];
    $avatar = $_FILES['new_img']['name'];
   
    

    if (isset($_FILES['new_img']) && $_FILES['new_img']['error'] == UPLOAD_ERR_OK) {
        $new_img_name = $_FILES['new_img']['name'];
        $temp_name = $_FILES['new_img']['tmp_name'];
        $img_tmp = $_FILES['new_img']['tmp_name'];
        // Di chuyển tệp hình ảnh tải lên vào thư mục lưu trữ
        $new_img_name = $name . ".jpg"; // Using story name as image name
        move_uploaded_file($temp_name, 'imgs/' . $new_img_name);

        // Cập nhật tên hình ảnh mới trong cơ sở dữ liệu
        $avatar = $new_img_name;
    } else {
        // Nếu người dùng không tải lên hình ảnh mới, sử dụng tên hình ảnh cũ
        $avatar = $_POST['avatar'];
    }

    // Cập nhật thông tin vào cơ sở dữ liệu
    $sql = "UPDATE user SET name='$name', avatar='$avatar' WHERE id='$id'";
    if(mysqli_query($conn, $sql)){
        header("Location: user.php?msg=Dữ liệu được cập nhật thành công");
            exit();
    } else {
        echo "ERROR: Could not able to execute $sql. " . mysqli_error($conn);
    }

    // Đóng kết nối
    mysqli_close($conn);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Chỉnh sửa truyện</title>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
</head>
<body>
    <div class="container mt-4">
        <div class="text-center mb-4">
            <h3>Chỉnh sửa thông tin cá nhân</h3>
        </div>
        <div class="container d-flex justify-content-center">
            <form action="" method="post" enctype="multipart/form-data" style="width:50vw; min-width:300px;">
                <div class="mb-3">
                    <div class="col">
                        <label class="form-label">Họ và tên</label>
                        <input type="text" class="form-control" name="name" value="<?php echo $row_user["name"]; ?>" placeholder="Nhập thông tin">
                    </div>
                </div>
                <div class="mb-3">
                    <div class="col">
                        <label class="form-label">Avatar</label>
                        <input type="file" class="form-control" name="new_img">
                        <br>
                        <img src="imgs/<?php echo $row['avatar'] ?>" alt="" style="max-width: 200px; max-height: 200px;">
                        <input type="hidden" name="avatar" value="<?php echo $row['avatar']; ?>">
                    </div>
                </div>
                <div class="mb-3">
                    <button type="submit" class="btn btn-success" name="submit">Lưu</button>
                    <a href="user.php" class="btn btn-danger">Hủy</a>
                </div>
            </form>
        </div>
    </div>
    <!-- Bootstrap -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
</body>
</html>