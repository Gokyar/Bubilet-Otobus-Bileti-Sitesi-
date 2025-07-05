<?php
session_start();
require_once "db_bagla.php";

$giris_basarili = false;
$hata = "";
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['email'], $_POST['sifre'])) {
    $e_posta = $_POST['email'];
    $sifre = $_POST['sifre'];

    $sqlQuery = $dbConnection->query("SELECT *, count(*) as kontrol FROM uyeler WHERE mail='$e_posta'");
    foreach ($sqlQuery as $deger) {
        if ($deger['kontrol'] == 1) {
            if ($deger['sifre'] == $sifre) {
                $_SESSION['uye_id'] = $deger['id'];
                $_SESSION['uye_ad'] = $deger['isim'];
                $_SESSION['uye_soyad'] = $deger['soyisim'];
                $_SESSION['uye_mail'] = $deger['mail'];
                $_SESSION['uye_sifre'] = $deger['sifre'];
                $_SESSION['uye_tc'] = $deger['tc'];
                $_SESSION['uye_tel'] = $deger['tel_no'];
                $_SESSION['uye_tarih'] = $deger['dogum_tarihi'];
                $_SESSION['uye_cinsiyet'] = $deger['cinsiyet'];

                $giris_basarili = true;
            } else {
                $hata = "Şifre yanlış.";
            }
        } else {
            $hata = "E-posta yanlış.";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/style.css">
    <script src="../js/uye_giris.js" language="javascript"></script>
    <title>Üye Giriş</title>
</head>

<body>
    <nav class="menu">
        <a class="menu_anasayfa" href="index.php">buBİLET</a>
    </nav>
    <div class="login">
        <form class="form1" method="post" action="">
            <h1 style="text-align:center">Üye Girişi</h1>
            <label>E-posta:</label>
            <input type="email" name="email">
            <label>Şifre:</label>
            <input type="password" name="sifre">
            <button>Giriş</button>

            <div class="rddiv">
                <input type="radio" id="Grs" value="grs" name="secim" checked onchange="Kontrol(this)">
                <label for="Grs">Giriş Yap</label>
                <input type="radio" id="Kyt" value="kyt" name="secim" onchange="Kontrol(this)">
                <label for="Kyt">Kayıt Ol</label>
            </div>
            <a href="unuttum.php">Şifremi Unuttum</a>
        </form>
    </div>


    <div class="signin">
        <form class="form1" method="post" action="uye_kayit.php">
            <h1 style="text-align:center">Üye Kayıt</h1>
            <label>E-posta:</label>
            <input type="email" name="kayit_email">
            <label>Şifre:</label>
            <input type="password" name="kayit_sifre">
            <button name="kaydet" onclick="boslukKontrol(this)">Kaydet</button>


            <div class="rddiv">
                <input type="radio" id="Grs2" value="grs" name="secim" onchange="Kontrol(this)">
                <label for="Grs2">Giriş Yap</label>
                <input type="radio" id="Kyt2" value="kyt" name="secim" onchange="Kontrol(this)">
                <label for="Kyt2">Kayıt Ol</label>
            </div>
            <p style="text-align:center" name="hata" id="hata"></p>
        </form>
    </div>
    <?php
    if (!empty($hata)) {
        echo "<p style='text-align:center;color:red;'>$hata</p>";
    } elseif ($giris_basarili) {
        echo "<p style='text-align:center;color:green;'>Giriş Başarılı</p>";
    }
    ?>

    <?php
    if (isset($_SESSION['uye_id'])) {
        header("Location: index.php");
    }
    ?>
</body>

</html>