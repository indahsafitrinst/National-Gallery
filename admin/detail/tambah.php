
<form action="detail/tambah.php" method="post">
        <div class="form-group">
            <label>Tinggi: </label>
            <input name="tinggi" type="text" class="form-control" placeholder="Masukan tinggi" required>
        </div>

        <div class="form-group">
            <label>Lebar: </label>
            <input name="lebar" type="text" class="form-control" placeholder="Masukan lebar" required>
        </div>
        <button type="submit" name="simpan_tambah" class="btn btn-dark">Tambah Detail</button>
      
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
        $id_detail=input($_POST["id_detail"]);
        $tinggi=input($_POST["tinggi"]);
        $lebar=input($_POST["lebar"]);
        
        //Query input menginput data kedalam tabel 
        $sql="insert into detail (id_detail,tinggi,lebar) values
        ('$id_detail','$tinggi','$lebar')";
        //Mengeksekusi/menjalankan query 
        $hasil=mysqli_query($kon,$sql);
     

        //Kondisi apakah berhasil atau tidak dalam mengeksekusi query diatas
        if ($hasil) {
            header("Location:../index.php?halaman=detail&tambah=berhasil");
        }
        else {
            header("Location:../index.php?halaman=detail&tambah=gagal");

        }
        
    }
?>