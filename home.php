<h4>Search for specific collections here
    <button onclick="location.href='index.php?halaman=search'" type="button" class="btn btn-dark" width="30" height"30"><img src="gambar/search.png" width="30" height"30"></button>
</h4>
<br>
<br>
<div class="row">
<?php       
    include 'config/database.php';
    if (isset($_GET['kategori'])) {
        $sql="select * from koleksi where status=1 and id_kategori=".$_GET['kategori']." order by id_koleksi desc";
    }else {
        $sql="select * from koleksi where status=1 order by id_koleksi desc";
    }
  
    $hasil=mysqli_query($kon,$sql);
    $jumlah = mysqli_num_rows($hasil);
    if ($jumlah>0){
    while ($data = mysqli_fetch_array($hasil)):
?>
    <div class="col-sm-3">
        <div class="thumbnail">
            <a href="index.php?halaman=koleksi&id=<?php echo $data['id_koleksi'];?>">
            <img src="admin/koleksi/gambar/<?php echo $data['gambar'];?>" 
                width="50%" height="25%" class="mx-auto d-block" alt="gambar"></a>
            <div class="caption">
                <h4><?php echo $data['judul_koleksi'];?></h4>
                <p>
                <?php 
                $ambil=$data["deskripsi"];
                $panjang = strip_tags(html_entity_decode($ambil,ENT_QUOTES,"ISO-8859-1"));
                echo substr($panjang, 0, 130);?>
                </p>
                <p><a href="index.php?halaman=koleksi&id=<?php echo $data['id_koleksi'];?>" 
                      class="btn btn-dark btn-block" role="button"> View </a></p>
                </div>
            </div>
        </div>
<?php 
        endwhile;
    }else {
        echo "<div class='alert alert-warning'> Tidak ada koleksi pada kategori ini.</div>";
    };
?>
</div>