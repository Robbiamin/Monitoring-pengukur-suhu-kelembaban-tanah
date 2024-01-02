<?php
include "konek.php";

            // plaginat
            $jmlhperhalaman = 20;
            $jmlhseluruhdata = count(tampil("SELECT * FROM data_1"));
            // raund()=membulatkan desimal ke bilangan terdekat,floor()=membulatkan desimal kebawah,ceil()=membulatkan desimal keatas
            $jmlhhalaman = ceil($jmlhseluruhdata / $jmlhperhalaman);
            $hlmnaktif = (isset($_GET['halaman'])?$_GET['halaman']:1);
            $awaldata = ($jmlhperhalaman * $hlmnaktif)-$jmlhperhalaman;
            $perintah="SELECT * FROM data_1 LIMIT $awaldata,$jmlhperhalaman";
            if($hlmnaktif==0){
                $perintah="SELECT * FROM data_1";
            }


            if( isset($_POST['cari']) ){
                $perintah= cari($_POST["keyword"]);
            }
?>
<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    </head>
<center><font color="#00FFFF">
<h1><marquee width="100%" direction="left" scrollamount="10" bgcolor="#000099"> BY => MUROBBI</marquee></h1></font></div>
<h2 class="w-51 p-3 bg-secondary text-light">- DATA SUHU KELEMBAPAN TANAH -</h1></center>

<form action="" method="post">
<input class="mt-2 ms-2" type="text" name="keyword" autofocus placeholder="masukkan keyword pencarian........" autocomplete="off" size="40" id="keyword">
<button type="submit" name="cari" class="btn btn-sm btn-primary" id="tombolcari">CARI</button>
</form>

<!-- navigasi plaginat-->
<a class="text-dark ms-4" href="?halaman=0">seluruh</a>
<?php if($hlmnaktif > 1):?>
<a class="ms-4" href="?halaman=<?= $hlmnaktif - 1; ?>">&laquo-</a>
<?php endif; ?>
<?php for($i=1;$i<=$jmlhhalaman;$i++) : ?>
    <?php if($i==$hlmnaktif): ?>
    <a class="ms-4" href="?halaman=<?= $i; ?>"><div class="btn btn-primary btn-md"><?= $i; ?></div></a>
    <?php else: ?>
    <a class="ms-4" href="?halaman=<?= $i; ?>"><?= $i; ?></a>
    <?php endif; ?>
<?php endfor; ?>
<?php if($hlmnaktif < $jmlhhalaman):?>
<a class="ms-4" href="?halaman=<?= $hlmnaktif + 1; ?>">-&raquo;</a>
<?php endif; ?>


<div id="container">
    <table class="table table-striped table-hover table-bordered table-dark mt-3" border="10" align="center" cellspacing="0" cellpadding="5" width="100%">
    <thead>
        <tr align="center">
            <th>ID</th>
            <th>TANGGAL</th>
            <th>JAM</th>
            <th>NILAI SENSOR</th>
            <th>PRESENTASE KELEMBAPAN</th>
        </tr>
    </thead>
    <tbody>
            <?php
                $databesar = tampil($perintah);
                $no=1;
                foreach($databesar as $data):
            ?>
            <tr align="center">
            <td><?php echo $data['id']; ?></td>
            <td><?php echo $data['tanggal']; ?></td>
            <td><?php echo $data['jam']; ?></td>
            <td><?php echo $data['data_sensor']; ?></td>            
            <td><?php echo $data['status']; ?></td>
            </tr>
            <?php
            $no++;
        endforeach; 
            ?>
    </tbody>    
    </table>
</div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <script src="../assets/dist/js/bootstrap.bundle.min.js"></script>
  </body>
</html>