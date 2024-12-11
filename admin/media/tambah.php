
<form action="media/tambah.php" method="post">
        <div class="form-group">
            <label>Media: </label>
            <input name="nama_media" type="text" class="form-control" placeholder="Masukan media" required>
        </div>

        <button type="submit" name="simpan_tambah" class="btn btn-dark">Tambah media</button>
      
    </form>
    <?php
    if (isset($_POST['simpan_tambah'])) {
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
        
        //Query untuk menginput data kedalam tabel 
        $sql="insert into media (id_media,nama_media) values
        ('$id_media','$nama_media')";
        //Mengeksekusi/menjalankan query 
        $hasil=mysqli_query($kon,$sql);
     

        //Kondisi apakah berhasil atau tidak dalam mengeksekusi query diatas
        if ($hasil) {
            header("Location:../index.php?halaman=media&tambah=berhasil");
        }
        else {
            header("Location:../index.php?halaman=media&tambah=gagal");

        }
        
    }
?>