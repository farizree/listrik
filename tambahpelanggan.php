<?php include ("controller/connection.php"); ?>
<!DOCTYPE html>
<html lang="en"> <?php include ("headfoot/header.php"); ?> <body>
    <div class="main-panel">
      <div class="content-wrapper">
        <div class="row">
          <div class="col-12 grid-margin">
            <div class="card">
              <div class="card-body">
                <h4 class="card-title">Tambah Data Pelanggan</h4>
                <form class="form-sample" method="POST" action="controller/savepelanggan.php">
                  <div class="row">
                    <div class="col-md-6">
                      <div class="form-group row">
                        <label class="col-sm-3 col-form-label">Nama Pelanggan</label>
                        <div class="col-sm-9">
                            <input type="text" name="nama" class="form-control" value="" />
                        </div>
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="form-group row">
                        <label class="col-sm-3 col-form-label">Alamat</label>
                        <div class="col-sm-9">
                          <input type="text" class="form-control" name="alamat" value="">
                      </div>
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-md-6">
                      <div class="form-group row">
                        <label class="col-sm-3 col-form-label">Username</label>
                        <div class="col-sm-9">
                            <input type="text" name="username" class="form-control" value="" />
                        </div>
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="form-group row">
                        <label class="col-sm-3 col-form-label">Password</label>
                        <div class="col-sm-9">
                          <input type="password" class="form-control" name="password" value="">
                      </div>
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-md-6">
                      <div class="form-group row">
                        <label class="col-sm-3 col-form-label">Nomor Kwh</label>
                        <div class="col-sm-9">
                            <input type="text" name="nomorkwh" class="form-control" value="" />
                        </div>
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="form-group row">
                        <label class="col-sm-3 col-form-label">Tarif</label>
                        <div class="col-sm-9">
                        <select class="form-control" name="tarif">
                        <option class="dropdown-item" value="">Select Tarif & Daya</option>
                          <?php
                                $query = mysqli_query($con, "SELECT id_tarif, tarifperkwh, daya FROM tarif");
                                    while($data = mysqli_fetch_array($query)){ ?>
                                <option class="dropdown-item" value="<?php echo $data['id_tarif']?>"><?php echo $data['tarifperkwh']?> - <?php echo $data['daya']?></option>
                            <?php } ?>
                          </select>
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