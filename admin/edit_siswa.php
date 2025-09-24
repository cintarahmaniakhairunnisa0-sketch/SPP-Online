<?php
include_once "../src/koneksi.php";

# SKRIP TOMBOL SIMPAN DIKLIK
if(isset($_POST['btnSimpan'])){
    $nisn       = $_POST['nisn'];
    $nis        = $_POST['nis'];
    $nama       = $_POST['nama'];
    $id_kelas   = $_POST['id_kelas'];
    $alamat     = $_POST['alamat'];
    $no_telp    = $_POST['no_telp'];
    $id_spp     = $_POST['id_spp'];

    $pesanError = array();
    if (trim($nisn)=="")  $pesanError[] = "Data <b>NISN</b> tidak boleh kosong!";
    if (trim($nis)=="")   $pesanError[] = "Data <b>NIS</b> tidak boleh kosong!";
    if (trim($nama)=="")  $pesanError[] = "Data <b>Nama</b> tidak boleh kosong!";
    if (trim($id_kelas)=="") $pesanError[] = "Data <b>Kelas</b> tidak boleh kosong!";
    if (trim($alamat)=="")   $pesanError[] = "Data <b>Alamat</b> tidak boleh kosong!";
    if (trim($no_telp)=="")  $pesanError[] = "Data <b>No Telepon</b> tidak boleh kosong!";
    if (trim($id_spp)=="")   $pesanError[] = "Data <b>SPP</b> tidak boleh kosong!";

    if (count($pesanError)>=1 ){
        $noPesan=0;
        foreach ($pesanError as $indeks=>$pesan_tampil){
            $noPesan++;
            echo "&nbsp; $noPesan. $pesan_tampil<br>";
        }
        echo "<br>";
    }
    else {
        # update data
        $sqlEdit = mysqli_query($koneksi, "UPDATE siswa SET 
                        nis='$nis',
                        nama='$nama',
                        id_kelas='$id_kelas',
                        alamat='$alamat',
                        no_telp='$no_telp',
                        id_spp='$id_spp'
                    WHERE nisn='$nisn'");
        if($sqlEdit){
            echo "<center><b><font color='red' size='4'><p>Data Berhasil diubah</p></font></b></center><br>
                  <meta http-equiv='refresh' content='2; url=?open=data_siswa'>";
        } else {
            echo "<center><b><font color='red' size='4'><p>Data Gagal Disimpan!</p></font></b></center><br>
                  <meta http-equiv='refresh' content='2; url=?open=data_siswa'>";
        }
        exit;
    }
}

# Baca data siswa berdasarkan NISN
$nisn = $_GET['nisn'];
$sql  = mysqli_query($koneksi, "SELECT * FROM siswa WHERE nisn='$nisn'");
$data = mysqli_fetch_array($sql);
?>

<form action="<?php $_SERVER['PHP_SELF']; ?>" method="post" name="form1" target="_self">
<table class="table-list" width="650" border="0" cellspacing="1" cellpadding="3">
    <tr>
        <td bgcolor="#CCCCCC" colspan="3"><strong>EDIT DATA SISWA</strong></td>
    </tr>
    <tr>
        <td width="182"><strong>NISN</strong></td>
        <td width="6">:</td>
        <td width="440"><input name="nisn" type="text" value="<?php echo $data['nisn']; ?>" readonly /></td>
    </tr>
    <tr>
        <td><strong>NIS</strong></td>
        <td>:</td>
        <td><input name="nis" type="text" value="<?php echo $data['nis']; ?>" size="20" maxlength="20" /></td>
    </tr>
    <tr>
        <td><strong>Nama</strong></td>
        <td>:</td>
        <td><input name="nama" type="text" value="<?php echo $data['nama']; ?>" size="60" maxlength="100" /></td>
    </tr>
    <tr>
        <td><strong>Kelas</strong></td>
        <td>:</td>
        <td>
            <select name="id_kelas">
                <option value="">-- Pilih Kelas --</option>
                <?php
                $tampilkanKelas = mysqli_query($koneksi, "SELECT * FROM kelas");
                while($bacaKelas = mysqli_fetch_array($tampilkanKelas)){
                    $cek = ($bacaKelas['id_kelas']==$data['id_kelas']) ? "selected" : "";
                    echo "<option value='$bacaKelas[id_kelas]' $cek>$bacaKelas[nama_kelas]</option>";
                }
                ?>
            </select>
        </td>
    </tr>
    <tr>
        <td><strong>Alamat</strong></td>
        <td>:</td>
        <td><input name="alamat" type="text" value="<?php echo $data['alamat']; ?>" size="60" maxlength="200" /></td>
    </tr>
    <tr>
        <td><strong>No. Telepon</strong></td>
        <td>:</td>
        <td><input name="no_telp" type="text" value="<?php echo $data['no_telp']; ?>" size="20" maxlength="20" /></td>
    </tr>
    <tr>
        <td><strong>SPP</strong></td>
        <td>:</td>
        <td>
            <select name="id_spp">
                <option value="">-- Pilih Nominal SPP --</option>
                <?php
                $tampilkanSPP = mysqli_query($koneksi, "SELECT * FROM spp");
                while($bacaSPP = mysqli_fetch_array($tampilkanSPP)){
                    $cek = ($bacaSPP['id_spp']==$data['id_spp']) ? "selected" : "";
                    echo "<option value='$bacaSPP[id_spp]' $cek>$bacaSPP[nominal]</option>";
                }
                ?>
            </select>
        </td>
    </tr>
    <tr>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td><input name="btnSimpan" type="submit" id="btnSimpan" value="Simpan" /></td>
    </tr>
</table>
</form>
