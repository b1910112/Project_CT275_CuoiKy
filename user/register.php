<?php
session_start();
include "../include/connect.php";

// Kiểm tra kết nối cơ sở dữ liệu
if (!$conn) {
    die("Kết nối cơ sở dữ liệu không thành công: " . mysqli_connect_error());
}

// Kiểm tra nếu người dùng đã đăng nhập thì chuyển hướng về trang index.php
if (!empty($_SESSION["id"])) {
    header("Location: index.php");
    exit();
}

if (isset($_POST["submit"])) {
    $name = $_POST["name"];
    $username = $_POST["username"];
    $pass = $_POST["pass"];
    $confirmpass = $_POST["confirmpass"];

    // Kiểm tra xem username đã tồn tại trong cơ sở dữ liệu chưa
    $result = mysqli_query($conn, "SELECT * FROM user WHERE username = '$username'");
    if (mysqli_num_rows($result) > 0) {
        echo "<script> alert('Tài khoản đã được sử dụng'); </script>";
    } else {
        // Kiểm tra xác nhận mật khẩu
        if ($pass == $confirmpass) {
            // Thực hiện thêm người dùng vào cơ sở dữ liệu
            $query = "INSERT INTO user (name, username, pass) VALUES ('$name', '$username', '$pass')";
            if (mysqli_query($conn, $query)) {
                echo "<script> alert('Đăng ký thành công'); </script>";
                header("Location: login.php");
                exit();
            } else {
                echo "Lỗi: " . $query . "<br>" . mysqli_error($conn);
            }
        } else {
            echo "<script> alert('Mật khẩu không trùng khớp'); </script>";
        }
    }
}
?>



<!DOCTYPE html>
<html lang="en">
<head>
    <title>Thích đọc truyện</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="includes/style_profile.css">
    <link rel="stylesheet" href="../include/style.css">
</head>
<Body>

<section class="vh-100" style="background-color: #eee;">
    <div class="container h-100">
        <div class="row d-flex justify-content-center align-items-center h-100">
            <div class="col-lg-12 col-xl-11">
                <div class="card text-black" style="border-radius: 25px;">
                    <div class="card-body p-md-5">
                        <div class="row justify-content-center">
                            <div class="col-md-10 col-lg-6 col-xl-5 order-2 order-lg-1">
                                <p class="text-center h1 fw-bold mb-5 mx-1 mx-md-4 mt-4">Đăng ký tài khoản</p>

                                <form class="mx-1 mx-md-4" action="" method="post" autocomplete="off" id="signupForm">
                                    <div class="d-flex flex-row align-items-center mb-4">
                                        <div class="form-outline flex-fill mb-0">
                                            <label class="form-label" for="form3Example1c">Họ và tên</label>
                                            <input type="text" id="name" name="name" class="form-control" />
                                        </div>
                                    </div>
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
                                    <div class="d-flex flex-row align-items-center mb-4">
                                        <div class="form-outline flex-fill mb-0">
                                            <label class="form-label" for="form3Example4cd">Nhập lại mật khẩu</label>
                                            <input type="password" name="confirmpass" id="confirmpass" class="form-control" />
                                        </div>
                                    </div>
                                    <div class="d-flex justify-content-center mx-4 mb-3 mb-lg-4">
                                        <button type="submit" name="submit" class="btn btn-primary btn-lg">Đăng ký</button>
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
<script
			src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js"
			integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj"
			crossorigin="anonymous"
		></script>
		<script src="https://cdn.jsdelivr.net/npm/jquery-validation@1.19.5/dist/jquery.validate.min.js"></script>
<script type="text/javascript">
			$(document).ready(function () {
				$('#signupForm').validate({
					rules: {
						name: 'required',
						username: { required: true, minlength: 2 },
						pass: { required: true, minlength: 5 },
						confirmpass: {
							required: true,
							minlength: 5,
							equalTo: '#pass',
						},
					},
					messages: {
						name: 'Bạn chưa nhập vào tên của bạn',
						username: {
							required: 'Bạn chưa nhập vào tên đăng nhập',
							minlength: 'Tên đăng nhập phải có ít nhất 5 ký tự',
						},
						pass: {
							required: 'Bạn chưa nhập mật khẩu',
							minlength: 'Mật khẩu phải có ít nhất 5 ký tự',
						},
						confirmpass: {
							required: 'Bạn chưa nhập mật khẩu',
							minlength: 'Mật khẩu phải có ít nhất 5 ký tự',
							equalTo:
								'Mật khẩu không trùng khớp với mật khẩu đã nhập',
						},
						
					},
					errorElement: 'div',
					errorPlacement: function (error, element) {
						error.addClass('invalid-feedback');
						if (element.prop('type') == 'checkbox') {
							error.insertAfter(element.siblings('label'));
						} else {
							error.insertAfter (element);
						}
					},
					highlight: function (element, errorClass, validClass) {
						$(element)
							.addClass('is-invalid')
							.removeClass('is-valid');
					},
					unhighlight: function (element, errorClass, validClass) {
						$(element)
							.addClass('is-valid')
							.removeClass('is-invalid');
					},
				});
			});
		</script>
</Body>



