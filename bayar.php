<?php
require "koneksi.php";

if(!isset($_GET['grup'])){
    header("location:grup.php?modul=$_GET[modul]");
}

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

if(isset($_POST['hapus'])){
    $sql = "DELETE from transaksi WHERE id_modul=$_GET[modul]";
    mysqli_query($koneksi,$sql);
    if(true){
        $sql = "DELETE from modul WHERE id_modul=$_GET[modul]";
        mysqli_query($koneksi,$sql);
        if(true){
            header("location:index.php");
        }
    }  
}

if(isset($_POST['debit'])){
    $nom = -$_POST['nominal'];
    $sql = "INSERT into pengeluaran values (NULL,'$_POST[deskripsi]')";
    mysqli_query($koneksi,$sql);
    if(true){
        $sql = "SELECT id_pengeluaran from pengeluaran order by id_pengeluaran DESC";
        $query = mysqli_query($koneksi,$sql);       
        $row = mysqli_fetch_array($query); 

        $sqltrans = "INSERT into transaksi values (NULL,$_GET[modul],NULL,$nom,$row[id_pengeluaran])";
        mysqli_query($koneksi,$sqltrans);        
        if(true){
            header("location:index.php");
        }
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
    <u><a href="index.php">< Home</a></u>
    <p><?= $row['nama_modul']  ?> - <?= $row['nama_grup'] ?></p>
    


    <div id="container">
    
    <footer>
        Rafli Ramadhan - &copy; 2019
    </footer>
    <script>
    function contentIndex(){
        document.getElementById('container').innerHTML = `
        <form action="" method="post">

        <label>Nama Member</label>
        <select name="member" id="">
        <option>...</option>
            <?php
            $sql = "select * from member where id_grup=$id";
            $query = mysqli_query($koneksi,$sql);
            while($row = mysqli_fetch_array($query)){ ?>
                    <option value="<?= $row[0] ?>"><?= $row[2] ?></option>
                    <?php } ?>
            </select>
            <label>Bayar Berapa kali?</label>
            <input type="number" name="bayar">
            <br>
            <input type="submit" name='submit' class="button" value="Tambah">
            <a onclick="pengeluaran()" class="button">Pengeluaran</a>
            <a onclick="detail()" class="button">Detail Pengeluaran</a>
            <input type="submit" name='hapus' onclick="confirm('Hapus semua transaksi pada modul?')" class="button" value="Hapus Modul">
            </form>
        </div>
        `;
    }

    function pengeluaran(){
        document.getElementById('container').innerHTML = `
        <form action="" method="post">


            <label>Nominal</label>
            <input type="number" name="nominal">
            <label>Deskripsi</label>
            <input type="text" name="deskripsi">
            <br>

            <input type="submit" name='debit' class="button" value="Simpan Pengeluaran">
            <a onclick="contentIndex()" class="button">Kembali</a>            
            </form>
        </div>
        `;
    }

    function detail(){
        document.getElementById('container').innerHTML = `
            <?php
            $sql = "CALL laporan_pengeluaran($_GET[modul])";
            $query = mysqli_query($koneksi,$sql);
            if(mysqli_num_rows($query) < 1){?>
                <div class="boxes">
                    <p>Pengeluaran kosong</p>
                </div>
                
            <?php }
            while($row = mysqli_fetch_array($query)){?>
                 <div class="boxes">
                            <p>
                            <?= $row[1] ?>
                            </p>        
                            Rp. <?= $row[0] ?>                                                            
                        </div>
           <?php } ?>
            <a onclick="contentIndex()" class="button">Kembali</a>            
        </div>
        `;
    }
    contentIndex();
    </script>
</body>

</html>