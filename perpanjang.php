<?php
if (isset($_GET['kode'])) {
    $sql_cek = "SELECT * FROM tb_sirkulasi WHERE id_sk = '".$_GET['kode']."'";
    $query_cek = mysqli_query($koneksi, $sql_cek);
    $data_cek = mysqli_fetch_array($query_cek, MYSQLI_BOTH);

    $tgl_p = $data_cek['tgl_pinjam'];
    $tgl_pp = date('Y-m-d', strtotime('+7 days', strtotime($tgl_p)));
    $tgl_kk = date('Y-m-d', strtotime('+14 days', strtotime($tgl_p)));

    $sql_ubah = "UPDATE tb_sirkulasi SET tgl_pinjam = '$tgl_pp', tgl_kembali = '$tgl_kk' WHERE id_sk = '".$_GET['kode']."'";
    $query_ubah = mysqli_query($koneksi, $sql_ubah);

    if ($query_ubah) {
        echo "<script>Swal.fire('Perpanjang Berhasil', '', 'success').then(() => { window.location = 'index.php?page=data_sirkul'; });</script>";
    } else {
        echo "<script>Swal.fire('Perpanjang Gagal', '', 'error').then(() => { window.location = 'index.php?page=data_sirkul'; });</script>";
    }
}
?>
