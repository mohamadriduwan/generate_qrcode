<?php
include 'koneksi.php';
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <!-- import bootstrap  -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
</head>

<body>
    <br>
    <!-- membuat container dengan lebar colomn col-lg-10  -->
    <div class="container col-lg-10">
        <!-- membuat tulisan alert berwarna hijau dengan tulisan di tengah  -->
        <h3 class="alert alert-success text-center" role="alert">
            Tutorial Import File Excel ke Database MySQL
        </h3>
        <br>
        <?php
        if (isset($_GET['berhasil'])) {
            echo "<p>" . $_GET['berhasil'] . "</p>";
        }
        ?>
        <!-- membuat card untuk membungkus tabel bootstrap  -->
        <div class="row">
            <div class="col-lg-4">
                <div class="card">
                    <div class="card-body">
                        <!-- membuat form input file -->
                        <form method="post" enctype="multipart/form-data" action="proses_upload.php">
                            Pilih File:
                            <input class="form-control" name="fileexcel" type="file" required="required">
                            <br>
                            <button class="btn btn-primary btn-block btn-login" type="submit">Submit</button>
                        </form>
                        <br>
                        <a href="Template.xls" class="btn btn-sm btn-info">
                            Download Template</a>

                    </div>
                </div>
                <br>
                <a href="proses_qrcode.php" class="btn btn-sm btn-danger">
                    Generate</a>
            </div>
            <div class="col-lg-8">
                <table class="table">
                    <thead class="thead-dark" align="center">
                        <!-- set table header  -->
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">NIS</th>
                            <th scope="col">NISN</th>
                            <th scope="col">NAMA</th>
                            <th scope="col">Qrcode</th>
                            <th scope="col"></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php

                        //membuat variabel angka
                        $no = 1;

                        //mengambil data dari tabel barang
                        $select = mysqli_query($koneksi, "SELECT * FROM daftar");

                        //melooping(perulangan) dengan menggunakan while
                        while ($data = mysqli_fetch_array($select)) {
                        ?>
                            <tr>

                                <!-- menampilkan data dengan menggunakan array  -->
                                <td><?php echo $no++; ?></td>
                                <td><?php echo $data['nis']; ?></td>
                                <td><?php echo $data['nisn']; ?></td>
                                <td><?php echo $data['nama']; ?></td>
                                <td>
                                    <?php
                                    if (file_exists("qrcode/" . $data['nis'] . ".png")) { ?>
                                        <center><img src="qrcode/<?= $data['nis']; ?>.png" height='25'></center>
                                    <?php
                                    } else {
                                        echo "";
                                    }
                                    ?>


                                </td>
                                <td>

                                    <!-- tombol edit dan modal akan dibuat disini -->

                                </td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</body>

</html>