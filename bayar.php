<?php
require "koneksi.php";

if(isset($_POST['submit'])){
    $modul = $_GET['modul'];
    $member = $_POST['member'];
    // mencari uang tagihan
    $sql = "select tagihan from modul where id_modul = $modul";
    $query = mysqli_query($koneksi,$sql);
    $row = mysqli_fetch_array($query);
    
    $tagihan = $_POST['bayar']*$row[0];
    
    $sql = "insert into transaksi (id_modul,id_member,total_tagihan) values($modul,$member,$tagihan)";
    mysqli_query($koneksi,$sql);
    if(true){
        header('location:index.php');
    }else{
        alert('pembayaran gagal');
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
    <?php
        // menampilkan nama grup
        $id = $_GET['grup'];
        $modul = $_GET['modul'];
        $sql = "select * from grup inner join modul on modul.id_grup = grup.id_grup where grup.id_grup=$id and modul.id_modul=$modul";
        $query = mysqli_query($koneksi,$sql);
        $row = mysqli_fetch_array($query);    
    ?>
    <p>Pembayaran <?= $row['nama_modul']  ?> - <?= $row['nama_grup'] ?></p>
    


    <div id="container">
    <form action="" method="post">

        <label>Nama Member</label>
        <select name="member" id="">
            <?php
    $sql = "select * from member where id_grup=$id";
    $query = mysqli_query($koneksi,$sql);
    while($row = mysqli_fetch_array($query)){ ?>
            <option value="<?= $row[0] ?>"><?= $row[2] ?></option>
            <?php } ?>
    </select>
    <label>Bayar Berapa kali?</label>
    <input type="number" name="bayar">
</div>
<br>
<input type="submit" name='submit' class="button" value="Tambah">
</form>
    <footer>
        Rafli Ramadhan - &copy; 2019
    </footer>
</body>

</html>