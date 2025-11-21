<?php

include_once("models/DB.php");
include("models/TabelTim.php");
include("models/TabelPembalap.php");

include("views/ViewPembalap.php");

include("presenters/PresenterTim.php");
include("presenters/PresenterPembalap.php");

$tabelTim = new TabelTim('localhost', 'tp9_mvp25', 'root', '');
$tabelPembalap = new TabelPembalap('localhost', 'tp9_mvp25', 'root', '');
$viewPembalap = new ViewPembalap();
$presenter = null;

$tableName = "pembalap";
if (isset($_GET['table'])) {
    $tableName = $_GET['table'];
}

switch ($tableName) {
    case "pembalap":
        $presenter = new PresenterPembalap($tabelTim, $tabelPembalap, $viewPembalap);
        break;
    case "tim":
        $presenter = new PresenterPembalap($tabelTim, $tabelPembalap, $viewPembalap);
        break;
    default:
        $presenter = new PresenterPembalap($tabelTim, $tabelPembalap, $viewPembalap);
}


if(isset($_GET['screen'])){
    if($_GET['screen'] == 'add'){
        $formHtml = $presenter->renderForm();
        echo $formHtml;
    }
    else if($_GET['screen'] == 'edit' && isset($_GET['id'])){
        $formHtml = $presenter->renderForm($_GET['id']);
        echo $formHtml;
    }
} 
else if(isset($_POST['action'])){
    // Execute CRUD actions
    switch ($_POST['action']) {
        case "add":
            $data = [
                'nama' => $_POST['nama'],
                'tim_id' => $_POST['tim_id'],
                'negara' => $_POST['negara'],
                'poinMusim' => $_POST['poinMusim'],
                'jumlahMenang' => $_POST['jumlahMenang']
            ];
            $presenter->tambahData($data);
            break;
        case "edit":
            $data = [
                'nama' => $_POST['nama'],
                'tim_id' => $_POST['tim_id'],
                'negara' => $_POST['negara'],
                'poinMusim' => $_POST['poinMusim'],
                'jumlahMenang' => $_POST['jumlahMenang']
            ];
            $presenter->ubahData($_POST['id'], $data);
            break;
        case "delete":
            $presenter->hapusData($_POST['id']);
            break;
    }

    // Redirect back to list without performing any action
    header("Location: index.php");
    exit();

} else{
    // Presenter now returns the full HTML (view injects the template and total)
    $html = $presenter->render();
    echo $html;
}

?>