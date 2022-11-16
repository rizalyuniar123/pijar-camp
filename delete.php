<?php
include 'functions.php';
$pdo = pdo_connect_mysql();
$msg = '';

if (isset($_GET['idproduk'])) {
    $stmt = $pdo->prepare('SELECT * FROM produk WHERE idproduk = ?');
    $stmt->execute([$_GET['idproduk']]);
    $produk = $stmt->fetch(PDO::FETCH_ASSOC);
    if (!$produk) {
        exit('produk tidak\'tidak ada id yang sesuai');
    }
    if (isset($_GET['confirm'])) {
        if ($_GET['confirm'] == 'yes') {
            
            $stmt = $pdo->prepare('DELETE FROM produk WHERE idproduk = ?');
            $stmt->execute([$_GET['idproduk']]);
            $msg = 'Berhasil Menghapus produk!';
        } else {  
            header('Location: produk.php');
            exit;
        }
    }
} else {
    exit('Tidak ada id yang sesuai!');
}
?>

<?=template_header('Delete')?>

<div class="content delete">
	<h2>Hapus produk #<?=$produk['idproduk']?></h2>
    <?php if ($msg): ?>
    <p><?=$msg?></p>
    <?php else: ?>
	<p>Yakin Ingin Menghapus produk #<?=$produk['idproduk']?>?</p>
    <div class="yesno">
        <a href="delete.php?idproduk=<?=$produk['idproduk']?>&confirm=yes">Iya</a>
        <a href="delete.php?idproduk=<?=$produk['idproduk']?>&confirm=no">Tidak</a>
    </div>
    <?php endif; ?>
</div>

<?=template_footer()?>