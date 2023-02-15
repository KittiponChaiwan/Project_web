<?php
require_once('connections/mysqli.php');
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title><?php echo $title; ?></title>
  <link rel="stylesheet" href="assets/css/bootstrap.min.css">
  <link rel="stylesheet" href="assets/icons/bootstrap-icons.css">
</head>
<body class="default">
  <?php include 'includes/navbar.php';?>
  <div class="container-fluid">
    <div class="row justify-content-md-center">
      <div class="col-md-8 py-4">
        <form class="row" method="POST">
          <div class="col col-lg-2">
            <select class="form-select" name="select" required>
              <option value="" selected disabled> -- เลือกข้อมูล -- </option>
              <option value="student_code" <?php if (isset($_POST['select'])) {if ($_POST['select'] == 'student_code') {echo 'selected';}} ?>>รหัสนักศึกษา</option>
              <option value="student_prefix" <?php if (isset($_POST['select'])) {if ($_POST['select'] == 'student_prefix') {echo 'selected';}} ?>>คำนำหน้า</option>
              <option value="student_name" <?php if (isset($_POST['select'])) {if ($_POST['select'] == 'student_name') {echo 'selected';}} ?>>ชื่อ</option>
              <option value="student_surname" <?php if (isset($_POST['select'])) {if ($_POST['select'] == 'student_surname') {echo 'selected';}} ?>>นามสกุล</option>
              <option value="student_branch" <?php if (isset($_POST['select'])) {if ($_POST['select'] == 'student_branch') {echo 'selected';}} ?>>สาขา</option>
            </select>
          </div>
          <div class="col">
            <input type="text" class="form-control" name="value" value="<?php if (isset($_POST['value'])) {echo $_POST['value'];} ?>" required/>
          </div>
          <div class="col-md-auto">
            <button type="submit" name="submit" class="btn btn-success">ค้นหา</button>
          </div>
        </form>
        <?php
        if (isset($_POST['submit'])) {
          $num = 1;
          $sql = "SELECT * FROM tb_student WHERE ".$_POST['select']." LIKE '".$_POST['value']."%'";
          $query = mysqli_query($Connection,$sql);
          $check_data = mysqli_num_rows($query);
          if ($check_data == 0) {
            echo '<p class="text-center py-4"><span class="badge bg-danger" style="font-size: 20px;">ไม่พบข้อมูล</span></p>';
          }else{
            ?>
            <table class="table table-bordered mt-4">
              <thead class="table-secondary">
                <tr>
                  <th scope="col">ลำดับที่</th>
                  <th scope="col">รหัสนักศึกษา</th>
                  <th scope="col">ชื่อ - นามสกุล</th>
                  <th scope="col">สาขา</th>
                </tr>
              </thead>
              <tbody>
                <?php
                while ($result = mysqli_fetch_array($query)) {
                  ?>
                  <tr>
                    <td><?php echo $num++; ?></td>
                    <td><?php echo $result['student_code']; ?></td>
                    <td><?php echo $result['student_prefix'].$result['student_name'].' '.$result['student_surname']; ?></td>
                    <td><?php echo $result['student_branch']; ?></td>
                  </tr>
                  <?php
                }
                ?>
              </tbody>
            </table>
            <?php
          }
        }
        ?>
      </div>
    </div>
  </div>
  <script src="assets/js/bootstrap.bundle.min.js"></script>
  <?php mysqli_close($Connection);?>
</body>
</html>
