<?php
    require 'db-connect.php';
    $id = $_GET['id'];

    $img = "SELECT photo FROM student_info WHERE id = '$id' ";
    $result = mysqli_query($db_connect, $img);
    $im = mysqli_fetch_assoc($result);
    $photo = $im['photo'];
    unlink('upload/'.$photo);

    $delete_query = "DELETE FROM student_info WHERE id = $id";
    mysqli_query($db_connect, $delete_query);
    header("location: data-table.php");
?>