<?php
include('konek.php');

//Data jam dan tgl
date_default_timezone_set('Asia/Jakarta');
$jam = date('H:i:s');
$tanggal = date('d-m-y');

//mengirim data sensor dg GET
$data_sensor = $_GET['data_sensor'];
$status = $_GET['status'];

$input = mysqli_query($konek, "INSERT INTO data_1 (tanggal, jam, data_sensor, status) VALUES('$tanggal','$jam','$data_sensor','$status')");
if ($input == TRUE){
    echo "\nberhasil input\nNilai = ";
    echo "$data_sensor";
    echo  "\nKelembapan =";
    echo "$status";
    echo "% \n\n";
}
else {
    echo "gagal input data";
}
?>