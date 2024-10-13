<?php
$carikode = mysqli_query($koneksi, "SELECT id_sk FROM tb_sirkulasi ORDER BY id_sk DESC");
$datakode = mysqli_fetch_array($carikode);
$kode = $datakode['id_sk'];
$urut = substr($kode, 1, 3);
$tambah = (int) $urut + 1;

$format = "S" . str_pad($tambah, 3, "0", STR_PAD_LEFT);

if (isset($_POST['Simpan'])) {
    $tgl_pinjam = $_POST['tgl_pinjam'];
    $tgl_kembali = date('Y-m-d', strtotime('+7 days', strtotime($tgl_pinjam)));

    $sql_simpan = "INSERT INTO tb_sirkulasi (id_sk, id_buku, id_anggota, tgl_pinjam, status, tgl_kembali, tgl_dikembalikan) 
                   VALUES ('".$_POST['id_sk']."', '".$_POST['id_buku']."', '".$_POST['id_anggota']."', 
                           '".$_POST['tgl_pinjam']."', 'PIN', '".$tgl_kembali."', '".date('Y-m-d')."')";
    $sql_simpan .= "INSERT INTO log_pinjam (id_buku, id_anggota, tgl_pinjam) 
                    VALUES ('".$_POST['id_buku']."', '".$_POST['id_anggota']."', '".$_POST['tgl_pinjam']."')";
                    
    $query_simpan = mysqli_multi_query($koneksi, $sql_simpan);
    mysqli_close($koneksi);

    if ($query_simpan) {
        echo "<script>Swal.fire('Tambah Data Berhasil', '', 'success').then(() => { window.location = 'index.php?page=data_sirkul'; });</script>";
    } else {
        echo "<script>Swal.fire('Tambah Data Gagal', '', 'error').then(() => { window.location = 'index.php?page=add_sirkul'; });</script>";
    }
}
?>
