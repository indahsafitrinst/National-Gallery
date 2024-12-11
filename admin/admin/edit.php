
<?php
    $id_admin=$_POST["id_admin"];
    include '../../config/database.php';
    $query = mysqli_query($kon, "SELECT * FROM admin where id_admin=$id_admin");
    $data = mysqli_fetch_array($query); 

    $nama_admin=$data['nama_admin'];
    $username=$data['username'];
    $password=$data['password'];
    $status=$data['status'];
?>
    <form action="admin/edit.php" method="post">
    <div class="form-group">
            <input name="id_admin" value="<?php echo $id_admin; ?>" type="hidden" class="form-control">
        </div>
        <div class="form-group">
            <label>Nama admin:</label>
            <input name="nama_admin" value="<?php echo $nama_admin; ?>" type="text" class="form-control" placeholder="Masukan nama" required>
        </div>

        <div class="row">
            <div class="col-sm-6">
                <div class="form-group">
                    <label>Username:</label>
                    <input name="username" value="<?php echo $username; ?>" type="text" class="form-control" placeholder="Masukan username" required>
                </div>
            </div>
            <div class="col-sm-6">
                <div class="form-group">
                    <label>Password:</label>
                    <input name="password" value="<?php echo $password; ?>" type="password" class="form-control" placeholder="Masukan password" required>
                </div>
            </div>
        </div>


        <div class="row">
            <div class="col-sm-6">
                <div class="form-group">
                    <label>Status:</label>
                    <select name="status" class="form-control">
                        <option <?php if ($status==1) echo "selected"; ?> value="1">Aktif</option>
                       <option <?php if ($status==0) echo "selected"; ?> value="0">Tidak Aktif</option>
                    </select>
                </div>
            </div>
        </div>


        <button type="submit" name="simpan_edit" class="btn btn-dark">Update Admin</button>
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
        $id_admin=input($_POST["id_admin"]);
        $nama_admin=input($_POST["nama_admin"]);
        $username=input($_POST["username"]);
        $status=input($_POST["status"]);

        $ambil_password=mysqli_query($kon,"select password from admin where id_admin=$id_admin limit 1");
        $data = mysqli_fetch_array($ambil_password);
        
        if ($data['password']==$_POST["password"]){
            $password=input($_POST["password"]);
        }else {
            $password=md5(input($_POST["password"]));
        }

        //Query input menginput data kedalam tabel admin
        $sql="update admin set
        nama_admin='$nama_admin',
        username='$username',
        password='$password',
        status='$status'
        where id_admin=$id_admin";

        //Mengeksekusi/menjalankan query 
        $hasil=mysqli_query($kon,$sql);


        //Kondisi apakah berhasil atau tidak dalam mengeksekusi query diatas
        if ($hasil) {
            header("Location:../index.php?halaman=admin&edit=berhasil");
        }
        else {
            header("Location:../index.php?halaman=admin&edit=gagal");

        }
        
    }
    ?>