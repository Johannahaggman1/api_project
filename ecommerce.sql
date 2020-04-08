-- phpMyAdmin SQL Dump
-- version 5.0.1
-- https://www.phpmyadmin.net/
--
-- Värd: 127.0.0.1
-- Tid vid skapande: 08 apr 2020 kl 21:01
-- Serverversion: 10.4.11-MariaDB
-- PHP-version: 7.4.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Databas: `ecommerce`
--

-- --------------------------------------------------------

--
-- Tabellstruktur `cart`
--

CREATE TABLE `cart` (
  `Id` int(11) NOT NULL,
  `orderDate` date NOT NULL DEFAULT current_timestamp(),
  `checkoutStatus` int(1) NOT NULL DEFAULT 0,
  `userId` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumpning av Data i tabell `cart`
--

INSERT INTO `cart` (`Id`, `orderDate`, `checkoutStatus`, `userId`) VALUES
(32, '2020-04-07', 0, 2),
(35, '2020-04-07', 1, 4),
-- --------------------------------------------------------

--
-- Tabellstruktur `orderrows`
--

CREATE TABLE `orderrows` (
  `Id` int(11) NOT NULL,
  `productAmount` int(11) NOT NULL,
  `totalPrice` int(11) NOT NULL,
  `productId` int(11) NOT NULL,
  `cartId` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumpning av Data i tabell `orderrows`
--

INSERT INTO `orderrows` (`Id`, `productAmount`, `totalPrice`, `productId`, `cartId`) VALUES
(36, 3, 2500, 5, 35),
(37, 2, 1500, 11, 32),
(86, 1, 3500, 13, 32),
(87, 1, 6500, 12, 32);

-- --------------------------------------------------------

--
-- Tabellstruktur `products`
--

CREATE TABLE `products` (
  `Id` int(11) NOT NULL,
  `productName` varchar(50) NOT NULL,
  `price` int(11) NOT NULL,
  `stockamount` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumpning av Data i tabell `products`
--

INSERT INTO `products` (`Id`, `productName`, `price`, `stockamount`) VALUES
(1, 'IphoneX', 8500, 0),
(3, 'airPods', 2100, 20),
(5, 'Ericsson560', 2500, 18),
(8, 'Produkt7', 150, 20),
(9, 'IphoneXS', 10500, 20),
(11, 'Nokia3310', 750, 4),
(12, 'Iphone7', 6500, 25),
(13, 'Ipod7', 3500, 15);

-- --------------------------------------------------------

--
-- Tabellstruktur `tokens`
--

CREATE TABLE `tokens` (
  `Id` int(11) NOT NULL,
  `date_updated` int(10) NOT NULL,
  `token` text NOT NULL,
  `userId` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumpning av Data i tabell `tokens`
--

INSERT INTO `tokens` (`Id`, `date_updated`, `token`, `userId`) VALUES
(41, 1585923635, 'd2e6bebe90b5fc8550f6783512d69be4', 3),
(63, 1586368404, 'caec663485d8de54021a4813085b290a', 4),
(64, 1586372152, 'f918b8db36c8ea8436eb7f66309eedb9', 2);

-- --------------------------------------------------------

--
-- Tabellstruktur `users`
--

CREATE TABLE `users` (
  `Id` int(11) NOT NULL,
  `email` varchar(150) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  `role` int(11) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumpning av Data i tabell `users`
--

INSERT INTO `users` (`Id`, `email`, `username`, `password`, `role`) VALUES
(2, 'lol@lol.se', 'lol', '9cdfb439c7876e703e307864c9167a15', 1),
(3, 'ickeadmin@mail.com', 'ickeAdmin', '07894b70097b0cf39f434848b54d8f57', 0),


--
-- Index för dumpade tabeller
--

--
-- Index för tabell `cart`
--
ALTER TABLE `cart`
  ADD PRIMARY KEY (`Id`),
  ADD KEY `userId` (`userId`);

--
-- Index för tabell `orderrows`
--
ALTER TABLE `orderrows`
  ADD PRIMARY KEY (`Id`),
  ADD KEY `productId` (`productId`),
  ADD KEY `orderId` (`cartId`);

--
-- Index för tabell `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`Id`);

--
-- Index för tabell `tokens`
--
ALTER TABLE `tokens`
  ADD PRIMARY KEY (`Id`),
  ADD KEY `userId` (`userId`);

--
-- Index för tabell `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`Id`);

--
-- AUTO_INCREMENT för dumpade tabeller
--

--
-- AUTO_INCREMENT för tabell `cart`
--
ALTER TABLE `cart`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=62;

--
-- AUTO_INCREMENT för tabell `orderrows`
--
ALTER TABLE `orderrows`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=88;

--
-- AUTO_INCREMENT för tabell `products`
--
ALTER TABLE `products`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT för tabell `tokens`
--
ALTER TABLE `tokens`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=65;

--
-- AUTO_INCREMENT för tabell `users`
--
ALTER TABLE `users`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Restriktioner för dumpade tabeller
--

--
-- Restriktioner för tabell `cart`
--
ALTER TABLE `cart`
  ADD CONSTRAINT `cart_ibfk_1` FOREIGN KEY (`userId`) REFERENCES `users` (`Id`);

--
-- Restriktioner för tabell `orderrows`
--
ALTER TABLE `orderrows`
  ADD CONSTRAINT `orderrows_ibfk_1` FOREIGN KEY (`productId`) REFERENCES `products` (`Id`),
  ADD CONSTRAINT `orderrows_ibfk_2` FOREIGN KEY (`cartId`) REFERENCES `cart` (`Id`);

--
-- Restriktioner för tabell `tokens`
--
ALTER TABLE `tokens`
  ADD CONSTRAINT `tokens_ibfk_1` FOREIGN KEY (`userId`) REFERENCES `users` (`Id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
