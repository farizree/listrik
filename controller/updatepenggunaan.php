<?php
if(isset($_POST['update'])){
    include 'connection.php';

    $idPenggunaan = $_POST['idpenggunaan'];
    $idPelanggan = $_POST['pelanggan'];
    $bulan = $_POST['bulan'];
    $tahun = $_POST['tahun'];
    $meterawal = $_POST['meterawal'];
    $meterakhir = $_POST['meterakhir'];

    // Creating new date format from that timestamp
    $new_date_awal = date("Y-m-d", strtotime($meterawal));
    $new_date_akhir = date("Y-m-d", strtotime($meterakhir));

    $result = mysqli_query($con, "Update penggunaan set id_pelanggan='".$idPelanggan."', bulan='".$bulan."', tahun='".$tahun."', meter_awal='".$new_date_awal."', meter_akhir='".$new_date_akhir."' where id_penggunaan='".$idPenggunaan."'");

	if($result){
        $_SESSION['status'] = "Data Berhasil Diupdate";
		header("location: ../penggunaan.php");
	}else{
        $_SESSION['status'] = "Data Gagal Diupdate";
		header("location: ../penggunaan.php");
	}
} else {
    echo '<script>window.history.back()</script>';
}