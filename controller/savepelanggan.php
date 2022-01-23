<?php
if(isset($_POST['tambah'])){
    include 'connection.php';

    $idtarif = $_POST['tarif'];
    $namapelanggan = $_POST['nama'];
    $nomorkwh = $_POST['nomorkwh'];
    $username = $_POST['username'];
    $password = $_POST['password'];
    $alamat = $_POST['alamat'];

    $query = "INSERT INTO pelanggan(username, password, nomor_kwh, nama_pelanggan, alamat, id_tarif) VALUES('$username', '$password', '$nomorkwh', '$namapelanggan', '$alamat', '$idtarif')";
    $result = mysqli_query($con,$query); 

    //jika query input sukses
	if($result){
        $_SESSION['status'] = "Data Berhasil Disimpan";
		header("location: ../pelanggan.php");
	}else{
        $_SESSION['status'] = "Data Gagal Disimpan";
		header("location: ../pelanggan.php");
	}
} else {
    echo '<script>window.history.back()</script>';
}