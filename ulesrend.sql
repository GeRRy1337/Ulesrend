-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Gép: 127.0.0.1
-- Létrehozás ideje: 2021. Okt 14. 13:12
-- Kiszolgáló verziója: 10.4.14-MariaDB
-- PHP verzió: 7.4.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Adatbázis: `ulesrend`
--

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `5/13ice`
--

CREATE TABLE `5/13ice` (
  `id` int(11) UNSIGNED NOT NULL,
  `nev` varchar(100) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `sor` int(11) UNSIGNED NOT NULL,
  `oszlop` int(11) UNSIGNED NOT NULL,
  `jelszo` varchar(32) CHARACTER SET latin1 COLLATE latin1_general_ci NOT NULL,
  `felhasznalonev` varchar(50) CHARACTER SET latin1 COLLATE latin1_general_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_hungarian_ci;

--
-- A tábla adatainak kiíratása `5/13ice`
--

INSERT INTO `5/13ice` (`id`, `nev`, `sor`, `oszlop`, `jelszo`, `felhasznalonev`) VALUES
(1, 'Kulhanek László István', 1, 1, '', ' '),
(2, 'Molnár Gergő Máté', 2, 1, 'a92b60ddc579a73936574438aa1112cf', 'Gergo'),
(3, 'Bakcsányi Dominik', 2, 2, '', ''),
(4, 'Füstös Loránt', 2, 3, '', ''),
(5, 'Orosz Zsolt', 2, 4, '', ''),
(6, 'Harsányi László Ferenc', 2, 5, '', ' '),
(7, '', 2, 6, '', ''),
(8, 'Kereszturi Kevin', 3, 1, '', ''),
(9, 'Juhász Levente', 3, 2, '', ''),
(10, 'Szabó László', 3, 3, '', ''),
(11, 'Sütő Dániel', 3, 4, '', ''),
(12, 'Détári Klaudia', 3, 5, '', ''),
(13, '', 3, 6, '', ''),
(14, 'Fazekas Miklós Adrián', 4, 1, '', ''),
(15, '', 4, 2, '', ''),
(16, 'Gombos János', 4, 3, '', ''),
(17, 'Bicsák József', 4, 4, 'd47b837e163f20c78e38a99467b90ccc', 'tanar');

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `admins`
--

CREATE TABLE `admins` (
  `id` int(11) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_hungarian_ci;

--
-- A tábla adatainak kiíratása `admins`
--

INSERT INTO `admins` (`id`) VALUES
(17);

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `hianyzok`
--

CREATE TABLE `hianyzok` (
  `id` int(11) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_hungarian_ci;

--
-- Indexek a kiírt táblákhoz
--

--
-- A tábla indexei `5/13ice`
--
ALTER TABLE `5/13ice`
  ADD PRIMARY KEY (`id`);

--
-- A tábla indexei `admins`
--
ALTER TABLE `admins`
  ADD PRIMARY KEY (`id`);

--
-- A tábla indexei `hianyzok`
--
ALTER TABLE `hianyzok`
  ADD PRIMARY KEY (`id`);

--
-- A kiírt táblák AUTO_INCREMENT értéke
--

--
-- AUTO_INCREMENT a táblához `5/13ice`
--
ALTER TABLE `5/13ice`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT a táblához `admins`
--
ALTER TABLE `admins`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- Megkötések a kiírt táblákhoz
--

--
-- Megkötések a táblához `admins`
--
ALTER TABLE `admins`
  ADD CONSTRAINT `ibfk_admin_id` FOREIGN KEY (`id`) REFERENCES `5/13ice` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Megkötések a táblához `hianyzok`
--
ALTER TABLE `hianyzok`
  ADD CONSTRAINT `ibfk_tanulo_id` FOREIGN KEY (`id`) REFERENCES `5/13ice` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
