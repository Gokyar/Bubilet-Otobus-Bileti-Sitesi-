<?php
session_start();
$servername = "localhost";
$username = "root";
$password = "0123456789";
$dbname = "bubilet";

$conn = new mysqli($servername, $username, $password, $dbname);

$_SESSION['uye_mail'] = $_POST['email'];
$_SESSION['uye_ad'] = $_POST['ad'];
$_SESSION['uye_soyad'] = $_POST['soyad'];
$_SESSION['uye_tel'] = $_POST['tel_no'];
$_SESSION['uye_tc'] = $_POST['tc_no'];
$_SESSION['uye_tarih'] = $_POST['dogum_tarihi'];

if (isset($_POST['cnsyt'])) {
        $_SESSION['uye_cinsiyet'] = $_POST['cnsyt'];
    }

if (isset($_POST['guncelle'])) {

    if ($conn->connect_error) {
        die("Bağlantı başarısız: " . $conn->connect_error);
    }

    $email = $_POST['email'];
    $ad = $_POST['ad'];
    $soyad = $_POST['soyad'];
    $tel_no = $_POST['tel_no'];
    $tc_no = $_POST['tc_no'];
    $dogum_tarihi = $_POST['dogum_tarihi'];
    $cinsiyet = $_POST['cnsyt']; // Cinsiyet verisini al
    $uye_id = $_SESSION['uye_id']; // Kullanıcı ID'si

    // Hata raporlamayı aktif et
    ini_set('display_errors', 1);
    error_reporting(E_ALL);

    // SQL sorgusu için hazırlıklı ifade (prepared statement)
    $stmt = $conn->prepare("UPDATE uyeler SET mail = ?, isim = ?, soyisim = ?, tel_no = ?, tc = ?, dogum_tarihi = ?, cinsiyet = ? WHERE id = ?");
    
    if ($stmt === false) {
        die('Sorgu hazırlanırken hata oluştu: ' . $conn->error);
    }

    // Değerleri bağla
    $stmt->bind_param("sssssssi", $email, $ad, $soyad, $tel_no, $tc_no, $dogum_tarihi, $cinsiyet, $uye_id);

    // Sorguyu çalıştır
    if ($stmt->execute()) {
        echo "Veri başarıyla güncellendi.";
        header("Location: uye_bilgileri.php");
    } else {
        echo "Hata: " . $stmt->error;
    }

    // Bağlantıyı kapat
    $stmt->close();
    $conn->close();

    
}
?>
