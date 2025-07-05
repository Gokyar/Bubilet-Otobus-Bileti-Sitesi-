-- phpMyAdmin SQL Dump
-- version 4.9.1
-- https://www.phpmyadmin.net/
--
-- Anamakine: localhost
-- Üretim Zamanı: 11 Ara 2024, 10:39:28
-- Sunucu sürümü: 8.0.17
-- PHP Sürümü: 7.3.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Veritabanı: `bubilet`
--

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `biletler`
--

CREATE TABLE `biletler` (
  `bilet_id` int(11) NOT NULL,
  `uye_id` int(11) UNSIGNED NOT NULL,
  `seyahat_id` int(11) NOT NULL,
  `koltuk_no` int(11) NOT NULL,
  `yolcu_ad` varchar(30) CHARACTER SET utf8 COLLATE utf8_turkish_ci NOT NULL,
  `yolcu_soyad` varchar(30) CHARACTER SET utf8 COLLATE utf8_turkish_ci NOT NULL,
  `yolcu_tc` varchar(11) CHARACTER SET utf8 COLLATE utf8_turkish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_turkish_ci;

--
-- Tablo döküm verisi `biletler`
--

INSERT INTO `biletler` (`bilet_id`, `uye_id`, `seyahat_id`, `koltuk_no`, `yolcu_ad`, `yolcu_soyad`, `yolcu_tc`) VALUES
(1, 1, 1, 1, 'Ali İhsan', 'Gökyar', '12312312312'),
(2, 1, 1, 11, 'Ferhan', 'Aslan', '15915915915'),
(3, 1, 16, 17, 'Ferhan', 'Aslan', '15915915915'),
(4, 1, 1, 16, 'Ali İhsan', 'Aslan', '12312312312');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `firmalar`
--

CREATE TABLE `firmalar` (
  `id` int(11) NOT NULL,
  `ad` varchar(30) CHARACTER SET utf8 COLLATE utf8_turkish_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_turkish_ci;

--
-- Tablo döküm verisi `firmalar`
--

INSERT INTO `firmalar` (`id`, `ad`) VALUES
(1, 'KAMİL KOÇ'),
(2, 'KONTUR'),
(3, 'ÖZKAYMAK'),
(4, 'ALİ OSMAN ULUSOY'),
(5, 'ISPARTA PETROL TURİZM'),
(6, 'GÜNEY AKDENİZ SEYAHAT'),
(7, 'PAMUKKALE TURİZM');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `kartlar`
--

CREATE TABLE `kartlar` (
  `id` int(11) NOT NULL,
  `uye_id` int(11) UNSIGNED NOT NULL,
  `kart_ad` varchar(20) CHARACTER SET utf8 COLLATE utf8_turkish_ci NOT NULL,
  `kart_sahibi` varchar(50) CHARACTER SET utf8 COLLATE utf8_turkish_ci NOT NULL,
  `kart_no` varchar(16) CHARACTER SET utf8 COLLATE utf8_turkish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_turkish_ci;

--
-- Tablo döküm verisi `kartlar`
--

INSERT INTO `kartlar` (`id`, `uye_id`, `kart_ad`, `kart_sahibi`, `kart_no`) VALUES
(2, 1, 'Akbank', 'ALİ İHSAN GÖKYAR', '122222222222222'),
(4, 2, 'Ziraat', 'NURULLAH YILDIRIM', '211111111111111'),
(5, 2, 'Akbank', 'NURULLAH YILDIRIM', '222222222222222'),
(6, 3, 'Ziraat', 'Mehmet Yılmaz', '3444556677888888'),
(7, 3, 'Akbank', 'Mehmet Yılmaz', '3444556677889999'),
(8, 3, 'İş Bankası', 'Mehmet Yılmaz', '3444556677890000'),
(9, 4, 'Garanti', 'Ayşe Demir', '4555667788990011'),
(10, 4, 'DenizBank', 'Ayşe Demir', '4555667788990022'),
(11, 5, 'Halkbank', 'Fatma Kaya', '5666778899001122'),
(13, 1, 'Ziraat', 'ALİ İHSAN GÖKYAR', '1111111111111111'),
(15, 6, 'Garanti', 'İbrahim Gündüz', '1414141414141414');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `koltuklar`
--

CREATE TABLE `koltuklar` (
  `koltuk_id` int(11) NOT NULL,
  `uye_id` int(10) UNSIGNED NOT NULL,
  `seyahat_id` int(11) NOT NULL,
  `cinsiyet` varchar(5) CHARACTER SET utf8 COLLATE utf8_turkish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Tablo döküm verisi `koltuklar`
--

INSERT INTO `koltuklar` (`koltuk_id`, `uye_id`, `seyahat_id`, `cinsiyet`) VALUES
(1, 1, 1, 'E'),
(2, 6, 1, 'E'),
(10, 6, 1, 'K'),
(11, 1, 1, 'K'),
(13, 1, 1, 'E'),
(16, 1, 1, 'E'),
(17, 1, 16, 'K'),
(19, 6, 1, 'E'),
(20, 1, 1, 'K'),
(26, 6, 1, 'K');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `sehirler`
--

CREATE TABLE `sehirler` (
  `id` int(10) UNSIGNED NOT NULL,
  `sehir_ad` varchar(30) CHARACTER SET utf8 COLLATE utf8_turkish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_turkish_ci;

--
-- Tablo döküm verisi `sehirler`
--

INSERT INTO `sehirler` (`id`, `sehir_ad`) VALUES
(1, 'Adana'),
(2, 'Adıyaman'),
(3, 'Afyonkarahisar'),
(4, 'Ağrı'),
(5, 'Aksaray'),
(6, 'Amasya'),
(7, 'Ankara'),
(8, 'Antalya'),
(9, 'Ardahan'),
(10, 'Artvin'),
(11, 'Aydın'),
(12, 'Balıkesir'),
(13, 'Bartın'),
(14, 'Batman'),
(15, 'Bayburt'),
(16, 'Bilecik'),
(17, 'Bingöl'),
(18, 'Bitlis'),
(19, 'Bolu'),
(20, 'Burdur'),
(21, 'Bursa'),
(22, 'Çanakkale'),
(23, 'Çankırı'),
(24, 'Çorum'),
(25, 'Denizli'),
(26, 'Diyarbakır'),
(27, 'Düzce'),
(28, 'Edirne'),
(29, 'Elazığ'),
(30, 'Erzincan'),
(31, 'Erzurum'),
(32, 'Eskişehir'),
(33, 'Gaziantep'),
(34, 'Giresun'),
(35, 'Gümüşhane'),
(36, 'Hakkâri'),
(37, 'Hatay'),
(38, 'Iğdır'),
(39, 'Isparta'),
(40, 'İstanbul'),
(41, 'İzmir'),
(42, 'Kahramanmaraş'),
(43, 'Karabük'),
(44, 'Karaman'),
(45, 'Kars'),
(46, 'Kastamonu'),
(47, 'Kayseri'),
(48, 'Kırıkkale'),
(49, 'Kırklareli'),
(50, 'Kırşehir'),
(51, 'Kilis'),
(52, 'Kocaeli'),
(53, 'Konya'),
(54, 'Kütahya'),
(55, 'Malatya'),
(56, 'Manisa'),
(57, 'Mardin'),
(58, 'Mersin'),
(59, 'Muğla'),
(60, 'Muş'),
(61, 'Nevşehir'),
(62, 'Niğde'),
(63, 'Ordu'),
(64, 'Osmaniye'),
(65, 'Rize'),
(66, 'Sakarya'),
(67, 'Samsun'),
(68, 'Şanlıurfa'),
(69, 'Siirt'),
(70, 'Sinop'),
(71, 'Şırnak'),
(72, 'Sivas'),
(73, 'Tekirdağ'),
(74, 'Tokat'),
(75, 'Trabzon'),
(76, 'Tunceli'),
(77, 'Uşak'),
(78, 'Van'),
(79, 'Yalova'),
(80, 'Yozgat'),
(81, 'Zonguldak');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `seyahatler`
--

CREATE TABLE `seyahatler` (
  `seyahat_id` int(11) NOT NULL,
  `firma_id` int(11) NOT NULL,
  `kalkis` varchar(20) CHARACTER SET utf8 COLLATE utf8_turkish_ci NOT NULL,
  `varis` varchar(20) CHARACTER SET utf8 COLLATE utf8_turkish_ci NOT NULL,
  `tarih` date NOT NULL,
  `saat` time NOT NULL,
  `fiyat` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_turkish_ci;

--
-- Tablo döküm verisi `seyahatler`
--

INSERT INTO `seyahatler` (`seyahat_id`, `firma_id`, `kalkis`, `varis`, `tarih`, `saat`, `fiyat`) VALUES
(1, 1, 'Antalya', 'Konya', '2024-12-12', '16:00:00', 500),
(2, 1, 'İstanbul', 'Ankara', '2024-12-10', '08:00:00', 300),
(3, 2, 'İzmir', 'Antalya', '2024-12-11', '09:30:00', 350),
(4, 3, 'Konya', 'Bursa', '2024-12-12', '10:45:00', 250),
(5, 4, 'Antalya', 'Isparta', '2024-12-13', '11:00:00', 200),
(6, 5, 'Ankara', 'Samsun', '2024-12-14', '12:00:00', 320),
(7, 6, 'İzmir', 'Bodrum', '2024-12-15', '14:30:00', 180),
(8, 7, 'İstanbul', 'Kayseri', '2024-12-16', '15:00:00', 270),
(9, 1, 'Antalya', 'Aydın', '2024-12-17', '16:00:00', 290),
(10, 2, 'Konya', 'Çanakkale', '2024-12-18', '17:00:00', 310),
(11, 3, 'Bursa', 'Muğla', '2024-12-19', '18:00:00', 280),
(12, 4, 'Antalya', 'Gaziantep', '2024-12-20', '19:00:00', 330),
(13, 5, 'İstanbul', 'Adana', '2024-12-21', '07:30:00', 350),
(14, 6, 'İzmir', 'Trabzon', '2024-12-22', '08:15:00', 340),
(15, 7, 'Ankara', 'Kocaeli', '2024-12-23', '09:00:00', 300),
(16, 1, 'Bursa', 'İzmir', '2024-12-24', '10:30:00', 260),
(17, 1, 'Antalya', 'Konya', '2024-11-15', '10:00:00', 450),
(18, 2, 'İstanbul', 'Ankara', '2024-11-20', '09:00:00', 350);

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `uyeler`
--

CREATE TABLE `uyeler` (
  `id` int(10) UNSIGNED NOT NULL,
  `isim` varchar(30) CHARACTER SET utf8 COLLATE utf8_turkish_ci DEFAULT NULL,
  `soyisim` varchar(30) CHARACTER SET utf8 COLLATE utf8_turkish_ci DEFAULT NULL,
  `tc` varchar(11) CHARACTER SET utf8 COLLATE utf8_turkish_ci DEFAULT NULL,
  `dogum_tarihi` date NOT NULL,
  `cinsiyet` varchar(5) COLLATE utf8_turkish_ci NOT NULL,
  `mail` varchar(30) CHARACTER SET utf8 COLLATE utf8_turkish_ci DEFAULT NULL,
  `sifre` varchar(30) CHARACTER SET utf8 COLLATE utf8_turkish_ci DEFAULT NULL,
  `tel_no` varchar(11) CHARACTER SET utf8 COLLATE utf8_turkish_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_turkish_ci;

--
-- Tablo döküm verisi `uyeler`
--

INSERT INTO `uyeler` (`id`, `isim`, `soyisim`, `tc`, `dogum_tarihi`, `cinsiyet`, `mail`, `sifre`, `tel_no`) VALUES
(1, 'Ali İhsan', 'Gökyar', '11122233344', '2004-08-18', 'Erkek', 'ali@gmail.com', '123456', '05324107489'),
(2, 'Nurullah', 'Yıldırım', '22233344455', '2002-01-15', 'Erkek', 'nurullah@gmail.com', '012345', '05114789520'),
(3, 'Mehmet', 'Yılmaz', '33344455566', '1990-05-22', 'Erkek', 'mehmet@gmail.com', 'password123', '05431234567'),
(4, 'Ayşe', 'Demir', '44455566677', '1995-08-15', 'Kadın', 'ayse@gmail.com', 'password456', '05331234567'),
(5, 'Fatma', 'Kaya', '55566677788', '2000-02-28', 'Kadın', 'fatma@gmail.com', 'password789', '05231234567'),
(6, 'İbrahim', 'Gündüz', '13132469031', '2000-06-15', 'Erkek', 'igunduz@gmail.com', '123456', '05374961254');

--
-- Dökümü yapılmış tablolar için indeksler
--

--
-- Tablo için indeksler `biletler`
--
ALTER TABLE `biletler`
  ADD PRIMARY KEY (`bilet_id`),
  ADD KEY `fk_biletler_uye_id` (`uye_id`),
  ADD KEY `fk_biletler_seyahatler` (`seyahat_id`);

--
-- Tablo için indeksler `firmalar`
--
ALTER TABLE `firmalar`
  ADD PRIMARY KEY (`id`);

--
-- Tablo için indeksler `kartlar`
--
ALTER TABLE `kartlar`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_uye_id` (`uye_id`);

--
-- Tablo için indeksler `koltuklar`
--
ALTER TABLE `koltuklar`
  ADD PRIMARY KEY (`koltuk_id`),
  ADD KEY `fk_koltuklar_seyahat_id` (`seyahat_id`),
  ADD KEY `fk_koltuklar_uye_id` (`uye_id`);

--
-- Tablo için indeksler `sehirler`
--
ALTER TABLE `sehirler`
  ADD PRIMARY KEY (`id`);

--
-- Tablo için indeksler `seyahatler`
--
ALTER TABLE `seyahatler`
  ADD PRIMARY KEY (`seyahat_id`),
  ADD KEY `fk_seyahatler_firma_ad` (`firma_id`);

--
-- Tablo için indeksler `uyeler`
--
ALTER TABLE `uyeler`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `tc` (`tc`),
  ADD UNIQUE KEY `mail` (`mail`),
  ADD UNIQUE KEY `tel_no` (`tel_no`);

--
-- Dökümü yapılmış tablolar için AUTO_INCREMENT değeri
--

--
-- Tablo için AUTO_INCREMENT değeri `biletler`
--
ALTER TABLE `biletler`
  MODIFY `bilet_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- Tablo için AUTO_INCREMENT değeri `firmalar`
--
ALTER TABLE `firmalar`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- Tablo için AUTO_INCREMENT değeri `kartlar`
--
ALTER TABLE `kartlar`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- Tablo için AUTO_INCREMENT değeri `sehirler`
--
ALTER TABLE `sehirler`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=83;

--
-- Tablo için AUTO_INCREMENT değeri `seyahatler`
--
ALTER TABLE `seyahatler`
  MODIFY `seyahat_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- Tablo için AUTO_INCREMENT değeri `uyeler`
--
ALTER TABLE `uyeler`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- Dökümü yapılmış tablolar için kısıtlamalar
--

--
-- Tablo kısıtlamaları `biletler`
--
ALTER TABLE `biletler`
  ADD CONSTRAINT `fk_biletler_seyahatler` FOREIGN KEY (`seyahat_id`) REFERENCES `seyahatler` (`seyahat_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_biletler_uye_id` FOREIGN KEY (`uye_id`) REFERENCES `uyeler` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Tablo kısıtlamaları `kartlar`
--
ALTER TABLE `kartlar`
  ADD CONSTRAINT `fk_uye_id` FOREIGN KEY (`uye_id`) REFERENCES `uyeler` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Tablo kısıtlamaları `koltuklar`
--
ALTER TABLE `koltuklar`
  ADD CONSTRAINT `fk_koltuklar_seyahat_id` FOREIGN KEY (`seyahat_id`) REFERENCES `seyahatler` (`seyahat_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_koltuklar_uye_id` FOREIGN KEY (`uye_id`) REFERENCES `uyeler` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Tablo kısıtlamaları `seyahatler`
--
ALTER TABLE `seyahatler`
  ADD CONSTRAINT `fk_seyahatler_firma_ad` FOREIGN KEY (`firma_id`) REFERENCES `firmalar` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
