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

   $statisticdata = $db->get("SELECT tabel_game.nama as game, MIN(tabel_user_game_data.score) as min, MAX(tabel_user_game_data.score) as max,

                               AVG(tabel_user_game_data.score) as avg FROM tabel_user_game_data, tabel_game

                               WHERE tabel_user_game_data.game_id = tabel_game.game_id AND tabel_user_game_data.nik = '".$nik."' group by tabel_user_game_data.game_id");               

       

 

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

PAGE : STATISTIK

<table border=1>

   <tr>

       <td>MENU</td>

       <td><a href="http://localhost/game_database/user/">HOME</a></td>

       <td><a href="http://localhost/game_database/user/statistik.php">STATISTIK</a></td>       

       <td><a href="http://localhost/game_database/user/leaderboard.php">LEADERBOARD</a></td>

       <td><a href="http://localhost/game_database/user/logout.php">LOGOUT</a></td>

   </tr>

</table>

<table border=1>

   <tr><td align="center" colspan=4>USER STATISTIK SKOR GAME</td></tr>

   <tr><td>GAME</td><td>MIN</td><td>MAX</td><td>AVG</td></tr>

   <?php

       while($row = mysqli_fetch_assoc($statisticdata))

       {

           ?>

           <tr>

               <td><?php echo $row['game']?></td>

               <td><?php echo $row['min']?></td>

               <td><?php echo $row['min']?></td>

               <td><?php echo $row['min']?></td>               

           </tr>

           <?php

       }

   ?>

</table>