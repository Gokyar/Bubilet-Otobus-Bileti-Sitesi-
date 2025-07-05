<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/style.css">
    <link rel="stylesheet" href="../css/bootstrap.css">
    <script language="javascript" src="../js/anasayfa.js" defer></script>
    <script src="../js/bootstrap.bundle.js"></script>
    <title>Anasayfa</title>
</head>

<body>
    <nav class="menu">
        <a class="menu_anasayfa" href="index.php">buBİLET</a>
        <div class="menu_uye">
            <div class="dropdown">
                <button class="btn btn-secondary" type="button" onclick="window.location.href='uye_giris.php'" id="uye_giris_btn">ÜYE
                    GİRİŞİ</button>
                <button class="btn btn-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown"
                    aria-expanded="false" id="hesabım_btn" style="display:none">
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
    <div class="login">
        <form class="form1" method="post" action="seyahat_bul.php">
            <h1>
                <?php
                session_start();
                if (isset($_SESSION['uye_id'])) {
                    echo "Hoşgeldin " . $_SESSION['uye_ad']."... Nereye gitmek istersin?";
                    echo "<script> document.getElementById('uye_giris_btn').style.display='none';</script>";
                    echo "<script> document.getElementById('hesabım_btn').style.display='block';</script>";
                }
                else
                    echo "Nereye gitmek istersiniz?";
                ?>
            </h1>
            <label>Kalkış:</label>

            <select id="sehir_sec" name="kalkis">
                <option>Kalkış yapılacak şehri seçiniz...</option>
                <?php
                require_once "db_bagla.php";

                $sehirler = $dbConnection->query("SELECT sehir_ad FROM sehirler");
                foreach ($sehirler as $sehir)
                    echo "<option id='{$sehir['id']}''>" . htmlspecialchars($sehir['sehir_ad']) . "</option>";
                ?>
            </select>

            <label>Varış:</label>
            <select id="sehir_sec" name="varis">
                <option>Gitmek istediğiniz şehri seçiniz...</option>
                <?php
                require_once "db_bagla.php";

                $sehirler = $dbConnection->query("SELECT sehir_ad FROM sehirler");
                foreach ($sehirler as $sehir)
                    echo "<option id='{$sehir['id']}''>" . htmlspecialchars($sehir['sehir_ad']) . "</option>";
                ?>
            </select>

            <label>Tarih:</label>
            <input type="date" class="tarih" id="tarih" name="tarih">
            <button onclick="sehirKontrol(this)">Seyahatleri Gör</button>
        </form>
    </div>

    <script>
        function sehirKontrol(btn) {
            var kalkis = document.getElementsByName("kalkis")[0].value;
            var varis = document.getElementsByName("varis")[0].value;

            if (kalkis == "Kalkış yapılacak şehri seçiniz..." || varis == "Gitmek istediğiniz şehri seçiniz...") {
                alert("Lütfen tüm alanları doğru bir şekilde doldurunuz.");
                window.location.href = "index.php";
                return false;
            }
            else
                btn.form.submit();
        }
    </script>
</body>

</html>