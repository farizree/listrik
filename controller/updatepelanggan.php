<?php
if(isset($_POST['update'])){
    include 'connection.php';

    $idpelanggan = $_POST['idpelanggan'];
    $idtarif = $_POST['tarif'];
    $namapelanggan = $_POST['nama'];
    $nomorkwh = $_POST['nomorkwh'];
    $username = $_POST['username'];
    $password = $_POST['password'];
    $alamat = $_POST['alamat'];

    $result = mysqli_query($con, "Update pelanggan set username='".$username."', password='".$password."', nomor_kwh='".$nomorkwh."', nama_pelanggan='".$namapelanggan."', alamat='".$alamat."', id_tarif='".$idtarif."' where id_pelanggan='".$idpelanggan."'");

	if($result){
        $_SESSION['status'] = "Data Berhasil Diupdate";
		header("location: ../pelanggan.php");
	}else{
        $_SESSION['status'] = "Data Gagal Diupdate";
		header("location: ../pelanggan.php");
	}
} else {
    echo '<script>window.history.back()</script>';
}