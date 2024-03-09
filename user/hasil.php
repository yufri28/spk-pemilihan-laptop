<?php 
session_start();
unset($_SESSION['menu']);
$_SESSION['menu'] = 'hasil';
require_once './header.php';
require_once './functions/hasil.php';
$c1 = 0;
$c2 = 0;
$c3 = 0;
$c4 = 0;
$c5 = 0;
$c6 = 0;
$c7 = 0;
$c8 = 0;
$C1_ = 0;
$C2_ = 0;
$C3_ = 0;
$C4_ = 0;
$C5_ = 0;
$C6_ = 0;
$C7_ = 0;
$C8_ = 0;
$total_bobot = 0;
$post = false;
$array = array();
// init k
$k = 0;

$data = $koneksi->query("SELECT * FROM kriteria ORDER BY id_kriteria");

while ($row = mysqli_fetch_assoc($data)) {
    $array[] = $row['nama_kriteria'];
}

if($_SERVER['REQUEST_METHOD'] == 'POST'){
    $matrik = array();
	$urut 	= 0;

	for ($i = 0; $i <= (count($array) - 2); $i++) {
		for ($j = ($i + 1); $j <= (count($array) - 1); $j++) {
			$urut++;
			$opsi	= "opsi".$urut;
			$bobot 	= "bobot".$urut;
			if ($_POST[$opsi] == 1) {
				$matrik[$i][$j] = $_POST[$bobot];
				$matrik[$j][$i] = 1 / $_POST[$bobot];
			} else {
				$matrik[$i][$j] = 1 / $_POST[$bobot];
				$matrik[$j][$i] = $_POST[$bobot];
			}
		}
	}

    // diagonal --> bernilai 1
    for ($i = 0; $i <= (count($array) - 1); $i++) {
        $matrik[$i][$i] = 1;
    }
    
    // inisialisasi jumlah tiap kolom dan baris kriteria
	$jmlmpb = array();
	$jmlmnk = array();
	for ($i=0; $i <= (count($matrik) - 1); $i++) {
		$jmlmpb[$i] = 0;
		$jmlmnk[$i] = 0;
	}

	// menghitung jumlah pada kolom kriteria tabel perbandingan berpasangan
	for ($x=0; $x < count($matrik); $x++) {
		for ($y=0; $y < count($matrik) ; $y++) {
			$value		= $matrik[$x][$y];
			$jmlmpb[$y] += $value;
		}
      
	}
    
	// menghitung jumlah pada baris kriteria tabel nilai kriteria
	// matrikb merupakan matrik yang telah dinormalisasi
	for ($x=0; $x <= (count($matrik) - 1) ; $x++) {
		for ($y=0; $y <= (count($matrik) - 1) ; $y++) {
			$matrikb[$x][$y] = $matrik[$x][$y] / $jmlmpb[$y];
			$value	= $matrikb[$x][$y];
			$jmlmnk[$x] += $value;
		}

		// nilai priority vektor
		$pv[$x]	 = $jmlmnk[$x] / count($matrik);

		
	}

    for ($x=0; $x < (count($matrik)) ; $x++) {
        switch ($x) {
            case 0:
                $c1 = $pv[$x];
                break;
            case 1:
                $c2 = $pv[$x];
                break;
            case 2:
                $c3 = $pv[$x];
                break;
            case 3:
                $c4 = $pv[$x];
                break;
            case 4:
                $c5 = $pv[$x];
                break;
            case 5:
                $c6 = $pv[$x];
                break;
            case 6:
                $c7 = $pv[$x];
                break;
            case 7:
                $c8 = $pv[$x];
                break;
        }
    }

   
  
    $dataBobotKriteria = [
        $c1,$c2,$c3,$c4,$c5,$c6,$c7,$c8
    ];
   
    $dataPreferensi = $getDataHasil->getDataPreferensi($c1,$c2,$c3,$c4,$c5,$c6,$c7,$c8);
    $dataPreferensiLimOne = $getDataHasil->getDataPreferensiLimOne($c1,$c2,$c3,$c4,$c5,$c6,$c7,$c8);
    // $simpanRiwayat = $getDataHasil->simpanRiwayat($dataPreferensiLimOne['id_alternatif'],$c1,$c2,$c3,$c4,$c5,$c6,$c7,$c8);
    $post = true;

}else{
    $dataPreferensi = $getDataHasil->getDataPreferensi($c1,$c2,$c3,$c4,$c5,$c6,$c7,$c8);
}
$array_skala = [
    ['nilai' => '1', 'keterangan' => 'Kedua Kriteria sama-sama penting'],
    ['nilai' => '3', 'keterangan' => 'Salah satu Kriteria sedikit lebih penting'],
    ['nilai' => '5', 'keterangan' => 'Salah satu Kriteria lebih penting'],
    ['nilai' => '7', 'keterangan' => 'Salah Kriteria sangat lebih penting'],
    ['nilai' => '9', 'keterangan' => 'Salah Kriteria jauh lebih penting'],
    ['nilai' => '2, 4, 6, 8', 'keterangan' => 'Ragu-ragu antara kedua Kriteria yang dibandingkan']
];

$increament = 0;
$urut = 0;
?>


<?php if (isset($_SESSION['error-bobot'])): ?>
<script>
var errorBobot = '<?php echo $_SESSION["error-bobot"]; ?>';
Swal.fire({
    title: 'Error!',
    text: errorBobot,
    icon: 'error',
    confirmButtonText: 'OK'
}).then(function(result) {
    if (result.isConfirmed) {
        window.location.href = './kriteria.php';
    }
});
</script>
<?php unset($_SESSION['error-bobot']); // Menghapus session setelah ditampilkan ?>
<?php endif; ?>
<style>
table {
    font-size: 10pt;
}

ol {
    text-align: start;
}
</style>
<script>
document.addEventListener('DOMContentLoaded', function() {
    let button_like_link = document.getElementById('btn-like-link');

    button_like_link.addEventListener('click', function() {
        Swal.fire({
            title: 'Panduan',
            text: 'Langkah-langkah pengisian form perbandingan kriteria:',
            icon: 'warning',
            html: `
            <ol>
                <li>Pilih Kriteria yang lebih penting</li>
                <li>Masukkan Nilai perbandingannya berdasarkan tabel berikut:</li>
                <table class="table nowrap">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Nilai Perbandingan</th>
                            <th scope="col">Keterangan</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($array_skala as $key => $value): ?>
                        <tr>
                            <th scope="row"><?=++$increament;?></th>
                            <td><?= $value['nilai'];?></td>
                            <td><?= $value['keterangan'];?></td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
                <li>Klik tombol submit</li>
            </ol>
        `,
            confirmButtonText: 'Paham'
        });

    });
});
</script>
<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-body">
                <div class="alert alert-warning" role="alert">
                    <h4 class="alert-heading text-center">PANDUAN</h4>
                    <ul>
                        <li>
                            <p>Model perengkingan dari sistem ini menggunakan form perbandingan kriteria/spesifikasi
                                laptop,
                                sehingga anda perlu mengisi form perbandingan tersebut. Namun sebelum mengisi form
                                perbandingan, diharapkan membaca panduan pengisian form terlebih dahulu.</p>
                        </li>
                        <li>
                            <p>Jika pada
                                kolom Preferensi semua
                                nilainya 0 atau anda belum mengisi form perbandingan, maka silahkan isi terlebih dahulu
                                dengan mengklik tombol Isi Form.</p>
                        </li>
                        <hr>
                        <div class="d-flex">
                            <button type="button" id="btn-like-link"
                                class="button-like-link mr-2 btn btn-primary mb-4 d-flex justify-content-end"><small
                                    class="">Baca
                                    Panduan</small></button>
                            <button type="button" data-toggle="modal" data-target="#isi-form"
                                class="btn btn-secondary mb-4 d-flex justify-content-end"><small class="">Isi
                                    Form</small></button>
                        </div>
                    </ul>
                </div>
            </div>
            <div class="card-body">
                <div class="card shadow mb-4">
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-primary">Hasil Perengkingan</h6>
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
                                        <th>Harga</th>
                                        <th>Kualitas</th>
                                        <th>Volume</th>
                                        <th>Kelengkapan</th>
                                        <th>Merek</th>
                                        <th class="text-primary">B.RAM</th>
                                        <th class="text-primary">B.Merk Processor</th>
                                        <th class="text-primary">B.Harga</th>
                                        <th class="text-primary">B.Ukuran Penyimpanan</th>
                                        <th class="text-primary">B.Jenis Penyimpanan</th>
                                        <th class="text-primary">B.Sistem Operasi</th>
                                        <th class="text-primary">B.Daya Tahan Baterai</th>
                                        <th class="text-primary">B.Ukuran Layar</th>
                                        <th>Preferensi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($dataPreferensi as $key => $preferensi):?>
                                    <tr>
                                        <td><?=$key+1?></td>
                                        <td><?=$preferensi['nama_alternatif'];?></td>
                                        <td><a href="../images/<?=$preferensi['gambar'];?>" data-lightbox="image-1"
                                                data-title="<?=$preferensi['nama_alternatif'];?>">
                                                <img style="width: 50px; height: 50px;"
                                                    src="../images/<?=$preferensi['gambar'];?>"
                                                    alt="Gambar <?=$preferensi['nama_alternatif'];?>">
                                            </a></td>
                                        <td><?=$preferensi['nama_kategori'];?></td>
                                        <td><?=$preferensi['nama_C1'];?></td>
                                        <td><?=$preferensi['nama_C2'];?></td>
                                        <td><?=$preferensi['nama_C3'];?></td>
                                        <td><?=$preferensi['nama_C4'];?></td>
                                        <td><?=$preferensi['nama_C5'];?></td>
                                        <td><?=$c1;?></td>
                                        <td><?=$c2;?></td>
                                        <td><?=$c3;?></td>
                                        <td><?=$c4;?></td>
                                        <td><?=$c5;?></td>
                                        <td><?=$c6;?></td>
                                        <td><?=$c7;?></td>
                                        <td><?=$c8;?></td>
                                        <td><?=$preferensi['preferensi'] != 0 ? $preferensi['preferensi']:0;?></td>
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
<div class="modal fade" id="isi-form" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form method="post">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Perbandingan Kriteria</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="card-body shadow-lg d-flex justify-content-center py-5 px-md-5">
                        <div class="container">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th scope="col">Pilih yang lebih penting</th>
                                        <th scope="col"></th>
                                        <th scope="col">Nilai Perbandingan</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php for ($i = 0; $i <= (count($array) - 2); $i++) : ?>
                                    <?php for ($j = ($i + 1); $j <= (count($array) - 1); $j++) : ?>
                                    <?php $k++; ?>
                                    <tr>
                                        <td>
                                            <div class="form-check me-3">
                                                <input class="form-check-input" type="radio" name="opsi<?= $k ?>"
                                                    id="flexRadioDefault<?= $k ?>" value="1">
                                                <label class="form-check-label" for="flexRadioDefault<?= $k ?>">
                                                    <?= $array[$i]; ?>
                                                </label>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="opsi<?= $k ?>"
                                                    value="2" id="flexRadioDefaults<?= $k ?>">
                                                <label class="form-check-label" for="flexRadioDefaults<?= $k ?>">
                                                    <?= $array[$j]; ?>
                                                </label>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="mb-3">
                                                <input class="form-control" type="number" placeholder="0"
                                                    name="bobot<?php echo $k;?>" value="<?php echo $nilai ?>" max="9"
                                                    required>
                                            </div>
                                        </td>
                                    </tr>
                                    <?php endfor; ?>
                                    <?php endfor; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Kembali</button>
                    <button type="submit" class="btn btn-primary">Submit</button>
                </div>
            </form>
        </div>
    </div>
</div>
<?php require_once './footer.php';?>