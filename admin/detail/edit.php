
<?php
    $id_detail=$_POST["id_detail"];
    include '../../config/database.php';
    $query = mysqli_query($kon, "SELECT * FROM detail where id_detail=$id_detail");
    $data = mysqli_fetch_array($query); 

    $tinggi=$data['tinggi'];
    $lebar=$data['lebar'];

?>
    <form action="detail/edit.php" method="post">
    <div class="form-group">
            <input name="id_detail" value="<?php echo $id_detail; ?>" type="hidden" class="form-control">
        </div>
        <div class="form-group">
            <label>Tinggi:</label>
            <input name="tinggi" value="<?php echo $tinggi; ?>" type="text" class="form-control">
        </div>
   
        <div class="form-group">
            <label>Lebar:</label>
            <input name="lebar" value="<?php echo $lebar; ?>" type="text" class="form-control">
        </div>

        <button type="submit" name="simpan_edit" class="btn btn-dark">Update Detail</button>
    </form>

<?php
    if (isset($_POST['simpan_edit'])) {
        include '../../config/database.php';
        
        //Fungsi untuk mencegah inputan karakter yang tidak sesuai
        function input($data) {
            $data = trim($data);
            $data = stripslashes($data);
            $data = htmlspecialchars($data);
            return $data;
        }
        $id_detail=input($_POST["id_detail"]);
        $tinggi=input($_POST["tinggi"]);
        $lebar=input($_POST["lebar"]);

        //Query input menginput data kedalam tabel
        $sql="update detail set
        tinggi='$tinggi',
        lebar='$lebar'
        where id_detail=$id_detail";

        //Mengeksekusi/menjalankan query 
        $hasil=mysqli_query($kon,$sql);


        //Kondisi apakah berhasil atau tidak dalam mengeksekusi query diatas
        if ($hasil) {
            header("Location:../index.php?halaman=detail&edit=berhasil");
        }
        else {
            header("Location:../index.php?halaman=detail&edit=gagal");;

        }
        
    }
    ?>