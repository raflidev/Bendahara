<?php
require "koneksi.php";
if(isset($_POST['submit'])){
    $nama = $_POST['nama'];
    $sql = "insert into grup values('',$nama)";
    mysqli_query($koneksi,$sql);
    if(true){
        header('location: member.php');
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

    <script>
        function lanjut(){

        }
    </script>
</body>
</html>
