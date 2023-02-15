<?php 
require('../connections/mysqli.php');
$name = $_POST["empname"]; // สม
$sql = "SELECT * FROM tb_student WHERE student_name LIKE '%$name%' ORDER BY student_name ASC";
$result=mysqli_query($Connection,$sql);
$count=mysqli_num_rows($result);
$order=1;
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <link rel="stylesheet" href="../assets/css/bootstrap.min.css">
        <link rel="stylesheet" href="../assets/icons/bootstrap-icons.css">
        <title>ข้อมูลพนักงาน</title>
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="assets/dashboard.css">
    </head>
    <body>
        <?php include 'include/header.php'; ?>
        <div class="container">
        <h1 class="text-center">ข้อมูลพนักงานในฐานข้อมูล</h1>
        <hr>
        <?php if($count>0){?>
            <form action="searchData.php" class="form-group" method="POST">
            <label for="">ค้นหาพนักงาน</label>
            <input type="text" placeholder="ป้อนชื่อพนักงาน" name="empname" class="form-control">
            <input type="submit" value="Search" class="btn btn-dark my-2"> 
        </form>
        

        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>รหัสนักศึกษา</th>
                    <th>คำนำหน้า</th>
                    <th>ชื่อ</th>
                    <th>นามสกุล</th>
                    <th>สาขา</th>
                    <th>แก้ไขข้อมูล</th>
                    <th>ลบข้อมูล</th>
                    <th>ลบข้อมูล (Checkbox)</th>
                </tr>
            </thead>
            <tbody>
            <?php while($row=mysqli_fetch_assoc($result)){
                ?>
                <tr>
                    <td><?php echo $row["student_code"] ;?></td>
                    <td><?php echo $row["student_perfix"] ;?></td>
                    <td><?php echo $row["student_name"] ;?></td>
                    <td><?php echo $row["student_surname"] ;?></td>
                    <td><?php echo $row["student_branch"] ;?></td>
                    <!-- <td><?php echo $row["user_temperature"] ;?></td>
                    <td>
                        <a href="editForm.php?id=<?php echo $row["id"]?>" class="btn btn-primary">แก้ไข</a>
                        

                    </td>
                    <td>
                        <a href="deleteQueryString.php?idemp=<?php echo $row["id"];?>" 
                        class="btn btn-danger"
                        onclick="return confirm('คุณต้องการลบข้อมูลหรือไม่')"
                        >ลบข้อมูล</a>
                    </td> -->
                    <td>
                        <button type="button" class="btn btn-success btn-sm" onclick="window.location.href='user_edit.php?id=<?php echo $row['student_id']?>'">
                            <i class="bi bi-pencil-square"></i>
                        </button>
                        <a href = 'user_delete.php?id=<?php echo $row['student_id'];?>' type="button" class="btn btn-danger btn-sm"  onclick=" return confirm('คุณต้องการลบข้อมูลหรือไม่')" >
                            <i class="bi bi-trash"
                            class="btn btn-danger"
                            > 
                        </i>
                    </a>    
                    </td>
                </tr>
                <?php } 
            ?>
            </tbody>        
        </table>
        <?php 
        }
    ?> 
    </body>

    <script>
    function checkAll(){
        var form_element=document.forms[1].length; 
        for(i=0;i<form_element-1;i++){
            document.forms[1].elements[i].checked=true;
        }
    }
    function uncheckAll(){
        var form_element=document.forms[1].length; 
        for(i=0;i<form_element-1;i++){
            document.forms[1].elements[i].checked=false;
        }
    }
    </script>
</html>