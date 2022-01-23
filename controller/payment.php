<?php
session_start();
include 'connection.php';
$biayaAdmin = 2500;
$id_tagihan = $_GET['id_tagihan'];	
$id_pelanggan = $_GET['id_pelanggan'];
$bulanBayar = $_GET['total_tagihan'];
$tanggal_pembayaran = date("Y-m-d");
$totalBayar = $bulanBayar + $biayaAdmin;
$iduser = $_SESSION['iduser'];
// echo '<pre>';
// echo $biayaAdmin;
// echo $id_tagihan;
// echo $id_pelanggan;
// echo $bulanBayar;
// echo $iduser;

// die;

$query = "INSERT INTO pembayaran(id_tagihan, id_pelanggan, tanggal_pembayaran, bulan_bayar, biaya_admin, total_bayar, id_user) 
VALUES('$id_tagihan', '$id_pelanggan', '$tanggal_pembayaran', '$bulanBayar', '$biayaAdmin', '$totalBayar', '$iduser')";

    $result = mysqli_query($con,$query); 
// echo $result; die;
    //jika query input sukses
	if($result){
        $_SESSION['status'] = "Pembayaran Berhasil";
		header("location: ../tagihan.php");
	}else{
        $_SESSION['status'] = "Pembayaran Gagal";
		header("location: ../tagihan.php");
    }
?>