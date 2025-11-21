<?php

include_once ("models/DB.php");
include_once ("KontrakModel.php");

class TabelPembalap extends DB implements KontrakModel {

    // Konstruktor untuk inisialisasi database
    public function __construct($host, $db_name, $username, $password) {
        parent::__construct($host, $db_name, $username, $password);
    }

    // Method untuk mendapatkan semua pembalap
    public function getAllData(): array {
        $query = "SELECT pembalap.id, pembalap.nama, pembalap.tim_id, tim.nama AS tim_nama, pembalap.negara, pembalap.poinMusim, pembalap.jumlahMenang 
                  FROM pembalap
                  INNER JOIN tim ON pembalap.tim_id = tim.id";
        $this->executeQuery($query);
        return $this->getAllResult();
    }

    // Method untuk mendapatkan pembalap berdasarkan ID
    public function getDataById($id): ?array {
        $query = "SELECT pembalap.id, pembalap.nama, pembalap.tim_id, tim.nama AS tim_nama, pembalap.negara, pembalap.poinMusim, pembalap.jumlahMenang 
                  FROM pembalap
                  INNER JOIN tim ON pembalap.tim_id = tim.id
                  WHERE pembalap.id = :id";
        $params = ['id' => $id];
        $this->executeQuery($query, $params);
        return $this->getSingleResult();
    }

    // Metode CUD (Create Update Delete)

    public function addData($data = []): void {
        $query = "INSERT INTO pembalap (nama, tim, negara, poinMusim, jumlahMenang) VALUES (:nama, :tim, :negara, :poinMusim, :jumlahMenang)";
        $params = ['nama' => $data['nama'], 'tim' => $data['tim'], 'negara' => $data['negara'], 'poinMusim' => $data['poinMusim'], 'jumlahMenang' => $data['jumlahMenang']];
        $this->executeQuery($query, $params);
    }
    
    public function updateData($id, $data = []): void {
        $query = "UPDATE pembalap SET nama = :nama, tim_id = :tim_id, negara = :negara, poinMusim = :poinMusim, jumlahMenang = :jumlahMenang WHERE id = :id";
        $params = ['nama' => $data['nama'], 'tim_id' => $data['tim_id'], 'negara' => $data['negara'], 'poinMusim' => $data['poinMusim'], 'jumlahMenang' => $data['jumlahMenang'], 'id' => $id];
        $this->executeQuery($query, $params);
    }
    
    public function deleteData($id): void {
        $query = "DELETE FROM pembalap WHERE id = :id";
        $params = ['id' => $id];
        $this->executeQuery($query, $params);
    }

}

?>