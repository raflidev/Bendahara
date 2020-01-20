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
                <?php
                $sql = "select * from member where id_grup=$_GET[grup]";
                $query = mysqli_query($koneksi,$sql);
                if(mysqli_num_rows($query) < 1){?>
                    <div class="boxes">
                        <p>Modul belum dibuat</p>
                    </div>
                    
                <?php }
                while($row = mysqli_fetch_array($query)) { ?>
                        <div class="boxes">
                            <p><?= $row['nama_member'] ?></p>                        
                        </div>
                </a>
                
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
                    echo "berhasil ditambahkan";
                }else{
                    echo "ga";
                }
            }
        ?>
        <form action="" method="post">

            <label>Nama Member</label>
            <input type="text" name="nama" id="">
        
    <br>
    <input type="submit" id="submit" name='submit' class="button" value="Tambah">
    <input type="submit" onclick="kembali()" class="button" value="Kembali">
            `;
        }

    </script>
</body>

</html>