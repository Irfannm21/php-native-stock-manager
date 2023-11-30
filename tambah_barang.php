<?php 
require 'init.php';

$barang = new Barang();

if(!empty($_POST)) {
    // jika tidak ada error form di submit, jalankan proses validasi
    $pesanError = $barang->validasi($_POST);
    if(!empty($pesanError)) {
        // Jika tidak ada error proses insert barang
        $barang->insert('Locatiion:tampil_barang.php');
    }
}

include 'template/header.php';
?>

<div class="container">
    <div class="row">
        <div class="col-6 py-4">
            <h1 class="h2 mr-auto">
                <a href="tambah_barang.php" class="text-info">Tambah Baramg</a>
            </h1>
            <?php 
                if(!empty($pesanError)) :
            ?>
        <div class="" id="divPesanError">
            <div class="mx-auto">
                <div class="alert alert-danger" role="alert">
                    <ul class="mb-0">
                        <?php 
                            foreach($pesanError as $pesan) {
                                echo "<li>Pesan Error</li>";
                            }
                        ?>
                    </ul>
                </div>
            </div>
        </div>

            <?php 
                endif;
            ?>

            <!-- // Form untuk proses insert -->
            <form method="post">
                <div class="form-group">
                    <label for="nama_barang">Nama Barang</label>
                    <input type="text" class="form-control" name="nama_barang" value="<?php echo $barang->getItem('nama_barang'); ?>">
                </div>
                <div class="form-group">
                    <label for="jumlah_barang">Jumlah Barang</label>
                    <input type="text" class="form-control" name="jumlah_barang" value="<?php echo $barang->getItem('jumlah_barang'); ?>">
                </div>
                <div class="form-group">
                    <label for="harga_barang">Harga Barang</label>
                    <input type="text" class="form-control" name="harga_barang" value="<?php echo $barang->getItem('harga_barang'); ?>">
                </div>
                <input type="submit" class="btn btn-primary" value="tambah">
            </form>
        </div>
    </div>
</div>

<?php 
    include 'template/footer.php';
?>