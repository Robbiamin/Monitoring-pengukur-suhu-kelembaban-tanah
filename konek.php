<?php
$server = "localhost";
$username = "root";
$pass = "";
$database = "nodemcu_1";

$konek = mysqli_connect($server, $username, $pass, $database);
if($konek == TRUE){
    echo "Terhubung ke database";
}
else{
    echo "Tidak terhubung ke database";
}

function tampil($query){
    global $konek;
$result = mysqli_query($konek, $query);
$rows=[];
while($row = mysqli_fetch_assoc($result)):
    $rows[]= $row;
endwhile;
    return $rows;
}

function cari($keyword){
    return "SELECT * FROM data_1 WHERE id LIKE '%$keyword%' OR 
                                          tanggal LIKE '%$keyword%' OR 
                                          jam LIKE '%$keyword%' OR 
                                          data_sensor LIKE '%$keyword%' OR  
                                          status LIKE '%$keyword%'";
     
}

function cariparkir($keyword){
    return "SELECT * FROM parkir WHERE id LIKE '%$keyword%' OR
                                          nomor_parkir LIKE '%$keyword%' OR  
                                          tanggal LIKE '%$keyword%' OR 
                                          jam LIKE '%$keyword%' OR 
                                          status LIKE '%$keyword%'";
     
}
?>