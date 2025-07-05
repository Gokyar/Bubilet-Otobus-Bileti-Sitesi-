<?php
session_start();

$gelenVeri = file_get_contents("php://input");

$gelenVeri = json_decode($gelenVeri, true);

if(isset($gelenVeri['sessionVeri'])){
    $_SESSION['koltuk_id'] = $gelenVeri['sessionVeri'];

    echo json_encode(['status'=>'success', 'message'=>'Session verisi başarıyla alındı.']);
}

else{
    echo json_encode(['status'=>'error', 'message'=>'Session verisi alınamadı.']);
}

?>