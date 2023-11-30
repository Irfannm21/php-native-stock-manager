<?php 
// Jalankan init.php untuk autoloader
require 'init.php';

// Buat Koneksi ke databse
$DB = DB::getInstance();

if(!empty($_GET)) {
    // jika terdeteksi form di submit, maka tampilkan hasil pencarian
    $tabelBarang = $DB->getLike('barang','nama_barang',
                    '%'.Input::get('search') . "%");
} else {
    // jika form tidak di submit, ambil semua isi tabel barang
    $tabelBarang = $DB->Get('barang');
}

/// include head
include 'template/header.php'
?>

<div class="container">
    <div class="row">
        <div class="col-12">
            <!-- Form Pencarian -->

            <div class="py-4 d-flex justify-content-end align-items-center">
                <h1 class="h2 mr-auto">
                    <a href="tampil_barang.php" class="text-info">
                        Tabel Barang
                    </a>
                </h1>
                    <form method="get" class="w-25 ml-4">
                        <div class="input-group">
                            <input type="text" class="form-control" placeholder="Search" name="Search">
                            <div class="input-group-append">
                                <input type="submit" class="btn btn-outline-secondary" value="cari">
                            </div>
                        </div>
                    </form>
            </div>
            <?php if(!empty($tabelBarang)) :  ?>
                <table class="table table-stripped">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Nama</th>
                            <th>Jumlah</th>
                            <th>Harga</th>
                            <th>Tanggal Update</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                       <?php 
                            foreach($tabelBarang as $value) {
                            echo '<tr>';
                            echo  "<td>{$value->id_barang}</td>";
                            echo  "<td>{$value->nama_barang}</td>";
                            echo  "<td>{$value->jumlah_barang}</td>";
                            echo  "<td>".number_format($value->harga_barang,0,',','.')."</td>";
                            $tanggal = new Datetime($value->tanggal_update);
                            echo  "<td>{$tanggal->format('d-m-Y H:i')}</td>";
                            echo  "<td>";
                            echo "<a href='\edit_barang.php?id_barang={$value->id_barang}\"class=\"btn btn-info\">Edit</a>";
                            echo "<a href='\hapus_barang.php?id_barang={$value->id_barang}\"class=\"btn btn-danger\">Hapus</a>";
                            echo  "</td>";
                            echo '</tr>';
                            }
                       ?>   
                    </tbody>
                </table>

                <?php 
                    endif;
                ?>
        </div>
    </div>
</div>

<?php
    include 'template/footer.php';
?>