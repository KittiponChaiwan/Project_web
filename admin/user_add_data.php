<?php
require_once('../connections/mysqli.php');

if ($_SESSION == NULL) {
  header("location:../login.php");
  exit();
}elseif ($_SESSION["user_level"] != "admin") {
  header("location:../index.php");
  exit();
}

$sql = "INSERT INTO tb_student (student_id,student_code,student_prefix,student_name,student_surname,student_branch) VALUES ('".$_POST["student_id"]."','".$_POST["student_code"]."','".($_POST["student_prefix"])."','".$_POST["student_name"]."','".$_POST["student_surname"]."','".$_POST["student_branch"]."')";
$query = mysqli_query($Connection,$sql);

header("location:index.php?add=pass");
exit();

mysqli_close($Connection);
?>
