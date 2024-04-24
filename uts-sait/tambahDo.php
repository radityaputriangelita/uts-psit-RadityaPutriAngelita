<?php
if(isset($_POST['submit'])) {    
    $nim = $_POST['nim'];
    $kode_mk = $_POST['kode_mk'];
    $nilai = $_POST['nilai'];

    // Ganti URL sesuai dengan alamat endpoint API untuk menambahkan data menu
    $url = 'http://localhost/uts-angel/uts-sait-api/mahasiswa_api.php';
    
    $ch = curl_init($url);
    
    // Data yang akan dikirim ke API, dalam format JSON
    $jsonData = array(
        'nim' =>  $nim,
        'kode_mk' =>  $kode_mk,
        'nilai' =>  $nilai,
    );

    // Mengkodekan array menjadi JSON
    $jsonDataEncoded = json_encode($jsonData);
    
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $jsonDataEncoded);
    curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json')); 
    
    $result = curl_exec($ch);
    $result = json_decode($result, true);
    
    curl_close($ch);
    // echo "<script>alert('data berhasil ditambahkan'); window.location.href='index.php';</script>";
    echo "<script>alert('" . $result['message'] . "'); window.location.href='index.php';</script>";

    
}
?>
