<?php 
    // session_start();
    require_once '../config.php';
    class Hasil{

        private $db;

        public function __construct()
        {
            $this->db = connectDatabase();
        }

        public function getDataPreferensi($id_user=null)
        {
            return $this->db->query("SELECT a.nama_alternatif, a.id_alternatif, a.gambar, a.f_id_kategori, ka.nama_kategori,
            MAX(CASE WHEN k.id_kriteria = 'C1' THEN sk.nama_sub_kriteria END) AS nama_C1,
            MAX(CASE WHEN k.id_kriteria = 'C2' THEN sk.nama_sub_kriteria END) AS nama_C2,
            MAX(CASE WHEN k.id_kriteria = 'C3' THEN sk.nama_sub_kriteria END) AS nama_C3,
            MAX(CASE WHEN k.id_kriteria = 'C4' THEN sk.nama_sub_kriteria END) AS nama_C4,
            MAX(CASE WHEN k.id_kriteria = 'C5' THEN sk.nama_sub_kriteria END) AS nama_C5,
            MAX(CASE WHEN k.id_kriteria = 'C6' THEN sk.nama_sub_kriteria END) AS nama_C6,
            MAX(CASE WHEN k.id_kriteria = 'C7' THEN sk.nama_sub_kriteria END) AS nama_C7,
            MAX(CASE WHEN k.id_kriteria = 'C8' THEN sk.nama_sub_kriteria END) AS nama_C8,
            
            (SELECT (C1/(C1+C2+C3+C4+C5+C6+C7+C8)) FROM bobot_kriteria WHERE f_id_user=$id_user) AS bobotC1,
            (SELECT (C2/(C1+C2+C3+C4+C5+C6+C7+C8)) FROM bobot_kriteria WHERE f_id_user=$id_user) AS bobotC2,
            (SELECT (C3/(C1+C2+C3+C4+C5+C6+C7+C8)) FROM bobot_kriteria WHERE f_id_user=$id_user) AS bobotC3,
            (SELECT (C4/(C1+C2+C3+C4+C5+C6+C7+C8)) FROM bobot_kriteria WHERE f_id_user=$id_user) AS bobotC4,
            (SELECT (C5/(C1+C2+C3+C4+C5+C6+C7+C8)) FROM bobot_kriteria WHERE f_id_user=$id_user) AS bobotC5,
            (SELECT (C6/(C1+C2+C3+C4+C5+C6+C7+C8)) FROM bobot_kriteria WHERE f_id_user=$id_user) AS bobotC6,
            (SELECT (C7/(C1+C2+C3+C4+C5+C6+C7+C8)) FROM bobot_kriteria WHERE f_id_user=$id_user) AS bobotC7,
            (SELECT (C8/(C1+C2+C3+C4+C5+C6+C7+C8)) FROM bobot_kriteria WHERE f_id_user=$id_user) AS bobotC8,
            
            
            (MAX(CASE WHEN k.id_kriteria = 'C1' THEN sk.bobot_sub_kriteria END) - (SELECT MIN(CASE WHEN k.id_kriteria = 'C1' THEN sk.bobot_sub_kriteria END)
            FROM alternatif a
            JOIN kec_alt_kriteria kak ON a.id_alternatif = kak.f_id_alternatif
            JOIN sub_kriteria sk ON kak.f_id_sub_kriteria = sk.id_sub_kriteria
            JOIN kriteria k ON kak.f_id_kriteria = k.id_kriteria))/((SELECT MAX(CASE WHEN k.id_kriteria = 'C1' THEN sk.bobot_sub_kriteria END)
            FROM alternatif a
            JOIN kec_alt_kriteria kak ON a.id_alternatif = kak.f_id_alternatif
            JOIN sub_kriteria sk ON kak.f_id_sub_kriteria = sk.id_sub_kriteria
            JOIN kriteria k ON kak.f_id_kriteria = k.id_kriteria) - (SELECT MIN(CASE WHEN k.id_kriteria = 'C1' THEN sk.bobot_sub_kriteria END)
            FROM alternatif a
            JOIN kec_alt_kriteria kak ON a.id_alternatif = kak.f_id_alternatif
            JOIN sub_kriteria sk ON kak.f_id_sub_kriteria = sk.id_sub_kriteria
            JOIN kriteria k ON kak.f_id_kriteria = k.id_kriteria)) AS utilitas_C1,
            
            (MAX(CASE WHEN k.id_kriteria = 'C2' THEN sk.bobot_sub_kriteria END) - (SELECT MIN(CASE WHEN k.id_kriteria = 'C2' THEN sk.bobot_sub_kriteria END)
            FROM alternatif a
            JOIN kec_alt_kriteria kak ON a.id_alternatif = kak.f_id_alternatif
            JOIN sub_kriteria sk ON kak.f_id_sub_kriteria = sk.id_sub_kriteria
            JOIN kriteria k ON kak.f_id_kriteria = k.id_kriteria))/((SELECT MAX(CASE WHEN k.id_kriteria = 'C2' THEN sk.bobot_sub_kriteria END)
            FROM alternatif a
            JOIN kec_alt_kriteria kak ON a.id_alternatif = kak.f_id_alternatif
            JOIN sub_kriteria sk ON kak.f_id_sub_kriteria = sk.id_sub_kriteria
            JOIN kriteria k ON kak.f_id_kriteria = k.id_kriteria) - (SELECT MIN(CASE WHEN k.id_kriteria = 'C2' THEN sk.bobot_sub_kriteria END)
            FROM alternatif a
            JOIN kec_alt_kriteria kak ON a.id_alternatif = kak.f_id_alternatif
            JOIN sub_kriteria sk ON kak.f_id_sub_kriteria = sk.id_sub_kriteria
            JOIN kriteria k ON kak.f_id_kriteria = k.id_kriteria)) AS utilitas_C2,
            
            (MAX(CASE WHEN k.id_kriteria = 'C3' THEN sk.bobot_sub_kriteria END) - (SELECT MIN(CASE WHEN k.id_kriteria = 'C3' THEN sk.bobot_sub_kriteria END)
            FROM alternatif a
            JOIN kec_alt_kriteria kak ON a.id_alternatif = kak.f_id_alternatif
            JOIN sub_kriteria sk ON kak.f_id_sub_kriteria = sk.id_sub_kriteria
            JOIN kriteria k ON kak.f_id_kriteria = k.id_kriteria))/((SELECT MAX(CASE WHEN k.id_kriteria = 'C3' THEN sk.bobot_sub_kriteria END)
            FROM alternatif a
            JOIN kec_alt_kriteria kak ON a.id_alternatif = kak.f_id_alternatif
            JOIN sub_kriteria sk ON kak.f_id_sub_kriteria = sk.id_sub_kriteria
            JOIN kriteria k ON kak.f_id_kriteria = k.id_kriteria) - (SELECT MIN(CASE WHEN k.id_kriteria = 'C3' THEN sk.bobot_sub_kriteria END)
            FROM alternatif a
            JOIN kec_alt_kriteria kak ON a.id_alternatif = kak.f_id_alternatif
            JOIN sub_kriteria sk ON kak.f_id_sub_kriteria = sk.id_sub_kriteria
            JOIN kriteria k ON kak.f_id_kriteria = k.id_kriteria)) AS utilitas_C3,
            
            (MAX(CASE WHEN k.id_kriteria = 'C4' THEN sk.bobot_sub_kriteria END) - (SELECT MIN(CASE WHEN k.id_kriteria = 'C4' THEN sk.bobot_sub_kriteria END)
            FROM alternatif a
            JOIN kec_alt_kriteria kak ON a.id_alternatif = kak.f_id_alternatif
            JOIN sub_kriteria sk ON kak.f_id_sub_kriteria = sk.id_sub_kriteria
            JOIN kriteria k ON kak.f_id_kriteria = k.id_kriteria))/((SELECT MAX(CASE WHEN k.id_kriteria = 'C4' THEN sk.bobot_sub_kriteria END)
            FROM alternatif a
            JOIN kec_alt_kriteria kak ON a.id_alternatif = kak.f_id_alternatif
            JOIN sub_kriteria sk ON kak.f_id_sub_kriteria = sk.id_sub_kriteria
            JOIN kriteria k ON kak.f_id_kriteria = k.id_kriteria) - (SELECT MIN(CASE WHEN k.id_kriteria = 'C4' THEN sk.bobot_sub_kriteria END)
            FROM alternatif a
            JOIN kec_alt_kriteria kak ON a.id_alternatif = kak.f_id_alternatif
            JOIN sub_kriteria sk ON kak.f_id_sub_kriteria = sk.id_sub_kriteria
            JOIN kriteria k ON kak.f_id_kriteria = k.id_kriteria)) AS utilitas_C4,
            
            (MAX(CASE WHEN k.id_kriteria = 'C5' THEN sk.bobot_sub_kriteria END) - (SELECT MIN(CASE WHEN k.id_kriteria = 'C5' THEN sk.bobot_sub_kriteria END)
            FROM alternatif a
            JOIN kec_alt_kriteria kak ON a.id_alternatif = kak.f_id_alternatif
            JOIN sub_kriteria sk ON kak.f_id_sub_kriteria = sk.id_sub_kriteria
            JOIN kriteria k ON kak.f_id_kriteria = k.id_kriteria))/((SELECT MAX(CASE WHEN k.id_kriteria = 'C5' THEN sk.bobot_sub_kriteria END)
            FROM alternatif a
            JOIN kec_alt_kriteria kak ON a.id_alternatif = kak.f_id_alternatif
            JOIN sub_kriteria sk ON kak.f_id_sub_kriteria = sk.id_sub_kriteria
            JOIN kriteria k ON kak.f_id_kriteria = k.id_kriteria) - (SELECT MIN(CASE WHEN k.id_kriteria = 'C5' THEN sk.bobot_sub_kriteria END)
            FROM alternatif a
            JOIN kec_alt_kriteria kak ON a.id_alternatif = kak.f_id_alternatif
            JOIN sub_kriteria sk ON kak.f_id_sub_kriteria = sk.id_sub_kriteria
            JOIN kriteria k ON kak.f_id_kriteria = k.id_kriteria)) AS utilitas_C5,

            (MAX(CASE WHEN k.id_kriteria = 'C6' THEN sk.bobot_sub_kriteria END) - (SELECT MIN(CASE WHEN k.id_kriteria = 'C6' THEN sk.bobot_sub_kriteria END)
            FROM alternatif a
            JOIN kec_alt_kriteria kak ON a.id_alternatif = kak.f_id_alternatif
            JOIN sub_kriteria sk ON kak.f_id_sub_kriteria = sk.id_sub_kriteria
            JOIN kriteria k ON kak.f_id_kriteria = k.id_kriteria))/((SELECT MAX(CASE WHEN k.id_kriteria = 'C6' THEN sk.bobot_sub_kriteria END)
            FROM alternatif a
            JOIN kec_alt_kriteria kak ON a.id_alternatif = kak.f_id_alternatif
            JOIN sub_kriteria sk ON kak.f_id_sub_kriteria = sk.id_sub_kriteria
            JOIN kriteria k ON kak.f_id_kriteria = k.id_kriteria) - (SELECT MIN(CASE WHEN k.id_kriteria = 'C6' THEN sk.bobot_sub_kriteria END)
            FROM alternatif a
            JOIN kec_alt_kriteria kak ON a.id_alternatif = kak.f_id_alternatif
            JOIN sub_kriteria sk ON kak.f_id_sub_kriteria = sk.id_sub_kriteria
            JOIN kriteria k ON kak.f_id_kriteria = k.id_kriteria)) AS utilitas_C6,

            (MAX(CASE WHEN k.id_kriteria = 'C7' THEN sk.bobot_sub_kriteria END) - (SELECT MIN(CASE WHEN k.id_kriteria = 'C7' THEN sk.bobot_sub_kriteria END)
            FROM alternatif a
            JOIN kec_alt_kriteria kak ON a.id_alternatif = kak.f_id_alternatif
            JOIN sub_kriteria sk ON kak.f_id_sub_kriteria = sk.id_sub_kriteria
            JOIN kriteria k ON kak.f_id_kriteria = k.id_kriteria))/((SELECT MAX(CASE WHEN k.id_kriteria = 'C7' THEN sk.bobot_sub_kriteria END)
            FROM alternatif a
            JOIN kec_alt_kriteria kak ON a.id_alternatif = kak.f_id_alternatif
            JOIN sub_kriteria sk ON kak.f_id_sub_kriteria = sk.id_sub_kriteria
            JOIN kriteria k ON kak.f_id_kriteria = k.id_kriteria) - (SELECT MIN(CASE WHEN k.id_kriteria = 'C7' THEN sk.bobot_sub_kriteria END)
            FROM alternatif a
            JOIN kec_alt_kriteria kak ON a.id_alternatif = kak.f_id_alternatif
            JOIN sub_kriteria sk ON kak.f_id_sub_kriteria = sk.id_sub_kriteria
            JOIN kriteria k ON kak.f_id_kriteria = k.id_kriteria)) AS utilitas_C7,

            (MAX(CASE WHEN k.id_kriteria = 'C8' THEN sk.bobot_sub_kriteria END) - (SELECT MIN(CASE WHEN k.id_kriteria = 'C8' THEN sk.bobot_sub_kriteria END)
            FROM alternatif a
            JOIN kec_alt_kriteria kak ON a.id_alternatif = kak.f_id_alternatif
            JOIN sub_kriteria sk ON kak.f_id_sub_kriteria = sk.id_sub_kriteria
            JOIN kriteria k ON kak.f_id_kriteria = k.id_kriteria))/((SELECT MAX(CASE WHEN k.id_kriteria = 'C8' THEN sk.bobot_sub_kriteria END)
            FROM alternatif a
            JOIN kec_alt_kriteria kak ON a.id_alternatif = kak.f_id_alternatif
            JOIN sub_kriteria sk ON kak.f_id_sub_kriteria = sk.id_sub_kriteria
            JOIN kriteria k ON kak.f_id_kriteria = k.id_kriteria) - (SELECT MIN(CASE WHEN k.id_kriteria = 'C8' THEN sk.bobot_sub_kriteria END)
            FROM alternatif a
            JOIN kec_alt_kriteria kak ON a.id_alternatif = kak.f_id_alternatif
            JOIN sub_kriteria sk ON kak.f_id_sub_kriteria = sk.id_sub_kriteria
            JOIN kriteria k ON kak.f_id_kriteria = k.id_kriteria)) AS utilitas_C8,
            
            ((SELECT (C1/(C1+C2+C3+C4+C5+C6+C7+C8)) FROM bobot_kriteria WHERE f_id_user=$id_user) * (MAX(CASE WHEN k.id_kriteria = 'C1' THEN sk.bobot_sub_kriteria END) - (SELECT MIN(CASE WHEN k.id_kriteria = 'C1' THEN sk.bobot_sub_kriteria END)
            FROM alternatif a
            JOIN kec_alt_kriteria kak ON a.id_alternatif = kak.f_id_alternatif
            JOIN sub_kriteria sk ON kak.f_id_sub_kriteria = sk.id_sub_kriteria
            JOIN kriteria k ON kak.f_id_kriteria = k.id_kriteria))/((SELECT MAX(CASE WHEN k.id_kriteria = 'C1' THEN sk.bobot_sub_kriteria END)
            FROM alternatif a
            JOIN kec_alt_kriteria kak ON a.id_alternatif = kak.f_id_alternatif
            JOIN sub_kriteria sk ON kak.f_id_sub_kriteria = sk.id_sub_kriteria
            JOIN kriteria k ON kak.f_id_kriteria = k.id_kriteria) - (SELECT MIN(CASE WHEN k.id_kriteria = 'C1' THEN sk.bobot_sub_kriteria END)
            FROM alternatif a
            JOIN kec_alt_kriteria kak ON a.id_alternatif = kak.f_id_alternatif
            JOIN sub_kriteria sk ON kak.f_id_sub_kriteria = sk.id_sub_kriteria
            JOIN kriteria k ON kak.f_id_kriteria = k.id_kriteria))) + 
            ((SELECT (C2/(C1+C2+C3+C4+C5+C6+C7+C8)) FROM bobot_kriteria WHERE f_id_user=$id_user) * (MAX(CASE WHEN k.id_kriteria = 'C2' THEN sk.bobot_sub_kriteria END) - (SELECT MIN(CASE WHEN k.id_kriteria = 'C2' THEN sk.bobot_sub_kriteria END)
            FROM alternatif a
            JOIN kec_alt_kriteria kak ON a.id_alternatif = kak.f_id_alternatif
            JOIN sub_kriteria sk ON kak.f_id_sub_kriteria = sk.id_sub_kriteria
            JOIN kriteria k ON kak.f_id_kriteria = k.id_kriteria))/((SELECT MAX(CASE WHEN k.id_kriteria = 'C2' THEN sk.bobot_sub_kriteria END)
            FROM alternatif a
            JOIN kec_alt_kriteria kak ON a.id_alternatif = kak.f_id_alternatif
            JOIN sub_kriteria sk ON kak.f_id_sub_kriteria = sk.id_sub_kriteria
            JOIN kriteria k ON kak.f_id_kriteria = k.id_kriteria) - (SELECT MIN(CASE WHEN k.id_kriteria = 'C2' THEN sk.bobot_sub_kriteria END)
            FROM alternatif a
            JOIN kec_alt_kriteria kak ON a.id_alternatif = kak.f_id_alternatif
            JOIN sub_kriteria sk ON kak.f_id_sub_kriteria = sk.id_sub_kriteria
            JOIN kriteria k ON kak.f_id_kriteria = k.id_kriteria))) +
            ((SELECT (C3/(C1+C2+C3+C4+C5+C6+C7+C8)) FROM bobot_kriteria WHERE f_id_user=$id_user) * (MAX(CASE WHEN k.id_kriteria = 'C3' THEN sk.bobot_sub_kriteria END) - (SELECT MIN(CASE WHEN k.id_kriteria = 'C3' THEN sk.bobot_sub_kriteria END)
            FROM alternatif a
            JOIN kec_alt_kriteria kak ON a.id_alternatif = kak.f_id_alternatif
            JOIN sub_kriteria sk ON kak.f_id_sub_kriteria = sk.id_sub_kriteria
            JOIN kriteria k ON kak.f_id_kriteria = k.id_kriteria))/((SELECT MAX(CASE WHEN k.id_kriteria = 'C3' THEN sk.bobot_sub_kriteria END)
            FROM alternatif a
            JOIN kec_alt_kriteria kak ON a.id_alternatif = kak.f_id_alternatif
            JOIN sub_kriteria sk ON kak.f_id_sub_kriteria = sk.id_sub_kriteria
            JOIN kriteria k ON kak.f_id_kriteria = k.id_kriteria) - (SELECT MIN(CASE WHEN k.id_kriteria = 'C3' THEN sk.bobot_sub_kriteria END)
            FROM alternatif a
            JOIN kec_alt_kriteria kak ON a.id_alternatif = kak.f_id_alternatif
            JOIN sub_kriteria sk ON kak.f_id_sub_kriteria = sk.id_sub_kriteria
            JOIN kriteria k ON kak.f_id_kriteria = k.id_kriteria))) +
            ((SELECT (C4/(C1+C2+C3+C4+C5+C6+C7+C8)) FROM bobot_kriteria WHERE f_id_user=$id_user) * (MAX(CASE WHEN k.id_kriteria = 'C4' THEN sk.bobot_sub_kriteria END) - (SELECT MIN(CASE WHEN k.id_kriteria = 'C4' THEN sk.bobot_sub_kriteria END)
            FROM alternatif a
            JOIN kec_alt_kriteria kak ON a.id_alternatif = kak.f_id_alternatif
            JOIN sub_kriteria sk ON kak.f_id_sub_kriteria = sk.id_sub_kriteria
            JOIN kriteria k ON kak.f_id_kriteria = k.id_kriteria))/((SELECT MAX(CASE WHEN k.id_kriteria = 'C4' THEN sk.bobot_sub_kriteria END)
            FROM alternatif a
            JOIN kec_alt_kriteria kak ON a.id_alternatif = kak.f_id_alternatif
            JOIN sub_kriteria sk ON kak.f_id_sub_kriteria = sk.id_sub_kriteria
            JOIN kriteria k ON kak.f_id_kriteria = k.id_kriteria) - (SELECT MIN(CASE WHEN k.id_kriteria = 'C4' THEN sk.bobot_sub_kriteria END)
            FROM alternatif a
            JOIN kec_alt_kriteria kak ON a.id_alternatif = kak.f_id_alternatif
            JOIN sub_kriteria sk ON kak.f_id_sub_kriteria = sk.id_sub_kriteria
            JOIN kriteria k ON kak.f_id_kriteria = k.id_kriteria))) + 
            ((SELECT (C5/(C1+C2+C3+C4+C5+C6+C7+C8)) FROM bobot_kriteria WHERE f_id_user=$id_user) * (MAX(CASE WHEN k.id_kriteria = 'C5' THEN sk.bobot_sub_kriteria END) - (SELECT MIN(CASE WHEN k.id_kriteria = 'C5' THEN sk.bobot_sub_kriteria END)
            FROM alternatif a
            JOIN kec_alt_kriteria kak ON a.id_alternatif = kak.f_id_alternatif
            JOIN sub_kriteria sk ON kak.f_id_sub_kriteria = sk.id_sub_kriteria
            JOIN kriteria k ON kak.f_id_kriteria = k.id_kriteria))/((SELECT MAX(CASE WHEN k.id_kriteria = 'C5' THEN sk.bobot_sub_kriteria END)
            FROM alternatif a
            JOIN kec_alt_kriteria kak ON a.id_alternatif = kak.f_id_alternatif
            JOIN sub_kriteria sk ON kak.f_id_sub_kriteria = sk.id_sub_kriteria
            JOIN kriteria k ON kak.f_id_kriteria = k.id_kriteria) - (SELECT MIN(CASE WHEN k.id_kriteria = 'C5' THEN sk.bobot_sub_kriteria END)
            FROM alternatif a
            JOIN kec_alt_kriteria kak ON a.id_alternatif = kak.f_id_alternatif
            JOIN sub_kriteria sk ON kak.f_id_sub_kriteria = sk.id_sub_kriteria
            JOIN kriteria k ON kak.f_id_kriteria = k.id_kriteria))) + 
            ((SELECT (C6/(C1+C2+C3+C4+C5+C6+C7+C8)) FROM bobot_kriteria WHERE f_id_user=$id_user) * (MAX(CASE WHEN k.id_kriteria = 'C6' THEN sk.bobot_sub_kriteria END) - (SELECT MIN(CASE WHEN k.id_kriteria = 'C6' THEN sk.bobot_sub_kriteria END)
            FROM alternatif a
            JOIN kec_alt_kriteria kak ON a.id_alternatif = kak.f_id_alternatif
            JOIN sub_kriteria sk ON kak.f_id_sub_kriteria = sk.id_sub_kriteria
            JOIN kriteria k ON kak.f_id_kriteria = k.id_kriteria))/((SELECT MAX(CASE WHEN k.id_kriteria = 'C6' THEN sk.bobot_sub_kriteria END)
            FROM alternatif a
            JOIN kec_alt_kriteria kak ON a.id_alternatif = kak.f_id_alternatif
            JOIN sub_kriteria sk ON kak.f_id_sub_kriteria = sk.id_sub_kriteria
            JOIN kriteria k ON kak.f_id_kriteria = k.id_kriteria) - (SELECT MIN(CASE WHEN k.id_kriteria = 'C6' THEN sk.bobot_sub_kriteria END)
            FROM alternatif a
            JOIN kec_alt_kriteria kak ON a.id_alternatif = kak.f_id_alternatif
            JOIN sub_kriteria sk ON kak.f_id_sub_kriteria = sk.id_sub_kriteria
            JOIN kriteria k ON kak.f_id_kriteria = k.id_kriteria))) + 
            ((SELECT (C7/(C1+C2+C3+C4+C5+C6+C7+C8)) FROM bobot_kriteria WHERE f_id_user=$id_user) * (MAX(CASE WHEN k.id_kriteria = 'C7' THEN sk.bobot_sub_kriteria END) - (SELECT MIN(CASE WHEN k.id_kriteria = 'C7' THEN sk.bobot_sub_kriteria END)
            FROM alternatif a
            JOIN kec_alt_kriteria kak ON a.id_alternatif = kak.f_id_alternatif
            JOIN sub_kriteria sk ON kak.f_id_sub_kriteria = sk.id_sub_kriteria
            JOIN kriteria k ON kak.f_id_kriteria = k.id_kriteria))/((SELECT MAX(CASE WHEN k.id_kriteria = 'C7' THEN sk.bobot_sub_kriteria END)
            FROM alternatif a
            JOIN kec_alt_kriteria kak ON a.id_alternatif = kak.f_id_alternatif
            JOIN sub_kriteria sk ON kak.f_id_sub_kriteria = sk.id_sub_kriteria
            JOIN kriteria k ON kak.f_id_kriteria = k.id_kriteria) - (SELECT MIN(CASE WHEN k.id_kriteria = 'C7' THEN sk.bobot_sub_kriteria END)
            FROM alternatif a
            JOIN kec_alt_kriteria kak ON a.id_alternatif = kak.f_id_alternatif
            JOIN sub_kriteria sk ON kak.f_id_sub_kriteria = sk.id_sub_kriteria
            JOIN kriteria k ON kak.f_id_kriteria = k.id_kriteria))) + 
            ((SELECT (C8/(C1+C2+C3+C4+C5+C6+C7+C8)) FROM bobot_kriteria WHERE f_id_user=$id_user) * (MAX(CASE WHEN k.id_kriteria = 'C8' THEN sk.bobot_sub_kriteria END) - (SELECT MIN(CASE WHEN k.id_kriteria = 'C8' THEN sk.bobot_sub_kriteria END)
            FROM alternatif a
            JOIN kec_alt_kriteria kak ON a.id_alternatif = kak.f_id_alternatif
            JOIN sub_kriteria sk ON kak.f_id_sub_kriteria = sk.id_sub_kriteria
            JOIN kriteria k ON kak.f_id_kriteria = k.id_kriteria))/((SELECT MAX(CASE WHEN k.id_kriteria = 'C8' THEN sk.bobot_sub_kriteria END)
            FROM alternatif a
            JOIN kec_alt_kriteria kak ON a.id_alternatif = kak.f_id_alternatif
            JOIN sub_kriteria sk ON kak.f_id_sub_kriteria = sk.id_sub_kriteria
            JOIN kriteria k ON kak.f_id_kriteria = k.id_kriteria) - (SELECT MIN(CASE WHEN k.id_kriteria = 'C8' THEN sk.bobot_sub_kriteria END)
            FROM alternatif a
            JOIN kec_alt_kriteria kak ON a.id_alternatif = kak.f_id_alternatif
            JOIN sub_kriteria sk ON kak.f_id_sub_kriteria = sk.id_sub_kriteria
            JOIN kriteria k ON kak.f_id_kriteria = k.id_kriteria))) AS preferensi
            FROM alternatif a
            JOIN kategori_alt ka ON ka.id_kategori=a.f_id_kategori
            JOIN kec_alt_kriteria kak ON a.id_alternatif = kak.f_id_alternatif
            JOIN sub_kriteria sk ON kak.f_id_sub_kriteria = sk.id_sub_kriteria
            JOIN kriteria k ON kak.f_id_kriteria = k.id_kriteria
            GROUP BY a.nama_alternatif ORDER BY preferensi DESC;");
        }        
    }

    $getDataHasil = new Hasil();
?>