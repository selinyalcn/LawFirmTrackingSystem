-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Anamakine: 127.0.0.1
-- Üretim Zamanı: 29 May 2024, 12:03:06
-- Sunucu sürümü: 10.4.32-MariaDB
-- PHP Sürümü: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Veritabanı: `final_projesi`
--

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `hukukdosyaları`
--

CREATE TABLE `hukukdosyaları` (
  `id` int(11) NOT NULL,
  `davaci` varchar(255) NOT NULL,
  `davali` varchar(255) NOT NULL,
  `dava_tarihi` date DEFAULT NULL,
  `dava_konusu` varchar(500) NOT NULL,
  `mahkeme` varchar(255) DEFAULT NULL,
  `esas_no` varchar(255) DEFAULT NULL,
  `dosya_durumu` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Tablo döküm verisi `hukukdosyaları`
--

INSERT INTO `hukukdosyaları` (`id`, `davaci`, `davali`, `dava_tarihi`, `dava_konusu`, `mahkeme`, `esas_no`, `dosya_durumu`) VALUES
(1, 'Sebahat Dön', 'Ferdi Döner', '2024-08-08', 'Boşanma(Evlilik birliğinin temelinden sarsılması nedeni ile boşanma(Çekişmeli))', 'Gaziantep 5. Aile Mahkemesi', '2022676', 'Duruşma tarihi verildi ön inceleme duruşması yapılacak'),
(2, 'Filiz Arslan', 'Ahmet Yalçın,Bedirhan Demir,Ali Arslan', '2024-08-09', 'Tapu İptali ve Tescil Davası', 'Gaziantep 2. Aile Mahkemesi', '2022675', 'Görevsizlik kararı verildi.Taşınmaz üzerinde ki tedbirin kaldırılmasına karar verildi.'),
(3, 'Günel Demir', 'Barış Demir', '2024-07-05', 'Boşanma(Evlilik birliğinin temelinden sarsılması(Anlaşmalı))', 'Gaziantep 6. Aile Mahkemesi', '2022711', 'Davadan Feragat edildi'),
(4, 'Ahmet Yalçın', 'Filiz Arslan', '2024-07-20', 'Haksız İşgal Tazminatı(Ecrimisil)', 'Gaziantep 11. Asliye Hukuk Mahkemesi', '2022255', 'Yargılama Devam Ediyor'),
(5, 'Ebubekir Akcan', 'Nakcan Unlu Mamüller Gıda Taşımacılık İnşaat Reklam Matbaa Organizasyon Pazarlama Sanayi ve Ticaret Limited Şirketi', '2024-06-30', 'İşçi Alacağı', '', '', 'İhtarname gönderildi'),
(6, 'Fatma Gümüş', 'Alican Gümüş', '2024-06-14', 'Boşanma(Evlilik birliğinin temelinden sarsılması nedeni ile boşanma(Çekişmeli))', 'Gaziantep 8. Aile Mahkemesi', '2023429', 'Yargılanma devam ediyor'),
(7, 'Filiz Arslan', 'Ali Arslan,Ahmet Yalçın', '2024-08-30', 'Tapu iptali ve tescil davası', 'Gaziantep 14. Asliye Mahkemesi', '202396', 'Cevap Dilekçesi gönderildi'),
(8, 'Baki Mert Şahin', 'Zeynep Gökdağ', '2024-06-20', 'Gasp Yaralama', 'Aksaray 14.Asliye Mahkemesi', '2024702', 'Yargılanma devam ediyor'),
(9, 'Baki Mert Şahin', 'Burak Uğur', '2024-06-20', 'Haksız İşgal Tazminatı', 'Gaziantep 2. Aile Mahkemesi', '2024702', 'Yargılanma devam ediyor');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `icradosyaları`
--

CREATE TABLE `icradosyaları` (
  `id` int(11) NOT NULL,
  `alacakli` varchar(255) NOT NULL,
  `borclu` varchar(500) NOT NULL,
  `takip_tarihi` date NOT NULL,
  `icra_dairesi` varchar(255) NOT NULL,
  `esas_no` bigint(20) NOT NULL,
  `takip_miktari` varchar(255) NOT NULL,
  `takibin_konusu` varchar(500) DEFAULT NULL,
  `dosya_durumu` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Tablo döküm verisi `icradosyaları`
--

INSERT INTO `icradosyaları` (`id`, `alacakli`, `borclu`, `takip_tarihi`, `icra_dairesi`, `esas_no`, `takip_miktari`, `takibin_konusu`, `dosya_durumu`) VALUES
(1, 'Anadolu Bank Anonim Şirketi', 'Mustafa Öztürk,Ramazan Öztürk (3. Şahıs:Mehmet Akif Öztürk)', '2019-01-14', 'Gaziantep İcra Dairesi', 2022155, '96.000,520 TL', 'Kredi Borcu ve tabu iptali', '3.Şahıs adına talepte bulunularak 3. Şahsa ait taşınmaz üzerine hacizin ilk m.106 ve m.110 itibarı ile kaldırılması talep edilmiştir.'),
(2, 'Nurgül Akcan', 'Mehmet Kel', '2022-12-27', 'Gaziantep İcra Dairesi', 2022127210, '7.843 TL ', 'Geçmiş Dönem nafaka alacağı', 'Tebligat çıkarıldı hazırlandı'),
(3, 'Ahmet Yalçın', 'Bekir Esmer', '2023-08-10', 'Gaziantep İcra Dairesi', 2020127, '190.500 TL', 'İhtiyati Haciz', 'Hacizler Konulacak'),
(4, 'Ahmet Yalçın', 'Filiz Arslan', '2023-09-28', 'Gaziantep İcra Dairesi', 2023125251, '9.500 TL', 'Vekalet Ücret Alacağı', 'Hacze Kabul Mal yok');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `iletisimbilgileri`
--

CREATE TABLE `iletisimbilgileri` (
  `adres` varchar(500) NOT NULL,
  `eposta` varchar(255) NOT NULL,
  `telefonNo` bigint(20) NOT NULL,
  `tcNo` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Tablo döküm verisi `iletisimbilgileri`
--

INSERT INTO `iletisimbilgileri` (`adres`, `eposta`, `telefonNo`, `tcNo`) VALUES
('Şahintepe Mahallesi 133394 sk. No:45 Şahinbey/Gaziantep', 'selin.yalcn00@gmail.com', 5350647050, 2147483647);

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `kimlikbilgileri`
--

CREATE TABLE `kimlikbilgileri` (
  `tcNo` bigint(20) NOT NULL,
  `ad` varchar(255) NOT NULL,
  `soyad` varchar(255) NOT NULL,
  `babaAdi` varchar(255) NOT NULL,
  `anneAdi` varchar(255) NOT NULL,
  `dogumYeri` varchar(255) NOT NULL,
  `dogumTarihi` date NOT NULL,
  `bagliBaro` varchar(255) NOT NULL,
  `baroNo` int(11) NOT NULL,
  `tbbNo` int(11) NOT NULL,
  `vergiNo` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Tablo döküm verisi `kimlikbilgileri`
--

INSERT INTO `kimlikbilgileri` (`tcNo`, `ad`, `soyad`, `babaAdi`, `anneAdi`, `dogumYeri`, `dogumTarihi`, `bagliBaro`, `baroNo`, `tbbNo`, `vergiNo`) VALUES
(2147483647, 'Selin', 'Yalçın', 'Bilal', 'Elif', 'Gaziantep', '2003-05-17', 'Gaziantep barosu', 4053, 200405, 550);

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `kullanicilar`
--

CREATE TABLE `kullanicilar` (
  `id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `passwordd` varchar(255) NOT NULL,
  `tcNo` bigint(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Tablo döküm verisi `kullanicilar`
--

INSERT INTO `kullanicilar` (`id`, `username`, `passwordd`, `tcNo`) VALUES
(1, 'Selinyalcn', '1234', 2147483647),
(2, 'Abdullahyalcn', '12345', 0);

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `makbuzgörüntüleme`
--

CREATE TABLE `makbuzgörüntüleme` (
  `id` int(11) NOT NULL,
  `kasa` varchar(255) NOT NULL,
  `gelir_gider_türü` varchar(255) NOT NULL,
  `borc` bigint(20) NOT NULL,
  `alacak` bigint(20) NOT NULL,
  `tarih` date NOT NULL,
  `aciklama` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Tablo döküm verisi `makbuzgörüntüleme`
--

INSERT INTO `makbuzgörüntüleme` (`id`, `kasa`, `gelir_gider_türü`, `borc`, `alacak`, `tarih`, `aciklama`) VALUES
(1, 'Merkez Kasa', 'Büro Yemek Masrafı', 500, 0, '2024-05-20', 'Ofis yemek '),
(2, 'Merkez Kasa', 'Fatura Ödemesi', 1000, 0, '2024-03-08', 'Mart Ayı ofis fatura ödemesi'),
(5, 'Kişisel Kasa', 'kazanç', 0, 2000, '2024-06-27', 'dava alacağı'),
(6, 'Merkez Kasa', 'kazanç', 0, 100000, '2024-05-26', 'dava alacağı');

--
-- Dökümü yapılmış tablolar için indeksler
--

--
-- Tablo için indeksler `hukukdosyaları`
--
ALTER TABLE `hukukdosyaları`
  ADD PRIMARY KEY (`id`);

--
-- Tablo için indeksler `icradosyaları`
--
ALTER TABLE `icradosyaları`
  ADD PRIMARY KEY (`id`);

--
-- Tablo için indeksler `kimlikbilgileri`
--
ALTER TABLE `kimlikbilgileri`
  ADD UNIQUE KEY `tcNo_UNIQUE` (`tcNo`);

--
-- Tablo için indeksler `kullanicilar`
--
ALTER TABLE `kullanicilar`
  ADD PRIMARY KEY (`id`);

--
-- Tablo için indeksler `makbuzgörüntüleme`
--
ALTER TABLE `makbuzgörüntüleme`
  ADD PRIMARY KEY (`id`);

--
-- Dökümü yapılmış tablolar için AUTO_INCREMENT değeri
--

--
-- Tablo için AUTO_INCREMENT değeri `hukukdosyaları`
--
ALTER TABLE `hukukdosyaları`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- Tablo için AUTO_INCREMENT değeri `icradosyaları`
--
ALTER TABLE `icradosyaları`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Tablo için AUTO_INCREMENT değeri `kullanicilar`
--
ALTER TABLE `kullanicilar`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Tablo için AUTO_INCREMENT değeri `makbuzgörüntüleme`
--
ALTER TABLE `makbuzgörüntüleme`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
