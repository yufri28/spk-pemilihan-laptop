<?php 
    // session_start();
    require_once '../config.php';
    class Alternatif{

        private $db;

        public function __construct()
        {
            $this->db = connectDatabase();
        }

        public function getDataAlternatif()
        {
            return $this->db->query("SELECT a.nama_alternatif, a.id_alternatif, a.gambar, a.f_id_kategori, ka.id_kategori, ka.nama_kategori, kak.id_alt_kriteria,
                MAX(CASE WHEN k.id_kriteria = 'C1' THEN kak.id_alt_kriteria END) AS id_alt_C1,
                MIN(CASE WHEN k.id_kriteria = 'C2' THEN kak.id_alt_kriteria END) AS id_alt_C2,
                MIN(CASE WHEN k.id_kriteria = 'C3' THEN kak.id_alt_kriteria END) AS id_alt_C3,
                MAX(CASE WHEN k.id_kriteria = 'C4' THEN kak.id_alt_kriteria END) AS id_alt_C4,
                MAX(CASE WHEN k.id_kriteria = 'C5' THEN kak.id_alt_kriteria END) AS id_alt_C5,
                MIN(CASE WHEN k.id_kriteria = 'C6' THEN kak.id_alt_kriteria END) AS id_alt_C6,
                MAX(CASE WHEN k.id_kriteria = 'C7' THEN kak.id_alt_kriteria END) AS id_alt_C7,
                MAX(CASE WHEN k.id_kriteria = 'C8' THEN kak.id_alt_kriteria END) AS id_alt_C8,
                MAX(CASE WHEN k.id_kriteria = 'C1' THEN kak.f_id_sub_kriteria END) AS id_sub_C1,
                MIN(CASE WHEN k.id_kriteria = 'C2' THEN kak.f_id_sub_kriteria END) AS id_sub_C2,
                MIN(CASE WHEN k.id_kriteria = 'C3' THEN kak.f_id_sub_kriteria END) AS id_sub_C3,
                MAX(CASE WHEN k.id_kriteria = 'C4' THEN kak.f_id_sub_kriteria END) AS id_sub_C4,
                MAX(CASE WHEN k.id_kriteria = 'C5' THEN kak.f_id_sub_kriteria END) AS id_sub_C5,
                MIN(CASE WHEN k.id_kriteria = 'C6' THEN kak.f_id_sub_kriteria END) AS id_sub_C6,
                MAX(CASE WHEN k.id_kriteria = 'C7' THEN kak.f_id_sub_kriteria END) AS id_sub_C7,
                MAX(CASE WHEN k.id_kriteria = 'C8' THEN kak.f_id_sub_kriteria END) AS id_sub_C8,
                MAX(CASE WHEN k.id_kriteria = 'C1' THEN sk.nama_sub_kriteria END) AS nama_C1,
                MIN(CASE WHEN k.id_kriteria = 'C2' THEN sk.nama_sub_kriteria END) AS nama_C2,
                MIN(CASE WHEN k.id_kriteria = 'C3' THEN sk.nama_sub_kriteria END) AS nama_C3,
                MAX(CASE WHEN k.id_kriteria = 'C4' THEN sk.nama_sub_kriteria END) AS nama_C4,
                MAX(CASE WHEN k.id_kriteria = 'C5' THEN sk.nama_sub_kriteria END) AS nama_C5,
                MIN(CASE WHEN k.id_kriteria = 'C6' THEN sk.nama_sub_kriteria END) AS nama_C6,
                MAX(CASE WHEN k.id_kriteria = 'C7' THEN sk.nama_sub_kriteria END) AS nama_C7,
                MAX(CASE WHEN k.id_kriteria = 'C8' THEN sk.nama_sub_kriteria END) AS nama_C8
                FROM alternatif a
                JOIN kategori_alt ka ON a.f_id_kategori = ka.id_kategori
                JOIN kec_alt_kriteria kak ON a.id_alternatif = kak.f_id_alternatif
                JOIN sub_kriteria sk ON kak.f_id_sub_kriteria = sk.id_sub_kriteria
                JOIN kriteria k ON kak.f_id_kriteria = k.id_kriteria
                GROUP BY a.nama_alternatif ORDER BY a.id_alternatif DESC;
            ");
        }
    }

    $getDataAlternatif = new Alternatif();
?>