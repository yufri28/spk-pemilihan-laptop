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
    echo "<pre>";
    print_r($_POST);
    echo "</pre>";
    die;
}
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
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous" />
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link href="https://fonts.googleapis.com/css2?family=Manrope:wght@400;700;800&family=Prompt&family=Righteous&family=Roboto:wght@500&display=swap" rel="stylesheet" />
</head>

<body>
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
                                                                    <input class="form-check-input" type="radio" name="opsi<?= $k ?>" id="flexRadioDefault<?= $k ?>">
                                                                    <label class="form-check-label" for="flexRadioDefault<?= $k ?>">
                                                                        <?= $array[$i]; ?>
                                                                    </label>
                                                                </div>
                                                            </td>
                                                            <td>
                                                                <div class="form-check">
                                                                    <input class="form-check-input" type="radio" name="opsi<?= $k ?>" id="flexRadioDefaults<?= $k ?>">
                                                                    <label class="form-check-label" for="flexRadioDefaults<?= $k ?>">
                                                                        <?= $array[$j]; ?>
                                                                    </label>
                                                                </div>
                                                            </td>
                                                            <td>
                                                                <div class="mb-3">
                                                                    <input class="form-control" type="number" placeholder="0" name="bobot<?php echo $urut ?>" value="<?php echo $nilai ?>" max="10" required>
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
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous">
    </script>

</body>

</html>