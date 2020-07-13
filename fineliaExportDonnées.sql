-- phpMyAdmin SQL Dump
-- version 4.6.4
-- https://www.phpmyadmin.net/
--
-- Client :  127.0.0.1
-- Généré le :  Lun 13 Juillet 2020 à 19:11
-- Version du serveur :  5.7.14
-- Version de PHP :  7.0.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `finelia`
--

-- --------------------------------------------------------

--
-- Structure de la table `etudiant`
--

CREATE TABLE `etudiant` (
  `etudiantID` int(11) NOT NULL,
  `nom` varchar(20) NOT NULL,
  `prenom` varchar(20) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Contenu de la table `etudiant`
--

INSERT INTO `etudiant` (`etudiantID`, `nom`, `prenom`) VALUES
(17121996, 'GONS SAIB', 'Fatimah'),
(30031999, 'GONS SAIB', 'Mohammad');

-- --------------------------------------------------------

--
-- Structure de la table `matiere`
--

CREATE TABLE `matiere` (
  `matiereID` int(11) NOT NULL,
  `intitule` varchar(20) NOT NULL,
  `etudiantID` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Contenu de la table `matiere`
--

INSERT INTO `matiere` (`matiereID`, `intitule`, `etudiantID`) VALUES
(1, 'Informatique', 1),
(2, 'Français', 2),
(3, 'Anglais', 1);

-- --------------------------------------------------------

--
-- Structure de la table `note`
--

CREATE TABLE `note` (
  `noteID` int(11) NOT NULL,
  `note` double NOT NULL,
  `coefficient` double NOT NULL,
  `matiereID` int(11) NOT NULL,
  `etudiantID` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Contenu de la table `note`
--

INSERT INTO `note` (`noteID`, `note`, `coefficient`, `matiereID`, `etudiantID`) VALUES
(35, 15, 3, 2, 17121996),
(34, 15, 2, 1, 17121996),
(41, 18, 3, 3, 30031999),
(40, 15, 2, 3, 30031999),
(39, 17, 2, 2, 30031999),
(38, 18, 2, 2, 17121996),
(37, 15, 1, 2, 30031999),
(36, 12, 1, 2, 17121996),
(33, 15, 1, 1, 17121996),
(32, 18, 3, 1, 30031999),
(31, 17, 2, 1, 30031999),
(30, 19, 2, 3, 17121996),
(29, 18, 1, 3, 17121996);

--
-- Index pour les tables exportées
--

--
-- Index pour la table `etudiant`
--
ALTER TABLE `etudiant`
  ADD PRIMARY KEY (`etudiantID`);

--
-- Index pour la table `matiere`
--
ALTER TABLE `matiere`
  ADD PRIMARY KEY (`matiereID`),
  ADD KEY `etudiantID` (`etudiantID`);

--
-- Index pour la table `note`
--
ALTER TABLE `note`
  ADD PRIMARY KEY (`noteID`),
  ADD KEY `matiereID` (`matiereID`),
  ADD KEY `etudiantID` (`etudiantID`);

--
-- AUTO_INCREMENT pour les tables exportées
--

--
-- AUTO_INCREMENT pour la table `note`
--
ALTER TABLE `note`
  MODIFY `noteID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=42;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
