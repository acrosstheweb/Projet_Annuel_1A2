-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:8889
-- Generation Time: Jun 23, 2022 at 09:50 PM
-- Server version: 5.7.34
-- PHP Version: 7.4.21

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `fitness_essential`
--

-- --------------------------------------------------------

--
-- Table structure for table `RkU_BOOKING`
--

CREATE TABLE `RkU_BOOKING` (
  `id` int(11) NOT NULL,
  `status` int(11) NOT NULL,
  `price` float NOT NULL,
  `discount` float DEFAULT NULL,
  `sport` int(11) NOT NULL,
  `gym` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `description` text,
  `startDate` datetime NOT NULL,
  `endDate` datetime NOT NULL,
  `places` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `RkU_BOOKING`
--

INSERT INTO `RkU_BOOKING` (`id`, `status`, `price`, `discount`, `sport`, `gym`, `name`, `description`, `startDate`, `endDate`, `places`) VALUES
(14, 1, 30, NULL, 11, 1, 'Séance découverte Zomba', 'Séance de découverte de la zomba', '2022-06-23 15:00:00', '2022-06-23 16:00:00', 9),
(15, 1, 10, NULL, 11, 1, 'Test affichage salle', 'Test', '2022-06-24 17:53:00', '2022-06-24 21:53:00', 10);

-- --------------------------------------------------------

--
-- Table structure for table `RkU_CITY`
--

CREATE TABLE `RkU_CITY` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `ZIPCode` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `RkU_CITY`
--

INSERT INTO `RkU_CITY` (`id`, `name`, `ZIPCode`) VALUES
(1, 'Paris', 75000);

-- --------------------------------------------------------

--
-- Table structure for table `RkU_CONTAINS`
--

CREATE TABLE `RkU_CONTAINS` (
  `series` int(11) NOT NULL,
  `repeats` int(11) NOT NULL,
  `programId` int(11) NOT NULL,
  `exerciceId` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `RkU_CONTAINS`
--

INSERT INTO `RkU_CONTAINS` (`series`, `repeats`, `programId`, `exerciceId`) VALUES
(4, 12, 1, 38),
(4, 15, 1, 39),
(3, 12, 1, 40),
(4, 8, 1, 41),
(4, 10, 1, 42),
(4, 12, 1, 43),
(4, 12, 2, 44),
(4, 12, 2, 45),
(4, 10, 2, 46),
(3, 15, 2, 47),
(4, 15, 2, 48),
(4, 15, 2, 49),
(4, 20, 3, 50),
(4, 20, 3, 51),
(4, 10, 3, 52),
(4, 10, 3, 53),
(4, 12, 3, 54),
(4, 10, 3, 55),
(5, 5, 4, 56),
(4, 8, 4, 57),
(4, 15, 4, 58),
(3, 15, 4, 59),
(4, 8, 4, 60),
(4, 12, 4, 61),
(4, 12, 4, 62),
(4, 10, 5, 44),
(4, 10, 5, 45),
(3, 15, 5, 63),
(4, 10, 5, 64),
(4, 12, 5, 65),
(4, 12, 5, 66),
(4, 20, 6, 67),
(4, 10, 6, 68),
(4, 10, 6, 69),
(3, 10, 6, 70),
(4, 10, 6, 71),
(4, 10, 6, 55);

-- --------------------------------------------------------

--
-- Table structure for table `RkU_EXERCICE`
--

CREATE TABLE `RkU_EXERCICE` (
  `id` int(11) NOT NULL,
  `nameExercice` varchar(100) NOT NULL,
  `descriptionExercice` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `RkU_EXERCICE`
--

INSERT INTO `RkU_EXERCICE` (`id`, `nameExercice`, `descriptionExercice`) VALUES
(38, 'Tirage vertical pronation', 'Tirage vertical pronation'),
(39, 'Rowing barre', 'Rowing barre'),
(40, 'Rowing unilateral', 'Rowing unilateral'),
(41, 'Tirage vertical supination', 'Tirage vertical supination'),
(42, 'Curl barre droite', 'Curl barre droite'),
(43, 'Curl marteau', 'Curl marteau'),
(44, 'Développé couché', 'Développé couché'),
(45, 'Développé incliné', 'Développé incliné'),
(46, 'Développé militaire', 'Développé militaire'),
(47, 'Tirage menton', 'Tirage menton'),
(48, 'Élévation latérale', 'Élévation latérale'),
(49, 'Oiseau poulie', 'Oiseau poulie'),
(50, 'Leg curl', 'Leg curl'),
(51, 'Low squat', 'Low squat'),
(52, 'Presse inclinée', 'Presse inclinée'),
(53, 'Sdt jambes tendues', 'Sdt jambes tendues'),
(54, 'Hack squat inversé', 'Hack squat inversé'),
(55, 'Mollet', 'Mollet'),
(56, 'Soulevé de terre convergent', 'Soulevé de terre convergent'),
(57, 'Tirage horizontal', 'Tirage horizontal'),
(58, 'Face pull', 'Face pull'),
(59, 'Lat pulldown', 'Lat pulldown'),
(60, 'Tirage vertical serré', 'Tirage vertical serré'),
(61, 'Curl poulie', 'Curl poulie'),
(62, 'Curl poulie corde', 'Curl poulie corde'),
(63, 'Écarté sur poulie', 'Écarté sur poulie'),
(64, 'Dips', 'Dips'),
(65, 'Extension triceps poulie haute', 'Extension triceps poulie haute'),
(66, 'Extension triceps poulie basse', 'Extension triceps poulie basse'),
(67, 'Leg extension', 'Leg extension'),
(68, 'Squat', 'Squat'),
(69, 'Presse incliné serré', 'Presse incliné serré'),
(70, 'Fentes smith machine', 'Fentes smith machine'),
(71, 'Hack squat', 'Hack squat');

-- --------------------------------------------------------

--
-- Table structure for table `RkU_GYMS`
--

CREATE TABLE `RkU_GYMS` (
  `id` int(11) NOT NULL,
  `surfaceArea` int(11) NOT NULL,
  `address` varchar(255) NOT NULL,
  `user` int(11) NOT NULL,
  `city` int(11) DEFAULT NULL,
  `name` varchar(50) NOT NULL,
  `phoneNumber` varchar(16) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `RkU_GYMS`
--

INSERT INTO `RkU_GYMS` (`id`, `surfaceArea`, `address`, `user`, `city`, `name`, `phoneNumber`) VALUES
(1, 15, '55 rue des près', 2, 1, 'Jaaj Gym', '0695069629');

-- --------------------------------------------------------

--
-- Table structure for table `RkU_MACHINE`
--

CREATE TABLE `RkU_MACHINE` (
  `id` int(11) NOT NULL,
  `serialNumber` varchar(50) NOT NULL,
  `name` varchar(100) NOT NULL,
  `state` int(11) DEFAULT NULL,
  `gym` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `RkU_MESSAGE`
--

CREATE TABLE `RkU_MESSAGE` (
  `id` int(11) NOT NULL,
  `dateSend` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `content` text NOT NULL,
  `userId` int(11) NOT NULL,
  `question` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `RkU_MESSAGE`
--

INSERT INTO `RkU_MESSAGE` (`id`, `dateSend`, `content`, `userId`, `question`) VALUES
(31, '2022-05-24 12:29:37', 'fezqf', 1, 34),
(32, '2022-05-24 12:29:38', 'fefqze', 1, 34),
(33, '2022-05-24 12:29:40', 'fqfefz', 1, 34),
(34, '2022-05-24 12:29:41', 'fezqfqzf', 1, 34),
(35, '2022-05-24 12:29:42', 'qfeqzef', 1, 34),
(36, '2022-05-24 12:29:44', 'qezfqzfqezf', 1, 34),
(37, '2022-05-24 12:29:45', 'fqfqzefezqf', 1, 34),
(38, '2022-05-24 12:29:47', 'feqzfqzf', 1, 34),
(39, '2022-05-24 12:29:48', 'qfzefqzef', 1, 34),
(40, '2022-05-24 12:29:49', 'fqefqfez', 1, 34),
(42, '2022-05-24 12:29:51', 'fqezfqzefzqf', 1, 34),
(43, '2022-05-24 12:29:52', 'qezfqf', 1, 34),
(44, '2022-05-24 12:29:54', 'qfqzfq', 1, 34),
(45, '2022-05-24 12:29:55', 'fqzf', 1, 34),
(46, '2022-05-24 12:30:00', 'qffqzf', 1, 34),
(47, '2022-05-24 12:30:01', 'fqfqez', 1, 34),
(48, '2022-05-24 12:30:03', 'fzqfqzef', 1, 34),
(49, '2022-05-28 19:35:22', 'On peut rajouter des commentaires', 1, 34),
(55, '2022-06-10 13:56:42', 'test', 1, 36),
(57, '2022-06-20 08:14:59', 'nfviuse hfqzijfouse h\r\nj\'espère que ça t\'aide', 2, 33),
(58, '2022-06-20 08:16:23', 'C\'est vraiment trop génial (un peu comme le poney)', 2, 38);

-- --------------------------------------------------------

--
-- Table structure for table `RkU_PARTICIPATE`
--

CREATE TABLE `RkU_PARTICIPATE` (
  `userId` int(11) NOT NULL,
  `eventId` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `RkU_PAYMENT`
--

CREATE TABLE `RkU_PAYMENT` (
  `id` int(11) NOT NULL,
  `amount` float NOT NULL,
  `paymentDate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `subscription` int(11) NOT NULL,
  `booking` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `rku_program`
--

CREATE TABLE `rku_program` (
  `id` int(11) NOT NULL,
  `nameProgram` varchar(25) NOT NULL,
  `creationDate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `illustration` varchar(30) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `rku_program`
--

INSERT INTO `rku_program` (`id`, `nameProgram`, `creationDate`, `illustration`) VALUES
(1, 'Pull #1', '2022-05-27 01:01:39', 'sources/img/pull1.jpg'),
(2, 'Push #1', '2022-05-28 01:01:39', 'sources/img/push1.jpg'),
(3, 'Legs #1', '2022-05-29 01:01:39', 'sources/img/legs1.jpg'),
(4, 'Pull #2', '2022-05-30 01:01:39', 'sources/img/pull2.jpg'),
(5, 'Push #2', '2022-05-31 01:01:39', 'sources/img/push2.jpg'),
(6, 'Legs #1', '2022-06-01 01:01:39', 'sources/img/legs2.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `RkU_QUESTION`
--

CREATE TABLE `RkU_QUESTION` (
  `id` int(11) NOT NULL,
  `creationDate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `title` varchar(255) NOT NULL,
  `content` text NOT NULL,
  `userId` int(11) NOT NULL,
  `topic` int(11) NOT NULL,
  `status` char(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `RkU_QUESTION`
--

INSERT INTO `RkU_QUESTION` (`id`, `creationDate`, `title`, `content`, `userId`, `topic`, `status`) VALUES
(31, '2022-05-24 10:36:32', '1', 'Test1', 1, 5, '1'),
(32, '2022-05-24 10:36:40', '2', 'Test2', 2, 5, '0'),
(33, '2022-05-24 12:00:40', ' fjkzebf', 'fbauibfsu', 2, 5, '0'),
(34, '2022-05-24 12:01:01', 'ferskfnk', 'fsejklfnmerz', 1, 5, '0'),
(35, '2022-05-26 20:48:36', 'viqerjv', 'fqnjlrn', 1, 5, '0'),
(36, '2022-05-28 19:35:48', 'Test', 'Test', 1, 5, '1'),
(37, '2022-05-28 19:39:50', 'Test1', 'Test1', 1, 5, '0'),
(38, '2022-06-20 08:15:54', 'Eh c\'est bien la zumba ou pas ?', 'Je sais pas si c\'est bien \r\nHELP', 2, 5, '0');

-- --------------------------------------------------------

--
-- Table structure for table `RkU_RESERVES`
--

CREATE TABLE `RkU_RESERVES` (
  `user` int(11) DEFAULT NULL,
  `booking` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `RkU_SPORT`
--

CREATE TABLE `RkU_SPORT` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `description` text
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `RkU_SPORT`
--

INSERT INTO `RkU_SPORT` (`id`, `name`, `description`) VALUES
(11, 'Zumba', 'Méthode de fitness inspirée de différentes danses latino-américaines'),
(12, 'Hiit', 'L\' entraînement fractionné de haute intensité est un mode d\'entraînement fractionné qui vise un renforcement de la condition physique par de brèves séances d\'exercices en anaérobie'),
(13, 'Pilates', 'Ensemble d\'exercices physiques visant au renforcement des muscles centraux et au bon équilibre du corps.'),
(14, 'Crossfit', 'Activité sportive associant gymnastique, haltérophilie et endurance'),
(15, 'Yoga', 'Doctrine et exercices traditionnels hindous, cherchant à réunir l\'individu avec le principe de toute existence'),
(16, 'Cycling', 'Faire du vélo :)'),
(17, 'Musculation', 'Développement d\'un muscle, d\'une partie du corps grâce à des exercices physiques'),
(18, 'Abdos fessiers', 'Relatif à des exercices physiques permettant de renforcer les muscles de la ceinture abdominale et des fesses'),
(20, 'Karaté', 'C\'est du karaté');

-- --------------------------------------------------------

--
-- Table structure for table `RkU_SUBSCRIPTION`
--

CREATE TABLE `RkU_SUBSCRIPTION` (
  `id` int(11) NOT NULL,
  `price` float NOT NULL,
  `discount` float DEFAULT NULL,
  `name` varchar(30) NOT NULL,
  `content` text NOT NULL,
  `firstAttribut` varchar(30) NOT NULL,
  `secondAttribut` varchar(30) NOT NULL,
  `thirdAttribut` varchar(30) NOT NULL,
  `path` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `RkU_SUBSCRIPTION`
--

INSERT INTO `RkU_SUBSCRIPTION` (`id`, `price`, `discount`, `name`, `content`, `firstAttribut`, `secondAttribut`, `thirdAttribut`, `path`) VALUES
(1, 15.99, NULL, 'ESSENTIAL', 'C\'est la même qualité, c\'est juste le prix qui baisse. T\'es pas obligé de faire le rat par contre.', 'Étudiant', '+ Bénéfice', '- Investissement', 'essential.png'),
(2, 24.99, NULL, 'CLASSIC', 'Accès classique à la salle de sport. Catégorie socioprofessionnelle moyenne, tu ne mérites pas que je t\'embête', 'Fonctionnaires', 'Abonnement rentabilisé', '+ Regard des autres', 'classic.png'),
(3, 49.99, NULL, 'PREMIUM', 'Wow, tu possèdes un maximum de valeur financière, ce qui te permet donc de profiter sur système capitaliste comme bon te semble.', 'Pesos Mexicanos', 'Livres Sterling', 'Dinar Algérien', 'premium.png');

-- --------------------------------------------------------

--
-- Table structure for table `RkU_TOPIC`
--

CREATE TABLE `RkU_TOPIC` (
  `id` int(11) NOT NULL,
  `creationDate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `title` varchar(255) NOT NULL,
  `description` varchar(255) DEFAULT NULL,
  `topicOrder` int(11) NOT NULL,
  `path` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `RkU_TOPIC`
--

INSERT INTO `RkU_TOPIC` (`id`, `creationDate`, `title`, `description`, `topicOrder`, `path`) VALUES
(5, '2022-05-17 21:21:54', 'Zumba', 'Toutes les questions et sujets Zomba', 1, 'zumba.jpg'),
(6, '2022-05-17 21:21:54', 'HIIT', 'Toutes les questions et sujets HIIT', 2, 'hiit.jpg'),
(7, '2022-05-17 21:25:24', 'Abdos fessiers', 'Toutes les questions et sujets Abdos-fessiers', 8, 'abs.jpg'),
(8, '2022-05-17 21:25:56', 'Pilates', 'Toutes les questions et sujets Pilates', 3, 'pilates.jpg'),
(9, '2022-05-17 21:26:15', 'Yoga', 'Toutes les questions et sujets Yoga', 5, 'yoga.jpg'),
(10, '2022-05-17 21:27:00', 'Cycling', 'Toutes les questions et sujets Cycling', 6, 'cycling.jpg'),
(11, '2022-05-17 21:27:00', 'Crossfit', 'Toutes les questions et sujets Crossfit', 4, 'crossfit.jpg'),
(12, '2022-05-17 21:27:34', 'Musculation', 'Toutes les questions et sujets Musculation', 7, 'musculation.jpg'),
(13, '2022-06-20 09:07:34', 'test', '&lt;h1&gt;ceci est un test&lt;/h1&gt;', 10, 'C.png');

-- --------------------------------------------------------

--
-- Table structure for table `RkU_USER`
--

CREATE TABLE `RkU_USER` (
  `id` int(11) NOT NULL,
  `firstName` varchar(100) NOT NULL,
  `lastName` varchar(180) NOT NULL,
  `email` varchar(255) NOT NULL,
  `civility` char(1) NOT NULL,
  `avatar` varchar(255) NOT NULL DEFAULT '0',
  `password` varchar(255) NOT NULL,
  `address` varchar(200) NOT NULL,
  `city` varchar(180) NOT NULL,
  `zipCode` int(11) NOT NULL,
  `birthday` date NOT NULL,
  `fitcoin` int(11) NOT NULL,
  `role` int(11) NOT NULL,
  `registrationDate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `lastUpdate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `lastPasswordUpdate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `changePassword` int(1) DEFAULT '0',
  `token` char(17) DEFAULT NULL,
  `subscription` int(11) DEFAULT NULL,
  `startDateSub` date DEFAULT NULL,
  `endDateSub` date DEFAULT NULL,
  `renewalDate` date DEFAULT NULL,
  `nextPaymentDate` date DEFAULT NULL,
  `token_confirm_inscription` char(17) DEFAULT NULL,
  `newsletter` int(1) DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `RkU_USER`
--

INSERT INTO `RkU_USER` (`id`, `firstName`, `lastName`, `email`, `civility`, `avatar`, `password`, `address`, `city`, `zipCode`, `birthday`, `fitcoin`, `role`, `registrationDate`, `lastUpdate`, `lastPasswordUpdate`, `changePassword`, `token`, `subscription`, `startDateSub`, `endDateSub`, `renewalDate`, `nextPaymentDate`, `token_confirm_inscription`, `newsletter`) VALUES
(2, 'Tom', 'BOURLARD', 'admin@admin.com', 'M', '0', '$2y$10$g5dGP/x7hQ65w7s1vzGEaOWDPxBJbuDp9k8czRmWH57dGA4dhSDhi', '25 Allée Des Platanes', 'Maisons-alfort', 94700, '2003-12-07', 70, 2, '2022-06-16 13:40:31', '2022-06-23 13:40:55', '2022-06-23 13:40:55', 0, 'f19fc76d64b261$@8', NULL, NULL, NULL, NULL, NULL, '51e1fbc23ba260@$6', 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `RkU_BOOKING`
--
ALTER TABLE `RkU_BOOKING`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `RkU_CITY`
--
ALTER TABLE `RkU_CITY`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `RkU_EXERCICE`
--
ALTER TABLE `RkU_EXERCICE`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `RkU_GYMS`
--
ALTER TABLE `RkU_GYMS`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `RkU_MACHINE`
--
ALTER TABLE `RkU_MACHINE`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `RkU_MESSAGE`
--
ALTER TABLE `RkU_MESSAGE`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `RkU_PAYMENT`
--
ALTER TABLE `RkU_PAYMENT`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `rku_program`
--
ALTER TABLE `rku_program`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `RkU_QUESTION`
--
ALTER TABLE `RkU_QUESTION`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `RkU_SPORT`
--
ALTER TABLE `RkU_SPORT`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `RkU_SUBSCRIPTION`
--
ALTER TABLE `RkU_SUBSCRIPTION`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `RkU_TOPIC`
--
ALTER TABLE `RkU_TOPIC`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `RkU_USER`
--
ALTER TABLE `RkU_USER`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `RkU_BOOKING`
--
ALTER TABLE `RkU_BOOKING`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `RkU_CITY`
--
ALTER TABLE `RkU_CITY`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `RkU_EXERCICE`
--
ALTER TABLE `RkU_EXERCICE`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=72;

--
-- AUTO_INCREMENT for table `RkU_GYMS`
--
ALTER TABLE `RkU_GYMS`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `RkU_MACHINE`
--
ALTER TABLE `RkU_MACHINE`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `RkU_MESSAGE`
--
ALTER TABLE `RkU_MESSAGE`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=59;

--
-- AUTO_INCREMENT for table `RkU_PAYMENT`
--
ALTER TABLE `RkU_PAYMENT`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `rku_program`
--
ALTER TABLE `rku_program`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `RkU_QUESTION`
--
ALTER TABLE `RkU_QUESTION`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39;

--
-- AUTO_INCREMENT for table `RkU_SPORT`
--
ALTER TABLE `RkU_SPORT`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `RkU_SUBSCRIPTION`
--
ALTER TABLE `RkU_SUBSCRIPTION`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `RkU_TOPIC`
--
ALTER TABLE `RkU_TOPIC`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `RkU_USER`
--
ALTER TABLE `RkU_USER`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
