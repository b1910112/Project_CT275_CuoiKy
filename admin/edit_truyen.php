<?php
    // Lấy id của truyện cần chỉnh sửa
    $id = $_GET['id'];

    // Kết nối đến cơ sở dữ liệu
    require_once '../include/connect.php';

    if (isset($_POST["submit"])) {
        $storyname = $_POST['storyname'];
        $categogy = $_POST['categogy'];
        $author = $_POST['author'];
        $postdate = $_POST['postdate'];
        $content = $_POST['content'];

        // Kiểm tra xem người dùng đã tải lên hình ảnh mới chưa
        if (isset($_FILES['new_img']) && $_FILES['new_img']['error'] == UPLOAD_ERR_OK) {
            $new_img_name = $_FILES['new_img']['name'];
            $temp_name = $_FILES['new_img']['tmp_name'];

            // Di chuyển tệp hình ảnh tải lên vào thư mục lưu trữ
            $new_img_name = $storyname . ".jpg"; // Using story name as image name
            // Thư mục 1 cho ảnh truyện
            $img_path_story_1 = "../user/imgs/";

            // Thư mục 2 cho ảnh truyện
            $img_path_story_2 = "imgs/";
            move_uploaded_file($temp_name, $img_path_story_1 . $new_img_name);
            copy($img_path_story_1 . $new_img_name, $img_path_story_2 . $new_img_name);

            // Cập nhật tên hình ảnh mới trong cơ sở dữ liệu
            $img = $new_img_name;
            copy($img_path_story_1 . $img, $img_path_story_2 . $img);
        } else {
            // Nếu người dùng không tải lên hình ảnh mới, sử dụng tên hình ảnh cũ
            $img = $_POST['img'];
        }

        // Cập nhật thông tin truyện vào cơ sở dữ liệu
        $sql = "UPDATE `story` SET `storyname`='$storyname', `categogy`='$categogy' , `author`='$author', `postdate`='$postdate', `content`='$content', `img`='$img' WHERE id = $id";

        $result = mysqli_query($conn, $sql);

        if ($result) {
            header("Location: quanlytruyen.php?msg=Dữ liệu được cập nhật thành công");
            exit();
        } else {
            echo "Failed: " . mysqli_error($conn);
        }
    }

    // Lấy thông tin của truyện từ cơ sở dữ liệu
    $sql = "SELECT * FROM story WHERE id = $id";
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_assoc($result);
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
    <div class="container">
        <div class="text-center mb-4">
            <h3>Chỉnh sửa truyện</h3>
            <p class="text-muted">(Hoàn thành biểu mẫu sau để chỉnh sửa thông tin truyện)</p>
        </div>

        <div class="container d-flex justify-content-center">
            <form action="" method="post" enctype="multipart/form-data" style="width:50vw; min-width:300px;">
                <input type="hidden" name="story_id" value="<?php echo $story_id; ?>">
                <div class="mb-3">
                    <div class="col">
                        <label class="form-label">Tên truyện</label>
                        <input type="text" class="form-control" name="storyname" value="<?php echo $row['storyname'] ?>" placeholder="Nhập thông tin">
                    </div>
                </div>
                <div class="mb-3">
                    <div class="col">
                        <label class="form-label">Thể loại</label>
                        <select class="form-select" name="categogy">
                            <option value="Ngụ Ngôn" <?php if($row['categogy'] == "Ngụ Ngôn") echo "selected"; ?>>Ngụ Ngôn</option>
                            <option value="Hài Hước" <?php if($row['categogy'] == "Hài Hước") echo "selected"; ?>>Hài Hước</option>
                            <option value="Cổ Tích" <?php if($row['categogy'] == "Cổ Tích") echo "selected"; ?>>Cổ Tích</option>
                        </select>
                    </div>
                </div>
                <div class="mb-3">
                    <div class="col">
                        <label class="form-label">Tác giả</label>
                        <input type="text" class="form-control" name="author" value="<?php echo $row['author'] ?>" placeholder="Nhập thông tin">
                    </div>
                </div>
                <div class="mb-3">
                    <div class="col">
                        <label class="form-label">Ngày đăng</label>
                        <input type="date" class="form-control" name="postdate" value="<?php echo $row['postdate'] ?>">
                    </div>
                </div>
                <div class="mb-3">
                    <div class="col">
                        <label class="form-label">Nội dung truyện</label>
                        <input type="text" class="form-control" name="content" value="<?php echo $row['content'] ?>" placeholder="Nhập thông tin">
                    </div>
                </div>
                <div class="mb-3">
                    <div class="col">
                        <label class="form-label">Hình ảnh của truyện</label>
                        <input type="file" class="form-control" name="new_img">
                        <br>
                        <img src="imgs/<?php echo $row['img'] ?>" alt="" style="max-width: 200px; max-height: 200px;">
                        <input type="hidden" name="img" value="<?php echo $row['img']; ?>">
                    </div>
                </div>

                <div>
                    <button type="submit" class="btn btn-success" name="submit">Lưu</button>
                    <a href="quanlytruyen.php" class="btn btn-danger">Hủy</a>
                </div>
            </form>
        </div>
    </div>
    <!-- Bootstrap -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
</body>
</html>
