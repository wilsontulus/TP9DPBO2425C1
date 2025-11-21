<?php

include_once(__DIR__ . "/KontrakPresenter.php");

include_once(__DIR__ . "/../models/Tim.php");
include_once(__DIR__ . "/../models/TabelTim.php");

include_once(__DIR__ . "/../models/Pembalap.php");
include_once(__DIR__ . "/../models/TabelPembalap.php");

include_once(__DIR__ . "/../views/ViewPembalap.php");

class PresenterPembalap implements KontrakPresenter
{
    // Model PembalapQuery untuk operasi database
    private $tabelTim; // Instance dari TabelTim (Model)
    private $tabelPembalap; // Instance dari TabelPembalap (Model)
    private $viewPembalap; // Instance dari ViewPembalap (View)

    // Data list pembalap
    private $listPembalap = []; // Menyimpan array objek Pembalap
    private $listTim = []; // Menyimpan array objek Tim

    public function __construct($tabelTim, $tabelPembalap, $viewPembalap)
    {
        $this->tabelTim = $tabelTim;
        $this->tabelPembalap = $tabelPembalap;
        $this->viewPembalap = $viewPembalap;
        $this->initListTim();
        $this->initListPembalap();
    }

    // Method untuk initialisasi list tim dari database
    public function initListTim()
    {
        $data = $this->tabelTim->getAllData();

        $this->listTim = [];
        foreach ($data as $item) {
            $tim = new Tim(
                $item['id'],
                $item['nama'],
                $item['tahun_berdiri']
            );
            $this->listTim[] = $tim;
        }
    }

    // Method untuk initialisasi list pembalap dari database
    public function initListPembalap()
    {
        $data = $this->tabelPembalap->getAllData();

        $this->listPembalap = [];
        foreach ($data as $item) {
            $pembalap = new Pembalap(
                $item['id'],
                $item['nama'],
                $item['tim_nama'],
                $item['negara'],
                $item['poinMusim'],
                $item['jumlahMenang'],
            );
            $this->listPembalap[] = $pembalap;
        }
    }

    // Method untuk menampilkan daftar pembalap menggunakan View
    public function render(): string
    {
        return $this->viewPembalap->tampilList($this->listPembalap);
    }

    // Method untuk menampilkan form
    public function renderForm($id = null): string
    {
        $data = null;
        if ($id !== null) {
            $data = $this->tabelPembalap->getDataById($id);
        }
        
        return $this->viewPembalap->tampilForm($data, $this->listTim);
    }

    // implementasikan metode

    public function tambahData($nama, $tim_id, $negara, $poinMusim, $jumlahMenang): void {
        $data = [
            'nama' => $nama,
            'tim_id' => $tim_id,
            'negara' => $negara,
            'poinMusim' => $poinMusim,
            'jumlahMenang' => $jumlahMenang
        ];
        $this->tabelPembalap->addData($nama, $data);
    }
    
    public function ubahData($id, $nama, $tim_id, $negara, $poinMusim, $jumlahMenang): void {
        $data = [
            'nama' => $nama,
            'tim_id' => $tim_id,
            'negara' => $negara,
            'poinMusim' => $poinMusim,
            'jumlahMenang' => $jumlahMenang
        ];
        $this->tabelPembalap->updateData($id, $data);
    }
    
    public function hapusData($id): void {
        $this->tabelPembalap->deleteData($id);
    }
}

?>