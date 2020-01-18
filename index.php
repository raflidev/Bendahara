<?php
require "koneksi.php";



// menampilkan semua modul
$sql = "select * from modul";
$query = mysqli_query($koneksi, $sql);
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
    <p>Uang Bendahara!</p>
    <?php
    // menampilkan semua total bendahara
    $sql = "select SUM(total_tagihan) from transaksi";
    $query = mysqli_query($koneksi,$sql);
    $row = mysqli_fetch_array($query);    
    ?>
    <h1>
        <span>Rp.</span>
        <?php
        if($row[0] == null){
            echo 0;
        }else{
            echo $row[0];
        }
        ?>
    </h1>
    <div id="content">

        
        <p>Modulmu <a id="all" class="line" onclick="allmodul()">All</a><a id='riwayat' onclick="riwayat()">History</a></p>
        <!-- mendapatkan id grup & innerjoin table transaksi ke table modul ke table grup-->
        <?php
        
        ?>
        <div id="container">
            <?php
            $sql = "SELECT modul.id_grup,modul.nama_modul,SUM(transaksi.total_tagihan),modul.id_modul FROM modul left join transaksi on modul.id_modul = transaksi.id_modul GROUP by modul.id_modul";
            $query = mysqli_query($koneksi,$sql);
            if(mysqli_num_rows($query) < 1){?>
                <div class="boxes">
                    <p>Modul belum dibuat</p>
                </div>
                
            <?php }
            while($row = mysqli_fetch_array($query)) { ?>
            <a href="bayar.php?grup=<?=$row[0]?>&modul=<?= $row[3] ?>">
                    <div class="boxes">
                        <p><?= $row[1] ?></p>        
                        Rp. <?php
                        if($row[2] == NULL){
                        echo 0;
                        }else{
                            echo $row[2];
                        }
                            ?>
                        
                    </div>
            </a>
            
            <?php
            }
            ?>
            <br>
            <a href="modul.php" class="button">Tambah</a>
        </div>
    </div>
    <div class="box-footer">
        <div id="list">
            <span id="moduling"><i onclick="modulling()" class="icon" data-feather="dollar-sign"></i></span>    
            <span id="adding"><i onclick="adding()" class="icon" data-feather="plus-circle"></i></span>    
            <span id="member"><i onclick="member()" class="icon" data-feather="user"></i></span>    
        </div>
    </div> 
        <footer>
        Rafli Ramadhan - &copy; 2019
    </footer>
    <script src="js/feather.min.js"></script>
    <script>
        feather.replace();

        function member(){
            document.getElementById('content').innerHTML = 
            `
            <p>Grup</p>
        <!-- mendapatkan id grup & innerjoin table transaksi ke table modul ke table grup-->
        <?php
        
        ?>
        <div id="container">
            <?php
            $sql = "SELECT grup.nama_grup,count(member.nama_member),grup.id_grup FROM grup inner join member on grup.id_grup = member.id_grup GROUP BY grup.id_grup";
            $query = mysqli_query($koneksi,$sql);
            if(mysqli_num_rows($query) < 1){?>
                <div class="boxes">
                    <p>Modul belum dibuat</p>
                </div>
                
            <?php }
            while($row = mysqli_fetch_array($query)) { ?>
            <a href="member.php?grup=<?=$row[2]?>">
                    <div class="boxes">
                        <p><?= $row[0] ?></p>        
                        <?php
                        if($row[1] == NULL){
                        echo 0;
                        }else{
                            echo "$row[1] Member";
                        }
                            ?>
                        
                    </div>
            </a>
            
            <?php
            }
            ?>
            <br>
            <a href="modul.php" class="button">Tambah</a>
        </div>
            `;
        }

        function riwayat(){
            document.getElementById('all').classList.remove('line');
            document.getElementById('riwayat').classList.add('line');
            document.getElementById('container').innerHTML = `
                <?php
                $sql = "select * from tampil_transaksi order by id_transaksi DESC";
                $query = mysqli_query($koneksi,$sql);
                if(mysqli_num_rows($query) < 1){?>
                    <div class="boxes">
                        <p>tidak ada transaksi</p>
                    </div>
                <?php }
                while($row = mysqli_fetch_array($query)) { ?>
                        <div class="boxes">
                            <p><?= $row[1]?> - <?= $row[2] ?></p>        
                            Rp. <?= $row[3] ?>  
                        </div>
                <?php } ?>
            `;
        }

        function allmodul(){
            document.getElementById('riwayat').classList.remove('line');
            document.getElementById('all').classList.add('line');

            document.getElementById('container').innerHTML = `
            <?php
               $sql = "SELECT modul.id_grup,modul.nama_modul,SUM(transaksi.total_tagihan),modul.id_modul FROM modul left join transaksi on modul.id_modul = transaksi.id_modul GROUP by modul.id_modul";
                $query = mysqli_query($koneksi,$sql);
                if(mysqli_num_rows($query) < 1){?>
                    <div class="boxes">
                        <p>Modul belum dibuat</p>
                    </div>
                    
                <?php }
                while($row = mysqli_fetch_array($query)) { ?>
                <a href="bayar.php?grup=<?=$row[0]?>&modul=<?= $row[3] ?>">
                        <div class="boxes">
                            <p><?= $row[1] ?></p>        
                            Rp. <?php
                            if($row[2] == NULL){
                            echo 0;
                            }else{
                                echo $row[2];
                            }
                    ?>
                
            </div>
    </a>
    
    <?php
    }
    ?>
            `;
        }
    </script>
</body>

</html>