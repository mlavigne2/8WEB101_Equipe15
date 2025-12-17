-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 11, 2025 at 05:33 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `smashorpassdb`
--

-- --------------------------------------------------------

--
-- Table structure for table `items`
--

CREATE TABLE `items` (
  `id` int(11) NOT NULL,
  `nom` tinytext NOT NULL,
  `image_path` tinytext NOT NULL,
  `nb_smash` int(11) NOT NULL,
  `nb_pass` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `items`
--

INSERT INTO `items` (`id`, `nom`, `image_path`, `nb_smash`, `nb_pass`) VALUES
(0, 'Chat mignon', '../Images/Listes/Chat/Chat mignon.jpg', 0, 0),
(1, 'Silly cat', '../Images/Listes/Chat/Silly cat.png', 0, 0),
(2, 'Grumpy cat', '../Images/Listes/Chat/Grumpy cat.jpg', 0, 0),
(3, 'Chat orange', '../Images/Listes/Chat/Chat orange.jpg', 0, 0),
(4, 'Garfield', '../Images/Listes/Chat/Garfield.webp', 0, 0),
(5, 'Chat botté', '../Images/Listes/Chat/Chat botté.png', 0, 0),
(6, 'Tom', '../Images/Listes/Chat/Tom.webp', 0, 0),
(7, 'Tom', '../Images/Listes/Chat/1Tom.webp', 0, 0),
(8, 'Grosminet', '../Images/Listes/Chat/Grosminet.jpg', 0, 0),
(9, 'Duchesse', '../Images/Listes/Chat/Duchesse.jpg', 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `listes`
--

CREATE TABLE `listes` (
  `id` int(11) NOT NULL,
  `nom` tinytext NOT NULL,
  `vignette_path` tinytext NOT NULL,
  `combat_mode` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `listes`
--

INSERT INTO `listes` (`id`, `nom`, `vignette_path`, `combat_mode`) VALUES
(0, 'Chat', 'Images/Listes/Chat/vignette_liste_Chat.png', 0);

-- --------------------------------------------------------

--
-- Table structure for table `listes_content`
--

CREATE TABLE `listes_content` (
  `id_liste` int(11) NOT NULL,
  `id_item1` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `listes_content`
--

INSERT INTO `listes_content` (`id_liste`, `id_item1`) VALUES
(0, 0),
(0, 1),
(0, 2),
(0, 3),
(0, 4),
(0, 5),
(0, 6),
(0, 7),
(0, 8),
(0, 9);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `items`
--
ALTER TABLE `items`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `listes`
--
ALTER TABLE `listes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `listes_content`
--
ALTER TABLE `listes_content`
  ADD PRIMARY KEY (`id_liste`,`id_item1`),
  ADD KEY `fk_iditem1_itemid` (`id_item1`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `items`
--
ALTER TABLE `items`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=99;

--
-- AUTO_INCREMENT for table `listes`
--
ALTER TABLE `listes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `listes_content`
--
ALTER TABLE `listes_content`
  ADD CONSTRAINT `fk_iditem1_itemid` FOREIGN KEY (`id_item1`) REFERENCES `items` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `fk_idliste_listeid` FOREIGN KEY (`id_liste`) REFERENCES `listes` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
