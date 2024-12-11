<?php 
  session_start();
  if (!$_SESSION["id_admin"]){
        header('Location:../index.php?halaman=login&pesan=login_dulu');
  }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>National Gallery of Art | Halaman Admin </title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="../css/style.css">
   <!-- Bootstrap CSS -->
   <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
    <!-- JavaScript-->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>

</head>

<body style="background-color: #f8f8ff;">
<nav class="navbar navbar-expand-md bg-dark navbar-dark">
    <!-- Banner -->
    <a class="navbar-brand" href="../index.php"><h4>National Gallery of Art</h4></a>

    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#collapsibleNavbar">
        <span class="navbar-toggler-icon"></span>
    </button>

    <!-- Navbar-->
    <div class="collapse navbar-collapse" id="collapsibleNavbar">
        <ul class="navbar-nav  ml-auto">
        <li class="text-light">Halaman Admin |  Login Sebagai :  <?php echo $_SESSION["nama_admin"]; ?> </li>
        </ul>
    </div>
   
</nav>

<div class="jumbotron jumbotron-fluid" style="background-color: #DCDCDC">
        <div class="container text-center">
          <img src="../gambar/art.jpg" width="200" class="rounded-circle">
<?php 
if(isset($_GET['halaman']) && !isset($_GET['kategori'])){
    $halaman = $_GET['halaman'];
   echo "<h1>".ucwords($halaman)."</h1>";
}

if(isset($_GET['halaman']) &&  isset($_GET['kategori'])){

    include '../config/database.php';
    $ambil_kategori = mysqli_query ($kon,"select * from kategori where id_kategori='".$_GET['kategori']."' limit 1");
    $row = mysqli_fetch_assoc($ambil_kategori); 
    $kategori = $row['nama_kategori'];
    $halaman = $_GET['halaman'];
   echo "<h1>".ucwords($halaman)." ".ucwords($kategori)."</h1>";
}
?>
          <p class="lead">Halaman Admin | National Gallery of Art</p>
        </div>
      </div>
<div class="container">
    <div class="row">
        <div class="col-sm-2" style="background-color: #000000">
        <br>
            <div class="list-group">
                <a href="index.php?halaman=kategori" class="list-group-item list-group-item-action list-group-item-dark">Koleksi</a>
                <a href="index.php?halaman=admin" class="list-group-item list-group-item-action list-group-item-dark">Admin</a>
                <a href="index.php?halaman=artist" class="list-group-item list-group-item-action list-group-item-dark">Artist</a>
                <a href="index.php?halaman=media" class="list-group-item list-group-item-action list-group-item-dark">Media</a>
                <a href="index.php?halaman=detail" class="list-group-item list-group-item-action list-group-item-dark">Detail</a>
                <a href="index.php?halaman=credit_line" class="list-group-item list-group-item-action list-group-item-dark">Credit Line</a>
                <a href="logout.php" class="list-group-item list-group-item-action list-group-item-dark">Logout</a>
            </div>
        </div> 
        <div class="col-sm-10" style="background-color: #000000">
        <br>
        <?php 
            if(isset($_GET['halaman'])){
                $halaman = $_GET['halaman'];
                switch ($halaman) {
                    case 'kategori':
                        include "koleksi/kategori.php";
                        break;
                    case 'koleksi':
                        include "koleksi/index.php";
                        break;
                    case 'artist':
                        include "artist/index.php";
                        break;
                    case 'media':
                        include "media/index.php";
                        break;
                    case 'detail':
                        include "detail/index.php";
                        break;
                    case 'admin':
                        include "admin/index.php";
                        break;
                    case 'credit_line':
                        include "credit_line/index.php";
                        break;
                    default:
                    echo "<center><h3>Maaf. Halaman tidak di temukan !</h3></center>";
                    break;
                }
            }else {
                include "dashboard.php";
            }
        ?>
        </div>
    </div>
    <br>
</div>


<!-- Bagian Footer-->
<footer class="footer">
            <div class="container2">
                <div class="row1">
                    <div class="footer-col">
                        <h4>National Gallery of Art</h4>
                        <ul>
                            <li>The National Gallery of Art serves the nation by welcoming</li>
                            <li>all people to explore and experience art, creativity,</li>
                            <li>and our shared humanity.</li>
                            <br>
                            <li>This website was created to fulfill the final project of a database system.</li>
                            <li>This website is inspired by:</li>
                            <li><a href="https://www.nga.gov/collection.html">National Gallery of Art </a>(Original Website)</li>
                        </ul>
                    </div>
                    <div class="footer-col">
                        <h4>Address</h4>
                        <ul>
                            <li>West Building</li>
                            <li>6th St and Constitution Ave NW</li>
                            <li>10:00 a.m. to 5:00 p.m. daily</li>
                            <br>
                            <li>Sculpture Garden</li>
                            <li>7th St and Constitution Ave </li> 
                            <li>10:00 a.m. to 5:00 p.m. daily</li>
                            <br> 
                            <li>East Building</li>
                            <li>4th St and Constitution Ave NW</li>
                            <li>10:00 a.m. to 5:00 p.m. daily</li>
                        </ul>
                    </div>
                    <div class="footer-col">
                            <img src="../gambar/12.png">
                    </div>
                    <hr style="width:100%; color: white;">
                    <p style="color:white; text-align: center;">Copyright &copy; 2021 <b>. Kelompok 10 SBD .</b></p>
                </div>
            </div>
        </footer>
</body>
</html>
