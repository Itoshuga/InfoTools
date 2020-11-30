-- phpMyAdmin SQL Dump
-- version 4.5.4.1
-- http://www.phpmyadmin.net
--
-- Client :  localhost
-- Généré le :  Lun 30 Novembre 2020 à 13:17
-- Version du serveur :  5.7.11
-- Version de PHP :  7.0.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `infotools`
--

-- --------------------------------------------------------

--
-- Structure de la table `categorie`
--

CREATE TABLE `categorie` (
  `NumCat` varchar(11) NOT NULL,
  `LibCat` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Contenu de la table `categorie`
--

INSERT INTO `categorie` (`NumCat`, `LibCat`) VALUES
('LOG', 'Logiciel'),
('PCB', 'Ordinateur de bureau'),
('PCP', 'Ordinateur portable');

-- --------------------------------------------------------

--
-- Structure de la table `contact`
--

CREATE TABLE `contact` (
  `IdCont` int(11) NOT NULL,
  `NomCont` varchar(100) NOT NULL,
  `PrenomCont` varchar(100) NOT NULL,
  `MailCont` varchar(200) NOT NULL,
  `Objet` varchar(200) NOT NULL,
  `Message` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Contenu de la table `contact`
--

INSERT INTO `contact` (`IdCont`, `NomCont`, `PrenomCont`, `MailCont`, `Objet`, `Message`) VALUES
(1, 'Antoine ', 'Picard', 'antoine@gmail.com', 'dfsdf', 'sdfsdfsdhjkfgsjkdhgfkjshdcjkhsdjchsdhchsdchjksdchsdkchsdfsdfsdhjkfgsjkdhgfkjshdcjkhsdjchsdhchsdchjksdchsdkchsdfsdfsdhjkfgsjkdhgfkjshdcjkhsdjchsdhchsdchjksdchsdkchsdfsdfsdhjkfgsjkdhgfkjshdcjkhsdjchsdhchsdchjksdchsdkchsdfsdfsdhjkfgsjkdhgfkjshdcjkhsdjchsdhchsdchjksdchsdkchsdfsdfsdhjkfgsjkdhgfkjshdcjkhsdjchsdhchsdchjksdchsdkchsdfsdfsdhjkfgsjkdhgfkjshdcjkhsdjchsdhchsdchjksdchsdkchsdfsdfsdhjkfgsjkdhgfkjshdcjkhsdjchsdhchsdchjksdchsdkch'),
(3, 'TEST', 'Test', 'test@gmail.com', 'test', 'texte textetexte textetexte textetexte textetexte textetexte textetexte textetexte textetexte textetexte textetexte textetexte textetexte textetexte textetexte texte'),
(4, 'jean ', 'Piere', 'pierejean@gmail.com', 'test de mail ', 'ceci est un test de lmailm , vois la c est tout'),
(5, 'dscsdc', 'sdcsdc', 'sdcsdc@gmail.com', 'sdcsdc', 'sdcsdcsdc'),
(6, 'trest', 'etst', 'test1@gmail.com', 'test', 'test'),
(7, '', '', '', '', '');

-- --------------------------------------------------------

--
-- Structure de la table `facturation`
--

CREATE TABLE `facturation` (
  `IdFact` int(11) NOT NULL,
  `IdProd` int(11) NOT NULL,
  `IdUti` int(11) NOT NULL,
  `Quantite` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Contenu de la table `facturation`
--

INSERT INTO `facturation` (`IdFact`, `IdProd`, `IdUti`, `Quantite`) VALUES
(1, 1, 3, 1),
(2, 7, 2, 1),
(5, 9, 1, 3),
(6, 6, 1, 2),
(7, 7, 1, 1);

-- --------------------------------------------------------

--
-- Structure de la table `produit`
--

CREATE TABLE `produit` (
  `IdProd` int(11) NOT NULL,
  `NumCat` varchar(11) NOT NULL,
  `NomProd` varchar(50) NOT NULL,
  `DescProd` varchar(500) NOT NULL,
  `PrixProd` varchar(10) NOT NULL,
  `Imgsrc` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Contenu de la table `produit`
--

INSERT INTO `produit` (`IdProd`, `NumCat`, `NomProd`, `DescProd`, `PrixProd`, `Imgsrc`) VALUES
(1, 'LOG', 'GowerFile', 'Ce logiciel permet d\'Ã©crire et de sauvegarder toutes les donnÃ©es de votre entreprise sur plusieurs serveurs simultanÃ©ment afin de toujours avoir une sauvegarde de vos donnÃ©es.', '150', 'GowerFile.png'),
(2, 'LOG', 'InopoStudio', 'Ce logiciel contient tous les outils nÃ©cessaires pour produire et enregistrer de la musique sur son ordinateur.', '170', 'InopoStudio.png'),
(3, 'LOG', 'StoryCut & Edit', 'Ce logiciel permet le montage et l\'editing de vos photos et vidÃ©os afin de crÃ©er vos nouvelles oeuvres et de ressortir votre c&ocirc;tÃ© artistique. ', '120', 'StoryCut.png'),
(4, 'LOG', 'FortunOffice', 'Ce logiciel est le couteau Suisse des traitements de texte, de prÃ©sentation, de tableur ainsi qu\'une multitude de possibilitÃ©s supplÃ©mentaires.', '130', 'FortunOffice.png'),
(5, 'PCB', 'PC Bureau KIO-58439', 'Cet Ordinateur de bureau vous apportera joie et bonheur dans votre vie de tout les jours. GrÃ¢ce &agrave sa palette de couleur RGB, se pc illuminera vos soirÃ©e dans le noir. sans vos amis.', '800', 'TourDeBureau.png'),
(6, 'PCP', 'Ordinateur Portable ROI-84522', 'Un ordinateur portable autant utile dans votre vie professionnelle que votre vie privÃ©e. Avec son faible poids, il est transportable partout et ces composants de tr&egrave;s bonne qualitÃ© en ferra un tr&egrave;s bon compagnon informatique.', '550', 'OrdinateurPortableROI.png'),
(7, 'PCP', 'Ordinateur Portable GAP-58232', 'GAP-58232 est un ordinateur portable indispensable dans votre vie professionnelle, sa puissance vous permettra de travailler sur les plus gros logiciels existants du le marchÃ©.', '750', 'OrdinateurPortableGAP.png'),
(8, 'LOG', 'StudyCode', 'Ce logiciel permet d\'apprendre les bases de la programmation afin de devenir un vrai dÃ©veloppeur !', '60', 'StudyCode.png'),
(9, 'LOG', 'SportDay', 'Ce logiciel permet de surveiller sa santÃ©, son alimentation ainsi que son activitÃ© physique tous les jours.', '30', 'SportDay.png'),
(10, 'LOG', 'EcoMoney', 'Ce logiciel permet de gÃ©rer vos dÃ©penses financi&egrave;res personnelles ou professionnelles, ce qui permet de ne pas ne pas &ecirc;tre &agrave; dÃ©couvert &agrave; la fin du mois.', '40', 'EcoMoney.png'),
(11, 'PCB', 'PC Bureau NOK-7452', 'Cet ordinateur est le plus standard dans sa catÃ©gorie. Il est idÃ©al pour du travail ou de l\'administratif.', '400', 'OrdinateurBureauNOK.png'),
(12, 'PCB', 'PC Bureau ZAP-6996F', 'Cet ordinateur de bureau associe rapiditÃ© d\'exÃ©cution et puissance informatique. C\'est un bon PC tout confort pour le travail et la vie quotidienne.', '600', 'OrdinateurBureauZAP.png'),
(13, 'PCP', 'Ordinateur Portable WEX-55615', 'simple, fin, ergonomique tout ce qu\'il faut d\'un bon ordinateur portable.', '550', 'OrdinateurPortableWEX.png'),
(14, 'PCP', 'Ordinateur Portable ASU-94384', 'La puissance incarnÃ© des Ordinateurs Portable dernier cris !', '790', 'OrdinateurPortableASU.png'),
(15, 'PCP', 'Ordinateur Portable TOG-48216', 'Utile dans vos prochains voyages a l\'Ã©tranger avec sa certification IP54, les Ã©claboussures d\'eau n\'auront plus de problÃ¨mes avec vous !', '860', 'OrdinateurPortableTOG.png'),
(16, 'PCP', 'Ordinateur Portable HEP-26287', 'Pratique dans la vie de tous les jours, Bonne autonomie, puissance ...', '530', 'OrdinateurPortableHEP.png'),
(17, 'PCB', 'PC Bureau LEV-20213', 'LEV-20213 est un ordinateur de Bureau. Il est assez utile au quotidien grÃ¢ce &agrave ses diffÃ©rents composants tel que sa carte graphique de Haute Performances, il est plus performant que jamais pour les tÃ¢ches du quotidiens.', '760', 'OrdinateurBureauLEV.png'),
(18, 'PCB', 'PC Bureau DEL-45761', 'Performant, Pratique, Utile, Efficace, AdaptÃ©, AdÃ©quat, AppropriÃ©, Apte, Bon, Conforme, Congru. Cet Ordinateur de Bureau est fait pour vous!', '940', 'OrdinateurBureauDEL.png'),
(19, 'PCB', 'PC Bureau ACE-84865', 'Voici l\'un des meilleurs PC de Bureau entre puissance et son rapport QualitÃ©/Prix, le ACE-84865 rÃ©pondra &agrave; toutes vos demandes.', '830', 'OrdinateurBureauACE.png');

-- --------------------------------------------------------

--
-- Structure de la table `prospects`
--

CREATE TABLE `prospects` (
  `IdProsp` int(11) NOT NULL,
  `DteProsp` date NOT NULL,
  `IdProd` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `rdv`
--

CREATE TABLE `rdv` (
  `IdRDV` int(11) NOT NULL,
  `Nom` varchar(50) NOT NULL,
  `Prenom` varchar(50) NOT NULL,
  `Mail` varchar(100) NOT NULL,
  `Tel` varchar(15) NOT NULL,
  `Contenu` varchar(500) NOT NULL,
  `DteRDV` date NOT NULL,
  `HeureRDV` time NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Contenu de la table `rdv`
--

INSERT INTO `rdv` (`IdRDV`, `Nom`, `Prenom`, `Mail`, `Tel`, `Contenu`, `DteRDV`, `HeureRDV`) VALUES
(44, 'sss', 'sss', 'lightedgx@gmail.com', '0606060606', 'erger', '2020-11-12', '18:51:00'),
(45, 'sss', 'sss', 'lightedgx@gmail.com', '0606060606', 'erger', '2020-11-12', '18:51:00'),
(46, 'sss', 'sss', 'lightedgx@gmail.com', '0606060606', 'erger', '2020-11-12', '18:51:00');

-- --------------------------------------------------------

--
-- Structure de la table `rdv_commercial`
--

CREATE TABLE `rdv_commercial` (
  `IdRDV` int(11) NOT NULL,
  `IdUti` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `role`
--

CREATE TABLE `role` (
  `NumRole` int(50) NOT NULL,
  `LibRole` varchar(50) CHARACTER SET utf8 NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Contenu de la table `role`
--

INSERT INTO `role` (`NumRole`, `LibRole`) VALUES
(0, 'Client'),
(1, 'Commercial'),
(2, 'Administrateur');

-- --------------------------------------------------------

--
-- Structure de la table `utilisateur`
--

CREATE TABLE `utilisateur` (
  `IdUti` int(11) NOT NULL,
  `NumRole` int(11) NOT NULL,
  `Nom` varchar(11) NOT NULL,
  `Prenom` varchar(11) NOT NULL,
  `Mdp` varchar(100) NOT NULL,
  `Mail` varchar(100) NOT NULL,
  `Tel` varchar(11) NOT NULL,
  `Adresse` varchar(300) NOT NULL,
  `CP` char(5) NOT NULL,
  `Ville` varchar(50) NOT NULL,
  `Pseudo` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Contenu de la table `utilisateur`
--

INSERT INTO `utilisateur` (`IdUti`, `NumRole`, `Nom`, `Prenom`, `Mdp`, `Mail`, `Tel`, `Adresse`, `CP`, `Ville`, `Pseudo`) VALUES
(1, 2, 'picard', 'Antoine', '$2y$12$KmFCg0XxD8X0dTRHFqHydujI58006c6mMlng78l6jSgFs/3XCPLGu', 'antoine@gmail.com', '0615457847', '55sdfhsdkhf', '71640', 'mellecey', 'Admin'),
(2, 1, 'Picard', 'Antoine', '$2y$12$cxGYjwmrsNje0H85HqiI7uOqb80p/lenMQl9M6CkhlbO2bg73LlMG', 'azz@gmail.com', '06196454847', '66 route de lyon', '71400', 'Lyon', 'Antoine09'),
(3, 1, 'Remars', 'LÃ©o', '$2y$12$6gjPUvqjABGDNOThLzftkOQ/lfin1kE84rdEDVemHf860tE1xr4Xy', 'remars.leo@gmail.com', '0647462008', '5 Rue Italie', '71300', 'Montceau Les Mines', 'Wanheda'),
(4, 1, 'JeSuis', 'ThÃ¿mÃ¶tÃ©', '$2y$12$QF8kh5c2FY3MiuT5sqs57ONpdi.DaS46elG17UDwa5GKI1AP68zNu', 'aertytg@Contact.fr', '0612345678', 'LycÃ©e Mathias', '71100', 'Chalon', 'GentilBonhomme'),
(5, 0, 'Cule', 'Leo', '$2y$12$PLO/sLPbdJervdYjgPNFUe9IKWZFgl6DEKHKrBOU27n4c8Qcyge9W', 'Jeanculetamair@gmail.com', '0696969696', 'Jemle 69 rue des pd', '69699', 'Trizoland', 'Jean');

--
-- Index pour les tables exportées
--

--
-- Index pour la table `categorie`
--
ALTER TABLE `categorie`
  ADD PRIMARY KEY (`NumCat`);

--
-- Index pour la table `contact`
--
ALTER TABLE `contact`
  ADD PRIMARY KEY (`IdCont`);

--
-- Index pour la table `facturation`
--
ALTER TABLE `facturation`
  ADD PRIMARY KEY (`IdFact`),
  ADD KEY `IdProd` (`IdProd`),
  ADD KEY `IdUti` (`IdUti`);

--
-- Index pour la table `produit`
--
ALTER TABLE `produit`
  ADD PRIMARY KEY (`IdProd`),
  ADD KEY `NumCat` (`NumCat`);

--
-- Index pour la table `prospects`
--
ALTER TABLE `prospects`
  ADD PRIMARY KEY (`IdProsp`),
  ADD KEY `IdProd` (`IdProd`);

--
-- Index pour la table `rdv`
--
ALTER TABLE `rdv`
  ADD PRIMARY KEY (`IdRDV`);

--
-- Index pour la table `rdv_commercial`
--
ALTER TABLE `rdv_commercial`
  ADD PRIMARY KEY (`IdRDV`,`IdUti`),
  ADD KEY `IdUti` (`IdUti`);

--
-- Index pour la table `role`
--
ALTER TABLE `role`
  ADD PRIMARY KEY (`NumRole`);

--
-- Index pour la table `utilisateur`
--
ALTER TABLE `utilisateur`
  ADD PRIMARY KEY (`IdUti`),
  ADD KEY `NumRole` (`NumRole`);

--
-- AUTO_INCREMENT pour les tables exportées
--

--
-- AUTO_INCREMENT pour la table `contact`
--
ALTER TABLE `contact`
  MODIFY `IdCont` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT pour la table `facturation`
--
ALTER TABLE `facturation`
  MODIFY `IdFact` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT pour la table `produit`
--
ALTER TABLE `produit`
  MODIFY `IdProd` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;
--
-- AUTO_INCREMENT pour la table `prospects`
--
ALTER TABLE `prospects`
  MODIFY `IdProsp` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT pour la table `rdv`
--
ALTER TABLE `rdv`
  MODIFY `IdRDV` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=47;
--
-- AUTO_INCREMENT pour la table `rdv_commercial`
--
ALTER TABLE `rdv_commercial`
  MODIFY `IdRDV` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT pour la table `utilisateur`
--
ALTER TABLE `utilisateur`
  MODIFY `IdUti` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- Contraintes pour les tables exportées
--

--
-- Contraintes pour la table `facturation`
--
ALTER TABLE `facturation`
  ADD CONSTRAINT `facturation_ibfk_1` FOREIGN KEY (`IdUti`) REFERENCES `utilisateur` (`IdUti`);

--
-- Contraintes pour la table `produit`
--
ALTER TABLE `produit`
  ADD CONSTRAINT `produit_ibfk_1` FOREIGN KEY (`NumCat`) REFERENCES `categorie` (`NumCat`);

--
-- Contraintes pour la table `rdv_commercial`
--
ALTER TABLE `rdv_commercial`
  ADD CONSTRAINT `rdv_commercial_ibfk_1` FOREIGN KEY (`IdRDV`) REFERENCES `rdv` (`IdRDV`),
  ADD CONSTRAINT `rdv_commercial_ibfk_2` FOREIGN KEY (`IdUti`) REFERENCES `utilisateur` (`IdUti`);

--
-- Contraintes pour la table `utilisateur`
--
ALTER TABLE `utilisateur`
  ADD CONSTRAINT `utilisateur_ibfk_1` FOREIGN KEY (`NumRole`) REFERENCES `role` (`NumRole`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
