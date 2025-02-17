

<div class="card mb-4">
    <div class="card-header">
        <button type="button" id="btn-tambah-kategori" class="btn btn-dark"><span class="text"><i class="fas fa-car fa-sm"></i> Tambah Kategori</span></button>
    </div>
    <div class="card-body">
        <div class="card-columns">
            <?php         
            include '../config/database.php';
            $sql="select * from kategori";
            $hasil=mysqli_query($kon,$sql);
            //Menampilkan data dengan perulangan while
            while ($data = mysqli_fetch_array($hasil)):
            ?>
            <div class="card bg-basic" style="width: 12rem;">
            <a href="index.php?halaman=koleksi&kategori=<?php echo $data['id_kategori'];?>">
            <img class="card-img-top" src="koleksi/gambar_kategori/<?php echo $data['gambar_kategori'];?>" alt="gambar"></a>
                <div class="card-body text-center">
                <a href="index.php?halaman=koleksi&kategori=<?php echo $data['id_kategori'];?>">
                    <h5 class="card-title" style="color: #000000;"><?php echo $data['nama_kategori'];?></h5>
                </a>
                   <button class="hapus_kategori btn btn-outline-danger btn-circle" id_kategori="<?php echo $data['id_kategori']; ?>" gambar="<?php echo $data['gambar_kategori']; ?>">Hapus</button> 
                </div>
            </div>
            <?php endwhile; ?>
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


    $('#btn-tambah-kategori').on('click',function(){
        
        $.ajax({
            url: 'koleksi/tambah-kategori.php',
            method: 'post',
            success:function(data){
                $('#tampil_data').html(data);  
                document.getElementById("judul").innerHTML='Tambah Kategori';
            }
        });
        // Membuka modal
        $('#modal').modal('show');
    });

        // fungsi hapus koleksi
        $('.hapus_kategori').on('click',function(){

        var id_kategori = $(this).attr("id_kategori");
        var gambar = $(this).attr("gambar");
    
        konfirmasi=confirm("Yakin ingin menghapus?")

        if (konfirmasi){
            $.ajax({
                url: 'koleksi/hapus-kategori.php',
                method: 'post',
                data: {id_kategori:id_kategori,gambar:gambar},
                success:function(data){
                    window.location.href = 'index.php?halaman=kategori&hapus=berhasil';
                }
            });
        }


        });
</script>