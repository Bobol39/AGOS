-- phpMyAdmin SQL Dump
-- version 4.5.3.1
-- http://www.phpmyadmin.net
--
-- Client :  127.0.0.1
-- Généré le :  Mar 22 Novembre 2016 à 16:32
-- Version du serveur :  5.7.10
-- Version de PHP :  5.6.17

DROP TABLE IF EXISTS critere, critere_groupe_notation_jonction, etudiant, groupe_notation, planning, professeur, promotion, salle, soutenance, interface_prof_soutenance, note_critere_soutenance;



SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `agos`
--

-- --------------------------------------------------------

--
-- Structure de la table `critere`
--

CREATE TABLE `critere` (
  `id` int(11) NOT NULL,
  `titre` varchar(100) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `critere_groupe_notation_jonction`
--

CREATE TABLE `critere_groupe_notation_jonction` (
  `id` int(11) NOT NULL,
  `id_critere` int(11) NOT NULL,
  `id_groupe_notation` int(11) NOT NULL,
  `bareme` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT;

-- --------------------------------------------------------

--
-- Structure de la table `etudiant`
--

CREATE TABLE `etudiant` (
  `id` varchar(25) NOT NULL,
  `nom` varchar(25) NOT NULL,
  `prenom` varchar(25) NOT NULL,
  `id_promotion` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `groupe_notation`
--

CREATE TABLE `groupe_notation` (
  `id` int(11) NOT NULL,
  `titre` varchar(120) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `interface_prof_soutenance`
--

CREATE TABLE `interface_prof_soutenance` (
  `id` int(11) NOT NULL,
  `id_soutenance` int(11) NOT NULL,
  `id_professeur` varchar(25) NOT NULL,
  `text_note` text NOT NULL,
  `img_note` varchar(25) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `note_critere_soutenance`
--

CREATE TABLE `note_critere_soutenance` (
  `id` int(11) NOT NULL,
  `id_soutenance` int(11) NOT NULL,
  `id_critere` int(11) NOT NULL,
  `note` float NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `planning`
--

CREATE TABLE `planning` (
  `id` int(11) NOT NULL,
  `duree` int(11) NOT NULL DEFAULT '25',
  `delai_alerte` float NOT NULL DEFAULT '5',
  `titre` varchar(50) NOT NULL,
  `id_promotion` int(11) NOT NULL,
  `id_groupe_notation` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `professeur`
--

CREATE TABLE `professeur` (
  `id` varchar(25) NOT NULL,
  `nom` varchar(25) NOT NULL,
  `prenom` varchar(25) NOT NULL,
  `abreviation` varchar(25) NOT NULL,
  `admin` boolean NOT NULL DEFAULT 0
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `promotion`
--

CREATE TABLE `promotion` (
  `id` int(11) NOT NULL,
  `nom` varchar(50) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `salle`
--

CREATE TABLE `salle` (
  `id` int(11) NOT NULL,
  `nom` varchar(25) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `soutenance`
--

CREATE TABLE `soutenance` (
  `id` int(11) NOT NULL,
  `id_planning` int(11) NOT NULL,
  `id_salle` int(11) NOT NULL,
  `horaire` time NOT NULL,
  `date` date NOT NULL,
  `id_etudiant` varchar(25) DEFAULT NULL,
  `professeur1` varchar(25) NOT NULL,
  `professeur2` varchar(25) NOT NULL,
  `titre` varchar(50) DEFAULT NULL,
  `resume` text
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Index pour les tables exportées
--

--
-- Index pour la table `critere`
--
ALTER TABLE `critere`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id` (`id`);

--
-- Index pour la table `critere_groupe_notation_jonction`
--
ALTER TABLE `critere_groupe_notation_jonction`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_critere` (`id_critere`),
  ADD KEY `id_planning` (`id_groupe_notation`);

--
-- Index pour la table `groupe_notation`
--
ALTER TABLE `groupe_notation`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `interface_prof_soutenance`
--
ALTER TABLE `interface_prof_soutenance`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `note_critere_soutenance`
--
ALTER TABLE `note_critere_soutenance`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `planning`
--
ALTER TABLE `planning`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id` (`id`);

--
-- Index pour la table `professeur`
--
ALTER TABLE `professeur`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `promotion`
--
ALTER TABLE `promotion`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `salle`
--
ALTER TABLE `salle`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `soutenance`
--
ALTER TABLE `soutenance`
  ADD PRIMARY KEY (`id`),
  ADD KEY `professeur1` (`professeur1`),
  ADD KEY `professeur2` (`professeur2`),
  ADD KEY `id_salle` (`id_salle`),
  ADD KEY `id_planning` (`id_planning`);

--
-- AUTO_INCREMENT pour les tables exportées
--

--
-- AUTO_INCREMENT pour la table `critere`
--
ALTER TABLE `critere`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT pour la table `critere_groupe_notation_jonction`
--
ALTER TABLE `critere_groupe_notation_jonction`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT pour la table `groupe_notation`
--
ALTER TABLE `groupe_notation`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT pour la table `interface_prof_soutenance`
--
ALTER TABLE `interface_prof_soutenance`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT pour la table `note_critere_soutenance`
--
ALTER TABLE `note_critere_soutenance`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT pour la table `planning`
--
ALTER TABLE `planning`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT pour la table `promotion`
--
ALTER TABLE `promotion`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT pour la table `salle`
--
ALTER TABLE `salle`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT pour la table `soutenance`
--
ALTER TABLE `soutenance`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;


ALTER TABLE `etudiant`
  ADD PRIMARY KEY (`id`);
