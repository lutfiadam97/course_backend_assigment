<?php

include("database.php");
echo "CRUD TESTING<br>";
$test = new Database();

// create -> insert
//$test->execute("INSERT INTO tabel_game(nama, tipe_leaderboard, status) VALUES ('FPS',1,true)");
//$test->execute("INSERT INTO tabel_game(nama, tipe_leaderboard, status) VALUES ('RPG',1,true)");
//$test->execute("INSERT INTO tabel_provinsi(nama_provinsi, status) VALUES ('Jawa Barat',1)");
//$test->execute("INSERT INTO tabel_provinsi(nama_provinsi, status) VALUES ('Jawa Timur',1)");
//$test->execute("INSERT INTO tabel_provinsi(nama_provinsi, status) VALUES ('Jawa Tengah',1)");

//$test->execute("INSERT INTO tabel_user(nik, nama_depan, nama_belakang, no_hp, tempat_lahir, tanggal_lahir, email, password, token, alamat, kota_id, kode_pos, status) VALUES('1000000000000001','Ani','Marni','081012349002','Bandung','01-01-1990','animarni@gmail.com','f43433f2d32d','4f33gf43h45656','Gedebage, Bandung',1,1,1)");

//$test->execute("INSERT INTO tabel_user(nik, nama_depan, nama_belakang, no_hp, tempat_lahir, tanggal_lahir, email, password, token, alamat, kota_id, kode_pos, status) VALUES('1000000000000002','Budi','Yanto','081012345678','Bandung','02-02-1991','budiyanto@gmail.com','f43433f24545','4f3fdfd3h45656','Gedebage, Bandung',1,1,1)");

//$test->execute("INSERT INTO tabel_user(nik, nama_depan, nama_belakang, no_hp, tempat_lahir, tanggal_lahir, email, password, token, alamat, kota_id, kode_pos, status) VALUES('1000000000000003','Charlie','Darwin','081012349999','Bandung','03-03-1992','charliedarwin@gmail.com','f43433f2bv5g','56565f43h45656','Gedebage, Bandung',1,1,1)");


//$test->execute("INSERT INTO tabel_user_game_data(nik, game_id, score, status) VALUES('1000000000000001',14,67,1)");
//$test->execute("INSERT INTO tabel_user_game_data(nik, game_id, score, status) VALUES('1000000000000002',14,89,1)");
//$test->execute("INSERT INTO tabel_user_game_data(nik, game_id, score, status) VALUES('1000000000000003',14,55,1)");
//$test->execute("INSERT INTO tabel_user_game_data(nik, game_id, score, status) VALUES('1000000000000001',20,76,1)");
//$test->execute("INSERT INTO tabel_user_game_data(nik, game_id, score, status) VALUES('1000000000000003',19,65,1)");
// read -> select
//SELECT field1, field2, field3 FROM nama_tabel WHERE field1=x
//$getdata = $test->get("SELECT game_id, nama, tipe_leaderboard, status FROM tabel_game WHERE status = 1");

//$getdata = $test->get_procedure_execute("GET_GAME_DATA_BY_STATUS(1)");

//while($row = mysqli_fetch_assoc($getdata)) {

   //echo "game_ID: " . $row["game_id"]. " - Nama: " . $row["nama"]. " - Tipe_Leaderboard: " . $row["tipe_leaderboard"]. " - ". $row["status"]."<br>";

//}

// update
//$test->execute("UPDATE tabel_game SET status=1, nama = 'Turn Base' WHERE game_id = 1");

// delete

//$test->execute("DELETE FROM tabel_game WHERE status=0");

// view

$test->execute("CREATE VIEW turn_base_leaderboard AS SELECT tabel_user.email as email, tabel_user.nama_depan as nama_depan, tabel_user.nama_belakang as nama_belakang, tabel_kota.nama_kota as kota, tabel_provinsi as nama_provinsi, tabel_user_game_data.score as score FROM tabel_user_game_data, tabel_user, tabel_kota, tabel_provinsi WHERE tabel_user_game_data.game_id = 14 AND tabel_user_game_data.nik = tabel_user.nik AND tabel_user.kota_id = tabel_kota.kota_id AND tabel_kota.provinsi_id = tabel_provinsi.provinsi_id AND tabel_user.status = 1 AND tabel_user_game_data.status = 1 GROUP BY tabel_user.nik ORDER BY tabel_user_game_data.score DESC");

$test->execute("CREATE VIEW fps_leaderboard AS SELECT tabel_user.email as email, tabel_user.nama_depan as nama_depan, tabel_user.nama_belakang as nama_belakang, tabel_kota.nama_kota as kota, tabel_provinsi as nama_provinsi, tabel_user_game_data.score as score FROM tabel_user_game_data, tabel_user, tabel_kota, tabel_provinsi WHERE tabel_user_game_data.game_id = 19 AND tabel_user_game_data.nik = tabel_user.nik AND tabel_user.kota_id = tabel_kota.kota_id AND tabel_kota.provinsi_id = tabel_provinsi.provinsi_id AND tabel_user.status = 1 AND tabel_user_game_data.status = 1 GROUP BY tabel_user.nik ORDER BY tabel_user_game_data.score DESC");

$test->execute("CREATE VIEW rpg_leaderboard AS SELECT tabel_user.email as email, tabel_user.nama_depan as nama_depan, tabel_user.nama_belakang as nama_belakang, tabel_kota.nama_kota as kota, tabel_provinsi as nama_provinsi, tabel_user_game_data.score as score FROM tabel_user_game_data, tabel_user, tabel_kota, tabel_provinsi WHERE tabel_user_game_data.game_id = 20 AND tabel_user_game_data.nik = tabel_user.nik AND tabel_user.kota_id = tabel_kota.kota_id AND tabel_kota.provinsi_id = tabel_provinsi.provinsi_id AND tabel_user.status = 1 AND tabel_user_game_data.status = 1 GROUP BY tabel_user.nik ORDER BY tabel_user_game_data.score DESC");

?>
