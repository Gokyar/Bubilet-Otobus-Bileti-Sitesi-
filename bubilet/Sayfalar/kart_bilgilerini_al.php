<?php
require_once "db_bagla.php";

if (isset($_GET['kart_id'])) {
    $kart_id = $_GET['kart_id'];

    // Kart bilgilerini al
    $sqlQuery = "SELECT * FROM kartlar WHERE id = :kart_id";
    $stmt = $dbConnection->prepare($sqlQuery);
    $stmt->bindParam(':kart_id', $kart_id, PDO::PARAM_INT);
    $stmt->execute();
    $kart = $stmt->fetch(PDO::FETCH_ASSOC);

    // Kart bilgilerini JSON formatında döndür
    if ($kart) {
        echo json_encode($kart);
    } else {
        echo json_encode(['error' => 'Kart bulunamadı']);
    }
}
?>
