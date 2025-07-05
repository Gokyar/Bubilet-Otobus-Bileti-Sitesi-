<?php
session_start();

$gelenVeri = file_get_contents("php://input");

$gelenVeri = json_decode($gelenVeri, true);

if(isset($gelenVeri['session_cinsiyet'])){
    $_SESSION['cinsiyet'] = $gelenVeri['session_cinsiyet'];

    echo json_encode(['status'=>'success', 'message'=>'Session verisi başarıyla alındı.']);
}

else{
    echo json_encode(['status'=>'error', 'message'=>'Session verisi alınamadı.']);
}

?>