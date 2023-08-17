<?php 

require_once '../config.php';
class Kriteria{
    private $db;

    public function __construct()
    {
        $this->db = connectDatabase();
    }

    public function getKriteriaByUser($id_user)
    {
        return $this->db->query("SELECT * FROM `kriteria` JOIN bobot_kriteria ON bobot_kriteria.f_id_user = '$id_user'");
    }
    public function getKriteria()
    {
        return $this->db->query("SELECT * FROM `kriteria`");
    }

    public function tambahBobotKriteria($dataPenilaian,$id_user)
    {
        $C1 = 0;
        $C2 = 0;
        $C3 = 0;
        $C4 = 0;
        $C5 = 0;
        $C6 = 0;
        $C7 = 0;
        $C8 = 0;
        $getKriteria = $this->getKriteria();
        foreach ($getKriteria as $kriteria) {
            
            switch ($kriteria['id_kriteria']) {
                case 'C1':
                    $RAM = $kriteria['nama_kriteria'];
                    break;
                case 'C2':
                    $Prosesor = $kriteria['nama_kriteria'];
                    break;
                case 'C3':
                    $Harga = $kriteria['nama_kriteria'];
                    break;
                case 'C4':
                    $ukuranPenyimpanan = $kriteria['nama_kriteria'];
                    break;
                case 'C5':
                    $jenisPenyimpanan = $kriteria['nama_kriteria'];
                    break;
                case 'C6':
                    $sistemOperasi = $kriteria['nama_kriteria'];
                    break;
                case 'C7':
                    $dayaTahanBaterai = $kriteria['nama_kriteria'];
                    break;
                case 'C8':
                    $ukuranLayar = $kriteria['nama_kriteria'];
                    break;
               }
        }
        foreach ($dataPenilaian as $key => $value) {
           switch ($key) {
            case $RAM:
                $C1 = $value;
                break;
            case $Prosesor:
                $C2 = $value;
                break;
            case $Harga:
                $C3 = $value;
                break;
            case $ukuranPenyimpanan:
                $C4 = $value;
                break;
            case $jenisPenyimpanan:
                $C5 = $value;
                break;
            case $sistemOperasi:
                $C6 = $value;
                break;
            case $dayaTahanBaterai:
                $C7 = $value;
                break;
            case $ukuranLayar:
                $C8 = $value;
                break;
           }
        }
        $stmt = $this->db->prepare("SELECT * FROM bobot_kriteria WHERE f_id_user=?");
        $stmt->bind_param("i", $id_user);
        $stmt->execute();
        $result = $stmt->get_result();
        if ($result->num_rows <= 0) {
            $stmtInsert = $this->db->query("INSERT INTO bobot_kriteria (id_bobot, C1, C2, C3, C4, C5, C6, C7, C8, f_id_user) VALUES (NULL, '$C1', '$C2', '$C3', '$C4', '$C5', '$C6', '$C7','$C8', '$id_user')");
            if($stmtInsert){
                return $_SESSION['success'] = 'Data berhasil ditambahkan!';
            }else{
                return $_SESSION['error'] = 'Terjadi kesalahan dalam menyimpan data.';
            }
         } 
         else {
             return $_SESSION['error'] = 'Data sudah ada!';
         }
         $stmt->close();
    }
    public function editBobotKriteria($id_bobot,$dataPenilaian)
    {
        $C1 = 0;
        $C2 = 0;
        $C3 = 0;
        $C4 = 0;
        $C5 = 0;
        $C6 = 0;
        $C7 = 0;
        $C8 = 0;
        $getKriteria = $this->getKriteria();
        foreach ($getKriteria as $kriteria) {
            
            switch ($kriteria['id_kriteria']) {
                case 'C1':
                    $RAM = $kriteria['nama_kriteria'];
                    break;
                case 'C2':
                    $Prosesor = $kriteria['nama_kriteria'];
                    break;
                case 'C3':
                    $Harga = $kriteria['nama_kriteria'];
                    break;
                case 'C4':
                    $ukuranPenyimpanan = $kriteria['nama_kriteria'];
                    break;
                case 'C5':
                    $jenisPenyimpanan = $kriteria['nama_kriteria'];
                    break;
                case 'C6':
                    $sistemOperasi = $kriteria['nama_kriteria'];
                    break;
                case 'C7':
                    $dayaTahanBaterai = $kriteria['nama_kriteria'];
                    break;
                case 'C8':
                    $ukuranLayar = $kriteria['nama_kriteria'];
                    break;
               }
        }
        foreach ($dataPenilaian as $key => $value) {
           switch ($key) {
            case $RAM:
                $C1 = $value;
                break;
            case $Prosesor:
                $C2 = $value;
                break;
            case $Harga:
                $C3 = $value;
                break;
            case $ukuranPenyimpanan:
                $C4 = $value;
                break;
            case $jenisPenyimpanan:
                $C5 = $value;
                break;
            case $sistemOperasi:
                $C6 = $value;
                break;
            case $dayaTahanBaterai:
                $C7 = $value;
                break;
            case $ukuranLayar:
                $C8 = $value;
                break;
           }
        }
        $update = $this->db->query("UPDATE bobot_kriteria SET C1=$C1,C2=$C2,C3=$C3,C4=$C4,C5=$C5,C6=$C6,C7=$C7,C8=$C8 WHERE id_bobot='$id_bobot'");
        if($update){
            return $_SESSION['success'] = 'Data berhasil diedit!';
        }else{
            return $_SESSION['error'] = 'Terjadi kesalahan dalam menyimpan data.';
        }
    }
    public function tambahTampung($dataTampung,$id_user)
    {
        $C1 = $dataTampung[0];
        $C2 =  $dataTampung[1];
        $C3 =  $dataTampung[2];
        $C4 =  $dataTampung[3];
        $C5 =  $dataTampung[4];
        $C6 =  $dataTampung[5];
        $C7 =  $dataTampung[6];
        $C8 =  $dataTampung[7];
        $this->db->query("INSERT INTO tabel_tampung (id, prio1, prio2, prio3, prio4, prio5, prio6, prio7, prio8, f_id_user) VALUES (NULL, '$C1', '$C2', '$C3', '$C4', '$C5', '$C6', '$C7', '$C8', '$id_user')");
    }
    public function editTampung($id,$dataTampung)
    {
        $C1 = $dataTampung[0];
        $C2 =  $dataTampung[1];
        $C3 =  $dataTampung[2];
        $C4 =  $dataTampung[3];
        $C5 =  $dataTampung[4];
        $C6 =  $dataTampung[5];
        $C7 =  $dataTampung[6];
        $C8 =  $dataTampung[7];

        $this->db->query("UPDATE tabel_tampung SET prio1='$C1',prio2='$C2',prio3='$C3',prio4='$C4',prio5='$C5',prio6='$C6',prio7='$C7',prio8='$C8' WHERE id='$id'");
    }

}


$Kriteria = new Kriteria();

?>