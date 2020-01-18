<?php
require "koneksi.php";


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
    <p><?= $row['nama_grup'] ?></p>
    


    <div id="container">
    <?php
        if(isset($_POST['submit'])){
            $nama = $_POST['nama'];
            $id = $_GET['grup'];
            $sql = "INSERT INTO member values (NULL,$id,'$nama')";
            mysqli_query($koneksi,$sql);
            if(true){
                echo "bagus";
            }else{
                echo "ga";
            }
        }
    ?>
    <form action="" method="post">

        <label>Nama Member</label>
        <input type="text" name="nama" id="">
    
</div>
<br>
<input type="submit" name='submit' class="button" value="Tambah">
</form>
    <footer>
        Rafli Ramadhan - &copy; 2019
    </footer>
</body>

</html>