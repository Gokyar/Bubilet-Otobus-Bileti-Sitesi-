<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

require_once "db_bagla.php";

// if (isset($_POST['onayla'])) {
//     $_SESSION['kart_id'] = $_POST['kart_id'];
//     $sqlQuery = "select * from kartlar where id = " . $_SESSION['kart_id'];
//     $stmt = $dbConnection->prepare($sqlQuery);
//     $stmt->bindParam(':kart_id', $_SESSION['kart_id'], PDO::PARAM_INT);
//     $stmt->execute();
//     $kartlar = $stmt->fetch(PDO::FETCH_ASSOC);
//     if ($kartlar) {
//         $_SESSION['kart_sahibi'] = $kartlar['kart_sahibi'];
//         $_SESSION['kart_no'] = $kartlar['kart_no'];
//     }
// }


if (isset($_POST['odeme_yap'])) {
    // üye bilgileri kısmındaki değerleri sessiona atıyoruz
    $yolcu_ad = $_SESSION['yolcu_ad'];
    $yolcu_soyad = $_SESSION['yolcu_soyad'];
    $yolcu_tc = $_SESSION['yolcu_tc'];

    $koltuk_id = $_SESSION['koltuk_id'];
    $uye_id = $_SESSION['uye_id'];
    $seyahat_id = $_SESSION['seyahat_id'];
    $cinsiyet = $_SESSION['cinsiyet'];

    $sqlQuery = "INSERT INTO biletler(uye_id, seyahat_id, koltuk_no, yolcu_ad, yolcu_soyad, yolcu_tc) VALUES 
    ($uye_id, $seyahat_id, $koltuk_id, '$yolcu_ad', '$yolcu_soyad', '$yolcu_tc')";
    $sqlResult = $dbConnection->exec($sqlQuery);

    $sqlQuery2 = "INSERT INTO koltuklar(uye_id, seyahat_id, koltuk_id,cinsiyet) VALUES
    ($uye_id, $seyahat_id, $koltuk_id,'$cinsiyet')";
    $sqlResult2 = $dbConnection->exec($sqlQuery2);

    header("Location:biletlerim.php");
}



?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="../css/style.css">
    <script src="../js/odeme.js"></script>
    <link rel="stylesheet" href="../css/bootstrap.css">
    <script src="../js/bootstrap.bundle.js"></script>
    <title>Ödeme</title>
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
    <nav class="odeme" style="border-top-left-radius: 15px;
    border-top-right-radius: 15px;">
        <h2 style="text-align:center;margin:10px;">BİLGİLER</h2>
        <div class="bilgiler1">
            <table>
                <tr>
                    <td>
                        <h4>Yolcu Bilgileri</h4>
                    </td>
                </tr>
                <tr>
                    <td>Yolcu Adı:</td>
                    <td>
                        <input type="text" id="yolcu_ad" name="yolcu_ad">

                    </td>
                </tr>
                <tr>
                    <td>Yolcu Soyadı:</td>
                    <td>
                        <input type="text" id="yolcu_soyad" name="yolcu_soyad">
                    </td>
                </tr>
                <tr>
                    <td>Yolcu TC Kimlik Numarası: </td>
                    <td>
                        <input type="text" id="yolcu_tc" name="yolcu_tc">
                    </td>
                </tr>
                <tr>
                    <td colspan="2" style="text-align: center">
                        <button class="kullanici_info" style="padding: 5px;" onclick="personel_info()">BİLGİLERİ ONAYLA</button>
                    </td>
                </tr>
            </table>
            <div>
                <?php
                $sqlQuery = "select * from seyahatler where seyahat_id = " . $_SESSION['seyahat_id'];
                $sqlResult = $dbConnection->query($sqlQuery);

                foreach ($sqlResult as $seyahat) {
                    $_SESSION['fiyat'] = $seyahat['fiyat'];
                    $_SESSION['kalkis'] = $seyahat['kalkis'];
                    $_SESSION['varis'] = $seyahat['varis'];
                    $_SESSION['kalkis_tarihi'] = $seyahat['tarih'];
                    $_SESSION['kalkis_saati'] = $seyahat['saat'];
                    $_SESSION['firma_id'] = $seyahat['firma_id'];
                }

                $sqlQuery2 = "select * from firmalar where id = " . $_SESSION['firma_id'];
                $sqlResult2 = $dbConnection->query($sqlQuery2);

                foreach ($sqlResult2 as $firma) {
                    $_SESSION['firma'] = $firma['ad'];
                }

                ?>
                <table>
                    <tr>
                        <td>
                            <h4>Bilet Bilgileri</h4>
                        </td>
                    </tr>
                    <tr>
                        <td>Firma:</td>
                        <td><input type="text" id="firma" name="firma" style="font-size: 15px;" disabled
                                value="<?php echo $_SESSION['firma']; ?>"></td>
                    </tr>
                    <tr>
                        <td>Kalkış:</td>
                        <td><input type="text" id="kalkis" name="kalkis" disabled
                                value="<?php echo $_SESSION['kalkis']; ?>"></td>
                    </tr>
                    <tr>
                        <td>Varış:</td>
                        <td><input type="text" id="varis" name="varis" disabled
                                value="<?php echo $_SESSION['varis']; ?>"></td>
                    </tr>
                    <tr class="tarih_saat">
                        <td>Kalkış Tarihi:</td>
                        <td><input type="text" id="kalkis_tarihi" name="kalkis_tarihi" disabled
                                value="Tarih: <?php echo $_SESSION['kalkis_tarihi']; ?>"><br><input id="kalkis_saati"
                                name="kalkis_saati" disabled value="Saat:  <?php echo $_SESSION['kalkis_saati']; ?>">
                        </td>
                    </tr>
                    <tr>
                        <td>Koltuk Numarası:</td>
                        <td><input type="text" id="koltuk_no" name="koltuk_no" disabled
                                value="<?php echo $_SESSION['koltuk_id'] ?>"></td>
                    </tr>
                    <tr>
                        <td>Fiyat:</td>
                        <td><input type="text" id="bilet_fiyati" name="bilet_fiyati" disabled
                                value="<?php echo $_SESSION['fiyat']; ?> TL"></td>
                    </tr>
                </table>
            </div>

        </div>
    </nav>

    <nav class="odeme">
        <div class="bilgiler1">
            <table>
                <tr>
                    <td>
                        <h4>Kart Bilgileri</h4>
                    </td>
                </tr>
                <tr>
                    <td>Kart Sahibi:</td>
                    <td><input type="text" id="kart_sahibi" name="kart_sahibi" value=""></td>
                </tr>
                <tr>
                    <td>Kart Numarası:</td>
                    <td><input type="text" id="kart_no" name="kart_no" value=""></td>
                </tr>
                <tr>
                    <td>Son Kullanma Tarihi:</td>
                    <td><input type="text" id="son_kullanma_tarihi" name="son_kullanma_tarihi" placeholder="AA/YY"></td>
                </tr>
                <tr>
                    <td>CVV:</td>
                    <td><input type="text" id="cvv" name="cvv"></td>
                </tr>

            </table>
        </div>
    </nav>
    <div class="kart_sec" style="display:none">
        <table>
            <tr>
                <td>
                    <form method="post" action="">
                        Kayıtlı Kartlar:
                        <select name='kart_id' onchange="kartSec()">
                            <option value=''>Kart Seçiniz</option>
                            <?php
                            $sqlQuery = "SELECT * FROM kartlar WHERE uye_id = :uye_id";
                            $stmt = $dbConnection->prepare($sqlQuery);
                            $stmt->bindParam(':uye_id', $_SESSION["uye_id"], PDO::PARAM_INT);
                            $stmt->execute();
                            foreach ($stmt as $kartlar) {
                                echo "<option value='" . $kartlar["id"] . "'>" . $kartlar["kart_ad"] . "</option>";
                            }
                            ?>
                        </select>
                    </form>

                </td>
            </tr>
        </table>
    </div>
    <div class="odeme_yap">
        <button id="kayitli_kart_btn" class="kayit_kart" onclick="kartGoster(this)">Kayıtlı kartımı kullanmak
            istiyorum.</button><br>
        <form method="post" action="">
            <button class="odeme_btn" id="odeme_yap" name="odeme_yap">Ödeme Yap</button>
        </form>

    </div>

    <script>
        function kartGoster() {
            var kartSecDiv = document.getElementsByClassName('kart_sec')[0];
            var kartBtn = document.getElementById("kayitli_kart_btn");

            if (kartBtn.innerHTML == "Yukarıdaki bölümden kartınızı seçebilirsiniz. Lütfen güvenlik sebebiyle 'Son Kullama Tarihi' ve 'CVV' kısmını kendiniz doldurunuz.") {
                kartSecDiv.style.display = "none";
                kartBtn.innerHTML = "Kayıtlı kartımı kullanmak istiyorum.";
                document.getElementById('kart_sahibi').value = '';
                document.getElementById('kart_no').value = '';
            } else {
                kartSecDiv.style.display = "block";
                kartBtn.innerHTML = "Yukarıdaki bölümden kartınızı seçebilirsiniz. Lütfen güvenlik sebebiyle 'Son Kullama Tarihi' ve 'CVV' kısmını kendiniz doldurunuz.";
            }
        }


        function kartSec() {
            var kartId = document.querySelector('select[name="kart_id"]').value;

            if (kartId) {
                var xhr = new XMLHttpRequest();
                xhr.open('GET', 'kart_bilgilerini_al.php?kart_id=' + kartId, true);
                xhr.onload = function () {
                    if (xhr.status === 200) {
                        var kart = JSON.parse(xhr.responseText);
                        if (kart) {
                            document.getElementById('kart_sahibi').value = kart.kart_sahibi;
                            document.getElementById('kart_no').value = kart.kart_no;
                        }
                    }
                };
                xhr.send();
            }
        }

        function personel_info() {
            var yolcu_ad = document.getElementById('yolcu_ad').value;
            var yolcu_soyad = document.getElementById('yolcu_soyad').value;
            var yolcu_tc = document.getElementById('yolcu_tc').value;


            fetch('yolcu_bilgileri_ata.php', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json'
                },

                body: JSON.stringify({ session_yolcu_ad: yolcu_ad,
                    session_yolcu_soyad: yolcu_soyad,
                    session_yolcu_tc: yolcu_tc
                 })

            })
                .then(response => response.json())
                .then(data => {
                    console.log('Sunucudan gelen cevap:', data);
                })
                .catch((error) => {
                    console.log('Hata:', error);
                });
                
        }
    </script>

    <?php echo "<h1>" . $_SESSION['seyahat_id'] . "</h1>" ?>
</body>

</html>