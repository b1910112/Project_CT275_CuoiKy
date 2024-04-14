<?php
   session_start();
   include "../include/connect.php";
   include "../include/header_admin.php";
   
   if(!empty($_SESSION["id"])) {
       $id = $_SESSION["id"];
       $result_user = mysqli_query($conn, "SELECT * FROM user WHERE id = $id");
       $row_user = mysqli_fetch_assoc($result_user);
   } else {
       header("location: login_admin.php");
   }

?>

<?php
    // ...
    
    // Đếm users có quyền truy cập là 'user'
    $sql_user = "SELECT COUNT(*) AS total_user FROM user WHERE quyentruycap = 'user'";
    $result_user = mysqli_query($conn, $sql_user);
    if ($result_user !== false && $result_user->num_rows > 0) {
        $row_user = $result_user->fetch_assoc();
        $total_user = $row_user["total_user"];
    } else {
        $total_user = 0;
    }
   
    // Đếm admins có quyền truy cập là 'admin'
    $sql_admin = "SELECT COUNT(*) AS total_admin FROM user WHERE quyentruycap = 'admin'";
    $result_admin = mysqli_query($conn, $sql_admin);
    if ($result_admin !== false && $result_admin->num_rows > 0) {
        $row_admin = $result_admin->fetch_assoc();
        $total_admin = $row_admin["total_admin"];
    } else {
        $total_admin = 0;
    }


      // Đếm users có quyền truy cập là 'user'
      $sql_cotich = "SELECT COUNT(*) AS total_cotich FROM story WHERE categogy = 'Cổ Tích'";
      $result_cotich = mysqli_query($conn, $sql_cotich);
      if ($result_cotich !== false && $result_cotich->num_rows > 0) {
          $row_cotich = $result_cotich->fetch_assoc();
          $total_cotich = $row_cotich["total_cotich"];
      } else {
          $total_cotich = 0;
      }
     
      // Đếm admins có quyền truy cập là 'admin'
      $sql_haihuoc = "SELECT COUNT(*) AS total_haihuoc FROM story WHERE categogy = 'Hài Hước'";
      $result_haihuoc = mysqli_query($conn, $sql_haihuoc);
      if ($result_haihuoc !== false && $result_haihuoc->num_rows > 0) {
          $row_haihuoc = $result_haihuoc->fetch_assoc();
          $total_haihuoc = $row_haihuoc["total_haihuoc"];
      } else {
          $total_haihuoc = 0;
      }

      // Đếm admins có quyền truy cập là 'admin'
      $sql_ngungon = "SELECT COUNT(*) AS total_ngungon FROM story WHERE categogy = 'Ngụ Ngôn'";
      $result_ngungon = mysqli_query($conn, $sql_ngungon);
      if ($result_ngungon !== false && $result_ngungon->num_rows > 0) {
          $row_ngungon = $result_ngungon->fetch_assoc();
          $total_ngungon = $row_ngungon["total_ngungon"];
      } else {
          $total_ngungon = 0;
      }
?>

<html>
  <head>
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript">
      google.charts.load('current', {'packages':['corechart']});
      google.charts.setOnLoadCallback(drawCharts);

      function drawCharts() {
        drawUserAdminChart();
        drawStoryChart();
      }

      function drawUserAdminChart() {
        var data = google.visualization.arrayToDataTable([
          ['Role', 'Number of Users'],
          ['Admin', <?php echo $total_admin; ?>],
          ['User', <?php echo $total_user; ?>]
        ]);

        var options = {
          title: 'Thống kê user và admin',
          pieHole: 0.4 // Tạo một lỗ tròn trong biểu đồ hình tròn
        };

        var chart = new google.visualization.PieChart(document.getElementById('user_admin_chart'));

        chart.draw(data, options);
      }

      function drawStoryChart() {
        var storyData = google.visualization.arrayToDataTable([
          ['Genre', 'Number of Stories'],
          ['Truyện Cổ Tích', <?php echo $total_cotich; ?>],
          ['Truyện Hài', <?php echo $total_haihuoc; ?>],
          ['Truyện Ngụ Ngôn', <?php echo $total_ngungon; ?>]
        ]);

        var storyOptions = {
          title: 'Thống kê truyện theo thể loại',
          pieHole: 0.4 // Tạo một lỗ tròn trong biểu đồ hình tròn
        };

        var storyChart = new google.visualization.PieChart(document.getElementById('story_chart'));

        storyChart.draw(storyData, storyOptions);
      }
    </script>
  </head>
  <body>
    <div style="display: flex; justify-content: space-between;">
      <div id="user_admin_chart" style="width: 45%; height: 500px;"></div>
      <div id="story_chart" style="width: 45%; height: 500px;"></div>
    </div>
  </body>
</html>



