<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Daftar Perkuliahan</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

</head>
<body style="background-color:cadetblue">
    <h1 style="text-align: center;" class="my-5">Tambah Daftar Perkuliahan</h1>
    <div class="d-flex justify-content-center">
        <div class="p-5" style="width: 50%">
            <form action="tambahDo.php" method="POST">
                <div class="mb-3">
                    <label class="form-label">NIM</label>
                    <input type="text" class="form-control" name="nim">
                </div>
                <div class="mb-3">
                    <label class="form-label">Kode Mata Kuliah</label>
                    <input type="text" class="form-control" name="kode_mk">
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
