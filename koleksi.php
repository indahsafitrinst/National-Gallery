<?php
    function input($data) {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }
    include 'config/database.php';
    $id_koleksi=input($_GET['id']);
    $query = mysqli_query ($kon,"select * from koleksi a inner join kategori k on k.id_kategori=a.id_kategori 
             where id_koleksi='".$id_koleksi."' limit 1");
    $data = mysqli_fetch_assoc($query); 
?>
<div class="row">
    <div class="col-sm-8">
        <div class="thumbnail">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb" style="background-color: #000000;">
                    <li class="breadcrumb-item"><a href="index.php">Home</a></li>
                    <li class="breadcrumb-item"><a href="index.php?halaman=home&kategori=<?php echo $data['id_kategori']; ?>"><?php echo $data["nama_kategori"];?></a></li>
                    <li class="breadcrumb-item active" aria-current="page"><?php echo $data["judul_koleksi"];?></li>
                </ol>
            </nav>
            
            <img src="admin/koleksi/gambar/<?php echo $data['gambar'];?>" width="25%" height="25%" class="mx-auto d-block" alt="gambar">
            <form>
                <button onClick="window.print()" type="button" class="btn btn-dark">Print Page</button>
                <a class="btn btn-dark" href="admin/koleksi/gambar/<?= $data['gambar']; ?>" download>Save Picture</a>
            </form>
            <br>
            <br>
                
            <div class="caption">
            <table class="table table-striped table-bordered table-dark">
            <?php
                    include 'config/database.php';
                    $sql="select * from media,koleksi where media.id_media=koleksi.id_media and id_koleksi=".$id_koleksi." ";
                    $hasil=mysqli_query($kon,$sql);
                    while ($media = mysqli_fetch_array($hasil)):
                ?>
            <tr>
            <td><b>Media :</b>
            <td> <p><?php echo $media['nama_media']; ?></p> </td>
                        <?php endwhile; ?>
            </tr>
            <?php
                    include 'config/database.php';
                    $sql="select * from detail,koleksi where detail.id_detail=koleksi.id_detail and id_koleksi=".$id_koleksi." ";
                    $hasil=mysqli_query($kon,$sql);
                    while ($detail = mysqli_fetch_array($hasil)):
                ?>
            <tr>
            <td><b>Detail :</b>   </td>
            <td><p>Tinggi x Lebar : <?php echo $detail['tinggi']; ?> X <?php echo $detail['lebar']; ?></p></td>
                        <?php endwhile; ?>
            </tr>
            <?php
                    include 'config/database.php';
                    $sql="select * from credit_line,koleksi where credit_line.id_credit=koleksi.id_credit and id_koleksi=".$id_koleksi." ";
                    $hasil=mysqli_query($kon,$sql);
                    while ($credit_line= mysqli_fetch_array($hasil)):
                ?>
            <tr>
            <td><b>Credit Line :</b>   </td>
            <td> <p><?php echo $credit_line['nama_credit']; ?></p> </td>
                        <?php endwhile; ?>
            </tr>
            </table>

            <?php
                    include 'config/database.php';
                    $sql="select * from artist,koleksi where artist.id_artist=koleksi.id_artist and id_koleksi=".$id_koleksi." ";
                    $hasil=mysqli_query($kon,$sql);
                    while ($artist = mysqli_fetch_array($hasil)):
                ?>
            <table class="table table-dark table-borderless">
            <tr>
            <td><center><b>Artist / Maker :</b></center>
                        <h5><?php echo $artist['nama_artist'];?></h5>
                        <div class="row">
                            <div class="col-sm-1">
                                <img src="gambar/artist.jpg" width="150%" height="150%" alt="gambar">
                            </div>
                            <div class="col-sm-11">
                                <?php echo $artist['about']; ?>
                            </div> 
                        </div>
                        <br>
                        <?php endwhile; ?>
                    </td>
            </tr>
        
                <tr>
                <br>
                <td>
                <center><b>Overview: </b></center>
                <br>
                <?php echo $data["deskripsi"]; ?>   
            <hr style="height: 12px; border: 0; box-shadow: inset 0 12px 12px -12px rgba(0, 0, 0, 0.5);">
            </td>
            </tr>
            </table>
            </div>
        </div>
    </div>

    <div class="col-sm-4">
        <div class="row">
            <?php
                include 'config/database.php';
                $sql="select * from koleksi where status=1 order by id_koleksi desc";
                $hasil=mysqli_query($kon,$sql);
                while ($data = mysqli_fetch_array($hasil)):
            ?>

            <div class="col-sm-12">
                <div class="card border-dark mb-3" style="width: 28rem;">
                <div class="card-header">
                    <h5><a class="text-dark" href="index.php?halaman=koleksi&id=<?php echo $data['id_koleksi'];?>"><?php echo $data['judul_koleksi'];?></a></h5>
                </div>
                    <div class="row">
                        <div class="col-xl-3">
                            <img src="admin/koleksi/gambar/<?php echo $data['gambar'];?>" width="100%" alt="gambar">
                        </div>
                        <div class="col-sm-9">
                            <?php
                                $ambil=$data["deskripsi"];
                                $panjang = strip_tags(html_entity_decode($ambil,ENT_QUOTES,"ISO-8859-1"));
                            
                                echo substr($panjang, 0, 130);
                            ?>
                        </div>
                    </div>
                    <div class="card-footer">
                           <small class="text-muted">Published <?php echo $data['tanggal'];?></small>
                    </div>
                </div>
            </div>
            <?php endwhile; ?>
        </div>
       
    </div>  
</div>