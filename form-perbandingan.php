<?php
require_once "./config.php";


$data = $koneksi->query("SELECT * FROM kriteria ORDER BY id_kriteria");


$array = array();

while ($row = mysqli_fetch_assoc($data)) {
    $array[] = $row['nama_kriteria'];
}

// init k
$k = 0;


if ($_SERVER['REQUEST_METHOD'] == 'POST') {
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
    
    // for ($i = 0; $i <= (count($array) - 2); $i++) {
	// 	for ($j = ($i + 1); $j <= (count($array) - 1); $j++) {
    //         echo $matrik[$i][$j]." ";
          
	// 	}
    //     echo "<br>";
	// }
    // for ($i = 0; $i <= (count($array) - 2); $i++) {
	// 	for ($j = ($i + 1); $j <= (count($array) - 1); $j++) {
           
    //         echo $matrik[$j][$i]." ";
	// 	}
    //     echo "<br>";
	// }

    // for ($i = 0; $i < (count($array)); $i++) {
	// 	for ($j = 0; $j < (count($array)); $j++) {
           
    //         echo $matrik[$i][$j]." ";
	// 	}
    //     echo "<br>";
	// }

 


    // for ($i = 0; $i < (count($array)); $i++) {
	// 	for ($j = 0; $j < (count($array)); $j++) {
           
    //         echo $matrik[$i][$j]." ";
	// 	}
    //     echo "<br>";
	// }

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

		// // memasukkan nilai priority vektor ke dalam tabel pv_kriteria dan pv_alternatif
		// if ($jenis == 'kriteria') {
		// 	$id_kriteria = getKriteriaID($x);
		// 	inputKriteriaPV($id_kriteria,$pv[$x]);
		// } else {
		// 	$id_kriteria	= getKriteriaID($jenis-1);
		// 	$id_alternatif	= getAlternatifID($x);
		// 	inputAlternatifPV($id_alternatif,$id_kriteria,$pv[$x]);
		// }
	}

    for ($x=0; $x < (count($matrik)) ; $x++) {
        echo ($x+1) ." : ". $pv[$x];
        echo "<br>";
    }
    die;
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



<!DOCTYPE html>
<html>

<head>
    <title>SPK Pemilihan Laptop</title>
    <style>
    #mapid {
        height: 100vh;
    }
    </style>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous" />
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
        href="https://fonts.googleapis.com/css2?family=Manrope:wght@400;700;800&family=Prompt&family=Righteous&family=Roboto:wght@500&display=swap"
        rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
    <style>
    .button-like-link {
        background: none;
        border: none;
        color: blue;
        /* Warna teks mirip tautan */
        text-decoration: none;
        /* Garis bawah mirip tautan */
        cursor: pointer;
        /* Jika ingin menyesuaikan tampilan saat digerakkan mouse */
    }

    .button-like-link:hover {
        text-decoration: none;
        /* Menghilangkan garis bawah saat digerakkan mouse */
        /* Sesuaikan tampilan hover sesuai keinginan */
    }

    table {
        font-size: 10pt;
    }

    ol {
        text-align: start;
    }
    </style>
</head>

<body>
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
    <!-- Section: Design Block -->
    <section class="">
        <!-- Jumbotron -->
        <div class="px-5 py-5 px-md-5 text-center text-lg-start" style="background-color: hsl(0, 0%, 96%);">
            <div class="container">
                <div class="row gx-lg-5 justify-content-center align-items-center">
                    <div class="col-lg-8 mb-1 mt-4 mb-lg-0">
                        <form method="post">
                            <div class="card">
                                <div class="card-header bg-white">
                                    <h4>Perbandingan Kriteria</h4>
                                </div>
                                <div class="card-body shadow-lg d-flex justify-content-center py-5 px-md-5">
                                    <div class="container">
                                        <button type="button" id="btn-like-link"
                                            class="button-like-link col-lg-12 mb-4 d-flex justify-content-end"><small
                                                class="">Baca Panduan?</small></button>
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
                                                            <input class="form-check-input" type="radio"
                                                                name="opsi<?= $k ?>" id="flexRadioDefault<?= $k ?>"
                                                                value="1">
                                                            <label class="form-check-label"
                                                                for="flexRadioDefault<?= $k ?>">
                                                                <?= $array[$i]; ?>
                                                            </label>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <div class="form-check">
                                                            <input class="form-check-input" type="radio"
                                                                name="opsi<?= $k ?>" value="2"
                                                                id="flexRadioDefaults<?= $k ?>">
                                                            <label class="form-check-label"
                                                                for="flexRadioDefaults<?= $k ?>">
                                                                <?= $array[$j]; ?>
                                                            </label>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <div class="mb-3">
                                                            <input class="form-control" type="number" placeholder="0"
                                                                name="bobot<?php echo $k;?>"
                                                                value="<?php echo $nilai ?>" max="9" required>
                                                        </div>
                                                    </td>
                                                </tr>
                                                <?php endfor; ?>
                                                <?php endfor; ?>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                                <div class="card-footer text-end bg-white">
                                    <button type="submit" class="btn btn-primary">Submit</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <!-- Jumbotron -->
    </section>
    <footer class="bg-white text-center text-lg-start">
        <!-- Copyright -->
        <div class="text-center p-3" style="background-color: #F0F0F0;">
            © 2023 Copyright:
            <a class="text-dark" href="https://www.instagram.com/ilkom19_unc/">Intel'19</a>
        </div>
        <!-- Copyright -->
    </footer>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous">
    </script>

</body>

</html>