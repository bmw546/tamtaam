-- phpMyAdmin SQL Dump
-- version 4.8.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 29, 2018 at 11:26 PM
-- Server version: 10.1.31-MariaDB
-- PHP Version: 7.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `tamtaam`
--

-- --------------------------------------------------------

--
-- Table structure for table `client`
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
-- Dumping data for table `client`
--

INSERT INTO `client` (`id_client`, `nom_utilisateur`, `mot_de_passe`, `adresse_email`, `adresse`, `telephone`) VALUES

-- --------------------------------------------------------

--
-- Table structure for table `commande`
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

--
-- Dumping data for table `commande`
--

INSERT INTO `commande` (`id_commande`, `id_client`, `id_etat`, `id_type_commande`, `date`, `montant`, `nom`) VALUES
(10, 1, 1, 1, '2018-04-26', 0, 'Test'),

-- --------------------------------------------------------

--
-- Table structure for table `etat_commande`
--

CREATE TABLE `etat_commande` (
  `id_etat` int(11) NOT NULL,
  `nom_etat` varchar(16) NOT NULL,
  `description_etat` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `etat_commande`
--

INSERT INTO `etat_commande` (`id_etat`, `nom_etat`, `description_etat`) VALUES
(1, 'attente_paiement', 'Le client doit payer sa commande.'),
(2, 'paiement_fait', 'Le paiement a été effectué.');

-- --------------------------------------------------------

--
-- Table structure for table `evenement`
--

CREATE TABLE `evenement` (
  `id_evenement` int(11) NOT NULL,
  `nom_evenement` varchar(32) NOT NULL,
  `date_debut` date NOT NULL,
  `date_fin` date NOT NULL,
  `description` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `livraison`
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

--
-- Dumping data for table `livraison`
--

INSERT INTO `livraison` (`id_livraison`, `id_commande`, `adresse`, `adresse_latitude`, `adresse_longitude`, `date_livraison_prevue`, `date_livraison_reel`) VALUES


-- --------------------------------------------------------

--
-- Table structure for table `produit`
--

CREATE TABLE `produit` (
  `id_produit` int(11) NOT NULL,
  `nom` varchar(32) NOT NULL,
  `description` text NOT NULL,
  `prix` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `produit`
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
-- Table structure for table `rabais`
--

CREATE TABLE `rabais` (
  `code_rabais` varchar(8) NOT NULL,
  `montant` float NOT NULL,
  `type` int(11) NOT NULL,
  `description` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `recette`
--

CREATE TABLE `recette` (
  `id_recette` int(11) NOT NULL,
  `nom` varchar(64) NOT NULL,
  `description` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `ta_produit_commande`
--

CREATE TABLE `ta_produit_commande` (
  `id_produit` int(11) NOT NULL,
  `id_commande` int(11) NOT NULL,
  `nb_produit` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `ta_produit_commande`
--

INSERT INTO `ta_produit_commande` (`id_produit`, `id_commande`, `nb_produit`) VALUES


-- --------------------------------------------------------

--
-- Table structure for table `ta_produit_recette`
--

CREATE TABLE `ta_produit_recette` (
  `id_recette` int(11) NOT NULL,
  `id_produit` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `ta_rabais_produit`
--

CREATE TABLE `ta_rabais_produit` (
  `id_produit` int(11) NOT NULL,
  `code_rabais` varchar(8) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `type_commande`
--

CREATE TABLE `type_commande` (
  `id_type_commande` int(11) NOT NULL,
  `description_type_commande` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `type_commande`
--

INSERT INTO `type_commande` (`id_type_commande`, `description_type_commande`) VALUES
(1, 'Livraison');

-- --------------------------------------------------------

--
-- Table structure for table `type_rabais`
--

CREATE TABLE `type_rabais` (
  `id_rabais` int(11) NOT NULL,
  `nom` varchar(32) NOT NULL,
  `description` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `client`
--
ALTER TABLE `client`
  ADD PRIMARY KEY (`id_client`);

--
-- Indexes for table `commande`
--
ALTER TABLE `commande`
  ADD PRIMARY KEY (`id_commande`),
  ADD KEY `client` (`id_client`),
  ADD KEY `etat` (`id_etat`),
  ADD KEY `type_commande` (`id_type_commande`);

--
-- Indexes for table `etat_commande`
--
ALTER TABLE `etat_commande`
  ADD PRIMARY KEY (`id_etat`);

--
-- Indexes for table `evenement`
--
ALTER TABLE `evenement`
  ADD PRIMARY KEY (`id_evenement`);

--
-- Indexes for table `livraison`
--
ALTER TABLE `livraison`
  ADD PRIMARY KEY (`id_livraison`),
  ADD KEY `_commande` (`id_commande`);

--
-- Indexes for table `produit`
--
ALTER TABLE `produit`
  ADD PRIMARY KEY (`id_produit`);

--
-- Indexes for table `rabais`
--
ALTER TABLE `rabais`
  ADD PRIMARY KEY (`code_rabais`),
  ADD KEY `rabais_type_FK` (`type`);

--
-- Indexes for table `recette`
--
ALTER TABLE `recette`
  ADD PRIMARY KEY (`id_recette`);

--
-- Indexes for table `ta_produit_commande`
--
ALTER TABLE `ta_produit_commande`
  ADD PRIMARY KEY (`id_produit`,`id_commande`),
  ADD KEY `commande` (`id_commande`);

--
-- Indexes for table `ta_produit_recette`
--
ALTER TABLE `ta_produit_recette`
  ADD PRIMARY KEY (`id_recette`,`id_produit`),
  ADD KEY `_produit` (`id_produit`);

--
-- Indexes for table `ta_rabais_produit`
--
ALTER TABLE `ta_rabais_produit`
  ADD PRIMARY KEY (`id_produit`,`code_rabais`),
  ADD KEY `rabais` (`code_rabais`);

--
-- Indexes for table `type_commande`
--
ALTER TABLE `type_commande`
  ADD PRIMARY KEY (`id_type_commande`);

--
-- Indexes for table `type_rabais`
--
ALTER TABLE `type_rabais`
  ADD PRIMARY KEY (`id_rabais`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `client`
--
ALTER TABLE `client`
  MODIFY `id_client` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `commande`
--
ALTER TABLE `commande`
  MODIFY `id_commande` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=75;

--
-- AUTO_INCREMENT for table `etat_commande`
--
ALTER TABLE `etat_commande`
  MODIFY `id_etat` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `evenement`
--
ALTER TABLE `evenement`
  MODIFY `id_evenement` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `livraison`
--
ALTER TABLE `livraison`
  MODIFY `id_livraison` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=73;

--
-- AUTO_INCREMENT for table `produit`
--
ALTER TABLE `produit`
  MODIFY `id_produit` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `recette`
--
ALTER TABLE `recette`
  MODIFY `id_recette` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `type_rabais`
--
ALTER TABLE `type_rabais`
  MODIFY `id_rabais` int(11) NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `commande`
--
ALTER TABLE `commande`
  ADD CONSTRAINT `client` FOREIGN KEY (`id_client`) REFERENCES `client` (`id_client`),
  ADD CONSTRAINT `etat` FOREIGN KEY (`id_etat`) REFERENCES `etat_commande` (`id_etat`),
  ADD CONSTRAINT `type_commande` FOREIGN KEY (`id_type_commande`) REFERENCES `type_commande` (`id_type_commande`);

--
-- Constraints for table `livraison`
--
ALTER TABLE `livraison`
  ADD CONSTRAINT `_commande` FOREIGN KEY (`id_commande`) REFERENCES `commande` (`id_commande`);

--
-- Constraints for table `rabais`
--
ALTER TABLE `rabais`
  ADD CONSTRAINT `rabais_type_FK` FOREIGN KEY (`type`) REFERENCES `type_rabais` (`id_rabais`);

--
-- Constraints for table `ta_produit_commande`
--
ALTER TABLE `ta_produit_commande`
  ADD CONSTRAINT `_produit_` FOREIGN KEY (`id_produit`) REFERENCES `produit` (`id_produit`),
  ADD CONSTRAINT `commande` FOREIGN KEY (`id_commande`) REFERENCES `commande` (`id_commande`);

--
-- Constraints for table `ta_produit_recette`
--
ALTER TABLE `ta_produit_recette`
  ADD CONSTRAINT `_produit` FOREIGN KEY (`id_produit`) REFERENCES `produit` (`id_produit`),
  ADD CONSTRAINT `recette` FOREIGN KEY (`id_recette`) REFERENCES `recette` (`id_recette`);

--
-- Constraints for table `ta_rabais_produit`
--
ALTER TABLE `ta_rabais_produit`
  ADD CONSTRAINT `produit` FOREIGN KEY (`id_produit`) REFERENCES `produit` (`id_produit`),
  ADD CONSTRAINT `rabais` FOREIGN KEY (`code_rabais`) REFERENCES `rabais` (`code_rabais`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
