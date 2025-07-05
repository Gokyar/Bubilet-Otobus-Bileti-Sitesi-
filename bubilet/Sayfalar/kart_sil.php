<?php
session_start();
require_once "db_bagla.php";

$_SESSION['show_sil'] = false;
$_SESSION['show_ekle'] = false;
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['kart_sil'])) {
        $_SESSION['show_sil'] = true;
    } else {
        $_SESSION['show_sil'] = false;
    }
}

if (isset($_POST['sil'])&&isset($_POST['kart_id']))
{
    $kart_id= $_POST['kart_id'];
    $sqlQuery = "delete from kartlar where id =" . $kart_id;
    $sqlDelete = $dbConnection->exec($sqlQuery);
}


?>