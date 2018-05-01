-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le :  mar. 01 mai 2018 à 12:31
-- Version du serveur :  10.1.30-MariaDB
-- Version de PHP :  7.2.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `tamtaam`
--

-- --------------------------------------------------------

--
-- Structure de la table `client`
--

CREATE TABLE `client` (
  `id_client` int(11) NOT NULL,
  `nom_utilisateur` varchar(32) NOT NULL,
  `mot_de_passe` varchar(32) NOT NULL,
  `adresse_email` varchar(64) NOT NULL,
  `adresse` varchar(64) NOT NULL,
  `telephone` bigint(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `client`
--

INSERT INTO `client` (`id_client`, `nom_utilisateur`, `mot_de_passe`, `adresse_email`, `adresse`, `telephone`) VALUES
(1, 'Bob', '123', '123', '123', 123),
(2, 'Idremi', '=user123', 'remi.let123@gmail.com', '597 rue king', 8193425058);

-- --------------------------------------------------------

--
-- Structure de la table `commande`
--

CREATE TABLE `commande` (
  `id_commande` int(11) NOT NULL,
  `id_client` int(11) NOT NULL,
  `id_etat` int(11) NOT NULL,
  `id_type_commande` int(11) NOT NULL,
  `date` date NOT NULL,
  `montant` float NOT NULL,
  `nom` varchar(32) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `etat_commande`
--

CREATE TABLE `etat_commande` (
  `id_etat` int(11) NOT NULL,
  `nom_etat` varchar(16) NOT NULL,
  `description_etat` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `etat_commande`
--

INSERT INTO `etat_commande` (`id_etat`, `nom_etat`, `description_etat`) VALUES
(1, 'attente_paiement', 'Le client doit payer sa commande.'),
(2, 'paiement_fait', 'Le paiement a été effectué.');

-- --------------------------------------------------------

--
-- Structure de la table `evenement`
--

CREATE TABLE `evenement` (
  `id_evenement` int(11) NOT NULL,
  `nom_evenement` varchar(32) NOT NULL,
  `date_debut` date NOT NULL,
  `date_fin` date NOT NULL,
  `description` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `livraison`
--

CREATE TABLE `livraison` (
  `id_livraison` int(11) NOT NULL,
  `id_commande` int(11) NOT NULL,
  `adresse` varchar(64) DEFAULT NULL,
  `adresse_latitude` float DEFAULT NULL,
  `adresse_longitude` float DEFAULT NULL,
  `date_livraison_prevue` date DEFAULT NULL,
  `date_livraison_reel` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `notification`
--

CREATE TABLE `notification` (
  `id_notification` int(11) NOT NULL,
  `courriel` varchar(100) NOT NULL,
  `telephone` bigint(20) NOT NULL,
  `sms` tinytext NOT NULL,
  `notification` tinytext NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `notification`
--

INSERT INTO `notification` (`id_notification`, `courriel`, `telephone`, `sms`, `notification`) VALUES
(2, 'remi.let123@gmail.com', 8193425058, 'oui', 'non');

-- --------------------------------------------------------

--
-- Structure de la table `produit`
--

CREATE TABLE `produit` (
  `id_produit` int(11) NOT NULL,
  `nom` varchar(32) NOT NULL,
  `description` text NOT NULL,
  `prix` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `produit`
--

INSERT INTO `produit` (`id_produit`, `nom`, `description`, `prix`) VALUES
(1, 'Hibiscus', '230ML', 3.25),
(2, 'Hibiscus', '500ML', 7),
(3, 'Hibiscus', '1L', 12),
(4, 'Hibiscus', '2L', 22),
(5, 'Gingembre', '230ML', 3.25),
(6, 'Gingembre', '500ML', 7),
(7, 'Gingembre', '1L', 12),
(8, 'Gingembre', '2L', 22);

-- --------------------------------------------------------

--
-- Structure de la table `rabais`
--

CREATE TABLE `rabais` (
  `code_rabais` varchar(8) NOT NULL,
  `montant` float NOT NULL,
  `type` int(11) NOT NULL,
  `description` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `recette`
--

CREATE TABLE `recette` (
  `id_recette` int(11) NOT NULL,
  `nom` varchar(64) NOT NULL,
  `description` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `ta_produit_commande`
--

CREATE TABLE `ta_produit_commande` (
  `id_produit` int(11) NOT NULL,
  `id_commande` int(11) NOT NULL,
  `nb_produit` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `ta_produit_recette`
--

CREATE TABLE `ta_produit_recette` (
  `id_recette` int(11) NOT NULL,
  `id_produit` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `ta_rabais_produit`
--

CREATE TABLE `ta_rabais_produit` (
  `id_produit` int(11) NOT NULL,
  `code_rabais` varchar(8) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `type_commande`
--

CREATE TABLE `type_commande` (
  `id_type_commande` int(11) NOT NULL,
  `description_type_commande` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `type_commande`
--

INSERT INTO `type_commande` (`id_type_commande`, `description_type_commande`) VALUES
(1, 'Livraison');

-- --------------------------------------------------------

--
-- Structure de la table `type_rabais`
--

CREATE TABLE `type_rabais` (
  `id_rabais` int(11) NOT NULL,
  `nom` varchar(32) NOT NULL,
  `description` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `client`
--
ALTER TABLE `client`
  ADD PRIMARY KEY (`id_client`);

--
-- Index pour la table `commande`
--
ALTER TABLE `commande`
  ADD PRIMARY KEY (`id_commande`),
  ADD KEY `client` (`id_client`),
  ADD KEY `etat` (`id_etat`),
  ADD KEY `type_commande` (`id_type_commande`);

--
-- Index pour la table `etat_commande`
--
ALTER TABLE `etat_commande`
  ADD PRIMARY KEY (`id_etat`);

--
-- Index pour la table `evenement`
--
ALTER TABLE `evenement`
  ADD PRIMARY KEY (`id_evenement`);

--
-- Index pour la table `livraison`
--
ALTER TABLE `livraison`
  ADD PRIMARY KEY (`id_livraison`),
  ADD KEY `_commande` (`id_commande`);

--
-- Index pour la table `notification`
--
ALTER TABLE `notification`
  ADD PRIMARY KEY (`id_notification`);

--
-- Index pour la table `produit`
--
ALTER TABLE `produit`
  ADD PRIMARY KEY (`id_produit`);

--
-- Index pour la table `rabais`
--
ALTER TABLE `rabais`
  ADD PRIMARY KEY (`code_rabais`),
  ADD KEY `rabais_type_FK` (`type`);

--
-- Index pour la table `recette`
--
ALTER TABLE `recette`
  ADD PRIMARY KEY (`id_recette`);

--
-- Index pour la table `ta_produit_commande`
--
ALTER TABLE `ta_produit_commande`
  ADD PRIMARY KEY (`id_produit`,`id_commande`),
  ADD KEY `commande` (`id_commande`);

--
-- Index pour la table `ta_produit_recette`
--
ALTER TABLE `ta_produit_recette`
  ADD PRIMARY KEY (`id_recette`,`id_produit`),
  ADD KEY `_produit` (`id_produit`);

--
-- Index pour la table `ta_rabais_produit`
--
ALTER TABLE `ta_rabais_produit`
  ADD PRIMARY KEY (`id_produit`,`code_rabais`),
  ADD KEY `rabais` (`code_rabais`);

--
-- Index pour la table `type_commande`
--
ALTER TABLE `type_commande`
  ADD PRIMARY KEY (`id_type_commande`);

--
-- Index pour la table `type_rabais`
--
ALTER TABLE `type_rabais`
  ADD PRIMARY KEY (`id_rabais`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `client`
--
ALTER TABLE `client`
  MODIFY `id_client` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT pour la table `commande`
--
ALTER TABLE `commande`
  MODIFY `id_commande` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `etat_commande`
--
ALTER TABLE `etat_commande`
  MODIFY `id_etat` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT pour la table `evenement`
--
ALTER TABLE `evenement`
  MODIFY `id_evenement` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `livraison`
--
ALTER TABLE `livraison`
  MODIFY `id_livraison` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `notification`
--
ALTER TABLE `notification`
  MODIFY `id_notification` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT pour la table `produit`
--
ALTER TABLE `produit`
  MODIFY `id_produit` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT pour la table `recette`
--
ALTER TABLE `recette`
  MODIFY `id_recette` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `type_rabais`
--
ALTER TABLE `type_rabais`
  MODIFY `id_rabais` int(11) NOT NULL AUTO_INCREMENT;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `commande`
--
ALTER TABLE `commande`
  ADD CONSTRAINT `client` FOREIGN KEY (`id_client`) REFERENCES `client` (`id_client`),
  ADD CONSTRAINT `etat` FOREIGN KEY (`id_etat`) REFERENCES `etat_commande` (`id_etat`),
  ADD CONSTRAINT `type_commande` FOREIGN KEY (`id_type_commande`) REFERENCES `type_commande` (`id_type_commande`);

--
-- Contraintes pour la table `livraison`
--
ALTER TABLE `livraison`
  ADD CONSTRAINT `_commande` FOREIGN KEY (`id_commande`) REFERENCES `commande` (`id_commande`);

--
-- Contraintes pour la table `rabais`
--
ALTER TABLE `rabais`
  ADD CONSTRAINT `rabais_type_FK` FOREIGN KEY (`type`) REFERENCES `type_rabais` (`id_rabais`);

--
-- Contraintes pour la table `ta_produit_commande`
--
ALTER TABLE `ta_produit_commande`
  ADD CONSTRAINT `_produit_` FOREIGN KEY (`id_produit`) REFERENCES `produit` (`id_produit`),
  ADD CONSTRAINT `commande` FOREIGN KEY (`id_commande`) REFERENCES `commande` (`id_commande`);

--
-- Contraintes pour la table `ta_produit_recette`
--
ALTER TABLE `ta_produit_recette`
  ADD CONSTRAINT `_produit` FOREIGN KEY (`id_produit`) REFERENCES `produit` (`id_produit`),
  ADD CONSTRAINT `recette` FOREIGN KEY (`id_recette`) REFERENCES `recette` (`id_recette`);

--
-- Contraintes pour la table `ta_rabais_produit`
--
ALTER TABLE `ta_rabais_produit`
  ADD CONSTRAINT `produit` FOREIGN KEY (`id_produit`) REFERENCES `produit` (`id_produit`),
  ADD CONSTRAINT `rabais` FOREIGN KEY (`code_rabais`) REFERENCES `rabais` (`code_rabais`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
