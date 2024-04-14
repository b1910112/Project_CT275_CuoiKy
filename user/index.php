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

// Số lượng truyện trên mỗi trang
$results_per_page = 9; // Giả sử bạn muốn hiển thị 6 truyện trên mỗi dòng

// Xác định trang hiện tại
$page = isset($_GET['page']) ? $_GET['page'] : 1;

// Tính toán điểm bắt đầu của kết quả trên trang hiện tại
$start_from = ($page - 1) * $results_per_page;

// Truy vấn cơ sở dữ liệu để lấy các truyện cho trang hiện tại, sắp xếp theo thứ tự ngược lại của ngày đăng
if(isset($_GET['search'])) {
    $search = $_GET['search'];
    $sql = "SELECT * FROM `story` WHERE `storyname` LIKE '%$search%' OR `author` LIKE '%$search%' ORDER BY `id` DESC LIMIT $start_from, $results_per_page";
} else {
    $sql = "SELECT * FROM `story` ORDER BY `id` DESC LIMIT $start_from, $results_per_page";
}
$result_story = mysqli_query($conn, $sql);

// Đếm tổng số trang
$total_sql = "SELECT COUNT(*) AS total FROM `story`";
if(isset($_GET['search'])) {
    $search = $_GET['search'];
    $total_sql = "SELECT COUNT(*) AS total FROM `story` WHERE `storyname` LIKE '%$search%' OR `author` LIKE '%$search%'";
}
$total_result = mysqli_query($conn, $total_sql);
$total_row = mysqli_fetch_assoc($total_result);
$total_pages = ceil($total_row["total"] / $results_per_page);
?>

<style>
    .card-img-top {
        object-fit: cover; /* Đảm bảo hình ảnh vừa với kích thước của thẻ */
        height: 200px; /* Đặt chiều cao cố định cho hình ảnh */
    }
</style>

<br>
<div class="container">
    <div class="row">
        <div class="col-9">
            <h1>Truyện mới nhất!</h1>
        </div>
        <div class="col-3 content-end">
            <form action="" method="GET">
                <div class="input-group rounded">
                    <input type="search" name="search" class="form-control rounded" placeholder="Tìm kiếm" aria-label="Search" aria-describedby="search-addon">
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-search"></i>
                    </button>
                </div>
            </form>
        </div>
    </div>
    <br>
    <div class="row row-cols-1 row-cols-md-2 row-cols-lg-3 g-4">
        <?php while ($row_story = mysqli_fetch_assoc($result_story)) : ?>
            <div class="col">
                <div class="card h-100">
                    <img src="/imgs/<?php echo $row_story['img']; ?>" class="card-img-top" alt="Hình ảnh truyện">
                    <div class="card-body">
                        <h5 class="card-title"><?php echo $row_story['storyname']; ?></h5>
                        <p class="card-text">Tác giả: <?php echo $row_story['author']; ?></p>
                        <p class="card-text">Ngày đăng: <?php echo $row_story['postdate']; ?></p>
                        <a href="view_story.php?id=<?php echo $row_story['id']; ?>" class="btn btn-primary">Đọc truyện</a>
                    </div>
                </div>
            </div>
        <?php endwhile; ?>
    </div>
    <br>
    <!-- Phân trang -->
    <nav aria-label="Page navigation">
        <ul class="pagination justify-content-center">
            <?php for ($i = 1; $i <= $total_pages; $i++) : ?>
                <li class="page-item <?php echo ($page == $i) ? 'active' : ''; ?>">
                    <a class="page-link" href="?page=<?php echo $i; ?>&search=<?php echo isset($_GET['search']) ? $_GET['search'] : ''; ?>"><?php echo $i; ?></a>
                </li>
            <?php endfor; ?>
        </ul>
    </nav>
</div>

<?php
// Đóng kết nối cơ sở dữ liệu
mysqli_close($conn);
?>
