<?php 
session_start();
unset($_SESSION['menu']);
$_SESSION['menu'] = 'laptop';
require_once './header.php';
require_once './functions/data_laptop.php';
$dataAlternatif = $Laptop->getLaptop();
$dataSubRAM = $Laptop->getSubRAM();
$dataSubProsesor = $Laptop->getSubProsesor();
$dataSubHarga = $Laptop->getSubHarga();
$dataSubUkuranPenyimpanan = $Laptop->getSubUkuranPenyimpanan();
$dataSubJenisPenyimpanan = $Laptop->getSubJenisPenyimpanan();
$dataSubSistemOperasi = $Laptop->getSubSistemOperasi();
$dataSubDayaTahanBaterai = $Laptop->getSubDayaTahanBaterai();
$dataSubUkuranLayar = $Laptop->getSubUkuranLayar();
$dataKategori = $Laptop->getKategori();

// tambah alternatif/laptop
if(isset($_POST['tambah'])){
    $nama_alternatif = htmlspecialchars($_POST['nama_alternatif']);
    
    // Pastikan ada file gambar yang diunggah
    if (isset($_FILES['gambar']) && $_FILES['gambar']['error'] === UPLOAD_ERR_OK) {
        $namaFile = $_FILES['gambar']['name'];
        $lokasiSementara = $_FILES['gambar']['tmp_name'];
        
        // Tentukan lokasi tujuan penyimpanan
        $targetDir = '../images/';
        $targetFilePath = $targetDir . $namaFile;

        // Cek apakah nama file sudah ada dalam direktori target
        if (file_exists($targetFilePath)) {
            $fileInfo = pathinfo($namaFile);
            $baseName = $fileInfo['filename'];
            $extension = $fileInfo['extension'];
            $counter = 1;

            // Loop hingga menemukan nama file yang unik
            while (file_exists($targetFilePath)) {
                $namaFile = $baseName . '_' . $counter . '.' . $extension;
                $targetFilePath = $targetDir . $namaFile;
                $counter++;
            }
        }

        // Pindahkan file gambar dari lokasi sementara ke lokasi tujuan
        if (move_uploaded_file($lokasiSementara, $targetFilePath)) {
            $ram = htmlspecialchars($_POST['ram']);
            $prosesor = htmlspecialchars($_POST['prosesor']);
            $harga = htmlspecialchars($_POST['harga']);
            $ukuran_penyimpanan = htmlspecialchars($_POST['ukuran_penyimpanan']);
            $jenis_penyimpanan = htmlspecialchars($_POST['jenis_penyimpanan']);
            $sistem_operasi = htmlspecialchars($_POST['sistem_operasi']);
            $daya_tahan = htmlspecialchars($_POST['daya_tahan']);
            $ukuran_layar = htmlspecialchars($_POST['ukuran_layar']);
            $kategori = htmlspecialchars($_POST['kategori']);
        
            $dataLaptop = [
                'nama_alternatif' => $nama_alternatif,
                'gambar' => $namaFile,
                'ram' => $ram,
                'prosesor' => $prosesor,
                'harga' => $harga,
                'ukuran_penyimpanan' => $ukuran_penyimpanan,
                'jenis_penyimpanan' => $jenis_penyimpanan,
                'sistem_operasi' => $sistem_operasi,
                'daya_tahan' => $daya_tahan,
                'ukuran_layar' => $ukuran_layar,
                'kategori' => $kategori
            ];
            
            $dataKecAltKrit = [
                'C1' => $ram,
                'C2' => $prosesor,
                'C3' => $harga,
                'C4' => $ukuran_penyimpanan,
                'C5' => $jenis_penyimpanan,
                'C6' => $sistem_operasi,
                'C7' => $daya_tahan,
                'C8' => $ukuran_layar
            ];
            $Laptop->addDataLaptop($dataLaptop,$dataKecAltKrit);
        } else {
            return $_SESSION['error'] = 'Tidak ada data yang dikirim!';
        }
    } else {
        return $_SESSION['error'] = 'Tidak ada data yang dikirim!';
    }    
}

// edit alternatif/Laptop
if(isset($_POST['edit'])){
    $id_alternatif = htmlspecialchars($_POST['id_alternatif']);
    $nama_alternatif = htmlspecialchars($_POST['nama_alternatif']);
    $ram = htmlspecialchars($_POST['ram']);
    $prosesor = htmlspecialchars($_POST['prosesor']);
    $harga = htmlspecialchars($_POST['harga']);
    $ukuran_penyimpanan = htmlspecialchars($_POST['ukuran_penyimpanan']);
    $jenis_penyimpanan = htmlspecialchars($_POST['jenis_penyimpanan']);
    $sistem_operasi = htmlspecialchars($_POST['sistem_operasi']);
    $daya_tahan = htmlspecialchars($_POST['daya_tahan']);
    $ukuran_layar = htmlspecialchars($_POST['ukuran_layar']);
    $kategori = htmlspecialchars($_POST['kategori']);

    // Pastikan ada file gambar yang diunggah
    if (isset($_FILES['gambar']) && $_FILES['gambar']['error'] === UPLOAD_ERR_OK) {
        $namaFile = $_FILES['gambar']['name'];
        $lokasiSementara = $_FILES['gambar']['tmp_name'];
        
        // Tentukan lokasi tujuan penyimpanan
        $targetDir = '../images/';
        $targetFilePath = $targetDir . $namaFile;

        // Cek apakah nama file sudah ada dalam direktori target
        if (file_exists($targetFilePath)) {
            $fileInfo = pathinfo($namaFile);
            $baseName = $fileInfo['filename'];
            $extension = $fileInfo['extension'];
            $counter = 1;

            // Loop hingga menemukan nama file yang unik
            while (file_exists($targetFilePath)) {
                $namaFile = $baseName . '_' . $counter . '.' . $extension;
                $targetFilePath = $targetDir . $namaFile;
                $counter++;
            }
        }

        // Pindahkan file gambar dari lokasi sementara ke lokasi tujuan
        if (move_uploaded_file($lokasiSementara, $targetFilePath)) {
            // Hapus file gambar lama jika ada
            $gambarLama = $_POST['gambar_lama'];
            $pathGambarLama = $targetDir . $gambarLama;
            if (file_exists($pathGambarLama) && is_file($pathGambarLama)) {
                unlink($pathGambarLama); // Hapus file gambar lama
            }

            // $ram = htmlspecialchars($_POST['ram']);
            // $prosesor = htmlspecialchars($_POST['prosesor']);
            // $harga = htmlspecialchars($_POST['harga']);
            // $ukuran_penyimpanan = htmlspecialchars($_POST['ukuran_penyimpanan']);
            // $jenis_penyimpanan = htmlspecialchars($_POST['jenis_penyimpanan']);
            // $sistem_operasi = htmlspecialchars($_POST['sistem_operasi']);
            // $daya_tahan = htmlspecialchars($_POST['daya_tahan']);
            // $ukuran_layar = htmlspecialchars($_POST['ukuran_layar']);
            // $kategori = htmlspecialchars($_POST['kategori']);
        
            $dataLaptop = [
                'id_alternatif' => $id_alternatif,
                'nama_alternatif' => $nama_alternatif,
                'gambar' => $namaFile,
                'ram' => $ram,
                'prosesor' => $prosesor,
                'harga' => $harga,
                'ukuran_penyimpanan' => $ukuran_penyimpanan,
                'jenis_penyimpanan' => $jenis_penyimpanan,
                'sistem_operasi' => $sistem_operasi,
                'daya_tahan' => $daya_tahan,
                'ukuran_layar' => $ukuran_layar,
                'kategori' => $kategori
            ];
            
            $dataKecAltKrit = [
                'C1' => $ram,
                'C2' => $prosesor,
                'C3' => $harga,
                'C4' => $ukuran_penyimpanan,
                'C5' => $jenis_penyimpanan,
                'C6' => $sistem_operasi,
                'C7' => $daya_tahan,
                'C8' => $ukuran_layar
            ];
            $Laptop->editDataLaptop($dataLaptop,$dataKecAltKrit);
        } else {
            return $_SESSION['error'] = 'Tidak ada data yang dikirim!';
        }
    } else {
        // $harga = htmlspecialchars($_POST['harga']);
        // $kualitas = htmlspecialchars($_POST['kualitas']);
        // $volume = htmlspecialchars($_POST['volume']);
        // $kelengkapan = htmlspecialchars($_POST['kelengkapan']);
        // $merek = htmlspecialchars($_POST['merek']);
    
        $dataLaptop = [
            'id_alternatif' => $id_alternatif,
            'nama_alternatif' => $nama_alternatif,
            'gambar' => $_POST['gambar_lama'],
            'ram' => $ram,
            'prosesor' => $prosesor,
            'harga' => $harga,
            'ukuran_penyimpanan' => $ukuran_penyimpanan,
            'jenis_penyimpanan' => $jenis_penyimpanan,
            'sistem_operasi' => $sistem_operasi,
            'daya_tahan' => $daya_tahan,
            'ukuran_layar' => $ukuran_layar,
            'kategori' => $kategori
        ];
        
        $dataKecAltKrit = [
            'C1' => $ram,
            'C2' => $prosesor,
            'C3' => $harga,
            'C4' => $ukuran_penyimpanan,
            'C5' => $jenis_penyimpanan,
            'C6' => $sistem_operasi,
            'C7' => $daya_tahan,
            'C8' => $ukuran_layar
        ];
        $Laptop->editDataLaptop($dataLaptop,$dataKecAltKrit);
    }
}

if(isset($_POST['hapus'])){
    $id_alternatif = htmlspecialchars($_POST['id_alternatif']);
    $Laptop->hapusDataLaptop($id_alternatif);
}

?>
<?php if (isset($_SESSION['success'])): ?>
<script>
var successfuly = '<?php echo $_SESSION["success"]; ?>';
Swal.fire({
    title: 'Sukses!',
    text: successfuly,
    icon: 'success',
    confirmButtonText: 'OK'
}).then(function(result) {
    if (result.isConfirmed) {
        window.location.href = '';
    }
});
</script>
<?php unset($_SESSION['success']); // Menghapus session setelah ditampilkan ?>
<?php endif; ?>
<?php if (isset($_SESSION['error'])): ?>
<script>
Swal.fire({
    title: 'Error!',
    text: '<?php echo $_SESSION['error']; ?>',
    icon: 'error',
    confirmButtonText: 'OK'
}).then(function(result) {
    if (result.isConfirmed) {
        window.location.href = '';
    }
});
</script>
<?php unset($_SESSION['error']); // Menghapus session setelah ditampilkan ?>
<?php endif; ?>
<div class="row">
    <!-- Area Chart -->
    <!-- Button trigger modal -->
    <div class="col-lg-12">
        <button type="button" class="btn btn-primary mb-3" data-toggle="modal" data-target="#exampleModal">
            + Tambah data
        </button>
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
                                        <th>Aksi</th>
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
                                        <td>
                                            <button data-toggle="modal"
                                                data-target="#edit<?=$alternatif['id_alternatif'];?>" type="button"
                                                class="btn btn-sm btn-primary">Edit</button>
                                            <button data-toggle="modal"
                                                data-target="#hapus<?=$alternatif['id_alternatif'];?>" type="button"
                                                class="btn btn-sm btn-danger">Hapus</button>
                                        </td>
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

<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Tambah Data</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form method="post" action="" enctype="multipart/form-data">
                <div class="modal-body">
                    <div class="card-body">
                        <small class="text-danger">(*) Wajib</small>
                        <div class="">
                            <label for="exampleFormControlInput1" class="form-label">Nama Alternatif <small
                                    class="text-danger">*</small></label>
                            <input type="text" class="form-control" required name="nama_alternatif"
                                id="exampleFormControlInput1" placeholder="Nama Alternatif" />
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="">
                            <label for="gambar" class="form-label">Gambar <small class="text-danger">*</small></label>
                            <input type="file" accept=".jpg, .jpeg, .png" class="form-control" name="gambar" id="gambar"
                                required placeholder="Gambar" />
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="">
                            <label for="kategori" class="form-label">Kategori <small
                                    class="text-danger">*</small></label>
                            <select class="form-control" name="kategori" required aria-label="Default select example">
                                <option value="">-- Pilih --</option>
                                <?php foreach ($dataKategori as $key => $kategori):?>
                                <option value="<?=$kategori['id_kategori'];?>"><?=$kategori['nama_kategori'];?></option>
                                <?php endforeach;?>
                            </select>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="">
                            <label for="ram" class="form-label">RAM <small class="text-danger">*</small></label>
                            <select class="form-control" name="ram" required aria-label="Default select example">
                                <option value="">-- Pilih --</option>
                                <?php foreach ($dataSubRAM as $key => $ram):?>
                                <option value="<?=$ram['id_sub_kriteria'];?>">
                                    <?=$ram['nama_sub_kriteria'];?></option>
                                <?php endforeach;?>
                            </select>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="">
                            <label for="prosesor" class="form-label">Merk Prosesor <small
                                    class="text-danger">*</small></label>
                            <select class="form-control" name="prosesor" required aria-label="Default select example">
                                <option value="">-- Pilih --</option>
                                <?php foreach ($dataSubProsesor as $key => $prosesor):?>
                                <option value="<?=$prosesor['id_sub_kriteria'];?>">
                                    <?=$prosesor['nama_sub_kriteria'];?></option>
                                <?php endforeach;?>
                            </select>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="">
                            <label for="harga" class="form-label">Harga <small class="text-danger">*</small></label>
                            <select class="form-control" name="harga" required aria-label="Default select example">
                                <option value="">-- Pilih --</option>
                                <?php foreach ($dataSubHarga as $key => $harga):?>
                                <option value="<?=$harga['id_sub_kriteria'];?>">
                                    <?=$harga['nama_sub_kriteria'];?></option>
                                <?php endforeach;?>
                            </select>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="">
                            <label for="ukuran_penyimpanan" class="form-label">Ukuran Penyimpanan <small
                                    class="text-danger">*</small></label>
                            <select class="form-control" name="ukuran_penyimpanan" required
                                aria-label="Default select example">
                                <option value="">-- Pilih --</option>
                                <?php foreach ($dataSubUkuranPenyimpanan as $key => $ukuran_penyimpanan):?>
                                <option value="<?=$ukuran_penyimpanan['id_sub_kriteria'];?>">
                                    <?=$ukuran_penyimpanan['nama_sub_kriteria'];?></option>
                                <?php endforeach;?>
                            </select>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="">
                            <label for="jenis_penyimpanan" class="form-label">Jenis Penyimpanan <small
                                    class="text-danger">*</small></label>
                            <select class="form-control" name="jenis_penyimpanan" required
                                aria-label="Default select example">
                                <option value="">-- Pilih --</option>
                                <?php foreach ($dataSubJenisPenyimpanan as $key => $jenis_penyimpanan):?>
                                <option value="<?=$jenis_penyimpanan['id_sub_kriteria'];?>">
                                    <?=$jenis_penyimpanan['nama_sub_kriteria'];?></option>
                                <?php endforeach;?>
                            </select>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="">
                            <label for="sistem_operasi" class="form-label">Sistem Operasi <small
                                    class="text-danger">*</small></label>
                            <select class="form-control" name="sistem_operasi" required
                                aria-label="Default select example">
                                <option value="">-- Pilih --</option>
                                <?php foreach ($dataSubSistemOperasi as $key => $sistem_operasi):?>
                                <option value="<?=$sistem_operasi['id_sub_kriteria'];?>">
                                    <?=$sistem_operasi['nama_sub_kriteria'];?></option>
                                <?php endforeach;?>
                            </select>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="">
                            <label for="daya_tahan" class="form-label">Daya Tahan Baterai <small
                                    class="text-danger">*</small></label>
                            <select class="form-control" name="daya_tahan" required aria-label="Default select example">
                                <option value="">-- Pilih --</option>
                                <?php foreach ($dataSubDayaTahanBaterai as $key => $daya_tahan):?>
                                <option value="<?=$daya_tahan['id_sub_kriteria'];?>">
                                    <?=$daya_tahan['nama_sub_kriteria'];?></option>
                                <?php endforeach;?>
                            </select>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="">
                            <label for="ukuran_layar" class="form-label">Ukuran Layar <small
                                    class="text-danger">*</small></label>
                            <select class="form-control" name="ukuran_layar" required
                                aria-label="Default select example">
                                <option value="">-- Pilih --</option>
                                <?php foreach ($dataSubUkuranLayar as $key => $ukuran_layar):?>
                                <option value="<?=$ukuran_layar['id_sub_kriteria'];?>">
                                    <?=$ukuran_layar['nama_sub_kriteria'];?></option>
                                <?php endforeach;?>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Kembali</button>
                    <button type="submit" name="tambah" class="btn btn-primary">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>

<?php foreach ($dataAlternatif as $alternatif):?>
<div class="modal fade" id="edit<?=$alternatif['id_alternatif'];?>" tabindex="-1" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form method="post" action="" enctype="multipart/form-data">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Edit Data</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <input type="hidden" name="id_alternatif" value="<?=$alternatif['id_alternatif'];?>">
                <div class="modal-body">
                    <div class="card-body">
                        <small class="text-danger">(*) Wajib</small>
                        <div class="">
                            <label for="exampleFormControlInput1" class="form-label">Nama Alternatif <small
                                    class="text-danger">*</small></label>
                            <input type="text" class="form-control" required name="nama_alternatif"
                                value="<?=$alternatif['nama_alternatif'];?>" id="exampleFormControlInput1"
                                placeholder="Nama Alternatif" />
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="">
                            <input type="hidden" name="gambar_lama" value="<?=$alternatif['gambar'];?>">
                            <label for="gambar" class="form-label">Gambar</label>
                            <input type="file" accept=".jpg, .jpeg, .png" class="form-control"
                                value="<?=$alternatif['gambar'];?>" name="gambar" id="gambar" placeholder="Gambar" />
                            <small><i>Jika gambar tidak diubah, maka tidak perlu diupload lagi.</i></small>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="">
                            <label for="kategori" class="form-label">Kategori <small
                                    class="text-danger">*</small></label>
                            <select class="form-control" name="kategori" required aria-label="Default select example">
                                <option value="">-- Pilih --</option>
                                <?php foreach ($dataKategori as $key => $kategori):?>
                                <option <?=$kategori['id_kategori'] == $alternatif['f_id_kategori'] ? 'selected':'';?>
                                    value="<?=$kategori['id_kategori'];?>"><?=$kategori['nama_kategori'];?></option>
                                <?php endforeach;?>
                            </select>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="">
                            <label for="ram" class="form-label">RAM <small class="text-danger">*</small></label>
                            <select class="form-control" name="ram" required aria-label="Default select example">
                                <option value="">-- Pilih --</option>
                                <?php foreach ($dataSubRAM as $key => $ram):?>
                                <option <?= $ram['id_sub_kriteria'] == $alternatif['id_sub_C1'] ? 'selected':'';?>
                                    value="<?=$ram['id_sub_kriteria'];?>">
                                    <?=$ram['nama_sub_kriteria'];?></option>
                                <?php endforeach;?>
                            </select>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="">
                            <label for="prosesor" class="form-label">Merk Prosesor <small
                                    class="text-danger">*</small></label>
                            <select class="form-control" name="prosesor" required aria-label="Default select example">
                                <option value="">-- Pilih --</option>
                                <?php foreach ($dataSubProsesor as $key => $prosesor):?>
                                <option <?= $prosesor['id_sub_kriteria'] == $alternatif['id_sub_C2'] ? 'selected':'';?>
                                    value="<?=$prosesor['id_sub_kriteria'];?>">
                                    <?=$prosesor['nama_sub_kriteria'];?></option>
                                <?php endforeach;?>
                            </select>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="">
                            <label for="harga" class="form-label">Harga <small class="text-danger">*</small></label>
                            <select class="form-control" name="harga" required aria-label="Default select example">
                                <option value="">-- Pilih --</option>
                                <?php foreach ($dataSubHarga as $key => $harga):?>
                                <option <?= $harga['id_sub_kriteria'] == $alternatif['id_sub_C3'] ? 'selected':'';?>
                                    value="<?=$harga['id_sub_kriteria'];?>">
                                    <?=$harga['nama_sub_kriteria'];?></option>
                                <?php endforeach;?>
                            </select>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="">
                            <label for="ukuran_penyimpanan" class="form-label">Ukuran Penyimpanan <small
                                    class="text-danger">*</small></label>
                            <select class="form-control" name="ukuran_penyimpanan" required
                                aria-label="Default select example">
                                <option value="">-- Pilih --</option>
                                <?php foreach ($dataSubUkuranPenyimpanan as $key => $ukuran_penyimpanan):?>
                                <option
                                    <?= $ukuran_penyimpanan['id_sub_kriteria'] == $alternatif['id_sub_C4'] ? 'selected':'';?>
                                    value="<?=$ukuran_penyimpanan['id_sub_kriteria'];?>">
                                    <?=$ukuran_penyimpanan['nama_sub_kriteria'];?></option>
                                <?php endforeach;?>
                            </select>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="">
                            <label for="jenis_penyimpanan" class="form-label">Jenis Penyimpanan <small
                                    class="text-danger">*</small></label>
                            <select class="form-control" name="jenis_penyimpanan" required
                                aria-label="Default select example">
                                <option value="">-- Pilih --</option>
                                <?php foreach ($dataSubJenisPenyimpanan as $key => $jenis_penyimpanan):?>
                                <option
                                    <?= $jenis_penyimpanan['id_sub_kriteria'] == $alternatif['id_sub_C5'] ? 'selected':'';?>
                                    value="<?=$jenis_penyimpanan['id_sub_kriteria'];?>">
                                    <?=$jenis_penyimpanan['nama_sub_kriteria'];?></option>
                                <?php endforeach;?>
                            </select>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="">
                            <label for="sistem_operasi" class="form-label">Sistem Operasi <small
                                    class="text-danger">*</small></label>
                            <select class="form-control" name="sistem_operasi" required
                                aria-label="Default select example">
                                <option value="">-- Pilih --</option>
                                <?php foreach ($dataSubSistemOperasi as $key => $sistem_operasi):?>
                                <option
                                    <?= $sistem_operasi['id_sub_kriteria'] == $alternatif['id_sub_C6'] ? 'selected':'';?>
                                    value="<?=$sistem_operasi['id_sub_kriteria'];?>">
                                    <?=$sistem_operasi['nama_sub_kriteria'];?></option>
                                <?php endforeach;?>
                            </select>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="">
                            <label for="daya_tahan" class="form-label">Daya Tahan Baterai <small
                                    class="text-danger">*</small></label>
                            <select class="form-control" name="daya_tahan" required aria-label="Default select example">
                                <option value="">-- Pilih --</option>
                                <?php foreach ($dataSubDayaTahanBaterai as $key => $daya_tahan):?>
                                <option
                                    <?= $daya_tahan['id_sub_kriteria'] == $alternatif['id_sub_C7'] ? 'selected':'';?>
                                    value="<?=$daya_tahan['id_sub_kriteria'];?>">
                                    <?=$daya_tahan['nama_sub_kriteria'];?></option>
                                <?php endforeach;?>
                            </select>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="">
                            <label for="ukuran_layar" class="form-label">Ukuran Layar <small
                                    class="text-danger">*</small></label>
                            <select class="form-control" name="ukuran_layar" required
                                aria-label="Default select example">
                                <option value="">-- Pilih --</option>
                                <?php foreach ($dataSubUkuranLayar as $key => $ukuran_layar):?>
                                <option
                                    <?= $ukuran_layar['id_sub_kriteria'] == $alternatif['id_sub_C8'] ? 'selected':'';?>
                                    value="<?=$ukuran_layar['id_sub_kriteria'];?>">
                                    <?=$ukuran_layar['nama_sub_kriteria'];?></option>
                                <?php endforeach;?>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Kembali</button>
                    <button type="submit" name="edit" class="btn btn-primary">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>
<?php endforeach;?>
<?php foreach ($dataAlternatif as $alternatif):?>
<div class="modal fade" id="hapus<?=$alternatif['id_alternatif'];?>" tabindex="-1" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form method="post" action="">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Hapus Data</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <input type="hidden" name="id_alternatif" value="<?=$alternatif['id_alternatif'];?>">
                <div class="modal-body">
                    <p>Anda yakin ingin menghapus alternatif <strong>
                            <?=$alternatif['nama_alternatif'];?></strong> ?</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Kembali</button>
                    <button type="submit" name="hapus" class="btn btn-primary">Hapus</button>
                </div>
            </form>
        </div>
    </div>
</div>
<?php endforeach;?>
<?php require_once './footer.php';?>