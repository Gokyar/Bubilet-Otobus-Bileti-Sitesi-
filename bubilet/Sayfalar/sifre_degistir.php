<?php
// Hata raporlama
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Veritabanı bağlantısını dahil et
require_once 'db_bagla.php';

// Veritabanı bağlantısı kontrolü
if ($dbConnection === null) {
    die("Veritabanına bağlantı sağlanamadı.");
}

// POST verilerini al
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $mail = $_POST['mail'] ?? null;
    $yeni_sifre = $_POST['yeni_sifre'] ?? null;
    $yeni_sifre_tekrar = $_POST['yeni_sifre_tekrar'] ?? null;

    // Verilerin doğruluğunu kontrol et
    if (!$mail || !$yeni_sifre || !$yeni_sifre_tekrar) {
        die("Lütfen tüm alanları doldurun.");
    }

    if ($yeni_sifre !== $yeni_sifre_tekrar) {
        die("Şifreler eşleşmiyor.");
    }

    // E-posta ile kullanıcıyı bul
    $sql = "SELECT * FROM uyeler WHERE mail = :mail";
    $stmt = $dbConnection->prepare($sql);
    $stmt->bindParam(':mail', $mail, PDO::PARAM_STR);
    $stmt->execute();

    // E-posta adresi veritabanında var mı kontrol et
    if ($stmt->rowCount() == 0) {
        die("Bu e-posta adresiyle kayıtlı bir kullanıcı bulunamadı.");
    }

    // Şifreyi güncelle
    $update_sql = "UPDATE uyeler SET sifre = :sifre WHERE mail = :mail";
    $update_stmt = $dbConnection->prepare($update_sql);
    $update_stmt->bindParam(':sifre', $yeni_sifre, PDO::PARAM_STR);
    $update_stmt->bindParam(':mail', $mail, PDO::PARAM_STR);

    // Şifreyi güncelleme işlemi
    if ($update_stmt->execute()) {
        header('Location:uye_giris.php');
        echo "Şifreniz başarıyla güncellenmiştir.";
    } else {
        echo "Şifre güncellenirken bir hata oluştu.";
    }

} else {
    echo "Form gönderilmedi.";
}
?>
