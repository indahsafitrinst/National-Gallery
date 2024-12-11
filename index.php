<!DOCTYPE html>
<html lang="en">
<head>
    <title>National Gallery of Art | Home </title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="css/style.css">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
    <!-- JavaScript-->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
</head>
<body style="background-color: #f8f8ff;">
<nav class="navbar navbar-expand-md bg-dark navbar-dark">
    <!-- Brand -->
    
    <a class="navbar-brand" href="index.php?halaman=home"><h4>National Gallery of Art</h4></a>

    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#collapsibleNavbar">
        <span class="navbar-toggler-icon"></span>
    </button>

    <!-- Navbar -->
    <div class="collapse navbar-collapse" id="collapsibleNavbar">
        <ul class="navbar-nav">
        <?php
         
            include 'config/database.php';
            $sql="select * from kategori";
            $hasil=mysqli_query($kon,$sql);
            while ($data = mysqli_fetch_array($hasil)):
        ?>
            <li class="nav-item">
                <a class="nav-link" href="index.php?halaman=home&kategori=<?php echo $data['id_kategori']; ?>"><?php echo $data['nama_kategori'];?></a>
            </li>
            <?php endwhile; ?>
        </ul>
        <ul class="navbar-nav ml-auto">
            <?php 
                session_start();
                if (isset($_SESSION["id_admin"])) {
                        echo " <li><a class='nav-link' href='admin/index.php?halaman=kategori'>Halaman Admin</a></li>";
                }else {
                    echo " <li><a class='nav-link' href='index.php?halaman=login'><span class='fas fa-log-in'></span> Login</a></li>";
                }
            ?>
        </ul>
    </div>
   
</nav>

<?php
    $judul="Mediums";   
    include 'config/database.php';
    if (isset($_GET['id'])) {
        $sql="select * from koleksi where status=1 and id_koleksi=".$_GET['id']."";
        $hasil=mysqli_query($kon,$sql);
        $data = mysqli_fetch_array($hasil);
        $judul=$data['judul_koleksi'];  
    }else if (isset($_GET['kategori'])){
        $sql="select * from kategori where id_kategori=".$_GET['kategori']."";
        $hasil=mysqli_query($kon,$sql);
        $data = mysqli_fetch_array($hasil);
        $judul=$data['nama_kategori'];  
    }

    

?>

<img src="gambar/collection.png" width="100%" height="500">

<div class="container">
<h1 style="margin-top: 50px;margin-bottom: 30px;font-family: 'Lora', serif;font-size: 60px;"><?php echo $judul;?></h1>
<?php 
    if(isset($_GET['halaman'])){
        $halaman = $_GET['halaman'];
        switch ($halaman) {
            case 'home':
                include "home.php";
                break;
            case 'koleksi':
                include "koleksi.php";
                break;
            case 'search':
                include "search.php";
                break;
            case 'login':
                include "login.php";
                break;
            default:
            echo "<center><h3>Maaf. Halaman tidak di temukan !</h3></center>";
            break;
        }
    }else {
        include "home.php";
    }
?>
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
                            <img src="gambar/12.png">
                    </div>
                    <hr style="width:100%; color: white;">
                    <p style="color:white; text-align: center;">Copyright &copy; 2021 <b>. Kelompok 10 SBD .</b></p>
                </div>
            </div>
        </footer>
</body>
</html>

<!--Username: indah atau admin
    Password: 12345--->