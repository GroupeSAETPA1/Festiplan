-- phpMyAdmin SQL Dump
-- version 4.9.5
-- https://www.phpmyadmin.net/
--
-- Hôte : localhost:3306
-- Généré le : mar. 12 déc. 2023 à 07:02
-- Version du serveur :  5.7.18
-- Version de PHP : 7.4.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `festiplan`
--
CREATE DATABASE IF NOT EXISTS `festiplan` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_bin;
USE `festiplan`;

-- --------------------------------------------------------

--
-- Structure de la table `categorie`
--

CREATE TABLE `categorie` (
  `id_categorie` int(6) NOT NULL,
  `nom` varchar(70) COLLATE utf8_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Structure de la table `festival`
--

CREATE TABLE `festival` (
  `id_festival` int(6) NOT NULL,
  `nom` varchar(150) COLLATE utf8_bin NOT NULL,
  `description` varchar(1000) COLLATE utf8_bin NOT NULL,
  `illustration` varchar(250) COLLATE utf8_bin NOT NULL,
  `debut` date NOT NULL,
  `fin` date NOT NULL,
  `id_categorie` int(11) NOT NULL,
  `id_responsable` int(11) NOT NULL,
  `duree entre spectacle` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Structure de la table `grij`
--

CREATE TABLE `grij` (
  `id_grij` int(11) NOT NULL,
  `id_festival` int(11) NOT NULL,
  `id_spectacle` int(11) NOT NULL,
  `debut` date NOT NULL,
  `fin` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Structure de la table `liste_organisateur`
--

CREATE TABLE `liste_organisateur` (
  `id_festival` int(6) NOT NULL,
  `id_organisateur` int(6) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Structure de la table `liste_scene`
--

CREATE TABLE `liste_scene` (
  `id_festival` int(6) NOT NULL,
  `id_scene` int(6) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Structure de la table `liste_spectacle`
--

CREATE TABLE `liste_spectacle` (
  `le_festival` int(6) NOT NULL,
  `id_spectacle` int(6) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Structure de la table `scene`
--

CREATE TABLE `scene` (
  `id_scene` int(6) NOT NULL,
  `nom` varchar(50) COLLATE utf8_bin NOT NULL,
  `taille` int(11) NOT NULL COMMENT 'id taille depuis taille scene',
  `spectateurs` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Structure de la table `spectacle`
--

CREATE TABLE `spectacle` (
  `id_spectacle` int(6) NOT NULL,
  `nom` varchar(150) COLLATE utf8_bin NOT NULL,
  `description` varchar(1000) COLLATE utf8_bin NOT NULL,
  `illustration` varchar(200) COLLATE utf8_bin DEFAULT NULL COMMENT 'lien de l''image pour le code php',
  `duree` int(3) NOT NULL,
  `id_categorie` int(11) NOT NULL COMMENT 'cle etrangere de categorie',
  `taille_scene` int(11) NOT NULL COMMENT 'cle etrangere de scene',
  `responsable_spectacle` int(11) NOT NULL COMMENT 'cle etrangere de utilisateur'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Structure de la table `taille scene`
--

CREATE TABLE `taille scene` (
  `id_taille` int(2) NOT NULL,
  `taille` varchar(30) COLLATE utf8_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Structure de la table `utilisateurs`
--

CREATE TABLE `utilisateurs` (
  `id_utilisateur` int(6) NOT NULL,
  `nom` varchar(50) COLLATE utf8_bin NOT NULL,
  `prenom` varchar(30) COLLATE utf8_bin NOT NULL,
  `mail` varchar(70) COLLATE utf8_bin NOT NULL,
  `mdp` varchar(50) COLLATE utf8_bin NOT NULL,
  `login` varchar(50) COLLATE utf8_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `categorie`
--
ALTER TABLE `categorie`
  ADD PRIMARY KEY (`id_categorie`);

--
-- Index pour la table `festival`
--
ALTER TABLE `festival`
  ADD PRIMARY KEY (`id_festival`),
  ADD KEY `fk_categorie` (`id_categorie`),
  ADD KEY `fk_utilisateur` (`id_responsable`);

--
-- Index pour la table `grij`
--
ALTER TABLE `grij`
  ADD PRIMARY KEY (`id_grij`);

--
-- Index pour la table `liste_organisateur`
--
ALTER TABLE `liste_organisateur`
  ADD PRIMARY KEY (`id_festival`,`id_organisateur`);

--
-- Index pour la table `liste_scene`
--
ALTER TABLE `liste_scene`
  ADD PRIMARY KEY (`id_festival`,`id_scene`);

--
-- Index pour la table `liste_spectacle`
--
ALTER TABLE `liste_spectacle`
  ADD PRIMARY KEY (`le_festival`,`id_spectacle`),
  ADD KEY `fk_spectacle` (`id_spectacle`),
  ADD KEY `fk_festival` (`le_festival`);

--
-- Index pour la table `scene`
--
ALTER TABLE `scene`
  ADD PRIMARY KEY (`id_scene`),
  ADD KEY `fk_taille` (`taille`);

--
-- Index pour la table `spectacle`
--
ALTER TABLE `spectacle`
  ADD PRIMARY KEY (`id_spectacle`),
  ADD KEY `fk_responsable` (`responsable_spectacle`),
  ADD KEY `fk_scene` (`taille_scene`),
  ADD KEY `fk_categorie` (`id_categorie`) USING BTREE;

--
-- Index pour la table `taille scene`
--
ALTER TABLE `taille scene`
  ADD PRIMARY KEY (`id_taille`),
  ADD UNIQUE KEY `pas de taille en double` (`taille`);

--
-- Index pour la table `utilisateurs`
--
ALTER TABLE `utilisateurs`
  ADD PRIMARY KEY (`id_utilisateur`),
  ADD UNIQUE KEY `login` (`login`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `categorie`
--
ALTER TABLE `categorie`
  MODIFY `id_categorie` int(6) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `grij`
--
ALTER TABLE `grij`
  MODIFY `id_grij` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `scene`
--
ALTER TABLE `scene`
  MODIFY `id_scene` int(6) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `spectacle`
--
ALTER TABLE `spectacle`
  MODIFY `id_spectacle` int(6) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `taille scene`
--
ALTER TABLE `taille scene`
  MODIFY `id_taille` int(2) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `utilisateurs`
--
ALTER TABLE `utilisateurs`
  MODIFY `id_utilisateur` int(6) NOT NULL AUTO_INCREMENT;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `festival`
--
ALTER TABLE `festival`
  ADD CONSTRAINT `fk_categorie` FOREIGN KEY (`id_categorie`) REFERENCES `categorie` (`id_categorie`),
  ADD CONSTRAINT `fk_utilisateur` FOREIGN KEY (`id_responsable`) REFERENCES `utilisateurs` (`id_utilisateur`);

--
-- Contraintes pour la table `liste_spectacle`
--
ALTER TABLE `liste_spectacle`
  ADD CONSTRAINT `fk_festival` FOREIGN KEY (`le_festival`) REFERENCES `festival` (`id_festival`),
  ADD CONSTRAINT `fk_spectacle` FOREIGN KEY (`id_spectacle`) REFERENCES `spectacle` (`id_spectacle`);

--
-- Contraintes pour la table `scene`
--
ALTER TABLE `scene`
  ADD CONSTRAINT `fk_taille` FOREIGN KEY (`taille`) REFERENCES `taille scene` (`id_taille`);

--
-- Contraintes pour la table `spectacle`
--
ALTER TABLE `spectacle`
  ADD CONSTRAINT `fk_caategorie` FOREIGN KEY (`id_categorie`) REFERENCES `categorie` (`id_categorie`),
  ADD CONSTRAINT `fk_responsable` FOREIGN KEY (`responsable_spectacle`) REFERENCES `utilisateurs` (`id_utilisateur`),
  ADD CONSTRAINT `fk_scene` FOREIGN KEY (`taille_scene`) REFERENCES `scene` (`id_scene`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
