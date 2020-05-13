<?php

SESSION_START();

include("../database.php"); // sertakan database.php untuk dapat menggunakan class database

$db = new Database(); // membuat objek baru dari class database agar dapat menggunakan fungsi didalamnya

$nik = (isset($_SESSION['nik'])) ? $_SESSION['nik'] : "";

$token = (isset($_SESSION['token'])) ? $_SESSION['token'] : "";

if($token && $nik)

{

   $result = $db->execute("SELECT * FROM tabel_user WHERE nik = '".$nik."' AND token = '".$token."' AND status = 1 ");

   if(!$result)

   {

       // redirect ke halaman login, data tidak valid

       header("Location: http://localhost/game_database/");

   }

   // abaikan jika token valid

   $userdata = $db->get("SELECT tabel_user.nik as nik, tabel_user.nama_depan as nama_depan, tabel_user.nama_belakang as nama_belakang,

                       tabel_user.alamat as alamat, tabel_user.kode_pos as kode_pos, tabel_kota.nama_kota as nama_kota,

                       tabel_provinsi.nama_provinsi as nama_provinsi

                       from tabel_user,tabel_kota, tabel_provinsi WHERE tabel_user.nik = '".$nik."' AND

                       tabel_user.kota_id = tabel_kota.kota_id AND tabel_kota.provinsi_id = tabel_provinsi.provinsi_id");               

   $userdata = mysqli_fetch_assoc($userdata);                       

}

else

{

   header("Location: http://localhost/game_database/");

}

$notification = (isset($_SESSION['notification'])) ? $_SESSION['notification'] : "";

if($notification)

{

   echo $notification;

   unset($_SESSION['notification']);   

}

?>

PAGE : HOME

<table border=1>

   <tr>

       <td>MENU</td>

       <td><a href="http://localhost/game_database/user/">HOME</a></td>

       <td><a href="http://localhost/game_database/user/statistik.php">STATISTIK</a></td>       

       <td><a href="http://localhost/game_database/user/leaderboard.php">LEADERBOARD</a></td>

       <td><a href="http://localhost/game_database/user/logout.php">LOGOUT</a></td>

   </tr>

   <tr><td align="center" colspan=5>Profile</td></tr>

   <tr><td>NIK</td><td colspan=4><?php echo $userdata['nik'];?></td></tr>

   <tr><td>Nama</td><td colspan=4><?php echo $userdata['nama_depan']." ".$userdata['nama_belakang'];?></td></tr>

   <tr><td>alamat</td><td colspan=4><?php echo $userdata['alamat'].". Kode Pos: ".$userdata['kode_pos'];?></td></tr>

   <tr><td>Kota</td><td colspan=4><?php echo $userdata['nama_kota'];?></td></tr>   

   <tr><td>Provinsi</td><td colspan=4><?php echo $userdata['nama_provinsi'];?></td></tr>

</table>