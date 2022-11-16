<?php
include 'functions.php';
$pdo = pdo_connect_mysql();
$msg = '';

if (isset($_GET['idproduk'])) {
    if (!empty($_POST)) {
        $idproduk = isset($_POST['idproduk']) ? $_POST['idproduk'] : NULL;
        $nama_produk = isset($_POST['nama_produk']) ? $_POST['nama_produk'] : '';
        $keterangan = isset($_POST['keterangan']) ? $_POST['keterangan'] : '';
        $harga = isset($_POST['harga']) ? $_POST['harga'] : '';
        $jumlah = isset($_POST['jumlah']) ? $_POST['jumlah'] : '';
        
        $stmt = $pdo->prepare('UPDATE produk SET idproduk = ?, nama_produk = ?, keterangan = ?, harga = ?, jumlah = ? WHERE idproduk = ?');
        $stmt->execute([$idproduk, $nama_produk, $keterangan, $harga, $jumlah, $_GET['idproduk']]);
        $msg = 'Data produk Berhasil Di Update!';
    }
    
    $stmt = $pdo->prepare('SELECT * FROM produk WHERE idproduk = ?');
    $stmt->execute([$_GET['idproduk']]);
    $produk = $stmt->fetch(PDO::FETCH_ASSOC);
    if (!$produk) {
        exit('produk tidak ada\'tidak ada id yang sesuai!');
    }
} else {
    exit('tidak ada id yang sesuai!');
}
?>

<?=template_header('Read')?>

<div class="content update">
	<h2>Update Data produk #<?=$produk['idproduk']?></h2>
    <form action="update.php?idproduk=<?=$produk['idproduk']?>" method="post">
    <label for="idproduk">id</label>
        <input type="text" name="idproduk" value="<?=$produk['idproduk']?>" id="idproduk">
        <label for="nama_produk">Nama Produk</label>
        <label for="keterangan">Keterangan</label>
        <input type="text" name="nama_produk" value="<?=$produk['nama_produk']?>" id="nama_produk">
        <input type="text" name="keterangan" value="<?=$produk['keterangan']?>" id="keterangan">
        <label for="harga">harga</label>
        <label for="jumlah">Jumlah</label>
        <input type="text" name="harga" value="<?=$produk['harga']?>" id="harga">
        <input type="text" name="jumlah" value="<?=$produk['jumlah']?>" id="jumlah">
        <input type="submit" value="Update">
    </form>
    <?php if ($msg): ?>
    <p><?=$msg?></p>
    <?php endif; ?>
</div>

<?=template_footer()?>