<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/style.css">
    <script src="../js/uye_bilgileri.js"></script>
    <link rel="stylesheet" href="../css/bootstrap.css">
    <script src="../js/bootstrap.bundle.js"></script>
    <title>Üye Bilgileri</title>
</head>

<body>
    <nav class="menu">
        <a class="menu_anasayfa" href="index.php">buBİLET</a>
        <div class="menu_uye">
            <div class="dropdown">
                <button class="btn btn-secondary" type="button" onclick="window.location.href='uye_giris.php'"
                    id="uye_giris_btn" style="display:none">ÜYE
                    GİRİŞİ</button>
                <button class="btn btn-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown"
                    aria-expanded="false" id="hesabım_btn">
                    HESABIM
                </button>
                <ul class="dropdown-menu">
                    <li><a class="dropdown-item" href="uye_bilgileri.php">Hesap Bilgileri</a></li>
                    <li><a class="dropdown-item" href="biletlerim.php">Biletlerim</a></li>
                    <li><a class="dropdown-item" href="kartlarim.php">Kartlarım</a></li>
                    <li><a class="dropdown-item" href="cikis.php">Çıkış</a></li>
                </ul>
            </div>
        </div>
    </nav>

    <?php
    session_start();
    ?>

    <div class="uye_bilgi">
        <form method="post" action="bilgi_guncelle.php">
            <div class="div_uye">
                <label>E-posta:</label>
                <input type="email" name="email" value="<?php echo $_SESSION['uye_mail']; ?>">
            </div>
            <div class="div_uye">
                <label>Ad:</label>
                <input type="text" name="ad" value="<?php echo $_SESSION['uye_ad']; ?>">
            </div>
            <div class="div_uye">
                <label>Soyad:</label>
                <input type="text" name="soyad" value="<?php echo $_SESSION['uye_soyad']; ?>">
            </div>
            <div class="div_uye">
                <label>Telefon Numarası:</label>
                <input type="text" maxlength="11" name="tel_no" value="<?php echo $_SESSION['uye_tel']; ?>">
            </div>
            <div class="div_uye">
                <label>TC Kimlik Numarası:</label>
                <input type="text" maxlength="11" name="tc_no" value="<?php echo $_SESSION['uye_tc']; ?>">
            </div>
            <div class="div_uye">
                <label>Doğum Tarihi:</label>
                <input type="date" name="dogum_tarihi" value="<?php echo $_SESSION['uye_tarih']; ?>">
            </div>
            <div class="div_uye">
                <label>Cinsiyet:</label>
                <nav>
                    <input type="radio" id="erk" name="cnsyt" value="Erkek">
                    <label for="erk">Erkek</label>
                    <input type="radio" id="kdn" name="cnsyt" value="Kadın">
                    <label for="kdn">Kadın</label>
                </nav>
            </div>

            <?php
            if ($_SESSION['uye_cinsiyet'] == "Erkek") {
                echo '<script>document.getElementById("erk").checked = true;</script>';
            } else {
                echo '<script>document.getElementById("kdn").checked = true;</script>';
            }
            ?>

            <div class="guncelle">
                <input type="submit" name="guncelle" value="Güncelle">
            </div>
        </form>
        <div class="guncelle">
            <button id="sifremesaji" onclick="sifreGoster(this)">Şifremi değiştirmek istiyorum.</button>
            <?php if (isset($_SESSION['alert'])): ?>
                <div class="alert <?php echo $_SESSION['alert_type'] === 'success' ? 'alert-success' : 'alert-danger'; ?>">
                    <?php echo $_SESSION['alert']; ?>
                </div>
                <?php unset($_SESSION['alert'], $_SESSION['alert_type']); ?>
            <?php endif; ?>
        </div>
        <div class="sifre_gnc">
            <form action="sifre_guncelle.php" method="post">
                <div>
                    <label>Mevcut Şifre:</label>
                    <input type="password" name="eski_sifre">
                </div>
                <div>
                    <label>Yeni Şifre:</label>
                    <input type="password" name="yeni_sifre">
                </div>
                <div>
                    <label>Yeni Şifre Tekrar:</label>
                    <input type="password" name="yeni_sifre_tekrar">
                </div>
                <div>
                    <button name="sifre_guncelle">Şifreyi Güncelle</button>
                </div>

            </form>
        </div>
    </div>
</body>

</html>