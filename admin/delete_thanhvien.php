<?php
    // Kiểm tra xem có tham số ID được truyền vào không
    if(isset($_GET['id']) && !empty($_GET['id'])) {
        // Lấy ID từ tham số truyền vào
        $id = $_GET['id'];

        // Include file kết nối database
        include "../include/connect.php";

        // Kiểm tra nút xác nhận xóa đã được nhấn chưa
        if(isset($_POST['confirm_delete'])) {
            // Xóa người dùng
            $query = "DELETE FROM `user` WHERE `id` = $id";

            // Thực hiện truy vấn
            $result = mysqli_query($conn, $query);

            // Kiểm tra xem truy vấn xóa thành công hay không
            if($result) {
                // Nếu thành công, chuyển hướng trở lại trang quản lý thành viên với thông báo
                header("Location: quanlythanhvien.php?msg=Người dùng đã được xóa thành công");
                exit();
            } else {
                // Nếu không thành công, hiển thị thông báo lỗi
                echo "Lỗi khi xóa người dùng: " . mysqli_error($conn);
            }

            // Đóng kết nối database
            mysqli_close($conn);
        } else {
            // Nếu nút xác nhận xóa chưa được nhấn, hiển thị form xác nhận
            ?>
            <!DOCTYPE html>
            <html lang="en">
            <head>
                <meta charset="UTF-8">
                <meta name="viewport" content="width=device-width, initial-scale=1.0">
                <title>Xác nhận xóa</title>
                <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet">
            </head>
            <body>
                <div class="container mt-5">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Xác nhận xóa người dùng</h5>
                            <p class="card-text">Bạn có chắc chắn muốn xóa người dùng này không?</p>
                            <form method="post">
                                <button type="submit" name="confirm_delete" class="btn btn-danger">Xác nhận</button>
                                <a href="quanlythanhvien.php" class="btn btn-secondary">Hủy</a>
                            </form>
                        </div>
                    </div>
                </div>
            </body>
            </html>
            <?php
        }
    } else {
        // Nếu không có tham số ID được truyền vào, hiển thị thông báo lỗi
        echo "ID không hợp lệ";
    }
?>
