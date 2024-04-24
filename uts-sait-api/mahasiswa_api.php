<?php
require_once "config.php";
$request_method=$_SERVER["REQUEST_METHOD"];
switch ($request_method) {
   case 'GET':
         if(!empty($_GET["nim"]))
         {
            $nim = $_GET["nim"];
            get_nilai_nim($nim);
         }
         else
         {
            get_all_nilai();
         }
         break;
   case 'POST':
         if(!empty($_GET["nim"])&&!empty($_GET["kode_mk"]) )
         {
            $nim = $_GET["nim"];
            $kode_mk = $_GET["kode_mk"];
            update_nilai_perkuliahan($nim, $kode_mk);
         }
         else
         {
            // $kode_mk = $_GET["kode_mk"];
            insert_perkuliahan();
         }     
         break; 
   case 'DELETE':
            $nim = $_GET["nim"];
            $kode_mk = $_GET["kode_mk"];
            delete_nilai_perkuliahan($nim, $kode_mk);
            break;
   default:
      // Invalid Request Method
         header("HTTP/1.0 405 Method Not Allowed");
         break;
      break;
 }

   function get_all_nilai(){
      global $mysqli;
      $query = "SELECT mahasiswa.nim, mahasiswa.nama, mahasiswa.alamat,mahasiswa.tanggal_lahir, matakuliah.kode_mk, matakuliah.nama_mk, matakuliah.sks, perkuliahan.nilai FROM perkuliahan JOIN mahasiswa ON mahasiswa.nim = perkuliahan.nim JOIN matakuliah ON perkuliahan.kode_mk = matakuliah.kode_mk;";
      $data = array();
      $result = $mysqli->query($query);
      while ($row = mysqli_fetch_object($result)) {
         $data[] = $row;
      }
      $response = array(
         'status' => 1,
         'message' => 'Get All Nilai Mahasiswa Successfully.',
         'data' => $data
      );
      header('Content-Type: application/json');
      echo json_encode($response);
   }

   function get_nilai_nim($nim){
      global $mysqli;
      $query = "SELECT mahasiswa.nim, mahasiswa.nama, mahasiswa.alamat,mahasiswa.tanggal_lahir, matakuliah.kode_mk, matakuliah.nama_mk, matakuliah.sks, perkuliahan.nilai FROM perkuliahan JOIN mahasiswa ON mahasiswa.nim = perkuliahan.nim JOIN matakuliah ON perkuliahan.kode_mk = matakuliah.kode_mk where mahasiswa.nim='$nim';";
      $data = array();
      $result = $mysqli->query($query);
      while ($row = mysqli_fetch_object($result)) {
         $data[] = $row;
      }
      $response = array(
         'status' => 1,
         'message' => 'Get Nilai Mahasiswa By Successfully.',
         'data' => $data
      );
      header('Content-Type: application/json');
      echo json_encode($response);  
      }
 
      function insert_perkuliahan()
      {
          global $mysqli;
          if (!empty($_POST["nim"])) {
              $data = $_POST;
          } else {
              $data = json_decode(file_get_contents('php://input'), true);
          }
      
          // Memeriksa apakah nim dan kode_mk yang ditambahkan sudah terdaftar dalam tabel mahasiswa dan matakuliah
          $nim_exists = mysqli_query($mysqli, "SELECT * FROM mahasiswa WHERE nim = '$data[nim]'");
          $kode_mk_exists = mysqli_query($mysqli, "SELECT * FROM matakuliah WHERE kode_mk = '$data[kode_mk]'");
          $already_exists = mysqli_query($mysqli, "SELECT * FROM perkuliahan WHERE nim = '$data[nim]' AND kode_mk = '$data[kode_mk]'");
      
          if (mysqli_num_rows($nim_exists) > 0 && mysqli_num_rows($kode_mk_exists) > 0) {
              if(mysqli_num_rows($already_exists) == 0) {
                  $result = mysqli_query($mysqli, "INSERT INTO perkuliahan SET
                         nim = '$data[nim]',
                         kode_mk = '$data[kode_mk]',
                         nilai = '$data[nilai]'");
                  if ($result) {
                      $response = array(
                          'status' => 1,
                          'message' => 'Mahasiswa Added Successfully.'
                      );
                  } else {
                      $response = array(
                          'status' => 0,
                          'message' => 'Mahasiswa Addition Failed.'
                      );
                  }
              } else {
                  $response = array(
                      'status' => 0,
                      'message' => 'NIM and Kode MK already exists in Perkuliahan table.'
                  );
              }
          } else {
              $response = array(
                  'status' => 0,
                  'message' => 'NIM or Kode MK is not registered.'
              );
          }
      
          header('Content-Type: application/json');
          echo json_encode($response);
      }
      
       
   function update_nilai_perkuliahan($nim, $kode_mk)
      {
         global $mysqli;
         if(!empty($_POST["nim"])){
            $data=$_POST;
         }else{
            $data = json_decode(file_get_contents('php://input'), true);
         }

         $arrcheckpost = array('nilai' => '');
         $hitung = count(array_intersect_key($data, $arrcheckpost));
         if($hitung == count($arrcheckpost)){
          
              $result = mysqli_query($mysqli, "UPDATE perkuliahan SET
              nilai = '$data[nilai]'
              WHERE nim = '$nim' && kode_mk = '$kode_mk'");
          
            if($result)
            {
               $response=array(
                  'status' => 1,
                  'message' =>'Data Perkuliahan Updated Successfully.'
               );
            }
            else
            {
               $response=array(
                  'status' => 0,
                  'message' =>'Mahasiswa Updation Failed.'
               );
            }
         }else{
            $response=array(
                     'status' => 0,
                     'message' =>'Parameter Do Not Match'
                  );
         }
         header('Content-Type: application/json');
         echo json_encode($response);
      }
 
   function delete_nilai_perkuliahan($nim, $kode_mk)
   {
      global $mysqli;
      $query="DELETE FROM perkuliahan WHERE nim = '$nim' && kode_mk = '$kode_mk'";
      if(mysqli_query($mysqli, $query))
      {
         $response=array(
            'status' => 1,
            'message' =>'Perkuliahan Deleted Successfully.'
         );
      }
      else
      {
         $response=array(
            'status' => 0,
            'message' =>'Data Mahasiswa Deletion Failed.'
         );
      }
      header('Content-Type: application/json');
      echo json_encode($response);
   }

 
?> 
