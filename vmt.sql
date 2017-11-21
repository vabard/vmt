-- phpMyAdmin SQL Dump
-- version 4.7.0
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le :  mar. 21 nov. 2017 à 17:03
-- Version du serveur :  10.1.22-MariaDB
-- Version de PHP :  7.1.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `vmt`
--

-- --------------------------------------------------------

--
-- Structure de la table `avis`
--

CREATE TABLE `avis` (
  `id_avis` int(3) NOT NULL,
  `id_membre` int(3) NOT NULL,
  `id_salle` int(3) NOT NULL,
  `commentaire` text NOT NULL,
  `note` int(2) NOT NULL,
  `date_enregistrement` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `avis`
--

INSERT INTO `avis` (`id_avis`, `id_membre`, `id_salle`, `commentaire`, `note`, `date_enregistrement`) VALUES
(1, 3, 4, 'La salle était vraiment très agréable. TOP !', 5, '2017-10-08 21:00:00'),
(2, 3, 5, 'La salle est un peu sombre et le café n\'était pas top top', 3, '2017-10-20 12:00:00'),
(3, 5, 3, 'Le bureau est parfait, je recommande', 5, '2017-11-10 20:00:00'),
(4, 9, 3, 'Le calme n\'était pas au rdv, dommage pour la concentration', 3, '2017-10-15 15:00:00'),
(5, 7, 2, 'La salle était conforme à l\'annonce', 4, '2017-10-06 19:00:00');

-- --------------------------------------------------------

--
-- Structure de la table `commande`
--

CREATE TABLE `commande` (
  `id_commande` int(3) NOT NULL,
  `id_membre` int(3) NOT NULL,
  `id_produit` int(3) NOT NULL,
  `date_enregistrement` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `membre`
--

CREATE TABLE `membre` (
  `id_membre` int(3) NOT NULL,
  `pseudo` varchar(20) NOT NULL,
  `mdp` varchar(60) NOT NULL,
  `nom` varchar(20) NOT NULL,
  `prenom` varchar(20) NOT NULL,
  `email` varchar(50) NOT NULL,
  `civilite` enum('m','f') NOT NULL,
  `statut` int(1) NOT NULL,
  `date_enregistrement` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `membre`
--

INSERT INTO `membre` (`id_membre`, `pseudo`, `mdp`, `nom`, `prenom`, `email`, `civilite`, `statut`, `date_enregistrement`) VALUES
(1, 'albatros', 'soleil', 'Laborde', 'Jean-Pierre', 'laborde@gmail.com', 'm', 1, '2017-11-07 14:00:00'),
(2, 'goeland', 'lune', 'Gallet', 'Clement', 'gallet@gmail.com', 'm', 1, '2017-10-09 09:00:00'),
(3, 'mouette', 'venus', 'Fellier', 'Elodie', 'fellier@gmail.com', 'f', 1, '2017-09-12 17:00:00'),
(4, 'moineau', 'jupiter', 'Dubar', 'Chloe', 'dubar@gmail.com', 'f', 1, '2017-08-15 15:00:00'),
(5, 'guigui', 'alinea', 'Miller', 'Guillaume', 'miller@gmail.com', 'm', 1, '2017-11-05 10:00:00'),
(6, 'admin', 'admin', 'admin', 'admin', 'admin@gmail.com', 'm', 0, '2017-08-01 16:00:00'),
(7, 'juju', 'jojo', 'Cottet', 'Julie', 'cottet@gmail.com', 'f', 1, '2017-10-17 19:00:00'),
(8, 'mimi', 'momo', 'Sennard', 'Emilie', 'sennard@gmail.com', 'f', 1, '2017-10-15 11:00:00'),
(9, 'titi', 'toto', 'Desprez', 'Thierry', 'desprez@gmail.com', 'm', 1, '2017-10-09 13:00:00'),
(10, 'didine', 'dodone', 'Thoyer', 'Amandine', 'thoyer@gmail.com', 'f', 1, '2017-09-12 12:00:00');

-- --------------------------------------------------------

--
-- Structure de la table `photo`
--

CREATE TABLE `photo` (
  `id_photo` int(3) NOT NULL,
  `id_salle` int(3) NOT NULL,
  `nom` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `produit`
--

CREATE TABLE `produit` (
  `id_produit` int(3) NOT NULL,
  `id_salle` int(3) NOT NULL,
  `date_arrivee` datetime NOT NULL,
  `date_depart` datetime NOT NULL,
  `prix` int(3) NOT NULL,
  `etat` enum('libre','reservation') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `produit`
--

INSERT INTO `produit` (`id_produit`, `id_salle`, `date_arrivee`, `date_depart`, `prix`, `etat`) VALUES
(1, 1, '2017-11-20 08:00:00', '2017-11-24 19:00:00', 1200, 'libre'),
(2, 1, '2017-11-26 08:00:00', '2017-12-01 19:00:00', 990, 'libre'),
(3, 1, '2017-12-04 08:00:00', '2017-11-16 19:00:00', 1000, 'reservation'),
(4, 2, '2017-11-20 08:00:00', '2017-11-24 19:00:00', 1500, 'reservation'),
(5, 2, '2017-11-27 08:00:00', '2017-12-01 19:00:00', 1400, 'libre'),
(6, 2, '2017-12-04 08:00:00', '2017-12-08 19:00:00', 1600, 'libre'),
(7, 3, '2017-11-20 08:00:00', '2017-11-24 19:00:00', 790, 'reservation'),
(8, 3, '2017-11-27 08:00:00', '2017-12-01 19:00:00', 890, 'libre'),
(9, 3, '2017-12-04 08:00:00', '2017-12-08 19:00:00', 880, 'libre'),
(10, 4, '2017-11-20 08:00:00', '2017-11-24 19:00:00', 1200, 'libre'),
(11, 4, '2017-11-26 08:00:00', '2017-12-01 19:00:00', 990, 'libre'),
(12, 4, '2017-12-04 08:00:00', '2017-11-16 19:00:00', 1000, 'reservation'),
(13, 5, '2017-11-20 08:00:00', '2017-11-24 19:00:00', 1500, 'reservation'),
(14, 5, '2017-11-27 08:00:00', '2017-12-01 19:00:00', 1400, 'libre'),
(15, 5, '2017-12-04 08:00:00', '2017-12-08 19:00:00', 1600, 'libre'),
(16, 6, '2017-11-20 08:00:00', '2017-11-24 19:00:00', 790, 'reservation'),
(17, 6, '2017-11-27 08:00:00', '2017-12-01 19:00:00', 890, 'libre'),
(18, 6, '2017-12-04 08:00:00', '2017-12-08 19:00:00', 880, 'libre'),
(19, 7, '2017-11-20 08:00:00', '2017-11-24 19:00:00', 1200, 'libre'),
(20, 7, '2017-11-26 08:00:00', '2017-12-01 19:00:00', 990, 'libre'),
(21, 7, '2017-12-04 08:00:00', '2017-11-16 19:00:00', 1000, 'reservation'),
(22, 8, '2017-11-20 08:00:00', '2017-11-24 19:00:00', 1500, 'reservation'),
(23, 8, '2017-11-27 08:00:00', '2017-12-01 19:00:00', 1400, 'libre'),
(24, 8, '2017-12-04 08:00:00', '2017-12-08 19:00:00', 1600, 'libre'),
(25, 9, '2017-11-20 08:00:00', '2017-11-24 19:00:00', 790, 'reservation'),
(26, 9, '2017-11-27 08:00:00', '2017-12-01 19:00:00', 890, 'libre'),
(27, 9, '2017-12-04 08:00:00', '2017-12-08 19:00:00', 880, 'libre');

-- --------------------------------------------------------

--
-- Structure de la table `salle`
--

CREATE TABLE `salle` (
  `id_salle` int(3) NOT NULL,
  `titre` varchar(200) NOT NULL,
  `description` text NOT NULL,
  `photo` varchar(200) NOT NULL,
  `pays` varchar(20) NOT NULL,
  `ville` varchar(20) NOT NULL,
  `adresse` varchar(50) NOT NULL,
  `cp` int(5) NOT NULL,
  `capacite` int(3) NOT NULL,
  `categorie` enum('reunion','bureau','formation') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `salle`
--

INSERT INTO `salle` (`id_salle`, `titre`, `description`, `photo`, `pays`, `ville`, `adresse`, `cp`, `capacite`, `categorie`) VALUES
(1, 'Cézanne', 'Avec une capacité de 15 personnes, la salle de réunion Cézanne est idéale pour vos rendez-vous d\'affaires. Connexion Wifi, écran LED, paperboard et café ou thé sont mis à votre disposition.', 'cezanne.jpg', 'France', 'Paris', '3 allée des impressionnistes', 75001, 15, 'reunion'),
(2, 'Van Gogh', 'Avec une capacité de 20 personnes, la salle Van Gogh est idéale pour vos sessions de formation. Connexion Wifi, écran LED, paperboard et café ou thé sont mis à votre disposition.', 'van_gogh.jpg', 'France', 'Paris', '30 rue Mademoiselle', 75007, 20, 'formation'),
(3, 'Picasso', 'Avec une capacité de 10 personnes, notre bureau Picasso, clair et spacieux pourra vous permettre de travailler au calme dans un espace atypique au centre de Paris.. Connexion Wifi, écran LED, paperboard et café ou thé sont mis à votre disposition.', 'Picasso.jpg', 'France', 'Paris', '17 rue de Turbigo', 75002, 10, 'bureau'),
(4, 'Mozart', 'Avec une capacité de 15 personnes, la salle de réunion Mozart est idéale pour vos rendez-vous d\'affaires. Connexion Wifi, écran LED, paperboard et café ou thé sont mis à votre disposition.', 'Mozart.jpg', 'France', 'Lyon', '3 allée des impressionnistes', 69001, 15, 'reunion'),
(5, 'Bach', 'Avec une capacité de 20 personnes, la salle Bach est idéale pour vos sessions de formation. Connexion Wifi, écran LED, paperboard et café ou thé sont mis à votre disposition.', 'Bach.jpg', 'France', 'Lyon', '30 rue Mademoiselle', 69007, 20, 'formation'),
(6, 'Satie', 'Avec une capacité de 10 personnes, notre bureau Satie, clair et spacieux pourra vous permettre de travailler au calme dans un espace atypique au centre de Lyon.. Connexion Wifi, écran LED, paperboard et café ou thé sont mis à votre disposition.', 'Satie.jpg', 'France', 'Lyon', '17 rue de Turbigo', 69002, 10, 'bureau'),
(7, 'Rodin', 'Avec une capacité de 15 personnes, la salle de réunion Rodin est idéale pour vos rendez-vous d\'affaires. Connexion Wifi, écran LED, paperboard et café ou thé sont mis à votre disposition.', 'Rodin.jpg', 'France', 'Marseille', '3 allée des impressionnistes', 13001, 15, 'reunion'),
(8, 'Claudel', 'Avec une capacité de 20 personnes, la salle Claudel est idéale pour vos sessions de formation. Connexion Wifi, écran LED, paperboard et café ou thé sont mis à votre disposition.', 'Claudel.jpg', 'France', 'Marseille', '30 rue Mademoiselle', 13007, 20, 'formation'),
(9, 'Maillol', 'Avec une capacité de 10 personnes, notre bureau Maillol, clair et spacieux pourra vous permettre de travailler au calme dans un espace atypique au centre de Lyon.. Connexion Wifi, écran LED, paperboard et café ou thé sont mis à votre disposition.', 'Maillo.jpg', 'France', 'Marseille', '17 rue de Turbigo', 13002, 10, 'bureau');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `avis`
--
ALTER TABLE `avis`
  ADD PRIMARY KEY (`id_avis`);

--
-- Index pour la table `commande`
--
ALTER TABLE `commande`
  ADD PRIMARY KEY (`id_commande`);

--
-- Index pour la table `membre`
--
ALTER TABLE `membre`
  ADD PRIMARY KEY (`id_membre`);

--
-- Index pour la table `photo`
--
ALTER TABLE `photo`
  ADD PRIMARY KEY (`id_photo`);

--
-- Index pour la table `produit`
--
ALTER TABLE `produit`
  ADD PRIMARY KEY (`id_produit`);

--
-- Index pour la table `salle`
--
ALTER TABLE `salle`
  ADD PRIMARY KEY (`id_salle`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `avis`
--
ALTER TABLE `avis`
  MODIFY `id_avis` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT pour la table `commande`
--
ALTER TABLE `commande`
  MODIFY `id_commande` int(3) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT pour la table `membre`
--
ALTER TABLE `membre`
  MODIFY `id_membre` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
--
-- AUTO_INCREMENT pour la table `photo`
--
ALTER TABLE `photo`
  MODIFY `id_photo` int(3) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT pour la table `produit`
--
ALTER TABLE `produit`
  MODIFY `id_produit` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;
--
-- AUTO_INCREMENT pour la table `salle`
--
ALTER TABLE `salle`
  MODIFY `id_salle` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
