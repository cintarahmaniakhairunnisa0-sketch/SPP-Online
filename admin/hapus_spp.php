<?php
include_once "../src/koneksi.php";


if(isset($_GET['id_spp'])){
    $id_spp= $_GET['id_spp'];


    $sql = mysqli_query($koneksi, "DELETE FROM spp WHERE id_spp='$id_spp'");
    if($sql){

        echo "<center> <b> <font color = 'red size = '4'> <p> Data Berhasil dihapus </p>
        </center> </b> </font> </br>
        <meta http-equiv='refresh' content='2; url=?open=data_spp'>";
    }
}
else {

    echo "<b>Data yang dihapus tidak ada</b>";
}
?>
