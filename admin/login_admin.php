<?php
    session_start();
    include "../include/connect.php";
    if (!empty($_SESSION["id"])) {
        header("Location: index.php");
    }
    if (isset($_POST["submit"])) {
        $username = $_POST["username"];
        $pass = $_POST["pass"];
        $result = mysqli_query($conn, "SELECT * FROM user WHERE username = '$username'");

        if (mysqli_num_rows($result) > 0) {
            $row = mysqli_fetch_assoc($result);
            if ($pass == $row["pass"]) {
                $_SESSION["login"] = true;
                $_SESSION["login"] = $row["quyentruycap"];
                $_SESSION["id"] = $row["id"];
                if ($_SESSION["login"] == 'admin') {
                    header("Location: index.php");
                    exit();
                } else {
                    echo "<script> alert('Tài khoản này không có quyền truy cập'); </script>";
                }
                
            } else {
                echo "<script> alert('Sai mật khẩu'); </script>";
            }
        }
        
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Quản Trị</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="includes/style_profile.css">
    <link rel="stylesheet" href="../include/style.css">
</head>

<body>
<section class="vh-100" style="background-color: #eee;">
    <div class="container h-100">
        <div class="row d-flex justify-content-center align-items-center h-100">
            <div class="col-lg-12 col-xl-11">
                <div class="card text-black" style="border-radius: 25px;">
                    <div class="card-body p-md-5">
                        <div class="row justify-content-center">
                            <div class="col-md-10 col-lg-6 col-xl-5 order-2 order-lg-1">
                                <p class="text-center h1 fw-bold mb-5 mx-1 mx-md-4 mt-4">Đăng nhập</p>

                                <form class="mx-1 mx-md-4" action="" method="post" autocomplete="off">
                    
                                    <div class="d-flex flex-row align-items-center mb-4">
                                        <div class="form-outline flex-fill mb-0">
                                            <label class="form-label" for="form3Example3c">Tên đăng nhập</label>
                                            <input type="text" id="username" name="username" class="form-control" />
                                        </div>
                                    </div>
                                    <div class="d-flex flex-row align-items-center mb-4">
                                        <div class="form-outline flex-fill mb-0">
                                            <label class="form-label" for="form3Example4c">Mật khẩu</label>
                                            <input type="password" id="pass" name="pass" class="form-control" />
                                        </div>
                                    </div>
                                    
                                    <div class="d-flex justify-content-center mx-4 mb-3 mb-lg-4">
                                        <button type="submit" name="submit" class="btn btn-primary btn-lg">Đăng nhập</button>
                                      
                                    </div>
                                  
                                </form>
                            </div>
                            <div class="col-md-10 col-lg-6 col-xl-7 d-flex align-items-center order-1 order-lg-2">
                                <img src="https://img.lovepik.com/photo/40006/9383.jpg_wh860.jpg"
                                    class="img-fluid" alt="Sample image">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
</body>