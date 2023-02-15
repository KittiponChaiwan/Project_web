<meta charset="UTF-8">
<?php
//1. เชื่อมต่อ database: 
include('../connections/mysqli.php');  //ไฟล์เชื่อมต่อกับ database ที่เราได้สร้างไว้ก่อนหน้าน้ี
// $fileupload = $_POST['fileupload']; //รับค่าไฟล์จากฟอร์ม	
$id = $_SESSION['getId'];
//ฟังก์ชั่นวันที่
date_default_timezone_set('Asia/Bangkok');
$date = date("Ymd");	
//ฟังก์ชั่นสุ่มตัวเลข
$numrand = (mt_rand());
//เพิ่มไฟล์
$upload=$_FILES['fileupload'];
if($upload <> '') {   //not select file
//โฟลเดอร์ที่จะ upload file เข้าไป 
        $path="uploadfile/";  

        //เอาชื่อไฟล์เก่าออกให้เหลือแต่นามสกุล
        $type = strrchr($_FILES['fileupload']['name'],".");
            
        //ตั้งชื่อไฟล์ใหม่โดยเอาเวลาไว้หน้าชื่อไฟล์เดิม
        $newname = $id.$type;
        $path_copy=$path.$newname;
        $path_link="uploadfile/".$newname;

        //คัดลอกไฟล์ไปเก็บที่เว็บเซริ์ฟเวอร์
        move_uploaded_file($_FILES['fileupload']['tmp_name'],$path_copy);  	
            }
            // เพิ่มไฟล์เข้าไปในตาราง uploadfile
            
                // $sql = "INSERT INTO tb_user (images) 
                // VALUES('$newname')";
                
                // $sql = "INSERT INTO tb_user (user_username,user_password,user_name,user_surname,user_sex,user_temperature,user_level,images) VALUES ('".$_POST["user_username"]."','".md5($_POST["user_password"])."','".$_POST["user_name"]."','".$_POST["user_surname"]."','".$_POST["user_sex"]."','".$_POST["user_temperature"]."','".$_POST["user_level"]."','$newname')";
                $sql = "UPDATE tb_student SET student_code = '".$_POST['student_code']."', student_prefix = '".$_POST['student_prefix']."', student_name = '".$_POST['student_name']."',
                student_surname = '".$_POST['student_surname']."', student_branch = '".$_POST['student_branch']."', images = '".$_POST['images']."''$newname' WHERE student_id = '".$id."'";
                $result = mysqli_query($Connection, $sql) or die ("Error in query: $sql " . mysqli_error());
            
            mysqli_close($Connection);
            // javascript แสดงการ upload file
            
            if($result){
            echo "<script type='text/javascript'>";
            echo "alert('Upload File Succesfuly');";
            echo "window.location = 'index.php'; ";
            echo "</script>";
            }
            else{
            echo "<script type='text/javascript'>";
            echo "alert('Error back to upload again');";
            echo "</script>";
}
?>