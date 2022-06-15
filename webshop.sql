-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Värd: localhost:8889
-- Tid vid skapande: 15 jun 2022 kl 09:33
-- Serverversion: 5.7.34
-- PHP-version: 8.0.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Databas: `webshop`
--

-- --------------------------------------------------------

--
-- Tabellstruktur `orders`
--

CREATE TABLE `orders` (
  `id` int(11) NOT NULL,
  `customerID` int(11) NOT NULL,
  `status` varchar(100) NOT NULL,
  `orderDate` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Tabellstruktur `ordersProducts`
--

CREATE TABLE `ordersProducts` (
  `id` int(11) NOT NULL,
  `orderID` int(11) NOT NULL,
  `productID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Tabellstruktur `products`
--

CREATE TABLE `products` (
  `id` int(11) NOT NULL,
  `name` varchar(50) CHARACTER SET utf8 NOT NULL,
  `description` varchar(1000) CHARACTER SET utf8 NOT NULL,
  `price` int(11) NOT NULL,
  `img-url` varchar(2048) CHARACTER SET utf8 NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_swedish_ci;

--
-- Dumpning av Data i tabell `products`
--

INSERT INTO `products` (`id`, `name`, `description`, `price`, `img-url`) VALUES
(3, 'Rio Sommar - Pale Ale', 'Maltig, något humlearomatisk smak med tydlig beska, inslag av fruktkaka, aprikos, smörkola, kryddor och apelsinskal. Serveras vid 8-10°C som sällskapsdryck eller till rätter av fläsk- eller lammkött.', 21, 'https://product-cdn.systembolaget.se/productimages/24697303/24697303_400.png'),
(4, 'Svensk Sommar - Fläder & Krusbär', 'Fruktig, söt, blommig smak med inslag av päron, honung, fläder och krusbär. Serveras väl kyld som aperitif eller används som drinkingrediens.', 129, 'https://sb-product-media-prod.azureedge.net/productimages/24480273/24480273_400.png'),
(7, 'Nominé-Renard', 'Nyanserad, något utvecklad, mycket frisk smak med inslag av röda äpplen, mineral, hasselnötter, rostat bröd, vit choklad och citron. Serveras vid 8-10°C som aperitif, eller till rätter av fisk och skaldjur.', 596, 'https://product-cdn.systembolaget.se/productimages/24697150/24697150_400.png'),
(8, 'Deschutes - Squeezy Rider IPA', 'Humlearomatisk, nyanserad smak med tydlig beska, inslag av passionsfrukt, aprikosmarmelad, apelsinskal, tallkåda, örter och sirapslimpa. Serveras vid 8-10°C som sällskapsdryck eller till rätter av lamm- eller nötkött.', 29, 'https://product-cdn.systembolaget.se/productimages/24697304/24697304_400.png'),
(9, 'Julià & Navinès Cava Organic', 'Fruktig, ungdomlig smak med sötma, inslag av päron, honung, krusbär, gula äpplen och citrus. Serveras vid 8-10°C som sällskapsdryck, till sallader eller till rätter av fisk eller skaldjur.', 89, 'https://product-cdn.systembolaget.se/productimages/1058518/1058518_400.png'),
(11, 'Moosehead - Grapefruit Radler', 'Fruktig smak med sötma och tydlig karaktär av grapefrukt, inslag av ljust bröd, citron, örter och honung. Serveras vid 6-8°C som sällskapsdryck.', 15, 'https://product-cdn.systembolaget.se/productimages/24679498/24679498_400.png'),
(12, 'Kvarnagårdens - Jordgubbstårta', 'Fruktig, maltig smak med inslag av jordgubbar, sockerkaka och vanilj. Serveras vid 6-8°C som sällskapsdryck.', 39, 'https://product-cdn.systembolaget.se/productimages/24701364/24701364_400.png'),
(16, 'Tour de FRUKT', 'Fruktig, mycket frisk smak med liten strävhet, inslag av röda äpplen, grapefrukt, päron och citronskal. Serveras vid 8-10°C som sällskapsdryck eller till rätter av ljust kött.', 144, 'https://product-cdn.systembolaget.se/productimages/25365190/25365190_400.png'),
(19, 'Aingura - Cidre Brut', 'Fruktig, karaktärsfull smak med inslag av gula äpplen, halm, kryddor och citrusskal. Serveras 8-10°C som sällskapsdryck, till vegetariska rätter eller till rätter av ljust kött.', 83, 'https://product-cdn.systembolaget.se/productimages/24664452/24664452_400.png'),
(20, 'Montresor - Grappa Bianca', 'Druvig, oljig smak med viss sötma, inslag av sultanarussin, halm, körsbärskärnor och örter. Serveras rumstempererad som digestif.', 289, 'https://product-cdn.systembolaget.se/productimages/8518/8518_400.png'),
(23, 'Bacardi - Mojito Classic', 'Kryddig, fruktig smak med sötma, inslag av lime och mynta. Serveras med krossad is.', 139, 'https://product-cdn.systembolaget.se/productimages/429329/429329_400.png'),
(24, 'AB Stockholms Bränneri - Pink Gin', 'Kryddig smak med inslag av enbär, rosor, citrusskal, lingon och rabarber. Används som drinkingrediens.', 310, 'https://product-cdn.systembolaget.se/productimages/13430309/13430309_400.png');

-- --------------------------------------------------------

--
-- Tabellstruktur `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `passwordHash` varchar(100) DEFAULT NULL,
  `isAdmin` tinyint(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumpning av Data i tabell `users`
--

INSERT INTO `users` (`id`, `username`, `passwordHash`, `isAdmin`) VALUES
(1, 'wiaxx', '$2y$10$3DZegjRYNsndzJiy4Xn3UeAE5mRvMLGhHdcF3ILR1e8nexxjzGApe', 1),
(4, 'another', '$2y$10$yVg5Q23nKmKwlyWsUaOoSO2D9BCDH5PfZoajJY8xx96Ed3C2ClXGi', NULL),
(5, 'test', '$2y$10$FcllilfAnE3zm9dQmLQ.4OOw4r9VvZJ85mIKRX.1UKt0Tk72X62WO', NULL),
(6, 'testuser', '$2y$10$zCD5j3t8q9U7f0hLd0DJeuhi6z.gp73P/g8M5yzGNEartAH4C0SfK', NULL),
(7, 'jag', '$2y$10$.pSA3t4cTuekpmYErpxCxON0ZEAdXFa9ClXImGJ0VQTQjfhU09M.u', NULL);

-- --------------------------------------------------------

--
-- Tabellstruktur `usersMessage`
--

CREATE TABLE `usersMessage` (
  `id` int(11) NOT NULL,
  `contactOption` varchar(15) NOT NULL,
  `title` varchar(200) NOT NULL,
  `message` varchar(2000) NOT NULL,
  `userID` int(11) NOT NULL,
  `responseMessage` varchar(5000) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumpning av Data i tabell `usersMessage`
--

INSERT INTO `usersMessage` (`id`, `contactOption`, `title`, `message`, `userID`, `responseMessage`) VALUES
(1, 'other', 'Hejsan', 'Jag undrar en sak...', 5, 'Hejsan, tack för din fråga!'),
(4, 'order', '#4', 'Hejsan, jag skulle vilja cancellera min order med ordernummer 4. Tack på förhand!', 5, NULL),
(5, 'question', 'Stockholms bränneri', 'Hej! Jag undrar ifall ni kommer få in dry gin från Stockholms Bränneri? Med vänlig hälsning, Lars', 4, NULL),
(6, 'other', 'Väntar fortfarande svar!!!!', 'Hallå, tänkte ni svara? Ska fan ha den till midsommar!', 4, NULL),
(7, 'order', '#12', 'Halloj, kan ni skicka om min orderbekräftelse? Jag har tappat bort den..', 6, 'Hejsan testuser, det kommer en ny till din mail inom kort! Ha en fin dag!'),
(8, 'other', 'Tänk på miljön', 'Använder ni miljövänliga fraktsätt?!', 6, NULL);

--
-- Index för dumpade tabeller
--

--
-- Index för tabell `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`);

--
-- Index för tabell `ordersProducts`
--
ALTER TABLE `ordersProducts`
  ADD PRIMARY KEY (`id`);

--
-- Index för tabell `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);

--
-- Index för tabell `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`);

--
-- Index för tabell `usersMessage`
--
ALTER TABLE `usersMessage`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT för dumpade tabeller
--

--
-- AUTO_INCREMENT för tabell `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT för tabell `ordersProducts`
--
ALTER TABLE `ordersProducts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT för tabell `products`
--
ALTER TABLE `products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

--
-- AUTO_INCREMENT för tabell `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT för tabell `usersMessage`
--
ALTER TABLE `usersMessage`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
