<?php 
session_start();
unset($_SESSION['menu']);
$_SESSION['menu'] = 'referensi';
require_once './header.php';
require_once './functions/alternatif.php';

$dataAlternatif = $getDataAlternatif->getDataAlternatif();
if(isset($_POST['simpan'])){
    $namaAlternatif = htmlspecialchars($_POST['nama_alternatif']);
    $latitude = htmlspecialchars($_POST['latitude']);
    $longitude = htmlspecialchars($_POST['longitude']);
    $alamat = htmlspecialchars($_POST['alamat']);

    $data = [
        'nama_alternatif' => $namaAlternatif,
        'latitude' =>$latitude,
        'longitude' => $longitude,
        'alamat' => $alamat
    ];

    $getDataAlternatif->tambahAlternatif($data);
}   

if(isset($_POST['hapus'])){
    $idAlternatif = htmlspecialchars($_POST['id_alternatif']);
    $getDataAlternatif->hapusAlternatif($idAlternatif);
}
?>
<div class="row">
    <!-- Area Chart -->
    <!-- Button trigger modal -->
    <div class="col-lg-12">
        <div class="card">
            <!-- <div class="card-header">
                Featured
            </div> -->
            <div class="card-body">
                <!-- DataTales Example -->
                <div class="card shadow mb-4">
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-primary">Daftar Laptop</h6>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered nowrap" id="dataLaptop" style="width:100%"
                                cellspacing="0">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Nama Laptop</th>
                                        <th>Gambar</th>
                                        <th>Kategori</th>
                                        <th>RAM</th>
                                        <th>Merk Procesor</th>
                                        <th>Harga</th>
                                        <th>Ukuran Penyimpanan</th>
                                        <th>Jenis Penyimpanan</th>
                                        <th>Sistem Operasi</th>
                                        <th>Daya Tahan Baterai</th>
                                        <th>Ukuran Layar</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($dataAlternatif as $key => $alternatif):?>
                                    <tr>
                                        <td><?=$key+1?></td>
                                        <td><?=$alternatif['nama_alternatif'];?></td>
                                        <td><a href="../images/<?=$alternatif['gambar'];?>" data-lightbox="image-1"
                                                data-title="<?=$alternatif['nama_alternatif'];?>">
                                                <img style="width: 50px; height: 50px;"
                                                    src="../images/<?=$alternatif['gambar'];?>"
                                                    alt="Gambar <?=$alternatif['nama_alternatif'];?>">
                                            </a></td>
                                        <td><?=$alternatif['nama_kategori'];?></td>
                                        <td><?=$alternatif['nama_C1'];?></td>
                                        <td><?=$alternatif['nama_C2'];?></td>
                                        <td><?=$alternatif['nama_C3'];?></td>
                                        <td><?=$alternatif['nama_C4'];?></td>
                                        <td><?=$alternatif['nama_C5'];?></td>
                                        <td><?=$alternatif['nama_C6'];?></td>
                                        <td><?=$alternatif['nama_C7'];?></td>
                                        <td><?=$alternatif['nama_C8'];?></td>
                                    </tr>
                                    <?php endforeach;?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php require_once './footer.php';?>