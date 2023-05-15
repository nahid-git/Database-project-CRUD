<?php
require 'db-connect.php';
if(isset($_POST['edit_btn']))
{
$ename = $_POST['edit_name'];
$ebatch = $_POST['edit_batch'];
$eid = $_POST['edit_id'];
$esemester = $_POST['edit_semester'];
$eemail = $_POST['edit_email'];
$egender = $_POST['edit_gender'];
$epassword = $_POST['edit_password'];
$eaddress = $_POST['edit_address'];
$ephoto_name = $_FILES['edit_photo']['name'];
$ephoto_temp_name = $_FILES['edit_photo']['tmp_name'];

    $img = "SELECT photo FROM student_info WHERE id = '$eid' ";
    $result = mysqli_query($db_connect, $img);
    $im = mysqli_fetch_assoc($result);
    $photo = $im['photo'];
    if (empty($ephoto_name)) {
        $update_query = "UPDATE student_info SET name ='$ename', batch ='$ebatch', semester ='$esemester', gender ='$egender', email ='$eemail', password ='$epassword', address ='$eaddress', photo ='$photo' WHERE id = '$eid' ";
    } else {
        $img = "SELECT photo FROM student_info WHERE id = '$eid' ";
        $result = mysqli_query($db_connect, $img);
        $im = mysqli_fetch_assoc($result);
        $photo = $im['photo'];
        unlink('upload/'.$photo);
        move_uploaded_file($ephoto_temp_name, "upload/" . $ephoto_name);
    
        $update_query = "UPDATE student_info SET name ='$ename', batch ='$ebatch', semester ='$esemester', gender ='$egender', email ='$eemail', password ='$epassword', address ='$eaddress', photo ='$ephoto_name' WHERE id = '$eid' ";
    }
    
    mysqli_query($db_connect, $update_query);
    header("location: data-table.php");
}
?>
