<?php
include_once "../src/koneksi.php";

if(isset($_POST['btnSimpan'])) {
    $id_spp          = $_POST['id_spp'];
    $tahun           = $_POST['tahun'];
    $nominal         = $_POST['nominal'];

    $pesanError = array();
    if (trim($id_spp)=="") {
        $pesanError[] = "Data <b>ID SPP</b> tidak boleh kosong!";
    }
    if (trim($tahun)=="") {
        $pesanError[] = "Data <b>Tahun</b> tidak boleh kosong!";
    }
    if (trim($nominal)=="") {
        $pesanError[] = "Data <b>Nominal</b> tidak boleh kosong!";
    }
    
    // Check for duplicate ID SPP
    if (trim($id_spp) != "") {
        $checkId = mysqli_query($koneksi, "SELECT id_spp FROM spp WHERE id_spp = '$id_spp'");
        if (mysqli_num_rows($checkId) > 0) {
            $pesanError[] = "Data <b>ID SPP</b> sudah ada, gunakan ID lain!";
        }
    }

    if (count($pesanError) >= 1) {
        $noPesan = 0;
        foreach ($pesanError as $indeks => $pesan_tampil) {
            $noPesan++;
            echo "&nbsp; $noPesan. $pesan_tampil<br>";
        }
        echo "<br>";
    }
    else {
        $sql = mysqli_query($koneksi, "INSERT INTO spp (id_spp, tahun, nominal)
            VALUES('$id_spp','$tahun','$nominal')");
        if($sql) {
            echo "<center><b><font color='green' size='4'><p>Data Berhasil Disimpan!</p></font></b></center><br>";
            echo "<meta http-equiv='refresh' content='2; url=?open=data_spp'>";
        }
        else {
            echo "<center><b><font color='red' size='4'><p>Data Gagal Disimpan!</p></font></b></center><br>";
            echo "<meta http-equiv='refresh' content='2; url=?open=data_spp'>";
        }
        exit;
    }
}
?>

<form action="" method="post">
    <table cellspacing="1" cellpadding="3">
        <tr>
            <td bgcolor="#CCCCCC"><strong>TAMBAH DATA SPP</strong></td>
        </tr>
        <tr>
            <td>ID SPP</td>
            <td>:</td>
            <td><input name="id_spp" type="text" size="10" maxlength="10" /></td>
        </tr>
        <tr>
            <td>Tahun</td>
            <td>:</td>
            <td><input name="tahun" type="number" size="4" maxlength="4" min="2020" max="2030" /></td>
        </tr>
        <tr>
            <td>Nominal</td>
            <td>:</td>
            <td><input name="nominal" type="number" size="15" maxlength="15" /></td>
        </tr>
        <tr>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            <td><input name="btnSimpan" type="submit" value="Simpan" /></td>
        </tr>
    </table>
</form>