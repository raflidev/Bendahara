<?php
require "koneksi.php";
if(isset($_POST['submit'])){
    $nama = $_POST['nama'];
    $sql = "INSERT into grup values(NULL,'$nama')";
    mysqli_query($koneksi,$sql);
    if(true){
        //mengambil id grup terbaru
        $sql = "SELECT id_grup from grup order by id_grup DESC LIMIT 1";
        $query = mysqli_query($koneksi, $sql);
        $row = mysqli_fetch_array($query);

        if(isset($_GET['modul'])){
            $modul =  $_GET['modul'];
            $sql = "UPDATE modul set id_grup=$row[0] where id_modul=$modul";
            mysqli_query($koneksi,$sql);
            if(true){
                header("location: member.php?grup=$row[0]");        
            }else{
                echo "update gagal";
            }
        }
        
        header("location: member.php?grup=$row[0]");
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Bendahara! - Tempat menyimpan uang sekertaris</title>
    <link rel="stylesheet" href="css/main.css">
</head>

<body>
<p>Tambah Grup</p>
<div id="content">
    <form action="" method="post">
        <label>Nama Grup</label>
        <input type="text" name="nama">        
        <input class="button" type="submit" name="submit" value='Tambah'>
    </form>
</div>
<?php

?>
    <footer>
        Rafli Ramadhan - &copy; 2019
    </footer>

   
</body>
</html>
