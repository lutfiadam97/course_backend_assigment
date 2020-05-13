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

PAGE : LEADERBOARD

<table border=1>

   <tr>

       <td>MENU</td>

       <td><a href="http://localhost/game_database/user/">HOME</a></td>

       <td><a href="http://localhost/game_database/user/statistik.php">STATISTIK</a></td>       

       <td><a href="http://localhost/game_database/user/leaderboard.php">LEADERBOARD</a></td>

       <td><a href="http://localhost/game_database/user/logout.php">LOGOUT</a></td>

   </tr>

</table>

<br>

<form action="http://localhost/game_database/user/leaderboard.php" method='GET'>

       Pilih Game

       <select name="gameid">

           <?php

           $gamedata = $db->get("SELECT game_id,nama FROM tabel_game WHERE status=1");                                

           while($row = mysqli_fetch_assoc($gamedata))

           {

               ?>

               <option value="<?php echo $row['game_id']?>"><?php echo $row['nama']?></option>

               <?php

           }

           ?>

       </select>

       <input type="submit" value="Tampilkan Leaderboard">

</form>

<?php

if(isset($_GET['gameid']))

{

   echo "LEADERBOARD GAME ID :".$_GET['gameid'];

   ?>

   <table border=1>

   <tr><td>NO</td><td>NAMA</td><td>SCORE</td></tr>

   <?php

   $leaderboarddata = $db->get("SELECT tabel_user.nama_depan as nama_depan, tabel_user.nama_belakang as nama_belakang, max(tabel_user_game_data.score) as score FROM tabel_user, tabel_user_game_data WHERE tabel_user.nik = tabel_user_game_data.nik AND tabel_user_game_data.game_id = ".$_GET['gameid']." GROUP BY tabel_user.nik ORDER BY score DESC");

   $no = 0;

   while($row = mysqli_fetch_assoc($leaderboarddata))

   {

       $no++;

       ?>

       <tr>

       <td><?php echo $no?></td>

       <td><?php echo $row['nama_depan']." ".$row['nama_belakang']?></td>

       <td><?php echo $row['score']?></td>               

       </tr>

       <?php

   }

   ?>

   </table>

   <?php

}

?>

