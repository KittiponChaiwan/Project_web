<meta charset="UTF-8">
<?php
    include('mysqli.php');

    if(isset($_POST['submit'])){
        $imgname=$_FILES['fileupload']['name'];
        echo '<br>';
        $extension = pathinfo($imgname,PATHINFO_EXTENSION);
        $randomno=rand(0,100000);
        $filename=$_FILES['fileupload']['tmp_name'];
        $temp = 0 ;
        $query = "SELECT user_id,user_username from tb_user";
        $final = mysqli_query($Connection, $query);
        if (mysqli_num_rows($final) >= 0) {
            //get the output of each row
            while($i = mysqli_fetch_assoc($final)) {
                echo "id: " . $i["user_id"]. "  ---->  name: " . $i["user_username"]. "<br>";
                $temp += 1;
            }
        }

        $rename=$temp+1;
        $newname=$rename.'.'.$extension;

        if(move_uploaded_file($filename, 'uploadfile/'.$newname)){
            echo "uploaded<br>";
            //$insertqry="INSERT INTO `image_upload`( `image_name`) VALUES ('$newname')";
            //$insertes=mysqli_query($con,$insertqry);
            $sql = "INSERT INTO tb_user (user_username,user_password,user_name,user_surname,user_sex,user_temperature,user_level,images) VALUES ('".$_POST["user_username"]."','".md5($_POST["user_password"])."','".$_POST["user_name"]."','".$_POST["user_surname"]."','".$_POST["user_sex"]."','".$_POST["user_temperature"]."','".$_POST["user_level"]."','$newname')";
            $result = mysqli_query($Connection, $sql) or die ("Error in query: $sql " . mysqli_error());
        } else {
            echo "not uploaded";
        }
    }


    1. เชื่อมต่อ database: 
    include('../connections/mysqli.php');  //ไฟล์เชื่อมต่อกับ database ที่เราได้สร้างไว้ก่อนหน้าน้ี
    $fileupload = $_POST['fileupload']; //รับค่าไฟล์จากฟอร์ม	

    ฟังก์ชั่นวันที่
    date_default_timezone_set('Asia/Bangkok');
    $date = date("Ymd");

    $id = $_SESSION['getId'];
    ฟังก์ชั่นสุ่มตัวเลข
    $numrand = (mt_rand());
    เพิ่มไฟล์
    $upload=$_FILES['fileupload'];
    $temp = 0 ;
    if($upload !='') {   //not select file
    โฟลเดอร์ที่จะ upload file เข้าไป 
            $path="uploadfile/";  
            เอาชื่อไฟล์เก่าออกให้เหลือแต่นามสกุล
            $type = strrchr($_FILES['fileupload']['name'],".");
            ตั้งชื่อไฟล์ใหม่โดยเอาเวลาไว้หน้าชื่อไฟล์เดิม
            $newname = $id.$type;
            $path_copy=$path.$newname;
            $path_link="uploadfile/".$newname;
            echo "id: " . $i["user_id"]. "  ---->  name: " . $i["user_username"]. "<br>";
            คัดลอกไฟล์ไปเก็บที่เว็บเซริ์ฟเวอร์
            
            $querySelect = "SELECT user_id,user_username from tb_user";
            $final = mysqli_query($Connection, $querySelect);
            if (mysqli_num_rows($final) >= 0) {
                while($i = mysqli_fetch_assoc($final)) {
                    echo "id: " . $i["user_id"]. "  ---->  name: " . $i["user_username"]. "<br>";
                    $temp += 1;
                }
            }
            move_uploaded_file($_FILES['fileupload']['tmp_name'],$path_copy); 
        }
        เพิ่มไฟล์เข้าไปในตาราง uploadfile
        $temp = $id;
        $rename=$temp+1;
        $newname=$rename.'.'.$extension;

        $sql = "INSERT INTO tb_user (user_username,user_password,user_name,user_surname,user_sex,user_temperature,user_level,images) VALUES ('".$_POST["user_username"]."','".md5($_POST["user_password"])."','".$_POST["user_name"]."','".$_POST["user_surname"]."','".$_POST["user_sex"]."','".$_POST["user_temperature"]."','".$_POST["user_level"]."','$newname')";
        $result = mysqli_query($Connection, $sql) or die ("Error in query: $sql " . mysqli_error());
                
        mysqli_close($Connection);
        javascript แสดงการ upload file
                
        if($result){
            echo "<script type='text/javascript'>";
            echo "alert('Upload File Succesfuly');";
            echo "window.location = 'index.php'; ";
            echo "</script>";
        } else {
            echo "<script type='text/javascript'>";
            echo "alert('Error back to upload again');";
            echo "</script>";
        }
