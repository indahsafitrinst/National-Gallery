<form action="admin/tambah.php" method="post">
        <div class="form-group">
            <label>Nama admin:</label>
            <input name="nama_admin" type="text" class="form-control" placeholder="Masukan nama" required>
        </div>

        <div class="row">
            <div class="col-sm-6">
                <div class="form-group">
                    <label>Username:</label>
                    <input name="username" type="text" class="form-control" placeholder="Masukan username" required>
                </div>
            </div>
            <div class="col-sm-6">
                <div class="form-group">
                    <label>Password:</label>
                    <input name="password" type="password" class="form-control" placeholder="Masukan password" required>
                </div>
            </div>
        </div>


        <div class="row">
 
            <div class="col-sm-6">
                <div class="form-group">
                    <label>Status:</label>
                    <select name="status" class="form-control">
                    <option value="1">Aktif</option>
                    <option value="0">Tidak Aktif</option>
                    </select>
                </div>
            </div>
        </div>


        <button type="submit" name="simpan_tambah" class="btn btn-dark">Tambah</button>
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
    
        $nama_admin=input($_POST["nama_admin"]);
        $username=input($_POST["username"]);
        $password=md5(input($_POST["password"]));
        $status=input($_POST["status"]);

        $sql="insert into admin (nama_admin,username,password,status) values
        ('$nama_admin','$username','$password','$status')";
        //Mengeksekusi/menjalankan query 
        $hasil=mysqli_query($kon,$sql);
     
   

        //Kondisi apakah berhasil atau tidak dalam mengeksekusi query diatas
        if ($hasil) {
            header("Location:../index.php?halaman=admin&tambah=berhasil");
        }
        else {
            header("Location:../index.php?halaman=admin&tambah=gagal");

        }
        
    }
?>