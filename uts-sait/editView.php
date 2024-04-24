<?php
 $nim = $_GET['nim'];
 $kode_mk = $_GET['kode_mk'];
 $curl= curl_init();
 curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
 //Pastikan sesuai dengan alamat endpoint dari REST API di ubuntu
 curl_setopt($curl, CURLOPT_URL, 'http://localhost/uts-angel/uts-sait-api/mahasiswa_api.php?nim='.$nim.'&kode_mk='.$kode_mk.'');
 $res = curl_exec($curl);
 $json = json_decode($res, true);
//var_dump($json);
?>

    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Edit Daftar Perkuliahan</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    </head>
    <body style="background-color:cadetblue">
        <h1 style="text-align: center;" class="my-5">Edit Daftar Perkuliahan</h1>
        <div class="d-flex justify-content-center">
            <div class="p-5" style="width: 50%">
                <form action="editDo.php" method="POST">
                    <div class="mb-3">
                        <label class="form-label">NIM</label>
                        <input type="text" class="form-control" name="nim"value="<?php echo $nim; ?>" >
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Kode Mata Kuliah</label>
                        <input type="text" class="form-control" name="kode_mk" value="<?php echo $kode_mk; ?>" >
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Nilai</label>
                        <input type="text" class="form-control" name="nilai">
                    </div>
                        <input type="submit"  class="btn btn-primary" name="submit" value="Submit">
                </form>
            </div>
        </div>
    </body>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    </html>
