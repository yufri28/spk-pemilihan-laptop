<?php 

require_once '../../config.php';

class Kriteria{

    private $db;

    public function __construct()
    {
        $this->db = connectDatabase();
    }

    public function getKriteria()
    {
        return $this->db->query("SELECT * FROM `kriteria`");
    }

}
$Kriteria = new Kriteria();
$dataKriteria = $Kriteria->getKriteria();
$kriteria = array();

foreach ($dataKriteria as $key => $kri) {
    array_push($kriteria,$kri['nama_kriteria']);
}

// $kriteria = ["Harga", "Kualitas", "Volume", "Kelengkapan", "Merek"];

if(isset($_POST['prioritas_1'])){
    echo "<option value=''>-- Pilih prioritas 2 --</option>";
    $selectedOptions = $_POST['prioritas_1']; 
    $filteredOptions = array_diff($kriteria, $selectedOptions);
    foreach ($filteredOptions as $option) {
        echo "<option value='$option'>$option</option>";
    }
}

if(isset($_POST['prioritas_2'])){
    echo "<option value=''>-- Pilih prioritas 3 --</option>";
    $selectedOptions = $_POST['prioritas_2']; 
    $filteredOptions = array_diff($kriteria, $selectedOptions);
    foreach ($filteredOptions as $option) {
        echo "<option value='$option'>$option</option>";
    }
}
if(isset($_POST['prioritas_3'])){
    echo "<option value=''>-- Pilih prioritas 4 -</option>";
    $selectedOptions = $_POST['prioritas_3']; 
    $filteredOptions = array_diff($kriteria, $selectedOptions);
    foreach ($filteredOptions as $option) {
        echo "<option value='$option'>$option</option>";
    }
}
if(isset($_POST['prioritas_4'])){
    echo "<option value=''>-- Pilih prioritas 5 --</option>";
    $selectedOptions = $_POST['prioritas_4']; 
    $filteredOptions = array_diff($kriteria, $selectedOptions);
    foreach ($filteredOptions as $option) {
        echo "<option value='$option'>$option</option>";
    }
}
if(isset($_POST['prioritas_5'])){
    echo "<option value=''>-- Pilih prioritas 6 --</option>";
    $selectedOptions = $_POST['prioritas_5']; 
    $filteredOptions = array_diff($kriteria, $selectedOptions);
    foreach ($filteredOptions as $option) {
        echo "<option value='$option'>$option</option>";
    }
}
if(isset($_POST['prioritas_6'])){
    echo "<option value=''>-- Pilih prioritas 7 --</option>";
    $selectedOptions = $_POST['prioritas_6']; 
    $filteredOptions = array_diff($kriteria, $selectedOptions);
    foreach ($filteredOptions as $option) {
        echo "<option value='$option'>$option</option>";
    }
}
if(isset($_POST['prioritas_7'])){
    echo "<option value=''>-- Pilih prioritas 8 --</option>";
    $selectedOptions = $_POST['prioritas_7']; 
    $filteredOptions = array_diff($kriteria, $selectedOptions);
    foreach ($filteredOptions as $option) {
        echo "<option value='$option'>$option</option>";
    }
}

?>