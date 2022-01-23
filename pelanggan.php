<?php include ("controller/connection.php"); ?>
<!DOCTYPE html>
<html lang="en"> <?php include ("headfoot/header.php"); ?> <body>
    <div class="main-panel">
      <div class="content-wrapper">
        <div class="row">
          <div class="col-lg-12 stretch-card">
            <div class="card">
              <div class="card-body">
                <h4 class="card-title">Table Pelanggan</h4>
                <a href="tambahpelanggan.php" class="btn btn-outline-secondary">Tambah Data</a>
                <form method="post" action="pelanggan.php" enctype="multipart/form-data">
                    <div class="dropdown">
                        <select class="btn btn-info btn-sm dropdown-toggle" type="button" id="dropdownMenuSizeButton3" data-bs-toggle="dropdown" name="daya" id="daya">
                        <option class="dropdown-item" value="0">Select Tarif</option>
                        <?php
                                $query = mysqli_query($con, "SELECT daya FROM tarif ORDER BY id_tarif ASC");
                                    while($data = mysqli_fetch_array($query)){ ?>
                            <div class="dropdown-menu" aria-labelledby="dropdownMenuSizeButton3">
                                <option class="dropdown-item" value="<?php echo $data['daya']?>"><?php echo $data['daya']?></option>
                            </div>
                        <?php } ?>
                        </select>
                    <input type = "submit" name="search" value="search" class="btn btn-default">
                    </div>
                </form>
                <div class="table-responsive pt-3">
                  <table class="table table-bordered">
                    <thead>
                      <tr>
                        <th> No</th>
                        <th> Nama Pelanggan </th>
                        <th> Nomor KWH </th>
                        <th> Alamat </th>
                        <th> Daya </th>
                        <th> Tarif PerKwh </th>
                        <th> Action </th>
                      </tr>
                    </thead>
                    <tbody>
                    <?php
                        $daya = isset($_POST['daya']) ? $_POST['daya'] : '';
                        $no = 1;
                        $sql = mysqli_query($con, "CALL spDayaPelanggan('$daya')");
                        while ($row = mysqli_fetch_array($sql)){?>    
                      <tr class="table-info"> 
                        <td><?=$no++;?></td>
                        <td><?php echo $row['nama_pelanggan'];?></td>
                        <td> <?php echo $row['nomor_kwh'];?> </td>
                        <td><?php echo $row['alamat'];?> </td>
                        <td><?php echo $row['daya'];?> Watt</td>
                        <td><?php echo $row['tarifperkwh'];?> </td>
                        <td>
                            <a class="btn btn-warning" href='updatepelanggan.php?id_pelanggan=<?=$row['id_pelanggan']?>'>Edit</a>
                            <a class="btn btn-danger" href="controller/deletepelanggan.php?id_pelanggan=<?=$row['id_pelanggan'] ?>">Hapus</a>
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