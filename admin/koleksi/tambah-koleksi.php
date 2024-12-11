
<?php
session_start();

        if (isset($_POST['publish']) ) {
        
        //Fungsi untuk mencegah inputan karakter yang tidak sesuai
        function input($data) {
            $data = trim($data);
            $data = stripslashes($data);
            $data = htmlspecialchars($data);
            return $data;
        }
        //Cek apakah ada kiriman form dari method post
        if ($_SERVER["REQUEST_METHOD"] == "POST") {

            if (isset($_POST['publish'])) {
                $status=1;
            }
            include '../../config/database.php';

            $kode_koleksi=input($_POST["kode_koleksi"]);
            $judul_koleksi=input($_POST["judul_koleksi"]);
            $admin=input($_POST["admin"]);
            $artist=input($_POST["artist"]);
            $media=input($_POST["media"]);
            $detail=input($_POST["detail"]);
            $credit_line=input($_POST["credit_line"]);
            $kategori=input($_POST["kategori"]);
            $deskripsi=input($_POST["deskripsi"]);
            $tanggal=date("Y-m-d H:i:s");
            $ekstensi_diperbolehkan	= array('png','jpg','jpeg');
            $gambar = $_FILES['gambar']['name'];
            $x = explode('.', $gambar);
            $ekstensi = strtolower(end($x));
            //$ukuran	= $_FILES['gambar']['size'];
            $file_tmp = $_FILES['gambar']['tmp_name'];	

            if (!empty($gambar)){
                if(in_array($ekstensi, $ekstensi_diperbolehkan) === true){

                    move_uploaded_file($file_tmp, 'gambar/'.$gambar);

                    //Menambah koleksi dengan gambar
                    $sql="insert into koleksi (kode_koleksi,judul_koleksi,id_admin,id_artist,id_media,id_detail,id_credit,deskripsi,gambar,tanggal,status,id_kategori) values
                    ('$kode_koleksi','$judul_koleksi','$admin','$artist','$media','$detail','$credit_line','$deskripsi','$gambar','$tanggal','$status','$kategori')";
                }    
                
            }else {
                    //Menambah koleksi tanpa gambar, maka gambar_default.png yang akan digunakan
                    $sql="insert into koleksi (kode_koleksi,judul_koleksi,id_admin,id_artist,id_media,id_detail,id_credit,deskripsi,tanggal,status,id_kategori) values
                    ('$kode_koleksi','$judul_koleksi','$admin','$artist','$media','$detail','$credit_line','$deskripsi','$tanggal','$status','$kategori')";
                     
            }

            //Mengeksekusi/menjalankan query 
            $simpan_koleksi=mysqli_query($kon,$sql);

            //Cek apakah berhasil atau tidak dalam mengeksekusi query
            if ($simpan_koleksi) {
                header("Location:../index.php?halaman=koleksi&kategori=$kategori&add=berhasil");
            }
            else {
                echo mysqli_error($kon);
                header("Location:../index.php?halaman=koleksi&kategori=$kategori&add=gagal");
                
            } 

        }
    }

      include '../../config/database.php';
      $query = mysqli_query($kon, "SELECT max(id_koleksi) as kodeTerbesar FROM koleksi");
      $data = mysqli_fetch_array($query);
      $id_koleksi = $data['kodeTerbesar'];
      $id_koleksi++;
      $huruf = "A";
      $kodekoleksi = $huruf . sprintf("%04s", $id_koleksi);

?>
<form action="koleksi/tambah-koleksi.php" method="post" enctype="multipart/form-data">
    <!-- rows -->
    <div class="row">
        <div class="col-sm-12">
            <div class="form-group">
                <label>Kode:</label>
                <h3><?php echo $kodekoleksi; ?></h3>
                <input name="kode_koleksi" value="<?php echo $kodekoleksi; ?>" type="hidden" class="form-control">
            </div>
        </div>
    </div>
    <!-- rows -->
    <div class="row">
        <div class="col-sm-12">
            <div class="form-group">
                <label>Judul Koleksi:</label>
                <input name="judul_koleksi" type="text" class="form-control" placeholder="Masukan nama koleksi" required>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-sm-12">
            <div class="form-group">
                <label>Admin:</label>
                    <select name="admin" class="form-control">
                    <!-- Menampilkan daftar admin di dalam select list -->
                    <?php
                        echo $id_admin=$_POST['admin'];
                        $sql="select * from admin order by id_admin asc";
                        $hasil=mysqli_query($kon,$sql);
                        while ($data = mysqli_fetch_array($hasil)):
                        ?>
                        <option value="<?php echo $data['id_admin']; ?>"><?php echo $data['nama_admin']; ?></option>
                        <?php endwhile; ?>
                    </select>
            </div>
        </div>
    </div>


    <div class="row">
        <div class="col-sm-12">
            <div class="form-group">
                <label>Artist/Maker:</label>
                    <select name="artist" class="form-control">
                    <!-- Menampilkan daftar artist di dalam select list -->
                    <?php
                        echo $id_artist=$_POST['artist'];
                        $sql="select * from artist order by id_artist asc";
                        $hasil=mysqli_query($kon,$sql);
                        while ($data = mysqli_fetch_array($hasil)):
                        ?>
                        <option value="<?php echo $data['id_artist']; ?>"><?php echo $data['nama_artist']; ?></option>
                        <?php endwhile; ?>
                </select>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-sm-12">
            <div class="form-group">
                <label>Media:</label>
                    <select name="media" class="form-control">
                    <!-- Menampilkan daftar media di dalam select list -->
                    <?php
                        echo $id_media=$_POST['media'];
                        $sql="select * from media order by id_media asc";
                        $hasil=mysqli_query($kon,$sql);
                        while ($data = mysqli_fetch_array($hasil)):
                        ?>
                        <option value="<?php echo $data['id_media']; ?>"><?php echo $data['nama_media']; ?></option>
                        <?php endwhile; ?>
                </select>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-sm-12">
            <div class="form-group">
                <label>Detail:</label>
                    <select name="detail" class="form-control">
                    <!-- Menampilkan daftar detail di dalam select list -->
                    <?php
                        echo $id_detail=$_POST['detail'];
                        $sql="select * from detail order by id_detail asc";
                        $hasil=mysqli_query($kon,$sql);
                        while ($data = mysqli_fetch_array($hasil)):
                        ?>
                        <option value="<?php echo $data['id_detail']; ?>"><?php echo $data['tinggi']; ?> X <?php echo $data['lebar']; ?></option>
                        <?php endwhile; ?>
                </select>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-sm-12">
            <div class="form-group">
                <label>Credit Line:</label>
                    <select name="credit_line" class="form-control">
                    <!-- Menampilkan daftar credit_line di dalam select list -->
                    <?php
                        echo $id_credit=$_POST['credit_line'];
                        $sql="select * from credit_line order by id_credit asc";
                        $hasil=mysqli_query($kon,$sql);
                        while ($data = mysqli_fetch_array($hasil)):
                        ?>
                        <option value="<?php echo $data['id_credit']; ?>"><?php echo $data['nama_credit']; ?></option>
                        <?php endwhile; ?>
                </select>
            </div>
        </div>
    </div>

    <!-- rows -->   
    <div class="row">
    <div class="col-sm-12">
        <div class="form-group">
            <label>Deskripsi:</label>
            <textarea name="deskripsi" class="form-control"  rows="5" ></textarea>
        </div>
    </div>
    </div>

    <!-- rows -->
    <div class="row">
        <div class="col-sm-6">
            <div class="form-group">
                <div id="msg"></div>
                <label>Gambar:</label>
                <input type="file" name="gambar" class="file" >
                    <div class="input-group my-3">
                        <input type="text" class="form-control" disabled placeholder="Upload Gambar" id="file">
                        <div class="input-group-append">
                                <button type="button" id="pilih_gambar" class="browse btn btn-dark">Pilih Gambar</button>
                        </div>
                    </div>
                <img src="gambar_default.png" id="preview" class="img-thumbnail">
            </div>
        </div>
        <div class="col-sm-6">
            <div class="form-group">
                <label>Kategori:</label>
                <select name="kategori" class="form-control">
                <?php
                    echo $id_kategori=$_POST['kategori'];
                    include '../../config/database.php';
                    $sql="select * from kategori where id_kategori='$id_kategori' limit 1";
                    $hasil=mysqli_query($kon,$sql);
                    while ($data = mysqli_fetch_array($hasil)):
                ?>
                    <option value="<?php echo $data['id_kategori']; ?>"><?php echo $data['nama_kategori']; ?></option>
                    <?php endwhile; ?>
                </select>
            </div>
        </div>
    </div>


    <!-- rows -->   
    <div class="row">
        <div class="col-sm-6">
            <div class="form-group">
                <button type="submit" name="publish" class="btn btn-success">Publish</button>
                
            </div>
    
        </div>
   
    </div>   
</form>
<style>
    .file {
    visibility: hidden;
    position: absolute;
    }
</style>
<script>
    $(document).on("click", "#pilih_gambar", function() {
    var file = $(this).parents().find(".file");
    file.trigger("click");
    });
    $('input[type="file"]').change(function(e) {
    var fileName = e.target.files[0].name;
    $("#file").val(fileName);

    var reader = new FileReader();
    reader.onload = function(e) {
        // get loaded data and render thumbnail.
        document.getElementById("preview").src = e.target.result;
    };
    // read the image file as a data URL.
    reader.readAsDataURL(this.files[0]);
    });
</script>
