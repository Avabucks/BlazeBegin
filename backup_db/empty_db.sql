-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Creato il: Giu 11, 2023 alle 11:43
-- Versione del server: 5.7.41-cll-lve
-- Versione PHP: 8.0.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `h1015089_avabucks`
--

-- --------------------------------------------------------

--
-- Struttura della tabella `tbl_category`
--

CREATE TABLE `tbl_category` (
  `id` int(11) NOT NULL,
  `name_category` mediumtext NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dump dei dati per la tabella `tbl_category`
--

INSERT INTO `tbl_category` (`id`, `name_category`) VALUES
(10, 'Portfolio'),
(11, 'Brand'),
(12, 'Web Tool'),
(13, 'Developer Tool'),
(14, 'Artificial Intelligence'),
(15, 'Blog'),
(16, 'Content Creator'),
(17, 'Web Development'),
(18, 'Business & Customer Service'),
(19, 'Education & Science'),
(20, 'eCommerce & Shopping'),
(21, 'Blockchain'),
(22, 'Design Tool'),
(23, 'Search Engines'),
(24, 'Arts & Entertainment'),
(25, 'Community & Society'),
(26, 'Finance & Investing'),
(27, 'Food & Drink'),
(28, 'Gambling'),
(29, 'Games'),
(30, 'Health'),
(31, 'Hobbies'),
(32, 'Jobs & Career'),
(33, 'Lifestyle'),
(34, 'News'),
(35, 'Sports'),
(36, 'Travel & Tourism'),
(37, 'Vehicles'),
(38, 'Computers & Technology'),
(39, 'Bot'),
(40, 'CMS');

-- --------------------------------------------------------

--
-- Struttura della tabella `tbl_likes`
--

CREATE TABLE `tbl_likes` (
  `id` int(11) NOT NULL,
  `id_startup` int(11) NOT NULL,
  `id_us` mediumtext NOT NULL,
  `isLike` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Struttura della tabella `tbl_notifications`
--

CREATE TABLE `tbl_notifications` (
  `id` int(11) NOT NULL,
  `id_us` mediumtext NOT NULL,
  `has_read` int(11) NOT NULL,
  `message_type` int(11) NOT NULL,
  `name_startup` mediumtext NOT NULL,
  `name_user` mediumtext NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Struttura della tabella `tbl_startups`
--

CREATE TABLE `tbl_startups` (
  `id` int(11) NOT NULL,
  `title` mediumtext NOT NULL,
  `subtitle` mediumtext NOT NULL,
  `description_c` longtext NOT NULL,
  `images_path` longtext NOT NULL,
  `link` mediumtext NOT NULL,
  `category_id` int(11) NOT NULL,
  `instagram_link` mediumtext NOT NULL,
  `tiktok_link` mediumtext NOT NULL,
  `facebook_link` mediumtext NOT NULL,
  `twitter_link` mediumtext NOT NULL,
  `author` mediumtext NOT NULL,
  `id_us` mediumtext NOT NULL,
  `status_bool` int(11) NOT NULL,
  `views` int(11) NOT NULL,
  `date_added` date NOT NULL,
  `boost_start` datetime NOT NULL,
  `boost_end` datetime NOT NULL,
  `likes` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struttura della tabella `tbl_user`
--

CREATE TABLE `tbl_user` (
  `id` int(11) NOT NULL,
  `username_us` varchar(256) NOT NULL,
  `email_us` varchar(256) NOT NULL,
  `password_us` varchar(256) NOT NULL,
  `id_us` mediumtext NOT NULL,
  `diamonds` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dump dei dati per la tabella `tbl_user`
--

INSERT INTO `tbl_user` (`id`, `username_us`, `email_us`, `password_us`, `id_us`, `diamonds`) VALUES
(1, 'localhost', 'local@host.it', '25d55ad283aa400af464c76d713c07ad', '34811d5b037c3be94b8c86253b36806d', 0);

--
-- Indici per le tabelle scaricate
--

--
-- Indici per le tabelle `tbl_category`
--
ALTER TABLE `tbl_category`
  ADD PRIMARY KEY (`id`);

--
-- Indici per le tabelle `tbl_likes`
--
ALTER TABLE `tbl_likes`
  ADD PRIMARY KEY (`id`);

--
-- Indici per le tabelle `tbl_notifications`
--
ALTER TABLE `tbl_notifications`
  ADD PRIMARY KEY (`id`);

--
-- Indici per le tabelle `tbl_startups`
--
ALTER TABLE `tbl_startups`
  ADD PRIMARY KEY (`id`);

--
-- Indici per le tabelle `tbl_user`
--
ALTER TABLE `tbl_user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT per le tabelle scaricate
--

--
-- AUTO_INCREMENT per la tabella `tbl_category`
--
ALTER TABLE `tbl_category`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;

--
-- AUTO_INCREMENT per la tabella `tbl_likes`
--
ALTER TABLE `tbl_likes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1;

--
-- AUTO_INCREMENT per la tabella `tbl_notifications`
--
ALTER TABLE `tbl_notifications`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1;

--
-- AUTO_INCREMENT per la tabella `tbl_startups`
--
ALTER TABLE `tbl_startups`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1000;

--
-- AUTO_INCREMENT per la tabella `tbl_user`
--
ALTER TABLE `tbl_user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
