<?php
require_once('../connections/mysqli.php');

if ($_SESSION == NULL) {
  header("location:../login.php");
  exit();
}elseif ($_SESSION["user_level"] != "admin") {
  header("location:../index.php");
  exit();
}

if (isset($_GET["add"])) {
  if ($_GET["add"] == "pass") {
    $check_submit = check_submit_p2("บันทึกข้อมูลเรียบร้อยแล้ว");
  }
}
if (isset($_GET["update"])) {
  if ($_GET["update"] == "pass") {
    $check_submit = check_submit_p2("บันทึกข้อมูลเรียบร้อยแล้ว");
  }
}
if (isset($_GET["delete"])) {
  if ($_GET["delete"] == "pass") {
    $check_submit = check_submit_p2("ลบข้อมูลออกจากระบบเรียบร้อยแล้ว");
  }
}


?>
<!doctype html>
<html lang="en">
  <head>

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="../assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="../assets/icons/bootstrap-icons.css">
    <link rel="stylesheet" href="assets/dashboard.css">
    <link rel="stylesheet" href="assets/icons/bootstrap-icons.css">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    
    <title>ระบบหลังบ้าน</title>
  </head>
  <?php include '../includes/navbar.php';?>
  <body>

    <div class="container-fluid">
      <div >
        <?php include 'include/sidebarMenu.php'; ?>
        <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
      <div class="jumbotron mt-4">
      <div class="container-fluid">
      <div class="row justify-content-md-center">
      <div class="col-md-8 py-4">


      <script>
        function handleclick(){

            confirm('คุณต้องการลบข้อมูลหรือไม่')
            location.href='user_delete.php?id=<?php echo $row['student_id'];?>'
        }
        
        
    </script>
        <form class="row" method="POST">
          <div class="col col-lg-3">
            <select class="form-select" name="select" required>
              <option value="" selected disabled> เลือกข้อมูล </option>
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
          <div class="col-md-auto">
              <button type="button" class="btn btn-secondary" data-bs-toggle="modal" data-bs-target="#add_data">เพิ่มข้อมูล</button>
          </div>
        </form>

              <!-- เพิ่มข้อมูล -->
              
              <div class="modal fade" id="add_data" tabindex="-1" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
                  <form class="modal-content" method="post" action="user_add_data.php">
                    <div class="modal-header">
                      <h5 class="modal-title">เพิ่มข้อมูลผู้ใช้งาน</h5>
                    </div>
                    <div class="modal-body">
                      <div class="mb-3">
                        <label class="form-label">รหัสนักศึกษา</label>
                        <input type="text" class="form-control" name="student_code" required/>
                      </div>
                      <div class="mb-3">
                        <label class="form-label">คำนำหน้า</label>
                        <input type="text" class="form-control" name="student_prefix" required/>
                      </div>
                      <div class="mb-3">
                        <label class="form-label">ชื่อ</label>
                        <input type="text" class="form-control" name="student_name" required/>
                      </div>
                      <div class="mb-3">
                        <label class="form-label">นามสกุล</label>
                        <input type="text" class="form-control" name="student_surname" required/>
                      </div>
                      <div class="mb-3">
                        <label class="form-label">สาขา</label>
                        <input type="text" class="form-control" name="student_branch" required/>
                      </div>
                      <div>
                        <td align="center" bgcolor="#EDEDED">File Browser</td>
                        <td bgcolor="#EDEDED"><label>
                          <input type="file" name="fileupload" id="fileupload"  required="required"/>
                        </label></td>
                      </div>
                    </div>
                    <div class="modal-footer">
                      <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">ยกเลิก</button>
                      <button type="submit" class="btn btn-primary">บันทึกข้อมูล</button>
                    </div>
                  </form>
                </div>
              </div>
            </div>
          </div>
            </div>
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
                  <td>
                    <!-- ปุ่มแก้ไข -->
                    <button type="button" class="btn btn-success btn-sm" onclick="window.location.href='user_edit.php?id=<?php echo $result['student_id'];?>'"><i class="bi bi-pencil-square"></i></button>
                    <!-- ลบข้อมูล-->
                    <button type="button" class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#delete_data<?php echo $result['student_id']; ?>">
                      <i class="bi bi-trash"></i>
                    </button>
                    <div class="modal fade" id="delete_data<?php echo $result['student_id']; ?>" tabindex="-1" aria-hidden="true">
                      <div class="modal-dialog modal-dialog-centered">
                        <div class="modal-content">
                          <div class="modal-header">
                            <h5 class="modal-title">ลบข้อมูล</h5>
                          </div>
                          <div class="modal-body">
                            กดยืนยันหากคุณต้องการลบผู้ใช้ <?php echo $result['student_name']; ?>
                          </div>
                          <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">ยกเลิก</button>
                            <button type="button" class="btn btn-primary" onclick="window.location.href='user_delete.php?id=<?php echo $result['student_id'];?>'">ยืนยัน</button>
                          </div>
                        </div>
                      </div>
                    </div>
                  </td>
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
        </main>
      </div>
    </div>
    <script src="../assets/js/bootstrap.bundle.min.js"></script>
    <?php mysqli_close($Connection); ?>
    
  </body>
</html>
