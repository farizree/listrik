<?php include ("controller/connection.php"); ?>
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
                <h4 class="card-title">Table Penggunaan Listrik</h4>
                <a href="tambahpenggunaan.php" class="btn btn-outline-secondary">Tambah Data</a>
                <div class="table-responsive pt-3">
                  <table class="table table-bordered">
                    <thead>
                      <tr>
                        <th> No</th>
                        <th> Nama Pelanggan </th>
                        <th> Nomer Kwh </th>
                        <th> Meter Awal </th>
                        <th> Meter Akhir </th>
                        <th> Bulan</th>
                        <th> Tahun </th>
                        <th> Action </th>
                      </tr>
                    </thead>
                    <tbody>
                    <?php
                        $daya = isset($_POST['daya']) ? $_POST['daya'] : '';
                        $no = 1;
                        $sql = mysqli_query($con, "select * from view_penggunaan");
                        while ($row = mysqli_fetch_array($sql)){?>    
                      <tr class="table-info"> 
                        <td><?=$no++;?></td>
                        <td><?php echo $row['nama_pelanggan'];?></td>
                        <td> <?php echo $row['nomor_kwh'];?> </td>
                        <td><?php echo $row['meter_awal'];?> </td>
                        <td><?php echo $row['meter_akhir'];?></td>
                        <td><?php echo $row['bulan'];?> </td>
                        <td><?php echo $row['tahun'];?> </td>
                        <td>
                            <a class="btn btn-warning" href='updatepenggunaan.php?id_penggunaan=<?=$row['id_penggunaan']?>'>Edit</a>
                            <a class="btn btn-danger" href="controller/deletepenggunaan.php?id_penggunaan=<?=$row['id_penggunaan'] ?>">Hapus</a>
                        </td>

                      </tr>
                      <?php } ?>
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