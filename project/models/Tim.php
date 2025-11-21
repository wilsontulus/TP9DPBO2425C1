<?php

class Tim {

    private $id;
    private $nama;
    private $tahun_berdiri;


    public function __construct($id, $nama, $tahun_berdiri){
        $this->id = $id;
        $this->nama = $nama;
        $this->tahun_berdiri = $tahun_berdiri;
    }

    public function getId(){
        return $this->id;
    }
    public function getNama(){
        return $this->nama;
    }
    public function getTahunBerdiri(){
        return $this->tahun_berdiri;
    }

    public function setNama($nama){
        $this->nama = $nama;
    }
    public function setTahunBerdiri($tahun_berdiri){
        $this->tahun_berdiri = $tahun_berdiri;
    }
}
?>