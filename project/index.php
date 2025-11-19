<?php

include_once("models/DB.php");
include("models/TabelPembalap.php");
include("views/ViewPembalap.php");
include("presenters/PresenterPembalap.php");

$tabelPembalap = new TabelPembalap('localhost', 'tp9_mvp25', 'root', '');
$viewPembalap = new ViewPembalap();
$presenter = new PresenterPembalap($tabelPembalap, $viewPembalap);



if(isset($_GET['screen'])){
    if($_GET['screen'] == 'add'){
        $formHtml = $presenter->tampilkanFormPembalap();
        echo $formHtml;
    }
    else if($_GET['screen'] == 'edit' && isset($_GET['id'])){
        $formHtml = $presenter->tampilkanFormPembalap($_GET['id']);
        echo $formHtml;
    }
} 
else if(isset($_POST['action'])){
    // Execute CRUD actions
    switch ($_POST['action']) {
        case "add":
            $presenter->tambahPembalap($_POST['nama'], $_POST['tim'], $_POST['negara'], $_POST['poinMusim'], $_POST['jumlahMenang']);
            break;
        case "edit":
            $presenter->ubahPembalap($_POST['id'], $_POST['nama'], $_POST['tim'], $_POST['negara'], $_POST['poinMusim'], $_POST['jumlahMenang']);
            break;
        case "delete":
            $presenter->hapusPembalap($_POST['id']);
            break;
    }

    // Redirect back to list without performing any action
    header("Location: index.php");
    exit();

} else{
    // Presenter now returns the full HTML (view injects the template and total)
    $html = $presenter->tampilkanPembalap();
    echo $html;
}

?>