<?php
session_start();
require_once "db_bagla.php";

if (!isset($_SESSION['show_sil'])) {
    $_SESSION['show_sil'] = false;
}
if (!isset($_SESSION['show_ekle'])) {
    $_SESSION['show_ekle'] = false;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['kart_sil'])) {
        $_SESSION['show_sil'] = true;
        $_SESSION['show_ekle'] = false;
    } 
    elseif (isset($_POST['kart_ekle'])) {
        $_SESSION['show_ekle'] = true;
        $_SESSION['show_sil'] = false;
    } 
    
    elseif (isset($_POST['sil']) && isset($_POST['kart_id']) && $_POST['kart_id'] !== '') {
        $kart_id = $_POST['kart_id'];
        $sqlQuery = "delete from kartlar where id =" . $kart_id . " and uye_id = " . $_SESSION["uye_id"];
        $sqlDelete = $dbConnection->exec($sqlQuery);
        $_SESSION['show_sil'] = false;
    }

    elseif(isset($_POST['ekle']) && isset($_POST['kart_ad']) && isset($_POST['kart_sahibi']) && isset($_POST['kart_no']) && $_POST['kart_ad'] !== '' && $_POST['kart_sahibi'] !== '' && $_POST['kart_no'] !== '') {
        $kart_ad = $_POST['kart_ad'];
        $kart_sahibi = $_POST['kart_sahibi'];
        $kart_no = $_POST['kart_no'];
        $sqlQuery = "insert into kartlar (kart_ad, kart_sahibi, kart_no, uye_id) values ('$kart_ad', '$kart_sahibi', '$kart_no', " . $_SESSION["uye_id"] . ")";
        $sqlInsert = $dbConnection->exec($sqlQuery);
        $_SESSION['show_ekle'] = false;
    }

    elseif (isset($_POST['vazgec'])) {
        $_SESSION['show_sil'] = false;
        $_SESSION['show_ekle'] = false;
    }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/style.css">
    <link rel="stylesheet" href="../css/bootstrap.css">
    <script src="../js/bootstrap.bundle.js"></script>
    <title>Kartlarım</title>
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

    <div class="kartlarim">
        <table>
            <tr>
                <td>Kart Adı</td>
                <td>Kart Sahibi</td>
                <td>Kart Numarası</td>
            </tr>
        </table>
    </div>

    <?php

    $sqlQuery = "select * from kartlar where uye_id = " . $_SESSION["uye_id"];
    $sqlResult = $dbConnection->query($sqlQuery);

    foreach ($sqlResult as $kartlar) {
        echo "<div class='kartlarim'>
            <table>
                <tr>
                    <td>" . $kartlar["kart_ad"] . "</td>
                    <td>" . $kartlar["kart_sahibi"] . "</td>
                    <td>" . $kartlar["kart_no"] . "</td>
                </tr>
            </table>
            </div>";
    }
    ?>

    <form method="post" action="">
        <div class="kartlarim" style="display: <?php echo $_SESSION['show_sil'] ? 'block' : 'none'; ?>">
            <label> Silmek İstediğiniz kartı yan taraftaki bölümden seçiniz..: </label>
            <?php
            session_start();

            $sqlQuery = "select * from kartlar where uye_id = " . $_SESSION["uye_id"];
            $sqlResult = $dbConnection->query($sqlQuery);

            if ($_SESSION['show_sil']) {
                echo "<select name='kart_id'>
                    <option value=''>Kart Seçiniz</option>";
                foreach ($sqlResult as $kartlar) {
                    echo "<option value='" . $kartlar["id"] . "'>" . $kartlar["kart_ad"] . "</option>";
                };
                echo "</select>";
            }
            ?>
            <button type='submit' name='sil' style="background-color:tomato">Sil</button>
            <button type='submit' name='vazgec' style="background-color:greenyellow">Vazgeç</button>

        </div>

        <div class="kartlarim" style="display: <?php echo $_SESSION['show_ekle'] ? 'block' : 'none'; ?>">
            <table>
                <th>Kart Ekleme</th>
                <tr>
                    <td>Kart Adı:</td>
                    <td>Kart Sahibi:</td>
                    <td>Kart Numarası:</td>
                </tr>
                <tr>
                    <td><input type="text" name="kart_ad"></td>
                    <td><input type="text" name="kart_sahibi"></td>
                    <td><input type="text" name="kart_no"></td>
                </tr>
            </table>
            <button type='submit' name='ekle' style="margin:0;margin-top:10px;background-color:yellowgreen">Ekle</button>
            <button type='submit' name='vazgec' style="margin:0;background-color:tomato">Vazgeç</button>
        </div>
        <div class="kart_ekle_sil">
            <button type="submit" name="kart_sil">
                Kart Sil
            </button>
            <button name="kart_ekle">
                Kart Ekle
            </button>
        </div>
    </form>
</body>

</html>