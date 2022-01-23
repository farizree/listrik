<?php
include("connection.php");
$query = "delete from pelanggan where id_pelanggan = '$_GET[id_pelanggan]'";
$result = mysqli_query($con,$query);

if($result){
    $_SESSION['status'] = "Data Berhasil Dihapus";
    header("location: ../pelanggan.php");
}else{
    $_SESSION['status'] = "Data Gagal Dihapus";
    header("location: ../pelanggan.php");
}
?>