-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 12, 2026 at 09:04 PM
-- Wersja serwera: 10.4.32-MariaDB
-- Wersja PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `bungalows_db`
--

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `address`
--

CREATE TABLE `address` (
  `id` int(11) NOT NULL,
  `street` varchar(255) NOT NULL,
  `street_number` varchar(50) NOT NULL,
  `house_number` varchar(50) DEFAULT NULL,
  `city` varchar(255) NOT NULL,
  `country` varchar(255) NOT NULL,
  `postal_code` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `address`
--

INSERT INTO `address` (`id`, `street`, `street_number`, `house_number`, `city`, `country`, `postal_code`) VALUES
(21, 'Oakwood Drive', '45', '', 'Denver', 'USA', '80201'),
(22, 'Sunset Avenue', '78', '', 'Austin', 'USA', '73301'),
(23, 'Mountain Trail', '12', '', 'Seattle', 'USA', '98101'),
(24, 'Maple Street', '45', '2A', 'New York', 'USA', '10001'),
(26, 'Sunset Avenue', '12', '3B', 'Los Angeles', 'USA', '90001');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `bungalow`
--

CREATE TABLE `bungalow` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `capacity` int(11) NOT NULL,
  `pricePerNight` decimal(10,2) NOT NULL,
  `bungalowPath` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `bungalow`
--

INSERT INTO `bungalow` (`id`, `name`, `capacity`, `pricePerNight`, `bungalowPath`) VALUES
(1, 'Mountain Retreat Bungalow', 2, 180.00, 'assets/images/bungalow-003.jpg'),
(2, 'Forest Hideaway Bungalow', 4, 250.00, 'assets/images/bungalow-004.jpg'),
(3, 'Cozy Chalet Bungalow', 3, 220.00, 'assets/images/bungalow-005.jpg'),
(4, 'Rustic Lodge Bungalow', 2, 190.00, 'assets/images/bungalow-006.jpg'),
(5, 'Lakeside Serenity Bungalow', 6, 450.00, 'assets/images/bungalow-007.jpg'),
(6, 'Pinewood Haven Bungalow', 3, 230.00, 'assets/images/bungalow-008.jpg'),
(7, 'Mountain View Bungalow', 5, 500.00, 'assets/images/IMG_6753.jpg'),
(8, 'Golden Forest Bungalow', 2, 160.00, 'assets/images/bungalow-002.jpg');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `customer`
--

CREATE TABLE `customer` (
  `id` int(11) NOT NULL,
  `idUser` int(11) NOT NULL,
  `nationality` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `customer`
--

INSERT INTO `customer` (`id`, `idUser`, `nationality`) VALUES
(22, 31, 'American'),
(24, 33, 'American');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `discount`
--

CREATE TABLE `discount` (
  `id` int(11) NOT NULL,
  `idBungalow` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `discount` decimal(5,2) NOT NULL,
  `description` text DEFAULT NULL,
  `validFrom` datetime DEFAULT NULL,
  `validTo` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `discount`
--

INSERT INTO `discount` (`id`, `idBungalow`, `name`, `discount`, `description`, `validFrom`, `validTo`) VALUES
(1, 3, 'Family Special', 25.00, 'Bookings with min. 4 guests', '2024-08-05 00:00:00', '2025-02-20 00:00:00'),
(2, 4, 'Summer Escape', 15.00, 'Bookings in June', '2025-06-01 19:44:53', '2025-06-30 20:29:53'),
(3, 5, 'Spring Special', 20.00, 'Bookings in May', '2025-05-01 20:30:25', '2025-05-31 20:30:33'),
(4, 8, 'Winter Wonderland', 10.00, 'Bookings in December', '2025-12-01 20:30:41', '2025-12-31 20:30:50');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `employee`
--

CREATE TABLE `employee` (
  `id` int(11) NOT NULL,
  `idUser` int(11) NOT NULL,
  `roleId` int(11) NOT NULL,
  `imagePath` varchar(300) DEFAULT NULL,
  `login` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `employee`
--

INSERT INTO `employee` (`id`, `idUser`, `roleId`, `imagePath`, `login`, `password`) VALUES
(4, 28, 4, 'assets/images/usr1.jpg', 'j.peterson', '03ac674216f3e15c761ee1a5e255f067953623c8b388b4459e13f978d7c846f4'),
(5, 29, 1, 'assets/images/usrk2.jpg', 'e.collins', '03ac674216f3e15c761ee1a5e255f067953623c8b388b4459e13f978d7c846f4'),
(6, 30, 2, 'assets/images/usr5.jpg', 'm.bennett', '03ac674216f3e15c761ee1a5e255f067953623c8b388b4459e13f978d7c846f4');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `paymentmethod`
--

CREATE TABLE `paymentmethod` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `paymentmethod`
--

INSERT INTO `paymentmethod` (`id`, `name`) VALUES
(1, 'Cash'),
(2, 'Credit Card'),
(3, 'Transfer'),
(4, 'PayPal'),
(5, 'ApplePay');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `reservation`
--

CREATE TABLE `reservation` (
  `id` int(11) NOT NULL,
  `idCustomer` int(11) NOT NULL,
  `idBungalow` int(11) NOT NULL,
  `checkIn` datetime DEFAULT NULL,
  `checkOut` datetime DEFAULT NULL,
  `amount` decimal(10,2) NOT NULL,
  `isStatus` tinyint(1) DEFAULT 1,
  `createdAt` datetime DEFAULT NULL,
  `notes` text DEFAULT NULL,
  `earlyCheckInRequest` tinyint(1) DEFAULT 0,
  `lateCheckOutRequest` tinyint(1) DEFAULT 0,
  `reservationStatus` varchar(255) DEFAULT NULL,
  `paymentMethodId` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `reservation`
--

INSERT INTO `reservation` (`id`, `idCustomer`, `idBungalow`, `checkIn`, `checkOut`, `amount`, `isStatus`, `createdAt`, `notes`, `earlyCheckInRequest`, `lateCheckOutRequest`, `reservationStatus`, `paymentMethodId`) VALUES
(29, 24, 3, '2025-02-07 00:00:00', '2025-02-20 00:00:00', 2860.00, 1, '2025-01-26 14:04:32', NULL, 1, 0, 'completed', 1),
(30, 22, 5, '2025-02-12 00:00:00', '2025-02-20 00:00:00', 3600.00, 1, '2025-01-26 14:05:01', NULL, 0, 0, 'completed', 2),
(32, 22, 4, '2025-06-25 00:00:00', '2025-07-16 00:00:00', 3990.00, 1, '2025-01-26 14:06:53', NULL, 0, 0, 'completed', 4),
(33, 22, 3, '2025-08-20 00:00:00', '2025-08-28 00:00:00', 1760.00, 1, '2025-01-26 14:07:45', NULL, 0, 0, 'completed', 5),
(36, 24, 4, '2025-02-01 00:00:00', '2025-02-03 00:00:00', 380.00, 1, '2025-01-31 22:08:39', NULL, 0, 0, 'completed', 2);

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `role`
--

CREATE TABLE `role` (
  `id` int(11) NOT NULL,
  `roleName` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `role`
--

INSERT INTO `role` (`id`, `roleName`) VALUES
(1, 'Receptionist'),
(2, 'Manager'),
(3, 'Cleaner'),
(4, 'Admin');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `surname` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `phone_number` varchar(20) DEFAULT NULL,
  `addressId` int(11) DEFAULT NULL,
  `createdAt` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `surname`, `email`, `phone_number`, `addressId`, `createdAt`) VALUES
(28, 'John', 'Peterson', 'j.peterson@mail.com', '5551234567', 21, '2025-01-26 13:26:26'),
(29, 'Emily', 'Collins', 'e.collins@mail.com', '5559876543', 22, '2025-01-26 13:31:01'),
(30, 'Michael', 'Bennett', 'm.bennett@mail.com', '5554567890', 23, '2025-01-26 13:32:30'),
(31, 'Olivias', 'Thompson', 'o.thompson@mail.com', '5551234565', 24, '2025-01-26 13:59:56'),
(33, 'Sophie', 'Martinez', 's.martinez@mail.com', '5559876543', 26, '2025-01-26 14:01:46');

--
-- Indeksy dla zrzutów tabel
--

--
-- Indeksy dla tabeli `address`
--
ALTER TABLE `address`
  ADD PRIMARY KEY (`id`);

--
-- Indeksy dla tabeli `bungalow`
--
ALTER TABLE `bungalow`
  ADD PRIMARY KEY (`id`);

--
-- Indeksy dla tabeli `customer`
--
ALTER TABLE `customer`
  ADD PRIMARY KEY (`id`),
  ADD KEY `customer_ibfk_1` (`idUser`);

--
-- Indeksy dla tabeli `discount`
--
ALTER TABLE `discount`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idBungalow` (`idBungalow`);

--
-- Indeksy dla tabeli `employee`
--
ALTER TABLE `employee`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idUser` (`idUser`),
  ADD KEY `roleId` (`roleId`);

--
-- Indeksy dla tabeli `paymentmethod`
--
ALTER TABLE `paymentmethod`
  ADD PRIMARY KEY (`id`);

--
-- Indeksy dla tabeli `reservation`
--
ALTER TABLE `reservation`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idCustomer` (`idCustomer`),
  ADD KEY `idBungalow` (`idBungalow`),
  ADD KEY `idPaymentMethod` (`paymentMethodId`);

--
-- Indeksy dla tabeli `role`
--
ALTER TABLE `role`
  ADD PRIMARY KEY (`id`);

--
-- Indeksy dla tabeli `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`),
  ADD KEY `users_ibfk_1` (`addressId`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `address`
--
ALTER TABLE `address`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT for table `bungalow`
--
ALTER TABLE `bungalow`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `customer`
--
ALTER TABLE `customer`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `discount`
--
ALTER TABLE `discount`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `employee`
--
ALTER TABLE `employee`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `paymentmethod`
--
ALTER TABLE `paymentmethod`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `reservation`
--
ALTER TABLE `reservation`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

--
-- AUTO_INCREMENT for table `role`
--
ALTER TABLE `role`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `customer`
--
ALTER TABLE `customer`
  ADD CONSTRAINT `customer_ibfk_1` FOREIGN KEY (`idUser`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `discount`
--
ALTER TABLE `discount`
  ADD CONSTRAINT `discount_ibfk_1` FOREIGN KEY (`idBungalow`) REFERENCES `bungalow` (`id`);

--
-- Constraints for table `employee`
--
ALTER TABLE `employee`
  ADD CONSTRAINT `employee_ibfk_1` FOREIGN KEY (`idUser`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `employee_ibfk_2` FOREIGN KEY (`roleId`) REFERENCES `role` (`id`);

--
-- Constraints for table `reservation`
--
ALTER TABLE `reservation`
  ADD CONSTRAINT `idPaymentMethod` FOREIGN KEY (`paymentMethodId`) REFERENCES `paymentmethod` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `reservation_ibfk_1` FOREIGN KEY (`idCustomer`) REFERENCES `customer` (`id`),
  ADD CONSTRAINT `reservation_ibfk_2` FOREIGN KEY (`idBungalow`) REFERENCES `bungalow` (`id`);

--
-- Constraints for table `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_ibfk_1` FOREIGN KEY (`addressId`) REFERENCES `address` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
