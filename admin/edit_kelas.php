<?php
include_once "../src/koneksi.php";

# SKRIP TOMBOL SIMPAN DIKLIK
if(isset($_POST['btnSimpan'])){
    $id_kelas            = $_POST['id_kelas'];
    $nama_kelas          = $_POST['nama_kelas'];
    $kompetensi_keahlian = $_POST['kompetensi_keahlian'];

    $pesanError = array();
    if (trim($id_kelas)=="")            $pesanError[] = "Data <b>ID Kelas</b> tidak boleh kosong!";
    if (trim($nama_kelas)=="")          $pesanError[] = "Data <b>Nama Kelas</b> tidak boleh kosong!";
    if (trim($kompetensi_keahlian)=="") $pesanError[] = "Data <b>Kompetensi Keahlian</b> tidak boleh kosong!";

    if (count($pesanError)>=1 ){
        $noPesan=0;
        foreach ($pesanError as $indeks=>$pesan_tampil){
            $noPesan++;
            echo "&nbsp; $noPesan. $pesan_tampil<br>";
        }
        echo "<br>";
    }
    else {
        # update data kelas
        $sqlEdit = mysqli_query($koneksi, "UPDATE kelas SET 
                        nama_kelas='$nama_kelas',
                        kompetensi_keahlian='$kompetensi_keahlian'
                    WHERE id_kelas='$id_kelas'");
        if($sqlEdit){
            echo "<center><b><font color='red' size='4'><p>Data Berhasil diubah</p></font></b></center><br>
                  <meta http-equiv='refresh' content='2; url=?open=data_kelas'>";
        } else {
            echo "<center><b><font color='red' size='4'><p>Data Gagal Disimpan!</p></font></b></center><br>
                  <meta http-equiv='refresh' content='2; url=?open=data_kelas'>";
        }
        exit;
    }
}

# Baca data kelas berdasarkan ID
$id_kelas = $_GET['id_kelas'];
$sql      = mysqli_query($koneksi, "SELECT * FROM kelas WHERE id_kelas='$id_kelas'");
$data     = mysqli_fetch_array($sql);
?>

<form action="<?php $_SERVER['PHP_SELF']; ?>" method="post" name="form1" target="_self">
<table class="table-list" width="650" border="0" cellspacing="1" cellpadding="3">
    <tr>
        <td bgcolor="#CCCCCC" colspan="3"><strong>EDIT DATA KELAS</strong></td>
    </tr>
    <tr>
        <td width="182"><strong>ID Kelas</strong></td>
        <td width="6">:</td>
        <td width="440">
            <input name="id_kelas" type="text" value="<?php echo $data['id_kelas']; ?>" readonly />
        </td>
    </tr>
    <tr>
        <td><strong>Nama Kelas</strong></td>
        <td>:</td>
        <td><input name="nama_kelas" type="text" value="<?php echo $data['nama_kelas']; ?>" size="50" maxlength="50" /></td>
    </tr>
    <tr>
        <td><strong>Kompetensi Keahlian</strong></td>
        <td>:</td>
        <td><input name="kompetensi_keahlian" type="text" value="<?php echo $data['kompetensi_keahlian']; ?>" size="80" maxlength="100" /></td>
    </tr>
    <tr>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td><input name="btnSimpan" type="submit" id="btnSimpan" value="Simpan" /></td>
    </tr>
</table>
</form>
