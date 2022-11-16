<?php
include 'functions.php';
$pdo = pdo_connect_mysql();
$page = isset($_GET['page']) && is_numeric($_GET['page']) ? (int)$_GET['page'] : 1;
$records_per_page = 5;
$stmt = $pdo->prepare('SELECT * FROM produk ORDER BY idproduk LIMIT :current_page, :record_per_page');
$stmt->bindValue(':current_page', ($page-1)*$records_per_page, PDO::PARAM_INT);
$stmt->bindValue(':record_per_page', $records_per_page, PDO::PARAM_INT);
$stmt->execute();
$produk = $stmt->fetchAll(PDO::FETCH_ASSOC);
$num_produk = $pdo->query('SELECT COUNT(*) FROM produk')->fetchColumn();
?>
<?=template_header('Read')?>

<div class="content read">
	<h2>Data Produk</h2>
	<a href="create.php" class="create-karyawan">Create Produk</a>
	<table>
        <thead>
            <tr>
                <td>#</td>
                <td>Nama Produk</td>
                <td>Keterangan</td>
                <td>Harga</td>
                <td>Jumlah</td>
                <td>Aksi</td>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($produk as $produk): ?>
            <tr>
                <td><?=$produk['idproduk']?></td>
                <td><?=$produk['nama_produk']?></td>
                <td><?=$produk['keterangan']?></td>
                <td><?=$produk['harga']?></td>
                <td><?=$produk['jumlah']?></td>
                <td class="actions">
                    <a href="update.php?idproduk=<?=$produk['idproduk']?>" class="edit"><i class="fas fa-pen fa-xs"></i></a>
                    <a href="delete.php?idproduk=<?=$produk['idproduk']?>" class="trash"><i class="fas fa-trash fa-xs"></i></a>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
	<div class="pagination">
		<?php if ($page > 1): ?>
		<a href="produk.php?page=<?=$page-1?>"><i class="fas fa-angle-double-left fa-sm"></i></a>
		<?php endif; ?>
		<?php if ($page*$records_per_page < $num_produk): ?>
		<a href="produk.php?page=<?=$page+1?>"><i class="fas fa-angle-double-right fa-sm"></i></a>
		<?php endif; ?>
	</div>
</div>

<?=template_footer()?>