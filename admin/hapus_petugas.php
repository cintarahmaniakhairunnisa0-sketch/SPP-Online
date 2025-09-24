<?php
include_once "../src/koneksi.php";

if(isset($_GET['id_petugas'])) {
    $id_petugas = $_GET['id_petugas'];

    $sql = mysqli_query($koneksi, "DELETE FROM petugas WHERE id_petugas='$id_petugas'");
    if($sql){
        echo "<center><b><font color='green' size='4'><p>Data Berhasil dihapus</p></font></b></center><br>";
        echo "<meta http-equiv='refresh' content='2; url=?open=data_petugas'>";
    }
    else {
        echo "<center><b><font color='red' size='4'><p>Data Gagal dihapus!</p></font></b></center><br>";
        echo "<meta http-equiv='refresh' content='2; url=?open=data_petugas'>";
    }
}
else {
    echo "<center><b><font color='red'>Data yang dihapus tidak ada</font></b></center>";
    echo "<meta http-equiv='refresh' content='2; url=?open=data_petugas'>";
}
?>