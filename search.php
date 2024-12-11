<h4>Search by Collection</h4>

    <form action="index.php?halaman=search" method="post">
    <div class="form-group">
        <label for="sel1">Keyword:
            <p style="color:blue ; font-size: 12px;"> *Keyword yang dicari berdasarkan judul koleksi</p>
        </label>
        <?php
        $kata_kunci="";
        if (isset($_POST['kata_kunci'])) {
            $kata_kunci=$_POST['kata_kunci'];
        }
        ?>
        <input type="text" name="kata_kunci" value="<?php echo $kata_kunci;?>" class="form-control" >
    </div>
    <div class="form-group">
        <input type="submit" class="btn btn-dark" value="Search">
    </div>
<div class="row">

        <?php
        include 'config/database.php';
        if (isset($_POST['kata_kunci'])) {
            $kata_kunci=trim($_POST['kata_kunci']);
            $sql="select * from koleksi where judul_koleksi like '%".$kata_kunci."%' order by judul_koleksi asc";

        }else {
            $sql="select * from koleksi order by judul_koleksi asc";
        }

        $hasil=mysqli_query($kon,$sql);
        while ($data = mysqli_fetch_array($hasil)) {

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
        };
        ?>

</div>
