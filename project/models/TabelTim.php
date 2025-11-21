<?php

include_once ("models/DB.php");
include_once ("KontrakModel.php");

class TabelTim extends DB implements KontrakModel {

    // Konstruktor untuk inisialisasi database
    public function __construct($host, $db_name, $username, $password) {
        parent::__construct($host, $db_name, $username, $password);
    }

    // Method untuk mendapatkan semua tim
    public function getAllData(): array {
        $query = "SELECT * 
                  FROM tim";
        $this->executeQuery($query);
        return $this->getAllResult();
    }

    // Method untuk mendapatkan tim berdasarkan ID
    public function getDataById($id): ?array {
        $query = "SELECT * 
                  FROM tim
                  WHERE id = :id";
        $params = ['id' => $id];
        $this->executeQuery($query, $params);
        return $this->getSingleResult();
    }

    // Metode CUD (Create Update Delete)

    public function addData($data = []): void {
        $query = "INSERT INTO tim (nama, tahun_berdiri) VALUES (:nama, :tahun_berdiri)";
        $params = ['nama' => $data['nama'], 'tahun_berdiri' => $data['tahun_berdiri']];
        $this->executeQuery($query, $params);
    }
    
    public function updateData($id, $data = []): void {
        $query = "UPDATE tim SET nama = :nama, tahun_berdiri = :tahun_berdiri WHERE id = :id";
        $params = ['nama' => $data['nama'], 'tahun_berdiri' => $data['tahun_berdiri'], 'id' => $id];
        $this->executeQuery($query, $params);
    }
    
    public function deleteData($id): void {
        $query = "DELETE FROM tim WHERE id = :id";
        $params = ['id' => $id];
        $this->executeQuery($query, $params);
    }

}

?>