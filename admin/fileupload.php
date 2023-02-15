<?php
require_once('../connections/mysqli.php');

if ($_SESSION == NULL) {
  header("location:../login.php");
  exit();
}elseif ($_SESSION["user_level"] != "admin") {
  header("location:../index.php");
  exit();
}

$id = $_GET["id"];
$_SESSION['getId'] = $id;
// $newname = $date.$numrand.$type;
// $path_copy=$path.$newname;
// $path_link="uploadfile/".$newname;

$sql = "SELECT * FROM tb_student WHERE student_id = '".$id."'";
$query = mysqli_query($Connection,$sql);
$result = mysqli_fetch_array($query,MYSQLI_ASSOC);

if (isset($_POST["submit"])) {
  $sql_2 = "UPDATE tb_user SET user_username = '".$_POST['user_username']."', user_name = '".$_POST['user_name']."', user_surname = '".$_POST['user_surname']."',
    user_sex = '".$_POST['user_sex']."', user_temperature = '".$_POST['user_temperature']."', user_level = '".$_POST['user_level']."' WHERE user_id = '".$id."','$newname'";
  $query_2 = mysqli_query($Connection,$sql_2);

  header("location:user.php?update=pass");
  exit();
}
?>
<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="../assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="../assets/icons/bootstrap-icons.css">
    <link rel="stylesheet" href="assets/dashboard.css">
    <title>ระบบหลังบ้าน</title>
  </head>
  <body>
    <?php include 'include/header.php'; ?>
    <div class="container-fluid">
      <div class="row">
        <?php include 'include/sidebarMenu.php'; ?>
        <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
          <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
            <h1 class="h2">แก้ไขข้อมูลผู้ใช้งาน</h1>
            <div class="btn-toolbar mb-2 mb-md-0">
              <button type="button" class="btn btn-secondary" onclick="window.location.href='user.php'">ย้อนกลับ</button>
            </div>
          </div>
          <div class="row justify-content-md-center">
            <div class="col-6">
              <div class="card">
                <h5 class="card-header"><?php echo 'ID : '.$result['student_id']; ?></h5>
                <div class="card-body">
                  <form method="post" action="update_db.php" enctype="multipart/form-data" name="upfile" id="upfile">
                  <!-- <form class="modal-content" action="add_file_db.php" method="post" enctype="multipart/form-data" name="upfile" id="upfile"> -->
                    <div class="mb-3">
                      <label class="form-label">รหัสนักศึกษา</label>
                      <input type="text" class="form-control" name="student_code" value="<?php echo $result['student_code']; ?>" required/>
                    </div>
                    <div class="mb-3">
                      <label class="form-label">คำนำหน้า</label>
                      <input type="text" class="form-control" name="student_prefix" value="<?php echo $result['student_prefix']; ?>" required/>
                    </div>
                    <div class="mb-3">
                      <label class="form-label">ชื่อ</label>
                      <input type="text" class="form-control" name="student_name" value="<?php echo $result['student_name']; ?>" required/>
                    </div>
                    <div class="mb-3">
                      <label class="form-label">นามสกุล</label>
                      <input type="text" class="form-control" name="student_surname" value="<?php echo $result['student_surname']; ?>" required/>
                    </div>
                    <div class="mb-3">
                      <label class="form-label">สาขา</label>
                      <input type="text" class="form-control" name="student_branch" value="<?php echo $result['student_branch']; ?>" required/>
                    </div>
                    <div>
                        <td align="center" bgcolor="#EDEDED">File Browser</td>
                        <td bgcolor="#EDEDED"><label>
                          <input type="file" name="fileupload" id="fileupload"  required="required"/>
                        </label></td>
                      </div>

                    <button type="submit" name="submit" class="btn btn-primary">บันทึก</button>
                  </form>
                </div>
              </div>
            </div>
          </div>
        </main>
      </div>
    </div>
    <script src="../assets/js/bootstrap.bundle.min.js"></script>
    <?php mysqli_close($Connection); ?>
  </body>
</html>
