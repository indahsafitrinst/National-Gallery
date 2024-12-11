
<?php
    $id_credit=$_POST["id_credit"];
    include '../../config/database.php';
    $query = mysqli_query($kon, "SELECT * FROM credit_line where id_credit=$id_credit");
    $data = mysqli_fetch_array($query); 

    $nama_credit=$data['nama_credit'];

?>
    <form action="credit_line/edit.php" method="post">
    <div class="form-group">
            <input name="id_credit" value="<?php echo $id_credit; ?>" type="hidden" class="form-control">
        </div>
        <div class="form-group">
            <label>Credit Line:</label>
            <input name="nama_credit" value="<?php echo $nama_credit; ?>" type="text" class="form-control">
        </div>

        <button type="submit" name="simpan_edit" class="btn btn-dark">Update Credit</button>
    </form>

<?php
    if (isset($_POST['simpan_edit'])) {
        include '../../config/database.php';
        
        function input($data) {
            $data = trim($data);
            $data = stripslashes($data);
            $data = htmlspecialchars($data);
            return $data;
        }
        $id_credit=input($_POST["id_credit"]);
        $nama_credit=input($_POST["nama_credit"]);

        $sql="update credit_line set
        nama_credit='$nama_credit'
        where id_credit=$id_credit";

        //Mengeksekusi/menjalankan query 
        $hasil=mysqli_query($kon,$sql);


        //Kondisi apakah berhasil atau tidak dalam mengeksekusi query diatas
        if ($hasil) {
            header("Location:../index.php?halaman=credit_line&edit=berhasil");
        }
        else {
            header("Location:../index.php?halaman=credit_line&edit=gagal");;

        }
        
    }
    ?>