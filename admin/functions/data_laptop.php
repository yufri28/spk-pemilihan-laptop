<?php 

    require_once '../config.php';
    class Laptop{
        private $db;
        public function __construct()
        {
            $this->db = connectDatabase();
        }

        public function getLaptop(){
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
        public function getSubRAM()
        {
           return $this->db->query(
                "SELECT * FROM sub_kriteria WHERE f_id_kriteria = 'C1'"
           );
        }
        public function getSubProsesor()
        {
           return $this->db->query(
                "SELECT * FROM sub_kriteria WHERE f_id_kriteria = 'C2'"
           );
        }
        public function getSubHarga()
        {
           return $this->db->query(
                "SELECT * FROM sub_kriteria WHERE f_id_kriteria = 'C3'"
           );
        }
        public function getSubUkuranPenyimpanan()
        {
           return $this->db->query(
                "SELECT * FROM sub_kriteria WHERE f_id_kriteria = 'C4'"
           );
        }
        public function getSubJenisPenyimpanan()
        {
           return $this->db->query(
                "SELECT * FROM sub_kriteria WHERE f_id_kriteria = 'C5'"
           );
        }
        public function getSubSistemOperasi()
        {
           return $this->db->query(
                "SELECT * FROM sub_kriteria WHERE f_id_kriteria = 'C6'"
           );
        }
        public function getSubDayaTahanBaterai()
        {
           return $this->db->query(
                "SELECT * FROM sub_kriteria WHERE f_id_kriteria = 'C7'"
           );
        }
        public function getSubUkuranLayar()
        {
           return $this->db->query(
                "SELECT * FROM sub_kriteria WHERE f_id_kriteria = 'C8'"
           );
        }
        public function getKategori()
        {
           return $this->db->query("SELECT * FROM kategori_alt");
        }


        // CRUD
        public function addDataLaptop($dataAlternatif = [], $dataKecAltKrit = [])
        {
            if (empty($dataAlternatif) && empty($dataKecAltKrit)) {
                return $_SESSION['error'] = 'Tidak ada data yang dikirim!';
            }

            $nama_alternatif = $dataAlternatif['nama_alternatif'];
            $gambar = $dataAlternatif['gambar'];
            $ram = $dataAlternatif['ram'];
            $prosesor = $dataAlternatif['prosesor'];
            $harga = $dataAlternatif['harga'];
            $ukuran_penyimpanan = $dataAlternatif['ukuran_penyimpanan'];
            $jenis_penyimpanan = $dataAlternatif['jenis_penyimpanan'];
            $sistem_operasi = $dataAlternatif['sistem_operasi'];
            $daya_tahan = $dataAlternatif['daya_tahan'];
            $ukuran_layar = $dataAlternatif['ukuran_layar'];
            $kategori = $dataAlternatif['kategori'];

            $cekData = $this->db->query("SELECT * FROM `alternatif` WHERE LOWER(nama_alternatif) = '" . strtolower($dataAlternatif['nama_alternatif']) . "'");
            if ($cekData->num_rows > 0) {
                return $_SESSION['error'] = 'Data sudah ada!';
            }

            $insertAlternatif = $this->db->query(
                "INSERT INTO alternatif (id_alternatif, nama_alternatif, gambar, f_id_kategori) VALUES (NULL, '$nama_alternatif', '$gambar','$kategori')"
            );

            if ($insertAlternatif) {
                $id_alternatif = $this->db->insert_id;
                foreach ($dataKecAltKrit as $key => $id_sub_kriteria) {
                    $insertKecAltKrit = $this->db->query("INSERT INTO kec_alt_kriteria (id_alt_kriteria, f_id_alternatif, f_id_kriteria, f_id_sub_kriteria) VALUES (NULL, '$id_alternatif', '$key', '$id_sub_kriteria')");
                }
                if ($insertKecAltKrit && $this->db->affected_rows > 0) {
                    return $_SESSION['success'] = 'Data berhasil disimpan!';
                } else {
                    return $_SESSION['error'] = 'Data gagal disimpan!';
                }
            } else {
                return $_SESSION['error'] = 'Data gagal disimpan!';
            }
        }

        public function editDataLaptop($dataAlternatif = [], $dataKecAltKrit = [])
        {
            if (empty($dataAlternatif) && empty($dataKecAltKrit)) {
                return $_SESSION['error'] = 'Tidak ada data yang dikirim!';
            }
            $id_alternatif = $dataAlternatif['id_alternatif'];
            $nama_alternatif = $dataAlternatif['nama_alternatif'];
            $gambar = $dataAlternatif['gambar'];
            $ram = $dataAlternatif['ram'];
            $prosesor = $dataAlternatif['prosesor'];
            $harga = $dataAlternatif['harga'];
            $ukuran_penyimpanan = $dataAlternatif['ukuran_penyimpanan'];
            $jenis_penyimpanan = $dataAlternatif['jenis_penyimpanan'];
            $sistem_operasi = $dataAlternatif['sistem_operasi'];
            $daya_tahan = $dataAlternatif['daya_tahan'];
            $ukuran_layar = $dataAlternatif['ukuran_layar'];
            $kategori = $dataAlternatif['kategori'];

            $updateAlternatif = $this->db->query(
                "UPDATE alternatif SET nama_alternatif = '$nama_alternatif',gambar='$gambar',f_id_kategori='$kategori' WHERE id_alternatif = $id_alternatif"
            );

            if ($updateAlternatif) {
                // Update data kec_alt_kriteria
                foreach ($dataKecAltKrit as $key => $id_sub_kriteria) {
                    $updateKecAltKrit = $this->db->query("UPDATE kec_alt_kriteria SET f_id_sub_kriteria = '$id_sub_kriteria' WHERE f_id_alternatif = '$id_alternatif' AND f_id_kriteria = '$key'");
                }
                if ($updateKecAltKrit || $this->db->affected_rows > 0) {
                    return $_SESSION['success'] = 'Data berhasil diupdate!';
                } 
                else {
                    return $_SESSION['error'] = 'Data gagal diupdate!';
                }
            } else {
                return $_SESSION['error'] = 'Data gagal diupdate!';
            }
        }

        public function hapusDataLaptop($id_alternatif)
        {
            $stmtDelete = $this->db->prepare("DELETE FROM alternatif WHERE id_alternatif=?");
            $stmtDelete->bind_param("i", $id_alternatif);
            $stmtDelete->execute();

            if ($stmtDelete->affected_rows > 0) {
                $_SESSION['success'] = 'Data berhasil dihapus!';
            } else {
                $_SESSION['error'] = 'Terjadi kesalahan dalam menghapus data.';
            }
            $stmtDelete->close();
        }

        // End CRUD

    }

    $Laptop = new Laptop();

?>