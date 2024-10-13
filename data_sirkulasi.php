<?php
$sql = $koneksi->query("SELECT s.id_sk, b.judul_buku, a.id_anggota, a.nama, s.tgl_pinjam, s.tgl_kembali 
                        FROM tb_sirkulasi s 
                        INNER JOIN tb_buku b ON s.id_buku = b.id_buku
                        INNER JOIN tb_anggota a ON s.id_anggota = a.id_anggota 
                        WHERE s.status = 'PIN' 
                        ORDER BY s.tgl_pinjam DESC");
                        
$no = 1;
while ($data = $sql->fetch_assoc()) {
    // Calculate Denda
    $denda = 0;
    $selisih = (new DateTime())->diff(new DateTime($data['tgl_kembali']))->days;
    if ($selisih > 0) {
        $denda = $selisih * 1000; // Assume fine is 1000/day
    }
    
    echo "<tr><td>{$no++}</td><td>{$data['id_sk']}</td><td>{$data['judul_buku']}</td><td>{$data['id_anggota']} - {$data['nama']}</td>";
    echo "<td>".date('d/M/Y', strtotime($data['tgl_pinjam']))."</td><td>".date('d/M/Y', strtotime($data['tgl_kembali']))."</td>";
    echo "<td>{$denda}</td><td><a href='?page=panjang&kode={$data['id_sk']}' class='btn btn-success'>Perpanjang</a>";
    echo "<a href='?page=kembali&kode={$data['id_sk']}' class='btn btn-danger'>Kembalikan</a></td></tr>";
}
?>
