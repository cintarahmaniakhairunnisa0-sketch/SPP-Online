<h3>Transaksi Pembayaran SPP</h3>
<form method="get" action="">
    nisn: <input type="text" name="nisn" value="<?php echo isset($_GET['nisn']) ? $_GET['nisn'] : ''; ?>" />
    <input type="hidden" id="open" name="open" value="data_pembayaran" />
    <input type="submit" name="cari" value="Cari Siswa" />
</form>

<?php
include_once "../src/koneksi.php";
if (isset($_GET['nisn']) && $_GET['nisn'] != '') {
    $nisn = mysqli_real_escape_string($koneksi, $_GET['nisn']);
    $sqlSiswa = mysqli_query($koneksi, "SELECT siswa.nisn, siswa.nama, kelas.nama_kelas 
        FROM siswa 
        JOIN kelas ON siswa.id_kelas = kelas.id_kelas 
        WHERE siswa.nisn = '$nisn'");
    $siswa = mysqli_fetch_array($sqlSiswa);
    
    if (!$siswa) {
        echo "<p><font color='red'>Siswa dengan NISN $nisn tidak ditemukan!</font></p>";
    } else {
?>

<h3>Biodata Siswa</h3>
<table>
    <tr>
        <td>NISN</td>
        <td>:</td>
        <td><?php echo $siswa['nisn']; ?></td>
    </tr>
    <tr>
        <td>Nama Siswa</td>
        <td>:</td>
        <td><?php echo $siswa['nama']; ?></td>
    </tr>
    <tr>
        <td>Kelas</td>
        <td>:</td>
        <td><?php echo $siswa['nama_kelas']; ?></td>
    </tr>
</table>

<h3>Tagihan SPP Siswa</h3>
<table border="1">
    <tr>
        <th>No</th>
        <th>Bulan</th>
        <th>Tahun</th>
        <th>No. Bayar</th>
        <th>Tgl. Bayar</th>
        <th>Jumlah</th>
        <th>Keterangan</th>
        <th>Bayar</th>
    </tr>

<?php
    $sql = mysqli_query($koneksi, "SELECT pembayaran.id_pembayaran, pembayaran.nisn, pembayaran.bulan_tagihan, 
        pembayaran.tahun_tagihan, pembayaran.no_bayar, pembayaran.tgl_pembayaran, 
        pembayaran.keterangan, spp.nominal 
        FROM pembayaran 
        LEFT JOIN spp ON pembayaran.id_spp = spp.id_spp 
        WHERE pembayaran.nisn = '$nisn' 
        ORDER BY pembayaran.tahun_tagihan, FIELD(pembayaran.bulan_tagihan, 'Juli', 'Agustus', 'September', 'Oktober', 'Nopember', 'Desember', 'Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni')");
    
    if (!$sql) {
        echo "<tr><td colspan='8' align='center'>Error executing query: " . mysqli_error($koneksi) . "</td></tr>";
    } elseif (mysqli_num_rows($sql) == 0) {
        echo "<tr><td colspan='8' align='center'>Tidak ada tagihan untuk siswa ini.</td></tr>";
        // Debug: Check if NISN exists in pembayaran
        $checkPembayaran = mysqli_query($koneksi, "SELECT nisn FROM pembayaran WHERE nisn = '$nisn'");
        echo "<tr><td colspan='8' align='center'>Debug: " . (mysqli_num_rows($checkPembayaran) > 0 ? "NISN found in pembayaran table" : "NISN not found in pembayaran table") . "</td></tr>";
    } else {
        $no = 1;
        while ($pembayaran = mysqli_fetch_array($sql)) {
            echo "<tr>
                <td>$no</td>
                <td>" . ($pembayaran['bulan_tagihan'] ? $pembayaran['bulan_tagihan'] : '-') . "</td>
                <td>" . ($pembayaran['tahun_tagihan'] ? $pembayaran['tahun_tagihan'] : '-') . "</td>
                <td>" . ($pembayaran['no_bayar'] ? $pembayaran['no_bayar'] : '-') . "</td>
                <td>" . ($pembayaran['tgl_pembayaran'] ? $pembayaran['tgl_pembayaran'] : '-') . "</td>
                <td>" . ($pembayaran['nominal'] ? $pembayaran['nominal'] : '-') . "</td>
                <td>" . ($pembayaran['keterangan'] ? $pembayaran['keterangan'] : '-') . "</td>
                <td align='center'>";
            if (empty($pembayaran['no_bayar'])) {
                echo "<a href='proses_pembayaran.php?nisn=$nisn&act=bayar&id_pembayaran=$pembayaran[id_pembayaran]'>Bayar</a>";
            } else {
                echo "-";
            }
            echo "</td>
            </tr>";
            $no++;
        }
    }
?>
</table>
<?php
    }
}
?>
<p>
    Pembayaran SPP dilakukan dengan cara mencari tagihan siswa dengan NISN melalui form di atas, kemudian proses pembayaran
</p>