<?php
session_start();
    include '../../config/database.php';

    $id_detail=$_POST["id_detail"];

    $sql="delete from detail where id_detail=$id_detail";
    $hapus_detail=mysqli_query($kon,$sql);


?>