<?php
session_start();

if ($_POST['kalkis'] == "Kalkış yapılacak şehri seçiniz..." || $_POST['varis'] == "Gitmek istediğiniz şehri seçiniz...") {
    echo "<script>window.location.href='index.php';</script>";
    return false;
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/style.css">
    <script src="../js/otobus_sorgu.js"></script>
    <link rel="stylesheet" href="../css/bootstrap.css">
    <script src="../js/bootstrap.bundle.js"></script>
    <title>Sorgulama</title>
</head>

<body>
    <nav class="menu">
        <a class="menu_anasayfa" href="index.php">buBİLET</a>
        <div class="menu_uye">
            <div class="dropdown">
                <button class="btn btn-secondary" type="button" onclick="window.location.href='uye_giris.php'"
                    id="uye_giris_btn">ÜYE
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

    <?php
    session_start();
    if (isset($_SESSION['uye_id'])) {
        echo "<script> document.getElementById('uye_giris_btn').style.display='none';</script>";
        echo "<script> document.getElementById('hesabım_btn').style.display='block';</script>";
    }

    ?>
    <div class="sorgu">
        <?php
        $kalkis = $_POST['kalkis'];
        $varis = $_POST['varis'];
        $tarih = $_POST['tarih'];
        ?>
        <label> Kalkış:</label>
        <input type="text" name="klk" value="<?php echo $kalkis; ?>" readonly>
        <label>Varış:</label>
        <input type="text" name="vrs" value="<?php echo $varis; ?>" readonly>
        <label>Tarih:</label>
        <input type="date" name="trh" value="<?php echo $tarih; ?>" readonly>
    </div>

    <div class="sorgu">
        <table>
            <tr>
                <td>Firma Adı</td>
                <td>Sefer Tarihi</td>
                <td>İstikamet</td>
                <td>Fiyat</td>
            </tr>
        </table>
    </div>

    <div class="seyahatler">
        <?php
        require_once "db_bagla.php";

        try {
            $kalkis = $_POST['kalkis'];
            $varis = $_POST['varis'];
            $tarih = $_POST['tarih'];

            $sqlQuery = "SELECT seyahatler.*,firmalar.ad, (SELECT COUNT(*) FROM seyahatler WHERE 
                        kalkis = '$kalkis' AND varis = '$varis' AND tarih = '$tarih') AS toplam_seyahat 
                        FROM seyahatler INNER JOIN firmalar ON firmalar.id = seyahatler.firma_id WHERE 
                        kalkis = '$kalkis' AND varis = '$varis' AND tarih = '$tarih'";

            $sqlResult = $dbConnection->query($sqlQuery);

            foreach ($sqlResult as $sonuc) {
                if ($sonuc['toplam_seyahat'] == 0) {
                    echo "<h3>Bu tarihte seyahat bulunmamaktadır.</h3>";
                    break;
                } else {
                    $seyahat_id = $sonuc['seyahat_id'];
                    $_SESSION['seyahat_id'] = $seyahat_id;
                    echo "<table class='seyahatler'>
                            <tr>
                                <td>{$sonuc['ad']}</td>
                                <td>Tarih: {$sonuc['tarih']} <br>Saat.: {$sonuc['saat']}</td>
                                <td>{$sonuc['kalkis']} - {$sonuc['varis']}</td>
                                <td>{$sonuc['fiyat']} TL</td>
                                <td><button name='{$sonuc['seyahat_id']}' style='background-color:greenyellow' onclick='koltukSec(this)'>Koltuk Seç</button></td>
                            </tr>
                        </table>";
                }
            }
        } catch (Exception $e) {
            echo $e->getMessage();
        }
        ?>

    </div>

    <div class="koltuk_sec" id="koltuk_sec">
        <table id="tablo">
            <tr>
                <td rowspan="4"></td>
                <td rowspan="4"></td>
                <td class="koltuk" id="1" onclick="seciliKoltuk(this)"><button>1</button></td>
                <td class="koltuk" id="4" onclick="seciliKoltuk(this)"><button>4</button></td>
                <td class="koltuk" id="7" onclick="seciliKoltuk(this)"><button>7</button></td>
                <td class="koltuk" id="10" onclick="seciliKoltuk(this)"><button>10</button></td>
                <td class="koltuk" id="13" onclick="seciliKoltuk(this)"><button>13</button></td>
                <td class="koltuk" id="16" onclick="seciliKoltuk(this)"><button>16</button></td>
                <td class="koltuk" id="19" onclick="seciliKoltuk(this)"><button>19</button></td>
                <td rowspan="2"></td>
                <td class="koltuk" id="23" onclick="seciliKoltuk(this)"><button>23</button></td>
                <td class="koltuk" id="26" onclick="seciliKoltuk(this)"><button>26</button></td>
                <td class="koltuk" id="29" onclick="seciliKoltuk(this)"><button>29</button></td>
                <td class="koltuk" id="32" onclick="seciliKoltuk(this)"><button>32</button></td>
                <td class="koltuk" id="35" onclick="seciliKoltuk(this)"><button>35</button></td>
                <td class="koltuk" id="38" onclick="seciliKoltuk(this)"><button>38</button></td>
            </tr>
            <tr>
                <td class="koltuk" id="2" onclick="seciliKoltuk(this)"><button>2</button></td>
                <td class="koltuk" id="5" onclick="seciliKoltuk(this)"><button>5</button></td>
                <td class="koltuk" id="8" onclick="seciliKoltuk(this)"><button>8</button></td>
                <td class="koltuk" id="11" onclick="seciliKoltuk(this)"><button>11</button></td>
                <td class="koltuk" id="14" onclick="seciliKoltuk(this)"><button>14</button></td>
                <td class="koltuk" id="17" onclick="seciliKoltuk(this)"><button>17</button></td>
                <td class="koltuk" id="20" onclick="seciliKoltuk(this)"><button>20</button></td>
                <td class="koltuk" id="24" onclick="seciliKoltuk(this)"><button>24</button></td>
                <td class="koltuk" id="27" onclick="seciliKoltuk(this)"><button>27</button></td>
                <td class="koltuk" id="30" onclick="seciliKoltuk(this)"><button>30</button></td>
                <td class="koltuk" id="33" onclick="seciliKoltuk(this)"><button>33</button></td>
                <td class="koltuk" id="36" onclick="seciliKoltuk(this)"><button>36</button></td>
                <td class="koltuk" id="39" onclick="seciliKoltuk(this)"><button>39</button></td>

            </tr>
            <tr>
                <td colspan="13" class=""></td>
                <td class="koltuk" id="40" onclick="seciliKoltuk(this)"><button>40</button></td>
            </tr>
            <tr>
                <td class="koltuk" id="3" onclick="seciliKoltuk(this)"><button>3</button></td>
                <td class="koltuk" id="6" onclick="seciliKoltuk(this)"><button>6</button></td>
                <td class="koltuk" id="9" onclick="seciliKoltuk(this)"><button>9</button></td>
                <td class="koltuk" id="12" onclick="seciliKoltuk(this)"><button>12</button></td>
                <td class="koltuk" id="15" onclick="seciliKoltuk(this)"><button>15</button></td>
                <td class="koltuk" id="18" onclick="seciliKoltuk(this)"><button>18</button></td>
                <td class="koltuk" id="21" onclick="seciliKoltuk(this)"><button>21</button></td>
                <td class="koltuk" id="22" onclick="seciliKoltuk(this)"><button>22</button></td>
                <td class="koltuk" id="25" onclick="seciliKoltuk(this)"><button>25</button></td>
                <td class="koltuk" id="28" onclick="seciliKoltuk(this)"><button>28</button></td>
                <td class="koltuk" id="31" onclick="seciliKoltuk(this)"><button>31</button></td>
                <td class="koltuk" id="34" onclick="seciliKoltuk(this)"><button>34</button></td>
                <td class="koltuk" id="37" onclick="seciliKoltuk(this)"><button>37</button></td>
                <td class="koltuk" id="41" onclick="seciliKoltuk(this)"><button>41</button></td>
            </tr>
        </table>

        <?php
        $sqlQuery = "select * from koltuklar where seyahat_id=" . $_SESSION['seyahat_id'];
        $sqlResult = $dbConnection->query($sqlQuery);
        foreach ($sqlResult as $koltuk) {
            if ($koltuk['cinsiyet'] == "E") {
                echo "<script>document.getElementById('{$koltuk['koltuk_id']}').style.backgroundImage='url(../Resimler/erkek_koltuk.png)';</script>";
            } else {
                echo "<script>document.getElementById('{$koltuk['koltuk_id']}').style.backgroundImage='url(../Resimler/kadin_koltuk.png)';</script>";
            }
        }
        ?>
    </div>
    <div class="butonlar" id="butonlar">
        <table>
            <tr>
                <td colspan="3">
                    <label>Önce oturmak istediğiniz koltuğu seçin ardından cinsiyetinizin bulunduğu butona
                        tıklayınız...</label>
                </td>
            </tr>
            <tr>
                <td colspan="3">
                    <button class="cinsiyet" style="background-color:turquoise" id="erk"
                        onclick="cinsiyet_secme(this)">Erkek</button>
                    <button class="cinsiyet" style="background-color:violet" id="kdn"
                        onclick="cinsiyet_secme(this)">Kadın</button>
                    </tdco>
            </tr>
            <tr>
                <td colspan>
                    <label for="koltuk">Seçtiğiniz Koltuk:</label>
                    <input type="text" id="koltuk_no" value=" " readonly>
                </td>
            </tr>
            <tr>
                <td>
                    <label for="cinsiyet">Cinsiyet:</label>
                    <input type="text" id="cinsiyet" value=" " readonly>
                </td>
            </tr>
            <tr>
                <td colspan="3" style="text-align:center">
                    <button class="vazgec_btn" onclick="vazgec(this)">Vazgeç</button>
                    <button class="odeme_btn" onclick="odeme_yonlendir(this)">Ödeme Yap</button>
                </td>
            </tr>
        </table>
    </div>
    <script>
        function koltukSec(btn) {
            if (btn.innerHTML == 'Kapat') {
                var koltuk_sec = document.getElementById('koltuk_sec');
                koltuk_sec.classList.toggle('koltuk_sec_goster');
                btn.innerHTML = "Koltuk Seç";
                btn.style.backgroundColor = "greenyellow";

                var butonlar = document.getElementById('butonlar');
                butonlar.classList.toggle('butonlar_goster');
                var otobus = document.getElementById('tablo');
                otobus.classList.toggle('otobus');

                setTimeout(function () {
                    var table = document.getElementById('tablo');
                    table.classList.toggle('otobus');
                    table.style.display = 'none';

                    var butonlar = document.getElementById('butonlar');
                    butonlar.classList.toggle('butonlar_goster');
                    butonlar.style.display = 'none';
                }, 0)

                return;
            }
            var koltuk_sec = document.getElementById('koltuk_sec');
            koltuk_sec.classList.toggle('koltuk_sec_goster');
            btn.innerHTML = "Kapat";
            btn.style.backgroundColor = "tomato";

            var otobus = document.getElementById('tablo');
            otobus.classList.toggle('otobus');

            var butonlar = document.getElementById('butonlar');
            butonlar.classList.toggle('butonlar_goster');

            setTimeout(function () {
                var table = document.getElementById('tablo');
                table.style.display = 'block';

                var butonlar = document.getElementById('butonlar');
                butonlar.style.display = 'block';
            }, 650)
        }

        let global_koltuk_id = null;
        let koltukSecildimi = false;
        let cinsiyet_kontrol = false;
        let cinsiyet = null;

        function seciliKoltuk(koltuk_secme) {
            if (koltukSecildimi) {
                alert('Önce seçtiğiniz koltuğu vazgeç butonundan iptal ediniz...');
                return;
            }

            var koltuk_id = koltuk_secme.id;
            global_koltuk_id = koltuk_id;
            fetch('koltuk_id_atama.php', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json'
                },

                body: JSON.stringify({ sessionVeri: koltuk_id })

            })
                .then(response => response.json())
                .then(data => {
                    console.log('Sunucudan gelen cevap:', data);
                })
                .catch((error) => {
                    console.log('Hata:', error);
                });

            const koltuk = window.getComputedStyle(koltuk_secme);
            if (koltuk.backgroundImage.includes("secili_koltuk.png")) {
                koltuk_secme.style.backgroundImage = "url('../Resimler/koltuk.png')";
                document.getElementById('koltuk_no').value = '';
            }
            else if (koltuk.backgroundImage.includes("erkek_koltuk.png") || koltuk.backgroundImage.includes("kadin_koltuk.png")) {
                alert('Bu koltuk doludur... Başka bir koltuk seçiniz...');
                return;
            }
            else {
                koltuk_secme.style.backgroundImage = "url('../Resimler/secili_koltuk.png')";
                document.getElementById('koltuk_no').value = koltuk_id;
                koltukSecildimi = true;
            }
        }


        function cinsiyet_secme(cinsiyet) {
            if (global_koltuk_id == null) {
                alert('Önce koltuk seçmelisiniz...');
                return;
            }

            console.log("Cinsiyet Seçimi için Koltuk Id:", global_koltuk_id);

            if (cinsiyet.id == 'erk') {

                cinsiyet = "E";
                document.getElementById('cinsiyet').value = 'Erkek';

                const koltuk = document.getElementById(global_koltuk_id);
                koltuk.style.backgroundImage = "url('../Resimler/erkek_koltuk.png')";

                cinsiyet_kontrol = true;
            }
            else {
                cinsiyet = "K";
                document.getElementById('cinsiyet').value = 'Kadın';
                const koltuk = document.getElementById(global_koltuk_id);
                koltuk.style.backgroundImage = "url('../Resimler/kadin_koltuk.png')";

                cinsiyet_kontrol = true;

            }

            fetch('cinsiyet_ata.php', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json'
                },

                body: JSON.stringify({ session_cinsiyet: cinsiyet })

            })
                .then(response => response.json())
                .then(data => {
                    console.log('Sunucudan gelen cevap:', data);
                })
                .catch((error) => {
                    console.log('Hata:', error);
                });

        }

        function vazgec() {
            const koltuk = document.getElementById(global_koltuk_id);
            koltuk.style.backgroundImage = "url('../Resimler/koltuk.png')";
            global_koltuk_id = null;
            koltukSecildimi = false;
            document.getElementById('koltuk_no').value = '';
            document.getElementById('cinsiyet').value = '';
        }

        function odeme_yonlendir() {
            var giris_kontrol = "<?php echo $_SESSION['uye_id']; ?>";
            if (giris_kontrol == "") {
                alert('Biletinizi almanız için giriş yapmalısınız...');
                window.location.href = 'uye_giris.php';
                return;
            }
            if (koltukSecildimi == false) {
                alert('Önce koltuk seçmelisiniz...');
                return;
            }
            else if (cinsiyet_kontrol == false) {
                alert('Önce cinsiyet seçmelisiniz...');
                return;
            }


            else
                window.location.href = 'odeme.php';
        }


    </script>
</body>

</html>