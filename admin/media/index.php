
<div class="card mb-4">
    <div class="card-header">
    <button type="button" id="btn-tambah-media" class="btn btn-dark"><span class="text"><i class="fas fa-car fa-sm"></i> Tambah Media</span></button>
    </div>
    <div class="card-body">
    <?php
    if (isset($_GET['tambah'])) {
        //Mengecek nilai variabel tambah 
        if ($_GET['tambah']=='berhasil'){
            echo"<div class='alert alert-success'><strong>Berhasil!</strong> media telah di tambahkan!</div>";
        }else if ($_GET['tambah']=='gagal'){
            echo"<div class='alert alert-danger'><strong>Gagal!</strong> media gagal di tambahkan!</div>";
        }    
    }
    if (isset($_GET['edit'])) {
        //Mengecek nilai variabel edit 
        if ($_GET['edit']=='berhasil'){
            echo"<div class='alert alert-success'><strong>Berhasil!</strong> media telah di edit!</div>";
        }else if ($_GET['edit']=='gagal'){
            echo"<div class='alert alert-danger'><strong>Gagal!</strong> media gagal di edit!</div>";
        }    
      }
    if (isset($_GET['hapus'])) {
        //Mengecek nilai variabel hapus 
        if ($_GET['hapus']=='berhasil'){
            echo"<div class='alert alert-success'><strong>Berhasil!</strong> media telah di hapus!</div>";
        }else if ($_GET['hapus']=='gagal'){
            echo"<div class='alert alert-danger'><strong>Gagal!</strong> media gagal di hapus!</div>";
        }    
    }
    ?>
       <!-- Tabel daftar media -->
       <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead class="thead-dark">
                <tr>
                    <th>No</th>
                    <th>Media</th>
                    <th>Aksi</th>
                </tr>
                </thead>
                <tbody>
                    <?php
                  
                        include '../config/database.php';
                        // perintah sql untuk menampilkan daftar media
                        $sql="select * from media order by id_media desc";
                        $hasil=mysqli_query($kon,$sql);
                        $no=0;
                        //Menampilkan data dengan perulangan while
                        while ($data = mysqli_fetch_array($hasil)):
                        $no++;
                    ?>
                    <tr>
                        <td><?php echo $no; ?></td>
                        <td><?php echo $data['nama_media']; ?></td>
                        <td>
                            <button class="btn-edit btn btn-outline-warning btn-circle" id_media="<?php echo $data['id_media']; ?>"  >Edit</button>
                            <button class="btn-hapus btn btn-outline-danger btn-circle"  id_media="<?php echo $data['id_media']; ?>" >Hapus</button>
                        </td>
                    </tr>
                    <?php endwhile; ?>
                </tbody>
            </table>
            </div>
     
    </div>
</div>




<!-- Modal -->
<div class="modal fade" id="modal">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">

        <!-- Bagian header -->
        <div class="modal-header">
            <h4 class="modal-title" id="judul"></h4>
            <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>

        <!-- Bagian body -->
        <div class="modal-body">
            <div id="tampil_data">

            </div>  
        </div>
        <!-- Bagian footer -->
        <div class="modal-footer">
        <button type="button" id="btn-close" class="btn btn-danger">Close</button>
        </div>

        </div>
    </div>
</div>
<script>
    
     $('#btn-close').on('click',function(){
        
        // Menutup modal
        $('#modal').modal('hide');
    });
    $('#btn-tambah-media').on('click',function(){
        
        $.ajax({
            url: 'media/tambah.php',
            method: 'post',
            success:function(data){
                $('#tampil_data').html(data);  
                document.getElementById("judul").innerHTML='Tambah media';
            }
        });
        // Membuka modal
        $('#modal').modal('show');
    });
   
    // fungsi edit media
    $('.btn-edit').on('click',function(){

        var id_media = $(this).attr("id_media");
    
        $.ajax({
            url: 'media/edit.php',
            method: 'post',
            data: {id_media:id_media},
            success:function(data){
                $('#tampil_data').html(data);  
                document.getElementById("judul").innerHTML='Edit media #'+id_media;
            }
        });
        // Membuka modal
        $('#modal').modal('show');
    });




    // fungsi hapus media
    $('.btn-hapus').on('click',function(){

        var id_media = $(this).attr("id_media");

        konfirmasi=confirm("Yakin ingin menghapus?")

        if (konfirmasi){
            $.ajax({
                url: 'media/hapus.php',
                method: 'post',
                data: {id_media:id_media},
                success:function(data){
                    window.location.href = 'index.php?halaman=media&hapus=berhasil';
                }
            });
        }
});

</script>