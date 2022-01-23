<?php
include("connection.php");
$query = "delete from penggunaan where id_penggunaan = '$_GET[id_penggunaan]'";
$result = mysqli_query($con,$query);

if($result){
    $_SESSION['status'] = "Data Berhasil Dihapus";
    header("location: ../penggunaan.php");
}else{
    $_SESSION['status'] = "Data Gagal Dihapus";
    header("location: ../penggunaan.php");
}
?>