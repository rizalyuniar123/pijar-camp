<?php
include 'functions.php';
$pdo = pdo_connect_mysql();
$msg = '';



if (!empty($_POST)) {
    $idproduk = isset($_POST['idproduk']) && !empty($_POST['idproduk']) && $_POST['idproduk'] != 'auto' ? $_POST['idproduk'] : NULL;
    $nama_produk = isset($_POST['nama_produk']) ? $_POST['nama_produk'] : '';
    $keterangan = isset($_POST['keterangan']) ? $_POST['keterangan'] : '';
    $harga = isset($_POST['harga']) ? $_POST['harga'] : '';
    $jumlah = isset($_POST['jumlah']) ? $_POST['jumlah'] : '';
    

    $stmt = $pdo->prepare('INSERT INTO produk VALUES (?, ?, ?, ?, ?)');
    $stmt->execute([$idproduk, $nama_produk, $keterangan, $harga, $jumlah]);
    $msg = 'Created Successfully!';
}
?>

<?=template_header('Create')?>

<div class="content update">
	<h2>Create produk</h2>
    <form action="create.php" method="post">
        <label for="nama">id</label>
        <input type="text" name="idproduk" id="idproduk">
        <label for="nama">Nama Produk</label>
        <label for="keterangan">Keterangan</label>
        <input type="text" name="nama_produk" id="nama_produk">
        <input type="text" name="keterangan" id="keterangan">
        <label for="harga">harga</label>
        <label for="jumlah">jumlah</label>
        <input type="text" name="harga" id="harga">
        <input type="text" name="jumlah" id="jumlah">
        <input type="submit" value="Create">
    </form>
    <?php if ($msg): ?>
    <p><?=$msg?></p>
    <?php endif; ?>
</div>

<?=template_footer()?>