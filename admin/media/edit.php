
<?php
    $id_media=$_POST["id_media"];
    include '../../config/database.php';
    $query = mysqli_query($kon, "SELECT * FROM media where id_media=$id_media");
    $data = mysqli_fetch_array($query); 

    $nama_media=$data['nama_media'];

?>
    <form action="media/edit.php" method="post">
    <div class="form-group">
            <input name="id_media" value="<?php echo $id_media; ?>" type="hidden" class="form-control">
        </div>
        <div class="form-group">
            <label>Media :</label>
            <input name="nama_media" value="<?php echo $nama_media; ?>" type="text" class="form-control">
        </div>
        <button type="submit" name="simpan_edit" class="btn btn-dark">Update Media</button>
    </form>

<?php
    if (isset($_POST['simpan_edit'])) {
        //Include file koneksi, untuk koneksikan ke database
        include '../../config/database.php';
        
        //Fungsi untuk mencegah inputan karakter yang tidak sesuai
        function input($data) {
            $data = trim($data);
            $data = stripslashes($data);
            $data = htmlspecialchars($data);
            return $data;
        }
        $id_media=input($_POST["id_media"]);
        $nama_media=input($_POST["nama_media"]);


        //Query input menginput data kedalam tabel
        $sql="update media set
        nama_media='$nama_media'
        where id_media=$id_media";

        //Mengeksekusi/menjalankan query 
        $hasil=mysqli_query($kon,$sql);


        //Kondisi apakah berhasil atau tidak dalam mengeksekusi query diatas
        if ($hasil) {
            header("Location:../index.php?halaman=media&edit=berhasil");
        }
        else {
            header("Location:../index.php?halaman=media&edit=gagal");;

        }
        
    }
    ?>