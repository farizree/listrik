<?php include ("controller/connection.php");
$id = $_GET['id_penggunaan'];
$query = mysqli_query($con, "select * from view_penggunaan where id_penggunaan = '".$id."'");
$result = mysqli_fetch_assoc($query);
?>
<!DOCTYPE html>
<html lang="en"> <?php include ("headfoot/header.php"); ?> <body>
    <div class="main-panel">
      <div class="content-wrapper">
        <div class="row">
          <div class="col-12 grid-margin">
            <div class="card">
              <div class="card-body">
                <h4 class="card-title">Update Data Penggunaan Listrik</h4>
                <form class="form-sample" method="POST" action="controller/updatepenggunaan.php">
                <input type="hidden" name="idpenggunaan" class="form-control" value="<?php echo $result['id_penggunaan'];?>" readonly/>
                  <div class="row">
                    <div class="col-md-6">
                      <div class="form-group row">
                        <label class="col-sm-3 col-form-label">Nama Pelanggan</label>
                        <div class="col-sm-9">
                          <select class="form-control" name="pelanggan">
                          <?php
                                $query = mysqli_query($con, "SELECT id_pelanggan, nama_pelanggan FROM pelanggan");
                                    while($data = mysqli_fetch_array($query)){ ?>
                                <option class="dropdown-item" value="">Select Nama Pelanggan</option>
                                <option class="dropdown-item" value="<?php echo $data['id_pelanggan']?>"  <?php echo ($data['id_pelanggan'] ==  $result['id_pelanggan']) ? ' selected="selected"' : '';?>><?php echo $data['nama_pelanggan']?></option>
                            <?php } ?>
                          </select>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-md-6">
                      <div class="form-group row">
                        <label class="col-sm-3 col-form-label">Bulan</label>
                        <div class="col-sm-9">
                          <input type="text" name="bulan" class="form-control" value="<?php echo $result['bulan'];?>" readonly/>
                        </div>
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="form-group row">
                        <label class="col-sm-3 col-form-label">Tahun</label>
                        <div class="col-sm-9">
                          <input class="form-control" name="tahun" value="<?php echo $result['tahun'];?>" readonly>
                      </div>
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-md-6">
                      <div class="form-group row">
                        <label class="col-sm-3 col-form-label">Meter Awal</label>
                        <div class="col-sm-9">
                          <input type="date" class="form-control" name="meterawal" value="<?php echo $result['meter_awal'];?>" >
                        </div>
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="form-group row">
                        <label class="col-sm-3 col-form-label">Meter Akhir</label>
                        <div class="col-sm-9">
                          <input type="date" class="form-control" name="meterakhir" value="<?php echo $result['meter_akhir'];?>">
                        </div>
                      </div>
                    </div>
                  </div>
                  </div>
                  <input type="submit" name="update" value="Update Data" class="btn btn-warning">
                </form>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <?php include ("headfoot/footer.php"); ?> 
  </body>
</html>