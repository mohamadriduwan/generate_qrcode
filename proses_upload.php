<?php

// menghubungkan dengan koneksi
include 'koneksi.php';

// menghubungkan dengan library excel reader
include "excel_reader.php";


// upload file xls
$target = basename($_FILES['fileexcel']['name']);
move_uploaded_file($_FILES['fileexcel']['tmp_name'], $target);

// beri permisi agar file xls dapat di baca
chmod($_FILES['fileexcel']['name'], 0777);

// mengambil isi file xls
$data = new Spreadsheet_Excel_Reader($_FILES['fileexcel']['name'], false);
// menghitung jumlah baris data yang ada
$jumlah_baris = $data->rowcount($sheet_index = 0);

// jumlah default data yang berhasil di import

for ($i = 2; $i <= $jumlah_baris; $i++) {

    // menangkap data dan memasukkan ke variabel sesuai dengan kolumnya masing-masing
    $nis         = $data->val($i, 1);
    $nisn   = $data->val($i, 2);
    $nama          = $data->val($i, 3);
    $jenkel        = $data->val($i, 4);
    $tgl_lahir        = $data->val($i, 5);
    $alamat1        = $data->val($i, 6);
    $alamat2        = $data->val($i, 7);
    $foto        = $data->val($i, 8);
    $qrcode        = $data->val($i, 9);
    $barcode        = $data->val($i, 10);

    if ($nis != "" && $nisn != "" && $nama != "" && $jenkel != "") {
        // input data ke database (table barang)
        mysqli_query($koneksi, "INSERT into daftar values('','$nis','$nisn','$nama','$jenkel','$tgl_lahir','$alamat1','$alamat2','$foto','$qrcode','$barcode')");
        $berhasil++;
    }
}
// from mahasiswa where id_mahasiswa='$id_mahasiswa'
// hapus kembali file .xls yang di upload tadi
unlink($_FILES['fileexcel']['name']);

// alihkan halaman ke index.php
header("location:index.php?berhasil=$berhasil Data berhasil di import");
