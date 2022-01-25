<?php
   include 'connection.php';
   session_start();
   
   $username = $_POST['username'];
   $password = $_POST['password'];

    if(empty($username)){
        die("'<script>alert('Masukkan Username'); window.location = '../index.php'</script>'");
    } else if(empty($password)){
        die("'<script>alert('Masukkan Password'); window.location = '../index.php'</script>'");
    } else {
            $sql = "select * from user where username = '".$username."'";
            $result = mysqli_query($con,$sql);
            $hasil = mysqli_num_rows($result);
            $row = mysqli_fetch_assoc($result);

            if ($row['username'] == "") {
                $sql = "select * from pelanggan where username = '".$username."'";
                $result = mysqli_query($con,$sql);
                $hasil = mysqli_num_rows($result);
                $row = mysqli_fetch_assoc($result);
               
                $idplg = $row['id_pelanggan'];
                $usrpg = $row['username'];
                $passpg = $row['password'];
                $namapg = $row['nama_pelanggan'];
                $nomorKwh = $row['nomor_kwh'];
                $alamat = $row['alamat'];
                $idTarif = $row['id_tarif'];

                $_SESSION['username'] = $usrpg;
                $_SESSION['nama'] = $namapg;
                $_SESSION['nomorkwh'] = $nomorKwh;
                $_SESSION['alamat'] = $alamat;
                $_SESSION['idtarif'] = $idTarif;
                $_SESSION['id_pelanggan'] = $idplg;

                if(($usrpg == $username) && ($passpg == $password))
                {
                    $_SESSION['logged'] = true;
                    $action = "Login ke Sistem Berhasil";  
                    die("'<script>alert('Anda Berhasil Login'); window.location = '../dashboard.php'</script>'");    
                }
                else{
                    $action = "Login ke Sistem Gagal";
                    die("'<script>alert('Username dan Password Salah'); window.location = '../login.php'</script>'");
                }
            } else {
                if ($hasil != 0) {
                
                $usr = $row['username'];
                $pass = $row['password'];
                $nama = $row['nama_admin'];
                $idlevel = $row['id_level'];
                $idUser = $row['id_user'];
                
                $_SESSION['nama'] = $nama;
                $_SESSION['idlevel'] = $idlevel;
                $_SESSION['username'] = $row['username'];
                $_SESSION['iduser'] = $idUser;
                
                if(($usr == $username) && ($pass == $password)){
                    $_SESSION['logged'] = true;
                    $action = "Login ke Sistem Berhasil";
                    if ($row['id_level']=="1"){
                        die("'<script>alert('Admin Berhasil Login'); window.location = '../dashboard.php'</script>'");
                    } if ($row['id_level']=="2") {
                        die("'<script>alert('Status Login Berhasil. selamat datang :3'); window.location = '../dashboard.php'</script>'");
                    }  
                } else {
                    $action = "Login ke Sistem Gagal";
                    die("'<script>alert('Username dan Password Salah'); window.location = '../login.php'</script>'");
                }
            } else {
                die("'<script>alert('Username dan Password Salah'); window.location = '../login.php'</script>'");
            }
        }
    }
?>