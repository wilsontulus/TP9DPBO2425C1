<?php

include_once ("KontrakView.php");

class ViewTim implements KontrakView {

    public function __construct(){
        // Konstruktor kosong
    }

    // Method untuk menampilkan daftar tim
    public function tampilList($listTim): string {
        // Build table rows
        $tbody = '';
        $no = 1;
        foreach($listTim as $tim){
            $tbody .= '<tr>';
            $tbody .= '<td class="col-id">'. $no .'</td>';
            $tbody .= '<td>'. htmlspecialchars($tim->getNama()) .'</td>';
            $tbody .= '<td>'. htmlspecialchars($tim->getTahunBerdiri()) .'</td>';
            $tbody .= '<td class="col-actions">
                    <a href="index.php?screen=edit&id='. $tim->getId() .'" class="btn btn-edit">Edit</a>
                    <button data-id="'. $tim->getId() .'" class="btn btn-delete">Hapus</button>
                  </td>';
            $tbody .= '</tr>';
            $no++;
        }

        // Load the page template and inject rows + total count
        $templatePath = __DIR__ . '/../template/listTim.html';
        $template = '';
        if (file_exists($templatePath)) {
            $template = file_get_contents($templatePath);
            $template = str_replace('<!-- PHP will inject rows here -->', $tbody, $template);
            $total = count($listTim);
            $template = str_replace('Total:', 'Total: ' . $total, $template);
            return $template;
        }

        // Fallback: just return the rows if template is missing
        return $tbody;
    }

    // Method untuk menampilkan form tambah/ubah tim
    public function tampilForm($data = null): string {
        // Dapatkan list tim
        $template = file_get_contents(__DIR__ . '/../template/formTim.html');

        if ($data) {
            $template = str_replace('value="add" id="tim-action"', 'value="edit" id="tim-action"', $template);
            $template = str_replace('value="" id="tim-id"', 'value="' . htmlspecialchars($data['id']) . '" id="tim-id"', $template);
            $template = str_replace('id="nama" name="nama" type="text" placeholder="Nama tim"', 'id="nama" name="nama" type="text" placeholder="Nama tim" value="' . htmlspecialchars($data['nama']) . '"', $template);
            $template = str_replace('id="tahun_berdiri" name="tahun_berdiri" type="text" placeholder="Tahun berdiri"', 'id="tahun_berdiri" name="tahun_berdiri" type="text" placeholder="Tahun berdiri" value="' . htmlspecialchars($data['tahun_berdiri']) . '"', $template);
        }
        
        return $template;
    }
}

?>