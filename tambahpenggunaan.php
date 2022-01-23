<?php include ("controller/connection.php"); ?>
<!DOCTYPE html>
<html lang="en"> <?php include ("headfoot/header.php"); ?> <body>
    <div class="main-panel">
      <div class="content-wrapper">
        <div class="row">
          <div class="col-12 grid-margin">
            <div class="card">
              <div class="card-body">
                <h4 class="card-title">Tambah Data Penggunaan Listrik</h4>
                <form class="form-sample" method="POST" action="controller/savepenggunaan.php">
                  <div class="row">
                    <div class="col-md-6">
                      <div class="form-group row">
                        <label class="col-sm-3 col-form-label">Nama Pelanggan</label>
                        <div class="col-sm-9">
                          <select class="form-control" name="pelanggan">
                          <option class="dropdown-item" value="">Select Nama Pelanggan</option>
                          <?php
                                $query = mysqli_query($con, "SELECT nama_pelanggan, id_pelanggan FROM pelanggan");
                                    while($data = mysqli_fetch_array($query)){ ?>
                                <option class="dropdown-item" value="<?php echo $data['id_pelanggan']?>"><?php echo $data['nama_pelanggan']?></option>
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
                            <input type="text" class="form-control" value="<?php echo date('F');?>" readonly />
                          <input type="hidden" name="bulan" class="form-control" value="<?php echo date('m', strtotime('month'));?>" />
                        </div>
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="form-group row">
                        <label class="col-sm-3 col-form-label">Tahun</label>
                        <div class="col-sm-9">
                          <input class="form-control" name="tahun" value="<?php echo date("Y");?>" readonly>
                      </div>
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-md-6">
                      <div class="form-group row">
                        <label class="col-sm-3 col-form-label">Meter Awal</label>
                        <div class="col-sm-9">
                          <input type="date" name="meterawal" class="form-control"/>
                        </div>
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="form-group row">
                        <label class="col-sm-3 col-form-label">Meter Akhir</label>
                        <div class="col-sm-9">
                          <input type="date" name="meterakhir" class="form-control"/>
                        </div>
                      </div>
                    </div>
                  </div>
                  </div>
                  <input type="submit" name="tambah" value="Tambah Data" class="btn btn-success">
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