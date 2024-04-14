<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Chi tiết truyện</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f8f9fa; /* Màu nền nhẹ */
        }
        .card {
            background-color: #fff; /* Màu nền của card */
            box-shadow: 0px 0px 15px 0px rgba(0,0,0,0.1); /* Hiển thị đường bóng mờ */
        }
        .book-info {
            display: flex;
            align-items: center;
        }
        .book-info img {
            max-width: 150px;
            margin-right: 20px;
        }
        .story-content {
            font-size: 18px;
        }
    </style>
</head>
<body>
    <?php
        // Kiểm tra xem có tham số ID được truyền vào không
        if(isset($_GET['id']) && !empty($_GET['id'])) {
            // Lấy ID từ tham số truyền vào
            $id = $_GET['id'];

            // Include file kết nối database
            include "../include/connect.php";

            // Truy vấn để lấy thông tin của truyện từ cơ sở dữ liệu
            $query = "SELECT * FROM `story` WHERE `id` = $id";
            $result = mysqli_query($conn, $query);
            

            // Kiểm tra xem có dữ liệu trả về từ cơ sở dữ liệu không
            if(mysqli_num_rows($result) > 0) {
                $row = mysqli_fetch_assoc($result);
                
    ?>
    <div class="container mt-5">
        <div class="card">
            <div class="card-body">
                <div class="book-info">
                    <img src="imgs/<?php echo $row['img']; ?>" alt="Hình ảnh truyện">
                    <div>
                        <h2 class="card-title"><?php echo $row['storyname']; ?></h2>
                        <p class="card-text"><strong>Tác giả:</strong> <?php echo $row['author']; ?></p>
                        <p class="card-text"><strong>Ngày đăng:</strong> <?php echo $row['postdate']; ?></p>
                    </div>
                </div>
                <div class="mt-4">
                    
                    <p class="story-content"><?php echo $row['content']; ?></p>
                </div>
            </div>
            <div class="card-footer text-end">
                <a href="quanlytruyen.php" class="btn btn-secondary">Quay lại</a>
            </div>
        </div>
    </div>
    <?php
            } else {
                // Nếu không có dữ liệu trả về, hiển thị thông báo
                echo "Không tìm thấy truyện";
            }

            // Đóng kết nối database
            mysqli_close($conn);
        } else {
            // Nếu không có tham số ID được truyền vào, hiển thị thông báo lỗi
            echo "ID không hợp lệ";
        }
    ?>
</body>
</html>
