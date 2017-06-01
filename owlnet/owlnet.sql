-- phpMyAdmin SQL Dump
-- version 4.6.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 31, 2017 at 10:56 AM
-- Server version: 5.7.14
-- PHP Version: 5.6.25

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `owlnet`
--

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

CREATE TABLE `comments` (
  `id` int(11) NOT NULL,
  `post_id` varchar(20) NOT NULL,
  `com_author` int(11) NOT NULL,
  `com_cont` varchar(300) NOT NULL,
  `time` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `comments`
--

INSERT INTO `comments` (`id`, `post_id`, `com_author`, `com_cont`, `time`) VALUES
(37, '149', 1, 'opj9', '2017-05-27 21:21:09'),
(40, '153', 1, 'Novi koment', '2017-05-28 18:37:42'),
(41, '152', 1, 'Novi ksafcnoisf', '2017-05-28 18:38:45'),
(42, '159', 2, '9uj', '2017-05-29 18:23:01'),
(43, '159', 2, 'dizerrr', '2017-05-29 19:29:24'),
(44, '160', 1, 'dada', '2017-05-30 14:44:58'),
(45, '170', 2, 'Ovo je komentar ', '2017-05-31 12:06:19');

-- --------------------------------------------------------

--
-- Table structure for table `groups`
--

CREATE TABLE `groups` (
  `id` int(11) NOT NULL,
  `name` varchar(250) NOT NULL,
  `pic` varchar(260) NOT NULL,
  `descript` varchar(300) NOT NULL,
  `Cover` varchar(300) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `groups`
--

INSERT INTO `groups` (`id`, `name`, `pic`, `descript`, `Cover`) VALUES
(1, 'Life', 'http://www.awarenessideas.com/v/vspfiles/images/thumbs/AI-eco-07.jpg', 'Ovo je stranica proizvoda bio melem', 'https://assets.entrepreneur.com/content/16x9/822/20160226192037-succeed-adventure-sunrise-successful-man-top-mountain.jpeg'),
(2, 'Fiat', 'https://upload.wikimedia.org/wikipedia/en/thumb/9/96/Fiat_Logo.svg/1200px-Fiat_Logo.svg.png', 'Fabrika automobila', 'https://www.fiatcanada.com/uploads/secondary_contents/fiat/1-2017_flat_lowerpromotiles1.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `groups_role`
--

CREATE TABLE `groups_role` (
  `id` int(11) NOT NULL,
  `group_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `group_role` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `groups_role`
--

INSERT INTO `groups_role` (`id`, `group_id`, `user_id`, `group_role`) VALUES
(1, 1, 1, 2),
(2, 2, 2, 2);

-- --------------------------------------------------------

--
-- Table structure for table `likes`
--

CREATE TABLE `likes` (
  `post_id` int(11) NOT NULL,
  `lajker_id` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `likes`
--

INSERT INTO `likes` (`post_id`, `lajker_id`) VALUES
(146, 1),
(153, 1),
(152, 1),
(160, 2),
(160, 2),
(161, 2),
(163, 1);

-- --------------------------------------------------------

--
-- Table structure for table `posts`
--

CREATE TABLE `posts` (
  `id` int(11) NOT NULL,
  `autor_id` int(50) DEFAULT NULL,
  `content` varchar(300) NOT NULL,
  `pictures` varchar(300) DEFAULT NULL,
  `type` varchar(10) DEFAULT 'status',
  `likes` int(11) NOT NULL DEFAULT '0',
  `date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `group_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `posts`
--

INSERT INTO `posts` (`id`, `autor_id`, `content`, `pictures`, `type`, `likes`, `date`, `group_id`) VALUES
(168, 1, 'Ovo je profil head admina!', NULL, 'status', 0, '2017-05-31 12:00:35', NULL),
(169, NULL, 'Ovo je grupa/stranica Life.I sa njom rukuje administrator stranice.', NULL, 'status', 0, '2017-05-31 12:01:03', 1),
(170, NULL, 'Ovo je stranica fiat ciji je admin Milan Mitrovic', NULL, 'status', 0, '2017-05-31 12:01:42', 2),
(171, 7, 'Ovo je vas account profesore.Slika na profilu je dodeljena na random, tako da nije neka prozivka.', NULL, 'status', 0, '2017-05-31 12:13:06', NULL),
(172, 1, 'dsadasdasa', NULL, 'status', 0, '2017-05-31 12:50:02', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `ime` varchar(256) NOT NULL,
  `prezime` varchar(256) NOT NULL,
  `email` varchar(256) NOT NULL,
  `pol` varchar(2) NOT NULL,
  `slika` varchar(1000) DEFAULT 'images/blancprofil.jpg',
  `sifra` varchar(256) NOT NULL,
  `datum_rodjenja` varchar(33) NOT NULL,
  `role` int(11) NOT NULL DEFAULT '0',
  `cover` varchar(341) NOT NULL DEFAULT 'images/coverblanc.jpg'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `ime`, `prezime`, `email`, `pol`, `slika`, `sifra`, `datum_rodjenja`, `role`, `cover`) VALUES
(1, 'Vukasin', 'Petrovic', 'vukasin123@gmail.com', 'm', 'images/blancprofil.jpg', '148ed0766a20cbf784c026b7992cfc80', '13.12.1994', 2, 'images/coverblanc.jpg'),
(2, 'Milan', 'Mitrovic', 'milan@gmail.com', 'm', 'https://upload.wikimedia.org/wikipedia/commons/thumb/7/7f/Robert_Pires_2011.jpg/1200px-Robert_Pires_2011.jpg', '49e34051a5bb3df733080908649b9ad1', '', 0, 'images/coverblanc.jpg'),
(4, 'Jova', 'Peric', 'jova@gmail.com', 'on', NULL, '25d55ad283aa400af464c76d713c07ad', '', 0, 'images/coverblanc.jpg'),
(5, 'Michel', 'Scofild', 'prison@gmail.com', 'm', 'images/blancprofil.jpg', '148ed0766a20cbf784c026b7992cfc80', '', 0, 'images/coverblanc.jpg'),
(6, 'Sovica', 'Sovic', 'sovic@gmail.com', 'm', 'images/owl10.jpg', '43ac324f641218d91d7a46b4016a70de', '', 0, 'images/coverblanc.jpg'),
(7, 'Vladimir', 'Maric', 'vlada@gmail.com', 'm', 'images/owl3.jpg', '9080ab12320bab8787cf8a4118ac6264', '', 2, 'images/coverblanc.jpg');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `groups`
--
ALTER TABLE `groups`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `groups_role`
--
ALTER TABLE `groups_role`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `posts`
--
ALTER TABLE `posts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `comments`
--
ALTER TABLE `comments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=46;
--
-- AUTO_INCREMENT for table `groups`
--
ALTER TABLE `groups`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `groups_role`
--
ALTER TABLE `groups_role`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `posts`
--
ALTER TABLE `posts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=173;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
