<?php
require "koneksi.php";

if(isset($_POST['submit']) && isset($_POST['grup'])){
    $nama = $_POST['nama'];
    $waktu = $_POST['waktu'];
    $grup = $_POST['grup'];
    $tagihan = $_POST['tagihan'];

    $sql = "INSERT INTO modul VALUES (NULL, '$nama', $grup, '$waktu', $tagihan)";
    mysqli_query($koneksi, $sql);
}

if(isset($_POST['submit']) && !isset($_POST['grup'])){
    $nama = $_POST['nama'];
    $waktu = $_POST['waktu'];
    $tagihan = $_POST['tagihan'];

    $sql = "INSERT into modul (id_modul,nama_modul,waktu,tagihan) values(NULL,'$nama','$waktu',$tagihan)";
    mysqli_query($koneksi, $sql);
    if(true){
        $sql = "select id_modul from modul order by id_modul  DESC";
        $query = mysqli_query($koneksi,$sql);
        $row = mysqli_fetch_array($query);

        header("location:grup.php?modul=$row[0]");
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
<p>Tambah Modul</p>
<div id="content">
    <form action="" method="post">
        <label>Nama Modul</label>
        <input type="text" name="nama" id="">       
        <label>Waktu Tagihan</label>
        <select name="waktu">
            <option value="Harian">Harian</option>
            <option value="Mingguan">Mingguan</option>
            <option value="Bulanan">Bulanan</option>
            <select>
                <label>Tagihan setiap member</label>
                <input type="number" name="tagihan">
                <div id="addgrup"></div>
        <input class="button" type='submit' name="submit" value='Tambah' id='submit'>
    </form>
    <u id="add"><a onclick="grup()">tambah dengan grup yang sudah ada</a></u>
</div>
    <footer>
        Rafli Ramadhan - &copy; 2019
    </footer>
    <script>
    function grup(){
        document.getElementById('addgrup').innerHTML = 
        `
        <label>Nama Grup</label>
        <select name="grup">
        <?php
        $sql = "select * from grup";
        $query= mysqli_query($koneksi,$sql);
        while($row = mysqli_fetch_array($query)){
        ?>
            <option value="<?= $row['id_grup'] ?>"><?= $row['nama_grup'] ?></option>            
        <?php } ?>
        <select>

        `;
        document.getElementById('add').innerHTML = 
        `
        <a onclick="cancel()">tidak jadi...</a>
        `;
    }
    function cancel(){
        document.getElementById('addgrup').innerHTML = 
        ``;
        document.getElementById('add').innerHTML = 
        `
        <a onclick="grup()">tambah dengan grup yang sudah ada</a>
        `;
    }
    </script>
</body>
</html>