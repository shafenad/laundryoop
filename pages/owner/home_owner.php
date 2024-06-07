<?php
session_start();


if(!isset($_SESSION['role']) || $_SESSION['role'] != 'owner') {

    header('Location: ../../index.php');
    exit;
}



if(!isset($_GET['p'])){
    $page = "dashboard";
} else {
    $page = $_GET['p'];
}


require '' . $page . '.php';

require '../../template/footer.php';
?>
