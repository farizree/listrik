<?php
if(isset($_POST['tambah'])){
    include 'connection.php';

    $idPelanggan = $_POST['pelanggan'];
    $bulan = $_POST['bulan'];
    $tahun = $_POST['tahun'];
    $meterawal = $_POST['meterawal'];
    $meterakhir = $_POST['meterakhir'];

    // Creating new date format from that timestamp
    $new_date_awal = date("Y-m-d", strtotime($meterawal));
    $new_date_akhir = date("Y-m-d", strtotime($meterakhir));

    $query = "INSERT INTO penggunaan(id_pelanggan, bulan, tahun, meter_awal, meter_akhir) VALUES('$idPelanggan', '$bulan', '$tahun', '$new_date_awal', '$new_date_akhir')";
    $result = mysqli_query($con,$query); 

    //jika query input sukses
	if($result){
        $_SESSION['status'] = "Data Berhasil Disimpan";
		header("location: ../penggunaan.php");
	}else{
        $_SESSION['status'] = "Data Gagal Disimpan";
		header("location: ../penggunaan.php");
	}
} else {
    echo '<script>window.history.back()</script>';
}