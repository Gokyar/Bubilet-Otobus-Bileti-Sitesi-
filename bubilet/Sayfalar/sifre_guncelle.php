<?php
session_start();
require_once "db_bagla.php";

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $eski_sifre = trim($_POST['eski_sifre']);
    $yeni_sifre = trim($_POST['yeni_sifre']);
    $yeni_sifre_tekrar = trim($_POST['yeni_sifre_tekrar']);
    $e_posta = $_SESSION['uye_mail'];

    if (empty($eski_sifre) || empty($yeni_sifre) || empty($yeni_sifre_tekrar)) {
        $_SESSION['alert'] = "Tüm alanları doldurmalısınız!";
        $_SESSION['alert_type'] = "error";
    } elseif ($yeni_sifre !== $yeni_sifre_tekrar) {
        $_SESSION['alert'] = "Yeni şifreler eşleşmiyor!";
        $_SESSION['alert_type'] = "error";
    } else {
        $stmt = $dbConnection->prepare("SELECT sifre FROM uyeler WHERE mail = ?");
        $stmt->execute([$e_posta]);
        $uye = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($uye) {
            if ($uye['sifre'] === $eski_sifre) {
                $update_stmt = $dbConnection->prepare("UPDATE uyeler SET sifre = ? WHERE mail = ?");
                $update_stmt->execute([$yeni_sifre, $e_posta]);

                $_SESSION['alert'] = "Şifre başarıyla güncellendi!";
                $_SESSION['alert_type'] = "success";
            } else {
                $_SESSION['alert'] = "Mevcut şifre yanlış!";
                $_SESSION['alert_type'] = "error";
            }
        } else {
            $_SESSION['alert'] = "Kullanıcı bulunamadı!";
            $_SESSION['alert_type'] = "error";
        }
    }

    header("Location: uye_bilgileri.php");
    exit;
}
?>
