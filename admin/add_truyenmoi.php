<?php
    include "../include/connect.php";

    if(isset($_POST['submit'])){
        $storyname = $_POST['storyname'];
        $categogy = $_POST['categogy']; // Thay đổi từ categogy thành category
        $author = $_POST['author'];
        $postdate = $_POST['postdate'];
        $content = $_POST['content'];
        
        // // File upload handling
        // $img_temp = $_FILES['img']['tmp_name'];
        // $img_path = "../user/imgs/";
        // $img_path_2 = "img/";
        // $img_name = $storyname . ".jpg"; // Using story name as image name
      
        
        // move_uploaded_file($img_temp, $img_path . $img_name);
        // move_uploaded_file($img_temp, $img_path_2 . $img_name);


        // File upload handling
$img_temp = $_FILES['img']['tmp_name'];
$img_name = $storyname . ".jpg"; // Using story name as image name

// Thư mục 1 cho ảnh truyện
$img_path_story_1 = "../user/imgs/";

// Thư mục 2 cho ảnh truyện
$img_path_story_2 = "imgs/";

// Lưu ảnh vào thư mục 1
move_uploaded_file($img_temp, $img_path_story_1 . $img_name);

// Sao chép ảnh từ thư mục 1 sang thư mục 2
copy($img_path_story_1 . $img_name, $img_path_story_2 . $img_name);
// move_uploaded_file($img_temp, $img_path_story_2 . $img_name);

        



        $sql = "INSERT INTO `story`(`id`, `storyname`, `categogy`, `author`, `postdate`, `content`, `img`)
        VALUES (NULL,'$storyname', '$categogy', '$author','$postdate','$content', '$img_name')"; // Thay đổi categogy thành category

        $result = mysqli_query($conn, $sql);

        if($result) {
            header("Location: quanlytruyen.php?msg= Truyện mới được thêm thành công");
        } else{
            echo "Failed: " . mysqli_error($conn);
        }
    }
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <title>Thêm truyện mới</title>
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
        <div class="text-center mb-4">
            <h3>Thêm Truyện Mới</h3>
            <p class="text-muted">(Hoàn thành biểu mẫu sau để thêm truyện mới)</p>
        </div>

        <div class="container d-flex justify-content-center">
            <form action="" method="post" enctype="multipart/form-data" style="width:50vw; min-width:300px;">
                <div class="mb-3">
                    <div class="col">
                        <label class="form-label">Tên truyện</label>
                        <input type="text" class="form-control" name="storyname" placeholder="nhập thông tin">
                    </div>
                </div>
                <div class="mb-3">
                    <div class="col">
                        <label class="form-label">Thể loại</label>
                        <select class="form-select" name="categogy">
                            <option value="Ngụ Ngôn">Ngụ Ngôn</option>
                            <option value="Hài Hước">Hài Hước</option>
                            <option value="Cổ Tích">Cổ Tích</option>
                        </select>
                    </div>
                </div>
                <div class="mb-3">
                    <div class="col">
                        <label class="form-label">Tác giả</label>
                        <input type="text" class="form-control" name="author" placeholder="nhập thông tin">
                    </div>
                </div>
                <div class="mb-3">
                    <div class="col">
                        <label class="form-label">Ngày đăng</label>
                        <input type="date" class="form-control"  name="postdate">
                    </div>
                </div>
                <div class="mb-3">
                    <div class="col">
                        <label class="form-label">Nội dung truyện</label>
                        <input type="text" class="form-control" name="content" placeholder="nhập thông tin">
                    </div>
                </div>
                <div class="mb-3">
                    <div class="col">
                        <label class="form-label">Hình ảnh của truyện</label>
                        <input type="file" class="form-control" name="img">
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
