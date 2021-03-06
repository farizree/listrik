<?php include ("controller/connection.php"); 
session_start();
error_reporting (E_ALL ^ E_NOTICE);
?>
<!DOCTYPE html>
<html lang="en"> <?php include ("headfoot/header.php"); ?> <body>
    <div class="main-panel">
      <div class="content-wrapper">
        <div class="row">
          <div class="col-lg-12 stretch-card">
            <div class="card">
              <div class="card-body">
              <?php 
                if(isset($_SESSION['status'])) { ?>
                    <div class="alert alert-warning alert-dismissible fade show" role="alert">
                    <strong>Hey!</strong> <?php echo $_SESSION['status']; ?>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                    <?php
                unset($_SESSION['status']);
                }?>
                <h4 class="card-title">Table Tagihan Listrik</h4>
                <div class="table-responsive pt-3">
                  <table class="table table-bordered">
                    <thead>
                      <tr>
                        <th> No</th>
                        <th> ID Tagihan</th>
                        <th> Nama Pelanggan </th>
                        <th> Nomer Kwh </th>
                        <th> Bulan</th>
                        <th> Tahun </th>
                        <th> Jumlah Meter </th>
                        <th> Status </th>
                        <th> Total Tagihan </th>
                        <th> Action </th>
                      </tr>
                    </thead>
                    <tbody>
                    <?php
                    $id_pelanggan = $_SESSION['id_pelanggan'];
                    if($_SESSION['id_pelanggan'] == "") {
                        $daya = isset($_POST['daya']) ? $_POST['daya'] : '';
                        $no = 1;
                        $sql = mysqli_query($con, "SELECT * from view_tagihan_pelanggan");
                        while ($row = mysqli_fetch_array($sql)){?>    
                      <tr class="table-info"> 
                        <td><?=$no++;?></td>
                        <td><?php echo $row['id_tagihan'];?></td>
                        <td><?php echo $row['nama_pelanggan'];?></td>
                        <td> <?php echo $row['nomor_kwh'];?> </td>
                        <td><?php echo $row['bulan'];?> </td>
                        <td><?php echo $row['tahun'];?></td>
                        <td><?php echo $row['jumlah_meter'];?> </td>
                        <td><?php echo $row['status'];?> </td>
                        <td><?php echo $row['total_tagihan'];?> </td>
                        <?php if($row['status'] == "Pembayaran Berhasil") {?>
                            <td>Payment Completed</td>
                        <?php } else {?>
                        <td>
                            <a class="btn btn-warning" href='controller/payment.php?id_tagihan=<?=$row['id_tagihan']?>&amp;id_pelanggan=<?=$row['id_pelanggan']?>&amp;total_tagihan=<?=$row['total_tagihan']?>'>Bayar</a>
                        </td>
                        <?php } ?>
                    </tr>
                      <?php }} else { 
                          $daya = isset($_POST['daya']) ? $_POST['daya'] : '';
                          $no = 1;
                          $sql = mysqli_query($con, "SELECT * from view_tagihan_pelanggan where id_pelanggan = '$id_pelanggan'");
                          while ($row = mysqli_fetch_array($sql)){?>    
                        <tr class="table-info"> 
                          <td><?=$no++;?></td>
                          <td><?php echo $row['id_tagihan'];?></td>
                          <td><?php echo $row['nama_pelanggan'];?></td>
                          <td> <?php echo $row['nomor_kwh'];?> </td>
                          <td><?php echo $row['bulan'];?> </td>
                          <td><?php echo $row['tahun'];?></td>
                          <td><?php echo $row['jumlah_meter'];?> </td>
                          <td><?php echo $row['status'];?> </td>
                          <td><?php echo $row['total_tagihan'];?> </td>
                          <?php if($row['status'] == "Pembayaran Berhasil") {?>
                              <td>Payment Completed</td>
                          <?php } else {?>
                          <td>
                              <a class="btn btn-warning" href='controller/payment.php?id_tagihan=<?=$row['id_tagihan']?>&amp;id_pelanggan=<?=$row['id_pelanggan']?>&amp;total_tagihan=<?=$row['total_tagihan']?>'>Bayar</a>
                          </td>
                          <?php } ?>
                      </tr>
                        <?php }} ?>
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <!-- plugins:js -->
    <script src="vendors/js/vendor.bundle.base.js"></script>
    <!-- endinject -->
    <!-- Plugin js for this page -->
    <script src="vendors/chart.js/Chart.min.js"></script>
    <script src="vendors/bootstrap-datepicker/bootstrap-datepicker.min.js"></script>
    <script src="vendors/progressbar.js/progressbar.min.js"></script>
    <!-- End plugin js for this page -->
    <!-- inject:js -->
    <script src="js/off-canvas.js"></script>
    <script src="js/hoverable-collapse.js"></script>
    <script src="js/template.js"></script>
    <script src="js/settings.js"></script>
    <script src="js/todolist.js"></script>
    <!-- endinject -->
    <!-- Custom js for this page-->
    <script src="js/jquery.cookie.js" type="text/javascript"></script>
    <script src="js/dashboard.js"></script>
    <script src="js/Chart.roundedBarCharts.js"></script>
    <!-- End custom js for this page-->
  </body>
</html>