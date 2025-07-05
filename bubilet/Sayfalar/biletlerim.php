<?php 
session_start();
require_once "db_bagla.php";

if (!isset($_SESSION['show_iptal'])) {
    $_SESSION['show_iptal'] = false;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['bilet_iptal'])) {
        $_SESSION['show_iptal'] = true;
    } 
    
    elseif (isset($_POST['iptal'])) {
        $bilet_id = $_POST['bilet_id'];
        $uye_id = $_SESSION["uye_id"];
    
        // Biletler tablosundan sil
        $sqlQuery = "DELETE FROM biletler WHERE bilet_id = :bilet_id AND uye_id = :uye_id";
        $stmt = $dbConnection->prepare($sqlQuery);
        $stmt->bindParam(':bilet_id', $bilet_id, PDO::PARAM_INT);
        $stmt->bindParam(':uye_id', $uye_id, PDO::PARAM_INT);
        $stmt->execute();
    
        // Koltuklar tablosundan sil (ilgili koltuğu kaldırmak için)
        $sqlQuery2 = "DELETE FROM koltuklar WHERE koltuk_id = (SELECT koltuk_no FROM biletler WHERE bilet_id = :bilet_id)";
        $stmt2 = $dbConnection->prepare($sqlQuery2);
        $stmt2->bindParam(':bilet_id', $bilet_id, PDO::PARAM_INT);
        $stmt2->execute();
    
        $_SESSION['show_iptal'] = false;
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
    <title>Biletlerim</title>
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

    <div class="biletlerim">
        <table>
            <tr>
                <td>Seyahat No</td>
                <td>Firma Adı</td>
                <td>Sefer Tarihi</td>
                <td>İstikamet</td>
                <td>Yolcu Adı</td>
                <td>Koltuk Numarası</td>
                <td>Fiyat</td>
            </tr>
        </table>
    </div>

    <?php
    session_start();
    require_once "db_bagla.php";
    $uye_id = $_SESSION['uye_id'];

    $sqlQuery = "select * from biletler, seyahatler, firmalar where (biletler.seyahat_id = seyahatler.seyahat_id) and (firmalar.id = seyahatler.firma_id) and uye_id = " . $uye_id . " order by tarih desc";
    $sqlResult = $dbConnection->query($sqlQuery);
    $currentDate = date("Y-m-d");
    foreach ($sqlResult as $biletler) {

        $tarih_kontrol = (strtotime($biletler["tarih"]) < strtotime($currentDate)) ? true : false;

        echo "<div class='biletlerim'>
            <table>
                <tr>
                    <td>" . $biletler["bilet_id"] . "</td>
                    <td>" . $biletler["ad"];//firma adı
    
        if ($tarih_kontrol) {
            echo "<br><span style='color: red;'>Geçmiş</span></td>"; //eğer bilet tarihi geçmişse firma adının altına yazı yazdıracak.
        } else
            echo "</td>";

        echo "<td>Tarih.:" . $biletler["tarih"] . "<br>Saat..:" . $biletler["saat"] . "</td>
                    <td>" . $biletler["kalkis"] . "-" . $biletler["varis"] . "</td>
                    <td>" . $biletler["yolcu_ad"] . " " . $biletler["yolcu_soyad"] . "</td>
                    <td>" . $biletler["koltuk_no"] . "</td>
                    <td>" . $biletler["fiyat"] . "TL" . "</td>
                </tr>
            </table>
        </div>";
    }

    

    ?>
    <form method="post" action="">
        <div class="kartlarim" style="display: <?php echo $_SESSION['show_iptal'] ? 'block' : 'none'; ?>">
            <label> Kaç numaralı bileti iptal etmek istersiniz..: </label>
            <?php
            session_start();

            $sqlQuery = "select * from biletler where uye_id = " . $_SESSION["uye_id"];
            $sqlResult = $dbConnection->query($sqlQuery);

            if ($_SESSION['show_iptal']) {
                echo "<select name='bilet_id'>
                    <option value=''>Bilet Numarasını Girin</option>";
                foreach ($sqlResult as $biletler) {
                    echo "<option value='" . $biletler["bilet_id"] . "'>".$biletler["bilet_id"]." Numaralı Bilet".  "</option>";
                };
                echo "</select>";
            }
            ?>
            <button type='submit' name='iptal' style="background-color:tomato">İptal Et</button>
            <button type='submit' name='vazgec' style="background-color:greenyellow">Vazgeç</button>

        </div>

        <div class="kart_ekle_sil">
            <button type="submit" name="bilet_iptal">
                Biletimi İptal Etmek İstiyorum.
            </button>
        </div>
    </form>
</body>

</html>