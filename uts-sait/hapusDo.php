<?php

$nim = $_GET['nim'];
$kode_mk = $_GET['kode_mk'];


//Pastikan sesuai dengan alamat endpoint dari REST API di ubuntu
$url='http://localhost/uts-angel/uts-sait-api/mahasiswa_api.php?nim='.$nim.'&kode_mk='.$kode_mk.'';

$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $url);
// pastikan method nya adalah delete
curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "DELETE");
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

$result = curl_exec($ch);
$result = json_decode($result, true);

curl_close($ch);

//var_dump($result);
echo "<script>alert('data berhasil dihapuskan'); window.location.href='index.php';</script>";


?>