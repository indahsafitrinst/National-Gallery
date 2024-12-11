<?php
session_start();
    include '../../config/database.php';

    $id_media=$_POST["id_media"];

    $sql="delete from media where id_media=$id_media";
    $hapus_media=mysqli_query($kon,$sql);


?>