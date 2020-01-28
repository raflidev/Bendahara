<?php
require "koneksi.php";

if(isset($_GET['grup'])&&isset($_GET['hapus'])){
    $sql = "delete from member where id_member=$_GET[hapus] and id_grup=$_GET[grup]";
    mysqli_query($koneksi,$sql);
    if(true){
        header("location:member.php?grup=$_GET[grup]");
    }
}

if(isset($_GET['id'])){
    $sql = "delete from member where id_grup = $_GET[id]";
    mysqli_query($koneksi,$sql);
    if(true){
        $sql = "delete from grup where id_grup = $_GET[id]";
        mysqli_query($koneksi,$sql);
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
        $sql = "select * from grup where id_grup=$id";
        $query = mysqli_query($koneksi,$sql);
        $row = mysqli_fetch_array($query);    
    ?>
    <u><a href="index.php">< Home</a></u>
    <p>Tambah Member - <?= $row['nama_grup'] ?></p>
    


    <div id="container">
    </div>
</form>
    <footer>
        Rafli Ramadhan - &copy; 2019
    </footer>
    <script>
        function kembali(){
            document.getElementById('container').innerHTML=`
                <input onclick="contentindex()" type="submit" value="Tambah Member" class='button'>
                <a onclick="confirm('Jika grup dihapus, semua member akan hilang? yakin?')" href="member.php?grup=<?=$_GET['grup']?>&id=<?=$_GET['grup']?>"  type="submit" class='button'>Hapus Grup</a>
                <?php
                $sql = "select * from member where id_grup=$_GET[grup]";
                $query = mysqli_query($koneksi,$sql);
                if(mysqli_num_rows($query) < 1){?>
                    <div class="boxes">
                        <p>Member kosong</p>
                    </div>
                    
                <?php }
                while($row = mysqli_fetch_array($query)) { ?>
                        <div class="boxes">
                            <p><?= $row['nama_member'] ?></p><a href="member.php?grup=<?=$_GET['grup']?>&hapus=<?= $row['id_member'] ?>">Hapus</a>
                        </div>
                
                <?php
                }
                ?>
            `;
        }
        kembali();
        function contentindex(){
            document.getElementById('container').innerHTML=`
            <?php
        if(isset($_POST['submit'])){
                $nama = $_POST['nama'];
                $id = $_GET['grup'];
                $sql = "INSERT INTO member values (NULL,$id,'$nama')";
                mysqli_query($koneksi,$sql);
                if(true){
                    header("location:member.php?grup=$_GET[grup]");
                }
            }
        ?>
        <form action="" method="post">

            <label>Nama Member</label>
            <input type="text" name="nama" id="">
        
    <br>
    <input type="submit" id="submit" name='submit' class="button" value="Tambah">
    <input type="submit" class="button" value="Kembali">
            `;
        }

    </script>
</body>

</html>