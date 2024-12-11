
<form action="credit_line/tambah.php" method="post">
        <div class="form-group">
            <label>Credit Line:</label>
            <input name="nama_credit" type="text" class="form-control" placeholder="Masukan Credit Line" required>
        </div>
        
        <button type="submit" name="simpan_tambah" class="btn btn-dark">Tambah</button>
      
    </form>
    <?php
    if (isset($_POST['simpan_tambah'])) {
        //Include file koneksi, untuk koneksikan ke database
        include '../../config/database.php';
        
        //Fungsi untuk mencegah inputan karakter yang tidak sesuai
        function input($data) {
            $data = trim($data);
            $data = stripslashes($data);
            $data = htmlspecialchars($data);
            return $data;
        }
        $id_credit=input($_POST["id_credit"]);
        $nama_credit=input($_POST["nama_credit"]);

        //Query input menginput data kedalam tabel 
        $sql="insert into credit_line (id_credit,nama_credit) values
        ('$id_credit','$nama_credit')";
        //Mengeksekusi/menjalankan query 
        $hasil=mysqli_query($kon,$sql);
     

        //Kondisi apakah berhasil atau tidak dalam mengeksekusi query diatas
        if ($hasil) {
            header("Location:../index.php?halaman=credit_line&tambah=berhasil");
        }
        else {
            header("Location:../index.php?halaman=credit_line&tambah=gagal");

        }
        
    }
?>