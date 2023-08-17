<?php 
session_start();
unset($_SESSION['menu']);
$_SESSION['menu'] = 'index';
?>
<?php require './header.php';?>
<div class="row">
    <!-- Area Chart -->
    <div class="col-lg-12">
        <div class="card shadow mb-4">
            <!-- Card Header - Dropdown -->
            <div class="card-header py-4 d-flex flex-row align-items-center justify-content-between">
                <div class="justify-content-center text-center p-5">
                    <h5 class="text-center mb-5">
                        SISTEM PENDUKUNG KEPUTUSAN PEMILIHAN LAPTOP
                    </h5>
                    <p>
                        Sistem pendukung keputusan (SPK) adalah sistem informasi terkomputerisasi yang menghasilkan
                        berbagai
                        alternatif keputusan untuk membantu manajemen dalam mengatasi berbagai masalah yang terstruktur
                        maupun tidak terstruktur dengan menggunakan data dan model (Pratiwi, 2016). SPK adalah sistem
                        yang mampu memberikan keterampilan pemecahan masalah dan keterampilan komunikasi untuk masalah
                        dengan kondisi semi terstruktur dan tidak terstruktur (Limbong et al, 2020).
                    </p>
                </div>
            </div>
        </div>
    </div>
</div>

<?php require './footer.php';?>