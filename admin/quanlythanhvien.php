<?php
    // Giả sử bạn đã thiết lập kết nối cơ sở dữ liệu
    include '../include/header_admin.php';
    include "../include/connect.php";

    // Xử lý trang
    $results_per_page = 5; // Số lượng kết quả trên mỗi trang

    if (isset($_GET['page'])) {
        $page = $_GET['page'];
    } else {
        $page = 1; // Trang mặc định
    }

    $start_from = ($page - 1) * $results_per_page;

    // Xử lý tìm kiếm
    $search_result = null; // Khởi tạo biến kết quả tìm kiếm
    if (isset($_POST['search'])) {
        $valueToSearch = $_POST['valueToSearch'];
        // Truy vấn cơ sở dữ liệu với điều kiện tìm kiếm
        $query = "SELECT * FROM `user` WHERE CONCAT(`id`, `name`, `username`, `pass`, `quyentruycap`) LIKE '%" . $valueToSearch . "%' LIMIT $start_from, $results_per_page";
        $search_result = mysqli_query($conn, $query);
        // Kiểm tra xem truy vấn có thành công không
        if (!$search_result) {
            echo "Lỗi khi thực thi truy vấn: " . mysqli_error($conn);
            exit;
        }
    } else {
        // Nếu không có tìm kiếm, hiển thị tất cả người dùng
        $query = "SELECT * FROM `user` LIMIT $start_from, $results_per_page";
        $search_result = mysqli_query($conn, $query);
        if (!$search_result) {
            echo "Lỗi khi thực thi truy vấn: " . mysqli_error($conn);
            exit;
        }
    }

    // Đếm tổng số lượng trang
    $sql = "SELECT COUNT(*) AS total FROM `user`";
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_assoc($result);
    $total_pages = ceil($row["total"] / $results_per_page);
?>

<nav class="navbar navbar-light justify-content-center fs-3 mb-5">
    Quản Lý Thành Viên
</nav>
  
<form class="container" action="quanlythanhvien.php" method="post">
    <?php
    if (isset($_GET['msg'])) {
        $msg = $_GET['msg'];
        echo
        '<div class="alert alert-warning alert-dismissible fade show" role="alert"> ' . $msg . '
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>';
    }
    ?>

    <div class="row d-flex">
        <div class="col-3 ">
            <div class="input-group rounded">
                <input type="search" name="valueToSearch" required value="" class="form-control rounded" placeholder="Search" aria-label="Search" aria-describedby="search-addon">
                <button type="submit" name="search" value="Filter" class="btn btn-primary">
                    <i class="fas fa-search"></i>
                </button>
            </div>
        </div>
        <div class="col-3">
            <a href="add_thanhvienquanly.php" class="btn btn-success">Thêm thành viên quản lý</a>
        </div>
    </div>

    <br>

    <table class="table table-hover text-center">
        <thead class="table-dark">
            <tr>
                <th scope="col">STT</th>
                <th scope="col">ID</th>
                <th scope="col">Họ và tên</th>
                <th scope="col">Tài khoản</th>
                <th scope="col">Mật khẩu</th>
                <th scope="col">Quyền truy cập</th>
                <th scope="col">Thao tác</th>
            </tr>
        </thead>

        <?php
        if (mysqli_num_rows($search_result) > 0) {
            $i = 1;
            while ($row = mysqli_fetch_assoc($search_result)) : ?>

                <tbody>
                    <tr>
                        <td><?php echo $i++ ?></td>
                        <td><?php echo $row['id'] ?></td>
                        <td><?php echo $row['name'] ?></td>
                        <td><?php echo $row['username'] ?></td>
                        <td><?php echo $row['pass'] ?></td>
                        <td><?php echo $row['quyentruycap'] ?></td>
                        <td>
                            <a href="delete_thanhvien.php?id=<?php echo $row['id'] ?>" class="link-dark">
                                <i class="fa-solid fa-trash fs-5"></i>
                            </a>
                        </td>
                    </tr>
                </tbody>
        <?php endwhile;
        } ?>
    </table>

    <!-- Phân trang -->
    <ul class="pagination justify-content-center">
        <?php for ($page = 1; $page <= $total_pages; $page++) : ?>
            <li class="page-item"><a class="page-link" href="?page=<?php echo $page; ?>"><?php echo $page; ?></a></li>
        <?php endfor; ?>
    </ul>
</form>
