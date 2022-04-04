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
-- Structure de la table `conducteur`
--

CREATE TABLE `conducteur` (
  `id` int(11) NOT NULL,
  `mconducteur` varchar(255) NOT NULL,
  `clat` varchar(255) NOT NULL,
  `clng` varchar(255) NOT NULL,
  `qualiterapide` int(11) NOT NULL,
  `qualitelent` int(11) NOT NULL,
  `countrapidenote` int(11) NOT NULL DEFAULT 100,
  `countlentnote` int(11) NOT NULL DEFAULT 100,
  `condid` int(11) NOT NULL,
  `disponible` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `conducteur`
--

INSERT INTO `conducteur` (`id`, `mconducteur`, `clat`, `clng`, `qualiterapide`, `qualitelent`, `countrapidenote`, `countlentnote`, `condid`, `disponible`) VALUES
(1, 'vehiculeclimatise', '18.12415637215046', '10.072978515625003', 23, 80, 100, 100, 8, 1),
(2, 'vehiculeclimatise', '16.277137871527852', '20.444072265625003\r\n', 10, 50, 100, 100, 9, 1),
(3, 'vehiculeclimatise', '21.595353940593835', '5.502666015625004', 15, 20, 100, 100, 10, 1),
(4, 'vehiculeclimatise', '22.084845988860238', '-6.977802734374996', 28, 79, 100, 100, 11, 1),
(5, 'vehiculeclimatise', '25.779335612740773', '13.764384765625003', 45, 90, 100, 100, 12, 1),
(6, 'vehiculesimple', '9.599905152875149', '36.791728515625', 32, 56, 100, 100, 13, 1),
(7, 'vehiculesimple', '-6.163252748535638', '35.385478515625', 99, 36, 100, 100, 14, 1),
(8, 'vehiculesimple', '1.5590094041840794', '15.697978515625003', 12, 5, 100, 100, 15, 1),
(9, 'vehiculesimple', '7.0727864462164325', '2.201274414062504', 15, 42, 74, 130, 1, 1),
(10, 'vehiculesimple', '10.60037813021819', '2.470439453125004', 59, 99, 100, 100, 16, 1),
(11, 'taximoto', '8.867943025604538', '2.305644531250004', 98, 25, 100, 100, 17, 1),
(12, 'taximoto', '32.5692405205576', '3.887675781250004', 88, 30, 100, 100, 18, 1),
(13, 'taximoto', '6.167010496292487', '22.344707031250003', 90, 23, 100, 100, 19, 1),
(14, 'taximoto', '4.1538249132596645', '12.940410156250003', 75, 45, 100, 100, 20, 1),
(15, 'taximoto', '-5.3270278096903185', '35.35251953125', 95, 75, 100, 100, 21, 1);

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `conducteur`
--
ALTER TABLE `conducteur`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `conducteur`
--
ALTER TABLE `conducteur`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
