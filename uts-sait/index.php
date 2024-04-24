<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Nilai Mahasiswa</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <style>
        tr{
            text-align: center;
        }
    </style>
</head>
<body>
    <h1 class="text-center my-5">Daftar Nilai Mahasiswa</h1>
    <div class="d-flex justify-content-end m-3">
        <button class="btn btn-primary">
            <a href="tambahView.php" style="color: white;">Tambah Nilai</a>
        </button>
    </div>
    <div class="d-flex justify-content-center">
        <table border="1" class="table table-striped" style="width: 80%;">
            <tr>
                <th>No</th>
                <th>NIM</th>
                <th>Nama Mahasiswa</th>
                <th>Alamat Mahasiswa</th>
                <th>Kode Mata Kuliah</th>
                <th>Nama Mata Kuliah</th>
                <th>SKS Mata Kuliah</th>
                <th>Nilai Mata Kuliah</th>
                <th>Action</th>
            </tr>
            <?php
            $curl = curl_init();
            curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($curl, CURLOPT_URL, 'http://localhost/uts-angel/uts-sait-api/mahasiswa_api.php');
            $res = curl_exec($curl);
            $json = json_decode($res, true);

            if (isset($json['data']) && !empty($json['data'])) {
                $no = 1;
                foreach ($json['data'] as $row) {
                    echo "<tr>";
                    echo "<td>".$no."</td>";
                    echo "<td>".$row['nim']."</td>";
                    echo "<td>".$row['nama']."</td>";
                    echo "<td>".$row['alamat']."</td>";
                    echo "<td>".$row['kode_mk']."</td>";
                    echo "<td>".$row['nama_mk']."</td>";
                    echo "<td>".$row['sks']."</td>";
                    echo "<td>".$row['nilai']."</td>";
                    echo "<td style='display: flex; justify-content: space-evenly'>
                    <button class='btn btn-warning'>
                        <a href='editView.php?nim=".$row['nim']."&kode_mk=".$row['kode_mk']."' style='color: white'>Edit</a>
                    </button>
                    <button class='btn btn-danger'>
                        <a href='hapusDo.php?nim=".$row['nim']."&kode_mk=".$row['kode_mk']."' style='color: white'>Delete</a>
                    </button>
                        </td>";
                    echo "</tr>";
                    $no++;
                }
            } else {
                echo "<tr><td colspan='4'>Tidak ada data</td></tr>";
            }
            ?>
        </table>
    </div>
</body>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</html>
