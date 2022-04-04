-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le : mer. 23 mars 2022 à 16:57
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
-- Structure de la table `distance`
--

CREATE TABLE `distance` (
  `id` int(11) NOT NULL,
  `reservid` varchar(255) NOT NULL,
  `condid` varchar(255) NOT NULL,
  `dst` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `distance`
--

INSERT INTO `distance` (`id`, `reservid`, `condid`, `dst`) VALUES
(1, '51', '8', '2188.1590886719'),
(2, '51', '9', '2691.9684120041'),
(3, '51', '10', '2426.6172084967'),
(4, '51', '11', '2652.3417774563'),
(5, '51', '12', '3120.4008471382'),
(6, '51', '13', '3966.0145908981'),
(7, '51', '14', '3737.8776666699'),
(8, '51', '15', '1502.6001390139'),
(9, '51', '1', '786.4600124587'),
(10, '51', '16', '1178.8542956753'),
(11, '51', '17', '986.02958921604'),
(12, '51', '18', '3625.3198130981'),
(13, '51', '19', '2330.6040080123'),
(14, '51', '20', '1271.916917671'),
(15, '51', '21', '3720.1605481238'),
(16, '52', '13', '3978.3067254061'),
(17, '52', '14', '3750.4613506425'),
(18, '52', '15', '1515.3400676485'),
(19, '52', '1', '786.43523544558'),
(20, '52', '16', '1179.1597413544');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `distance`
--
ALTER TABLE `distance`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `distance`
--
ALTER TABLE `distance`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
