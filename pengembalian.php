<?php
if (isset($_GET['kode'])) {
    $sql_ubah = "UPDATE tb_sirkulasi SET status = 'KEM' WHERE id_sk = '".$_GET['kode']."'";
    $query_ubah = mysqli_query($koneksi, $sql_ubah);

    if ($query_ubah) {
        echo "<script>Swal.fire('Kembalikan Buku Berhasil', '', 'success').then(() => { window.location = 'index.php?page=data_sirkul'; });</script>";
    } else {
        echo "<script>Swal.fire('Kembalikan Buku Gagal', '', 'error').then(() => { window.location = 'index.php?page=data_sirkul'; });</script>";
    }
}
?>
