<?php
session_start();
include "../src/koneksi.php";

if($_GET['act'] == 'bayar') {
    $id_pembayaran = $_GET['id_pembayaran'];
    $nisn = $_GET['nisn'];

    $today = date("ymd");
    $query = mysqli_query($koneksi, "SELECT max(no_bayar) AS last FROM 
        pembayaran WHERE no_bayar LIKE '$today%'");
    $data = mysqli_fetch_array($query);
    $lastNoBayar = $data['last'];
    $lastNoUrut = substr($lastNoBayar, 6, 4);
    $nextNoUrut = (int)$lastNoUrut + 1;
    $nextNoBayar = $today.sprintf('%04s', $nextNoUrut);

    $tgl_pembayaran = date('Y-m-d');
    $admin = isset($_SESSION['id_petugas']) ? $_SESSION['id_petugas'] : 1;
    
    // Coba update minimal dulu - cuma kolom yang gak ada constraint
    $updateResult = mysqli_query($koneksi, "UPDATE pembayaran SET 
        no_bayar='$nextNoBayar',
        tgl_pembayaran='$tgl_pembayaran',
        keterangan='LUNAS'
        WHERE id_pembayaran='$id_pembayaran' AND (no_bayar IS NULL OR no_bayar = '')");
    
    // Kalau berhasil, baru update id_petugas di query terpisah
    if ($updateResult) {
        $updatePetugas = mysqli_query($koneksi, "UPDATE pembayaran SET 
            id_petugas='$admin'
            WHERE id_pembayaran='$id_pembayaran'");
        
        if (!$updatePetugas) {
            echo "Warning: Could not update id_petugas: " . mysqli_error($koneksi) . "<br>";
        }
    }

    if ($updateResult) {
        // Redirect dengan parameter nisn dan cari untuk auto-load data
        header('location:halaman_admin.php?open=data_pembayaran&nisn='.$nisn.'&cari=Cari+Siswa');
    } else {
        echo "Error updating payment: " . mysqli_error($koneksi);
    }
}
?>