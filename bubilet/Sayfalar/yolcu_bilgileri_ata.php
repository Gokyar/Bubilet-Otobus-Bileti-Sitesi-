<?php
session_start();

$gelenVeri = file_get_contents("php://input");

$gelenVeri = json_decode($gelenVeri, true);

if(isset($gelenVeri['session_yolcu_ad']) && isset($gelenVeri['session_yolcu_soyad']) && isset($gelenVeri['session_yolcu_tc']) ){
    $_SESSION['yolcu_ad'] = $gelenVeri['session_yolcu_ad'];
    $_SESSION['yolcu_soyad'] = $gelenVeri['session_yolcu_soyad'];
    $_SESSION['yolcu_tc'] = $gelenVeri['session_yolcu_tc'];

    echo json_encode(['status'=>'success', 'message'=>'Session verisi başarıyla alındı.']);
}

else{
    echo json_encode(['status'=>'error', 'message'=>'Session verisi alınamadı.']);
}

?>