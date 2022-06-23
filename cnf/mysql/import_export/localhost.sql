-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Anamakine: localhost
-- Üretim Zamanı: 20 Haz 2022, 08:36:48
-- Sunucu sürümü: 5.7.34-log
-- PHP Sürümü: 8.0.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Veritabanı: `iot_mini`
--
CREATE DATABASE IF NOT EXISTS `iot_mini` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;
USE `iot_mini`;

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `ledmodule`
--

CREATE TABLE `ledmodule` (
  `id` int(11) NOT NULL,
  `module_name` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `settings` json DEFAULT NULL,
  `status` tinyint(1) DEFAULT '1',
  `created_at` datetime DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Tablo döküm verisi `ledmodule`
--

INSERT INTO `ledmodule` (`id`, `module_name`, `settings`, `status`, `created_at`, `updated_at`) VALUES
(1, 'Led Module P1', '{\"led1\": {\"B\": 255, \"G\": 0, \"R\": 146}, \"led2\": {\"B\": 61, \"G\": 240, \"R\": 232}, \"mode\": \"effect\", \"speed\": 1280, \"effect\": \"flip\", \"flip_change_color\": true}', 1, '2021-12-08 03:11:02', '2022-01-17 15:11:10');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `role_box`
--

CREATE TABLE `role_box` (
  `role_id` int(11) NOT NULL,
  `role_name` varchar(50) NOT NULL,
  `role_pin_name` varchar(10) NOT NULL,
  `value` varchar(10) DEFAULT 'false',
  `current` varchar(10) DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Tablo döküm verisi `role_box`
--

INSERT INTO `role_box` (`role_id`, `role_name`, `role_pin_name`, `value`, `current`, `updated_at`) VALUES
(1, 'Home Office Lamp', 'g0', 'true', 'false', '2022-03-04 00:11:15');

--
-- Dökümü yapılmış tablolar için indeksler
--

--
-- Tablo için indeksler `ledmodule`
--
ALTER TABLE `ledmodule`
  ADD PRIMARY KEY (`id`);

--
-- Tablo için indeksler `role_box`
--
ALTER TABLE `role_box`
  ADD PRIMARY KEY (`role_id`);

--
-- Dökümü yapılmış tablolar için AUTO_INCREMENT değeri
--

--
-- Tablo için AUTO_INCREMENT değeri `ledmodule`
--
ALTER TABLE `ledmodule`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Tablo için AUTO_INCREMENT değeri `role_box`
--
ALTER TABLE `role_box`
  MODIFY `role_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
