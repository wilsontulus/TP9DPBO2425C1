<?php

include_once(__DIR__ . "/KontrakPresenter.php");

include_once(__DIR__ . "/../models/Tim.php");
include_once(__DIR__ . "/../models/TabelTim.php");

include_once(__DIR__ . "/../views/ViewTim.php");

class PresenterTim implements KontrakPresenter
{
    // Model PembalapQuery untuk operasi database
    private $tabelTim; // Instance dari TabelTim (Model)
    private $viewTim; // Instance dari ViewTim (View)

    // Data list tim
    private $listTim = []; // Menyimpan array objek Tim

    public function __construct($tabelTim, $viewTim)
    {
        $this->tabelTim = $tabelTim;
        $this->viewTim = $viewTim;
        $this->initListTim();
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

    // Method untuk menampilkan daftar pembalap menggunakan View
    public function render(): string
    {
        return $this->viewTim->tampilList($this->listTim);
    }

    // Method untuk menampilkan form
    public function renderForm($id = null): string
    {
        $data = null;
        if ($id !== null) {
            $data = $this->tabelTim->getDataById($id);
        }
        
        return $this->viewTim->tampilForm($data);
    }

    // implementasikan metode

    public function tambahData($data = []): void {
        $this->tabelTim->addData($data);
    }
    
    public function ubahData($id, $data = []): void {
        $this->tabelTim->updateData($id, $data);
    }
    
    public function hapusData($id): void {
        $this->tabelTim->deleteData($id);
    }
}

?>