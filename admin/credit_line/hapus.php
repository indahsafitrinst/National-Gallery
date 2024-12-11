<?php
session_start();
    include '../../config/database.php';

    $id_credit=$_POST["id_credit"];

    $sql="delete from credit_line where id_credit=$id_credit";
    $hapus_credit=mysqli_query($kon,$sql);


?>