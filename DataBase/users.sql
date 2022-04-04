-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le : lun. 21 mars 2022 à 10:16
-- Version du serveur : 10.4.22-MariaDB
-- Version de PHP : 8.1.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `login`
--

-- --------------------------------------------------------

--
-- Structure de la table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `firstname` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `mobile` int(11) NOT NULL,
  `password` varchar(255) NOT NULL,
  `account` varchar(255) NOT NULL,
  `sex` varchar(255) NOT NULL,
  `otp` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `users`
--

INSERT INTO `users` (`id`, `name`, `firstname`, `email`, `mobile`, `password`, `account`, `sex`, `otp`) VALUES
(1, 'de SOUZA', 'Renaud', 'carickren@gmail.com', 66816189, 'e10adc3949ba59abbe56e057f20f883e', 'conducteur', 'masculin', ''),
(6, 'de SOUZA', 'tdtdtdt', 'caooochaooo@gmail.com', 12255555, '202cb962ac59075b964b07152d234b70', 'client', 'masculin', ''),
(8, 'con1', 'coc1', 'concoc@gmail.com', 125552555, 'e10adc3949ba59abbe56e057f20f883e', 'conducteur', 'masculin', ''),
(9, 'con2', 'cac2', 'cac@con2gmail.com', 258854555, 'e10adc3949ba59abbe56e057f20f883e', 'conducteur', 'masculin', ''),
(10, 'con3', 'cac3', 'cacon3@gmail.com', 566558965, 'e10adc3949ba59abbe56e057f20f883e', 'conducteur', 'masculin', ''),
(11, 'con4', 'cac4', 'cacon4@gmail.com', 55555578, 'e10adc3949ba59abbe56e057f20f883e', 'conducteur', 'masculin', ''),
(12, 'SOUZAnbb', 'Raphkknk', 'conca5@gmail.com', 45566655, 'e10adc3949ba59abbe56e057f20f883e', 'conducteur', 'masculin', ''),
(13, 'con6', 'cac6', 'concac7@gmail.com', 14455522, 'e10adc3949ba59abbe56e057f20f883e', 'conducteur', 'masculin', ''),
(14, 'con8', 'cac8', 'conca8@gmail.com', 452553652, 'e10adc3949ba59abbe56e057f20f883e', 'conducteur', 'masculin', ''),
(15, 'cal9', 'volx9', 'cocan9@gmail.com', 145655636, 'e10adc3949ba59abbe56e057f20f883e', 'conducteur', 'masculin', ''),
(16, 'Ren2', 'gom', 'conca10@gmail.com', 146555665, 'e10adc3949ba59abbe56e057f20f883e', 'conducteur', 'masculin', ''),
(17, 'ren3', 'kdk', 'conca11@gmail.com', 257566655, 'e10adc3949ba59abbe56e057f20f883e', 'conducteur', 'masculin', ''),
(18, 'viva', 'cal', 'caocon12@gmail.com', 22554565, 'e10adc3949ba59abbe56e057f20f883e', 'conducteur', 'masculin', ''),
(19, 'bilo', 'looo', 'cancli@13gmail.com', 155221, 'e10adc3949ba59abbe56e057f20f883e', 'conducteur', 'masculin', ''),
(20, 'halo', 'gibier', 'conca14@gmail.com', 1155225, 'e10adc3949ba59abbe56e057f20f883e', 'conducteur', 'masculin', ''),
(21, 'bouro', 'mile', 'conca15@gmail.com', 25555223, 'e10adc3949ba59abbe56e057f20f883e', 'conducteur', 'masculin', '');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
