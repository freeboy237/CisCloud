-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le : sam. 04 mai 2024 à 15:23
-- Version du serveur : 10.4.25-MariaDB
-- Version de PHP : 8.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `kdrive`
--

-- --------------------------------------------------------

--
-- Structure de la table `acivity_log`
--

CREATE TABLE `acivity_log` (
  `id_act` int(11) NOT NULL,
  `id_users` int(11) NOT NULL,
  `action` varchar(255) NOT NULL,
  `timestamp` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `acivity_log`
--

INSERT INTO `acivity_log` (`id_act`, `id_users`, `action`, `timestamp`) VALUES
(1713984212, 1710930700, 'Logged in sucessfully', 1713984212),
(1713984214, 1710930700, 'Logged in sucessfully', 1713984214),
(1713984276, 1710930700, 'Logged out sucessfully', 1713984276),
(0, 0, 'Logged in sucessfully', 0),
(1713984335, 1710930700, 'Logged out sucessfully', 1713984335),
(1713984338, 0, 'Logged in sucessfully', 1713984338),
(1713984344, 1710930700, 'Logged out sucessfully', 1713984344),
(1713984347, 0, 'Logged in sucessfully', 1713984347),
(1713984383, 1710930700, 'Logged out sucessfully', 1713984383),
(1713984385, 1710930700, 'Logged in sucessfully', 1713984385),
(1714034164, 1710930700, 'Logged in sucessfully', 1714034164),
(1714034186, 1710930700, 'Logged out sucessfully', 1714034186),
(1714034191, 1711032973, 'Logged in sucessfully', 1714034191),
(1714034233, 1711032973, 'Logged out sucessfully', 1714034233),
(1714034238, 1710930700, 'Logged in sucessfully', 1714034238),
(1714069582, 1710930700, 'Logged in sucessfully', 1714069582),
(1714073147, 1710930700, 'Logged out sucessfully', 1714073147),
(1714073221, 1714073202, 'Logged in sucessfully', 1714073221),
(1714074791, 1714073202, 'Logged out sucessfully', 1714074791),
(1714074795, 1710930700, 'Logged in sucessfully', 1714074795),
(1714080017, 1710930700, 'Logged out sucessfully', 1714080017),
(1714080171, 1710930700, 'Logged in sucessfully', 1714080171),
(1714080325, 1710930700, 'Logged out sucessfully', 1714080325),
(1714080327, 1710930700, 'Logged in sucessfully', 1714080327),
(1714080333, 1710930700, 'Logged out sucessfully', 1714080333),
(1714080335, 1710930700, 'Logged in sucessfully', 1714080335),
(1714080373, 1710930700, 'Logged out sucessfully', 1714080373),
(1714080425, 1710930700, 'Logged in sucessfully', 1714080425),
(1714080439, 1710930700, 'Logged out sucessfully', 1714080439),
(1714080445, 1710930700, 'Logged in sucessfully', 1714080445),
(1714080472, 1710930700, 'Logged out sucessfully', 1714080472),
(1714080473, 1710930700, 'Logged in sucessfully', 1714080473),
(1714084960, 1710930700, 'Logged out sucessfully', 1714084960),
(1714085028, 1711032451, 'Logged in sucessfully', 1714085028),
(1714085137, 1711032451, 'Logged out sucessfully', 1714085137),
(1714085142, 1710930700, 'Logged in sucessfully', 1714085142),
(1714086148, 1710930700, 'Logged out sucessfully', 1714086148),
(1714086149, 1710930700, 'Logged in sucessfully', 1714086149),
(1714086152, 1710930700, 'Logged out sucessfully', 1714086152),
(1714086156, 1711032451, 'Logged in sucessfully', 1714086156),
(1714086257, 1711032451, 'Logged out sucessfully', 1714086257),
(1714086262, 1711032973, 'Logged in sucessfully', 1714086262),
(1714086422, 1711032973, 'Logged out sucessfully', 1714086422),
(1714086424, 1711032451, 'Logged in sucessfully', 1714086424),
(1714086462, 1711032451, 'Logged out sucessfully', 1714086462),
(1714086473, 1710930700, 'Logged in sucessfully', 1714086473),
(1714086507, 1710930700, 'Logged out sucessfully', 1714086507),
(1714086510, 1711032451, 'Logged in sucessfully', 1714086510),
(1714086558, 1711032451, 'Logged out sucessfully', 1714086558),
(1714086562, 1710930700, 'Logged in sucessfully', 1714086562),
(1714086931, 1710930700, 'Logged out sucessfully', 1714086931),
(1714086936, 1711032451, 'Logged in sucessfully', 1714086936),
(1714087043, 1711032451, 'Logged out sucessfully', 1714087043),
(1714087047, 1710930700, 'Logged in sucessfully', 1714087047),
(1714087127, 1710930700, 'Logged out sucessfully', 1714087127),
(1714087132, 1711032451, 'Logged in sucessfully', 1714087132),
(1714088824, 1711032451, 'Logged out sucessfully', 1714088824),
(1714088828, 1710930700, 'Logged in sucessfully', 1714088828),
(1714088847, 1710930700, 'Logged out sucessfully', 1714088847),
(1714088851, 1711032451, 'Logged in sucessfully', 1714088851),
(1714088884, 1711032451, 'Logged out sucessfully', 1714088884),
(1714088889, 1710930700, 'Logged in sucessfully', 1714088889),
(1714089972, 1710930700, 'Logged out sucessfully', 1714089972),
(1714090525, 1714090525, 'logged out successfully', 1714090525),
(1714090607, 1714090607, 'logged out successfully', 1714090607),
(1714090627, 1714090627, 'logged out successfully', 1714090627),
(1714090632, 1714090632, 'logged out successfully', 1714090632),
(1714090766, 1714090766, 'logged out successfully', 1714090766),
(1714090770, 1714090770, 'logged out successfully', 1714090770),
(1714090785, 1714090785, 'logged out successfully', 1714090785),
(1714090799, 1714090799, 'logged out successfully', 1714090799),
(1714090805, 1714090805, 'logged out successfully', 1714090805),
(1714090809, 1714090809, 'logged out successfully', 1714090809),
(1714090850, 1714090850, 'logged out successfully', 1714090850),
(1714090895, 1714090895, 'logged out successfully', 1714090895),
(1714090903, 1714090903, 'logged out successfully', 1714090903),
(1714090983, 1714090983, 'logged out successfully', 1714090983),
(1714091023, 1714091023, 'logged out successfully', 1714091023),
(1714091057, 1714091057, 'logged out successfully', 1714091057),
(1714091115, 1710930700, 'Logged in sucessfully', 1714091115),
(1714091161, 1711032451, 'Logged in sucessfully', 1714091161),
(1714091194, 1710930700, 'Logged out sucessfully', 1714091194),
(1714091195, 1710930700, 'Logged in sucessfully', 1714091195),
(1714091251, 1710930700, 'Logged out sucessfully', 1714091251),
(1714091254, 1710930700, 'Logged in sucessfully', 1714091254),
(1714091351, 1711032451, 'Logged out sucessfully', 1714091351),
(1714091361, 1711032451, 'Logged in sucessfully', 1714091361),
(1714095770, 1711546245, 'Logged in sucessfully', 1714095770),
(1714096174, 1714096174, 'logged out successfully', 1714096174),
(1714096188, 1714096162, 'Logged in sucessfully', 1714096188),
(1714096260, 1714096162, 'Logged out sucessfully', 1714096260),
(1714096294, 1714096162, 'Logged in sucessfully', 1714096294),
(1714096297, 1714096162, 'Logged out sucessfully', 1714096297),
(1714096320, 1714096162, 'Logged in sucessfully', 1714096320),
(1714096875, 1714096162, 'Logged out sucessfully', 1714096875),
(1714097274, 0, 'Logged in sucessfully', 1714097274),
(1714097286, 0, 'Logged out sucessfully', 1714097286),
(1714097320, 1714097320, 'logged out successfully', 1714097320),
(1714097336, 1711546245, 'Logged in sucessfully', 1714097336),
(1714097913, 1711546245, 'Logged out sucessfully', 1714097913),
(1714097920, 1714097920, 'logged out successfully', 1714097920),
(1714097932, 1714096162, 'Logged in sucessfully', 1714097932),
(1714116692, 1714116692, 'logged out successfully', 1714116692),
(1714116707, 1714116707, 'logged out successfully', 1714116707),
(1714116773, 1711032451, 'Logged in sucessfully', 1714116773),
(1714117002, 1714117002, 'logged out successfully', 1714117002),
(1714117010, 1711032973, 'Logged in sucessfully', 1714117010),
(1714117340, 1711032451, 'Logged out sucessfully', 1714117340),
(1714117366, 1710930700, 'Logged in sucessfully', 1714117366),
(1714117560, 1711546245, 'Logged in sucessfully', 1714117560),
(1714140941, 1710930700, 'Logged out sucessfully', 1714140941),
(1714141232, 1714141232, 'logged out successfully', 1714141232),
(1714141239, 1714141192, 'Logged in sucessfully', 1714141239),
(1714141411, 1714141192, 'Logged out sucessfully', 1714141411),
(1714141414, 1710930700, 'Logged in sucessfully', 1714141414),
(1714235328, 1710930700, 'Logged in sucessfully', 1714235328),
(1714456363, 1710930700, 'Logged in sucessfully', 1714456363),
(1714514362, 1710930700, 'Logged in sucessfully', 1714514362),
(1714556428, 1714556428, 'logged out successfully', 1714556428),
(1714557948, 1711032973, 'Logged in sucessfully', 1714557948),
(1714562306, 1714562306, 'logged out successfully', 1714562306),
(1714563673, 1711032973, 'Logged in sucessfully', 1714563673),
(1714574964, 1710930700, 'Logged in sucessfully', 1714574964),
(1714582320, 1710930700, 'Logged in sucessfully', 1714582320),
(1714730258, 1710930700, 'Logged in sucessfully', 1714730258),
(1714730447, 1710930700, 'Logged out sucessfully', 1714730447),
(1714730489, 1710930700, 'Logged in sucessfully', 1714730489),
(1714730614, 1710930700, 'Logged out sucessfully', 1714730614),
(1714730619, 1711032451, 'Logged in sucessfully', 1714730619),
(1714731094, 1710930700, 'Logged in sucessfully', 1714731094),
(1714731580, 1710930700, 'Logged out sucessfully', 1714731580),
(1714731590, 1711032973, 'Logged in sucessfully', 1714731590),
(1714733082, 1711032451, 'Logged out sucessfully', 1714733082),
(1714735048, 1711032451, 'Logged in sucessfully', 1714735048),
(1714735179, 1711032451, 'Logged out sucessfully', 1714735179),
(1714735183, 1710930700, 'Logged in sucessfully', 1714735183),
(1714736308, 1710930700, 'Logged out sucessfully', 1714736308),
(1714736313, 1711130874, 'Logged in sucessfully', 1714736313),
(1714736333, 1711130874, 'Logged out sucessfully', 1714736333),
(1714736338, 1710930700, 'Logged in sucessfully', 1714736338),
(1714738839, 1714738839, 'logged out successfully', 1714738839),
(1714752493, 1710930700, 'Logged in sucessfully', 1714752493),
(1714809979, 1711032451, 'Logged in sucessfully', 1714809979),
(1714810443, 1714810443, 'logged out successfully', 1714810443),
(1714824010, 1711032451, 'Logged out sucessfully', 1714824010),
(1714824023, 1711032451, 'Logged in sucessfully', 1714824023),
(1714824062, 1711032451, 'Logged out sucessfully', 1714824062),
(1714824075, 1714824075, 'logged out successfully', 1714824075),
(1714824171, 1714824171, 'logged out successfully', 1714824171),
(1714824258, 1714824258, 'logged out successfully', 1714824258),
(1714824285, 1711032451, 'Logged in sucessfully', 1714824285),
(1714824305, 1711032451, 'Logged out sucessfully', 1714824305),
(1714824318, 1714824318, 'logged out successfully', 1714824318),
(1714824328, 1710930700, 'Logged in sucessfully', 1714824328),
(1714824337, 1710930700, 'Logged out sucessfully', 1714824337),
(1714824345, 1711032451, 'Logged in sucessfully', 1714824345),
(1714825899, 1711032451, 'Logged out sucessfully', 1714825899),
(1714825910, 1711032451, 'Logged in sucessfully', 1714825910),
(1714825981, 1711032451, 'Logged out sucessfully', 1714825981),
(1714826016, 1711032451, 'Logged in sucessfully', 1714826016);

-- --------------------------------------------------------

--
-- Structure de la table `bulletin`
--

CREATE TABLE `bulletin` (
  `id` int(11) NOT NULL,
  `id_students` int(11) NOT NULL,
  `id_classes` int(11) NOT NULL,
  `moy_premier` float NOT NULL,
  `moy_dernier` float NOT NULL,
  `rang` int(11) NOT NULL,
  `moyenne` float NOT NULL,
  `trim1` float NOT NULL,
  `trim2` float NOT NULL,
  `trim3` float NOT NULL,
  `seq1` float NOT NULL,
  `seq2` float NOT NULL,
  `seq3` float NOT NULL,
  `nb_hr_abs` int(11) NOT NULL,
  `decision` tinyint(1) NOT NULL,
  `id_formateur` int(11) NOT NULL,
  `timestamp` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Structure de la table `categorie`
--

CREATE TABLE `categorie` (
  `id` smallint(6) NOT NULL,
  `name` varchar(256) NOT NULL,
  `description` text NOT NULL,
  `position` smallint(6) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `categories`
--

CREATE TABLE `categories` (
  `id` smallint(6) NOT NULL,
  `name` varchar(256) NOT NULL,
  `description` text NOT NULL,
  `file` text NOT NULL,
  `position` smallint(6) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `categories`
--

INSERT INTO `categories` (`id`, `name`, `description`, `file`, `position`) VALUES
(3, 'bggg', '', '', 0),
(18, 'Logo Cis ', 'Logo ', 'A2412030-B74E-4F97-B0C5-26DB97CFE22E.jpeg', 3),
(20, 'Livre numériques ', 'télécharger ', 'EMPLOIS DE TEMPS ICT L3.pdf', 2),
(19, 'aperçu page 1', 'Screenshot ', 'cis.PNG', 4);

-- --------------------------------------------------------

--
-- Structure de la table `classes`
--

CREATE TABLE `classes` (
  `id_classes` int(11) NOT NULL,
  `description` text NOT NULL,
  `id_titulaire` int(11) NOT NULL,
  `niveau` int(11) NOT NULL,
  `timestamp` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Structure de la table `compte`
--

CREATE TABLE `compte` (
  `id_user` int(11) NOT NULL,
  `montant` int(11) NOT NULL,
  `credit` int(11) NOT NULL,
  `id_cmp` int(11) NOT NULL,
  `timestamp` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `compte`
--

INSERT INTO `compte` (`id_user`, `montant`, `credit`, `id_cmp`, `timestamp`) VALUES
(1714073202, 0, 100, 1714073202, 1714073202),
(1710930700, 100000, 500, 1710930700, 1710930700),
(1711032451, 1000, 100, 1711032451, 1711032451),
(1714096021, 0, 100, 1714096021, 1714096021),
(1714096095, 0, 100, 1714096095, 1714096095),
(1714096162, 0, 100, 1714096162, 1714096162),
(1711546245, 1000, 100, 1711546245, 1711546245),
(1714141105, 0, 100, 1714141105, 1714141105),
(1714141192, 0, 100, 1714141192, 1714141192);

-- --------------------------------------------------------

--
-- Structure de la table `cours`
--

CREATE TABLE `cours` (
  `id` int(11) NOT NULL,
  `intitule` text NOT NULL,
  `description` text NOT NULL,
  `titulaire` varchar(255) NOT NULL,
  `coef` int(11) NOT NULL,
  `niveau` text NOT NULL,
  `classe` varchar(255) NOT NULL,
  `department` text NOT NULL,
  `objectif` text NOT NULL,
  `hours` int(11) NOT NULL,
  `prix_u` int(11) NOT NULL,
  `id_struc` int(11) NOT NULL,
  `timestamp` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `cours`
--

INSERT INTO `cours` (`id`, `intitule`, `description`, `titulaire`, `coef`, `niveau`, `classe`, `department`, `objectif`, `hours`, `prix_u`, `id_struc`, `timestamp`) VALUES
(1714632459, 'Anglais', 'Anglais', 'BOFIA', 3, 'secondaire', '0', '', 'xénon ', 2, 2000, 1713564776, 1714632459);

-- --------------------------------------------------------

--
-- Structure de la table `formateur`
--

CREATE TABLE `formateur` (
  `id` int(11) NOT NULL,
  `id_struc` int(11) NOT NULL,
  `nom` text NOT NULL,
  `prenom` text NOT NULL,
  `specialite` text NOT NULL,
  `niveau` int(11) NOT NULL,
  `tel` text NOT NULL,
  `mdp` text NOT NULL,
  `email` varchar(255) NOT NULL,
  `assignation` varchar(255) NOT NULL,
  `timestamp` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `formateur`
--

INSERT INTO `formateur` (`id`, `id_struc`, `nom`, `prenom`, `specialite`, `niveau`, `tel`, `mdp`, `email`, `assignation`, `timestamp`) VALUES
(1714064540, 0, 'boyomo', ' ', ' ', 4, ' ', '000000', 'frank.kako@yahoo.fr', 'Techniciens ', 1714064540),
(1714064582, 0, 'BOFIA', ' ', ' ', 4, ' ', '000000', 'frank.kako@yahoo.fr', 'Techniciens ', 1714064582),
(1714064625, 0, 'BOFIA', ' ', ' ', 4, ' ', '000000', 'frank.kako@yahoo.fr', 'Techniciens ', 1714064625),
(1714065431, 1710930700, 'Berinyuy', ' ', ' ', 4, ' ', '000000', 'frank.kako@yahoo.fr', 'Techniciens ', 1714065431),
(1714731377, 1710930700, '', ' ', ' ', 4, ' ', '', '', '', 1714731377);

-- --------------------------------------------------------

--
-- Structure de la table `notes`
--

CREATE TABLE `notes` (
  `id_note` int(11) NOT NULL,
  `id_student` int(11) NOT NULL,
  `id_cours` int(11) NOT NULL,
  `note` int(11) NOT NULL,
  `coef` int(11) NOT NULL,
  `niveau` text NOT NULL,
  `appreciation` text NOT NULL,
  `rang` int(11) NOT NULL,
  `id_formateur` int(11) NOT NULL,
  `timestamp` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `notes`
--

INSERT INTO `notes` (`id_note`, `id_student`, `id_cours`, `note`, `coef`, `niveau`, `appreciation`, `rang`, `id_formateur`, `timestamp`) VALUES
(1714039560, 1714039560, 1714632459, 15, 4, 'LI', 'BIEN', 0, 1710930700, 1714039560),
(1714474988, 1714583391, 1714632459, 8, 3, '6', 'MEDIOCRE', 1, 1710930700, 1710930700);

-- --------------------------------------------------------

--
-- Structure de la table `notification`
--

CREATE TABLE `notification` (
  `id_notif` int(11) NOT NULL,
  `description` varchar(255) NOT NULL,
  `id_users` int(11) NOT NULL,
  `status` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `timestamp` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `notification`
--

INSERT INTO `notification` (`id_notif`, `description`, `id_users`, `status`, `title`, `timestamp`) VALUES
(1714079527, 'New Post', 1710930700, 0, 'PS', 1714079527),
(1714087207, 'New Post', 1711032451, 0, 'PS', 1714087207),
(1714141758, 'New Post', 1710930700, 0, 'PS', 1714141758);

-- --------------------------------------------------------

--
-- Structure de la table `organigrame`
--

CREATE TABLE `organigrame` (
  `id_org` int(11) NOT NULL,
  `id_ceo` int(11) NOT NULL,
  `id_admin` int(11) NOT NULL,
  `title` text NOT NULL,
  `content` text NOT NULL,
  `file` text NOT NULL,
  `id_struc` int(11) NOT NULL,
  `timestamp` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Structure de la table `pm`
--

CREATE TABLE `pm` (
  `id` bigint(20) NOT NULL,
  `id2` int(11) NOT NULL,
  `title` varchar(256) NOT NULL,
  `user1` bigint(20) NOT NULL,
  `user2` bigint(20) NOT NULL,
  `message` text NOT NULL,
  `timestamp` int(10) NOT NULL,
  `user1read` varchar(3) NOT NULL,
  `user2read` varchar(3) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `pm`
--

INSERT INTO `pm` (`id`, `id2`, `title`, `user1`, `user2`, `message`, `timestamp`, `user1read`, `user2read`) VALUES
(1, 1, 'bonne journée ', 1711032451, 1710930700, '$nb_pm2 = (&#039;select m1.id, m1.title, m1.timestamp, count(m2.id) as reps, count(*) as rep, users.id as userid, users.nom, users.avatar from pm as m1, pm as m2,users where ((m1.user1=&quot;&#039;.$_SESSION[&#039;userid&#039;].&#039;&quot; and m1.user1read=&quot;yes&quot; and users.id=m1.user2) or (m1.user2=&quot;&#039;.$_SESSION[&#039;userid&#039;].&#039;&quot; and m1.user2read=&quot;yes&quot; and users.id=m1.user1)) and m1.id2=&quot;1&quot; and m2.id=m1.id group by m1.id order by m1.id desc&#039;);<br />\r\n$nb_pm1 = $connxx-&gt;prepare($nb_pm1);<br />\r\n$nb_pm1-&gt;execute();<br />\r\n$nb_pm2 = $connxx-&gt;prepare($nb_pm2);<br />\r\n$nb_pm2-&gt;execute();', 1714086554, 'yes', 'yes'),
(1, 1, 'bonne journée ', 1710930700, 1710930700, 'merci merci ', 1714086916, 'yes', 'yes'),
(1, 1, 'bonne journée ', 1711032451, 1710930700, 'cc', 1714087031, 'yes', 'yes'),
(1, 1, 'bonne journée ', 1710930700, 1710930700, 'oui', 1714087058, 'yes', 'yes'),
(5, 1, 'Hello ', 1711032451, 1710930700, 'Mama I will call you tomorrow at noon ', 1714091747, 'yes', 'yes'),
(5, 1, 'Hello ', 1710930700, 1710930700, 'gags ', 1714091872, 'yes', 'yes'),
(5, 1, 'Hello ', 1711032451, 1710930700, 'Hey ', 1714092122, 'yes', 'yes'),
(8, 1, 'cc', 1711546245, 1714096162, 'Bonjour', 1714096259, 'yes', 'yes'),
(8, 1, 'cc', 1714096162, 1714096162, 'Bonjour Djeukam <br />\r\ncomment vas tu?', 1714096446, 'yes', 'yes'),
(8, 1, 'cc', 1711546245, 1714096162, 'Bien et toi', 1714096539, 'yes', 'yes'),
(8, 1, 'cc', 1714096162, 1714096162, 'ca va merci ', 1714096562, 'yes', 'yes'),
(8, 1, 'cc', 1711546245, 1714096162, 'Ahh ok merci ', 1714096612, 'yes', 'yes'),
(13, 1, 'Bonjour ', 1711032973, 1711032451, 'Merci beaucoup pareillement pour ton soutien ', 1714731655, 'yes', 'yes'),
(13, 1, 'Bonjour ', 1711032451, 1711032451, 'merci pour,;;,..,??', 1714732780, 'yes', 'yes'),
(15, 1, 'cc', 1711130874, 1710930700, 'jjj', 1714736329, 'yes', 'no');

-- --------------------------------------------------------

--
-- Structure de la table `processus`
--

CREATE TABLE `processus` (
  `id_process` int(11) NOT NULL,
  `id_users` int(11) NOT NULL,
  `title` int(11) NOT NULL,
  `description` int(11) NOT NULL,
  `status` int(11) NOT NULL,
  `due_date` int(11) NOT NULL,
  `timestamp` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Structure de la table `publication`
--

CREATE TABLE `publication` (
  `id_post` int(11) NOT NULL,
  `files` text NOT NULL,
  `description` text NOT NULL,
  `like` text NOT NULL,
  `id_users` int(11) NOT NULL,
  `comments` text NOT NULL,
  `public` text NOT NULL,
  `timestamp` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `publication`
--

INSERT INTO `publication` (`id_post`, `files`, `description`, `like`, `id_users`, `comments`, `public`, `timestamp`) VALUES
(1714071414, '2024-04-21.png', 'Bientôt Disponible<hr>Fonctionnalités ', 'Capture d’écran (6).png', 1710930700, 'Bientôt il vous sera possible de communiquer en instantané', 'yes', 1714071414),
(1714071694, 'dasboard.PNG', 'ID Card<hr>Fonctionnalités ', 'sign-up-kmerGo.PNG', 1710930700, 'Bientôt il vous sera possible de gérer vos carte d\'identité  ', 'yes', 1714071694),
(1714079527, 'TD TP ICT308 Software Development in Java II .docx.pdf', 'ICT 308<hr>TD/TP', '2024-04-21.png', 1710930700, 'PDF', 'yes', 1714079527),
(1714087207, 'EMPLOIS DE TEMPS ICT L3.pdf', 'Actualités <hr>Fonctionnalités ', 'Capture001.png', 1711032451, 'Bientôt il vous sera possible de communiquer en instantané', 'yes', 1714087207),
(1714141758, 'emma_a_encre_clip_officiel_mp3_49630.mp3', 'ICT<hr>I LOVE EVERYTHING ABOUT IT AND TECHNOLGY', 'moi meme.jpg', 1710930700, 'frank.kako@yahoo.fr', 'yes', 1714141758);

-- --------------------------------------------------------

--
-- Structure de la table `rh`
--

CREATE TABLE `rh` (
  `id_struc` int(11) NOT NULL,
  `solde_total_salaire` int(11) NOT NULL,
  `upgrade` int(11) NOT NULL,
  `nb_personnel` int(11) NOT NULL,
  `id_org` int(11) NOT NULL,
  `id_ceo` int(11) NOT NULL,
  `max_pers` int(11) NOT NULL,
  `min_pers` int(11) NOT NULL,
  `id_users` int(11) NOT NULL,
  `timestamp` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Structure de la table `solde`
--

CREATE TABLE `solde` (
  `id` int(11) NOT NULL,
  `id_personnel` int(11) NOT NULL,
  `montant_fixe` int(11) NOT NULL,
  `prime` int(11) NOT NULL,
  `nb_hr_work` int(11) NOT NULL,
  `montant_total` int(11) NOT NULL,
  `timestamp` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Structure de la table `sticky_notes`
--

CREATE TABLE `sticky_notes` (
  `id_stick` int(11) NOT NULL,
  `id_users` int(11) NOT NULL,
  `description` text NOT NULL,
  `timestamp` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Structure de la table `stucture`
--

CREATE TABLE `stucture` (
  `id_struc` int(11) NOT NULL,
  `raison_sociale` text NOT NULL,
  `description` text NOT NULL,
  `id_user` int(11) NOT NULL,
  `upgrade` tinyint(1) NOT NULL,
  `timestamp` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `stucture`
--

INSERT INTO `stucture` (`id_struc`, `raison_sociale`, `description`, `id_user`, `upgrade`, `timestamp`) VALUES
(1713564725, 'les Roitelets', 'Les Roitelets  trial ', 1710930700, 0, 1713564725),
(1713564776, 'les Roitelets', 'Les Roitelets  trial ', 1710930700, 2, 1713564776),
(1713564779, 'les Roitelets', 'Les Roitelets  trial ', 1710930700, 0, 1713564779),
(1714097998, 'GBI', 'Golden  trial ', 1714096162, 127, 1714097998),
(1714098117, 'GBI', 'Golden  trial ', 1714096162, 127, 1714098117),
(1714098152, 'GBI', 'Golden  trial ', 1714096162, 127, 1714098152),
(1714098156, 'GBI', 'Golden  trial ', 1714096162, 127, 1714098156),
(1714098157, 'GBI', 'Golden  trial ', 1714096162, 127, 1714098157),
(1714098161, 'GBI', 'Golden  trial ', 1714096162, 127, 1714098161);

-- --------------------------------------------------------

--
-- Structure de la table `students`
--

CREATE TABLE `students` (
  `id` int(11) NOT NULL,
  `id_struc` int(11) NOT NULL,
  `nom` text NOT NULL,
  `prenom` text NOT NULL,
  `niveau` text NOT NULL,
  `birthday` text NOT NULL,
  `tel` int(11) NOT NULL,
  `tutor` varchar(255) NOT NULL,
  `parents_name` text NOT NULL,
  `email` varchar(255) NOT NULL,
  `classe` text NOT NULL,
  `status` int(11) DEFAULT NULL,
  `timestamp` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `students`
--

INSERT INTO `students` (`id`, `id_struc`, `nom`, `prenom`, `niveau`, `birthday`, `tel`, `tutor`, `parents_name`, `email`, `classe`, `status`, `timestamp`) VALUES
(1714039560, 1710930700, 'AZEMEKEU', 'Flora', '0', '26', 691625782, '', '-', 'azemekerflora@gmail.com', '', NULL, 1714039560),
(1714039676, 1710930700, 'AZEMEKEU', 'Flora', '0', '26', 691625782, '', '-', 'azemekerflora@gmail.com', '0', NULL, 1714039676),
(1714039753, 1710930700, 'AZEMEKEU', 'Flora', '0', '26', 691625782, '', '-', 'azemekerflora@gmail.com', '0', NULL, 1714039753),
(1714039925, 1710930700, 'AZEMEKEU', 'Flora', '0', '26', 691625782, '', '-', 'azemekerflora@gmail.com', '0', NULL, 1714039925),
(1714040043, 1710930700, 'AZEMEKEU', 'Flora', 'secondaire', '26/03/2008', 691625782, '', '-', 'azemekerflora@gmail.com', '0', NULL, 1714040043),
(1714040113, 1710930700, 'AZEMEKEU', 'Flora', 'secondaire', '26/03/2008', 691625782, '//', '-', 'azemekerflora@gmail.com', '0', NULL, 1714040113),
(1714040162, 1710930700, 'Ntone', 'samuel', 'professionnel', '26/03/1975', 12345678, '//', 'louis marie -louisette juileit', 'gaellebofia17699@gmail.com', 'MI', NULL, 1714040162),
(1714040240, 1710930700, 'Ntondobeu', 'samuel', 'professionnel', '26/03/1975', 12345678, '//', 'louis marie -louisette juileit', 'gaellebofia17699@gmail.com', 'MI', NULL, 1714040240),
(1714040247, 1710930700, 'Ntondobeu', 'samuel', 'professionnel', '26/03/1975', 12345678, '//', 'louis marie -louisette juileit', 'gaellebofia17699@gmail.com', 'MI', NULL, 1714040247),
(1714040294, 1710930700, 'Ntondobeu', 'samuel', 'professionnel', '26/03/1975', 12345678, '//', 'louis marie -louisette juileit', 'gaellebofia17699@gmail.com', 'MI', NULL, 1714040294),
(1714040325, 1710930700, 'Ntondobeu', 'samuel', 'professionnel', '26/03/1975', 12345678, '//', 'louis marie -louisette juileit', 'gaellebofia17699@gmail.com', 'MI', NULL, 1714040325),
(1714040368, 1710930700, 'Ntondobeu', 'samuel', 'professionnel', '26/03/1975', 12345678, '//', 'louis marie -louisette juileit', 'gaellebofia17699@gmail.com', 'MI', NULL, 1714040368),
(1714040439, 1710930700, 'Ntondobeu', 'samuel', 'professionnel', '26/03/1975', 12345678, '//', 'louis marie -louisette juileit', 'gaellebofia17699@gmail.com', 'MI', NULL, 1714040439),
(1714040547, 1710930700, 'Ntondobeu', 'samuel', 'professionnel', '26/03/1975', 12345678, '//', 'louis marie -louisette juileit', 'gaellebofia17699@gmail.com', 'MI', NULL, 1714040547),
(1714040599, 1710930700, 'Ntondobeu', 'samuel', 'professionnel', '26/03/1975', 12345678, '//', 'louis marie -louisette juileit', 'gaellebofia17699@gmail.com', 'MI', NULL, 1714040599),
(1714040932, 1710930700, 'Ntondobeu', 'samuel', 'professionnel', '26/03/1975', 12345678, '//', 'louis marie -louisette juileit', 'gaellebofia17699@gmail.com', 'MI', NULL, 1714040932),
(1714040932, 1710930700, 'Ntone', 'samuel', 'professionnel', '26/03/1975', 12345678, '//', 'louis marie -louisette juileit', 'gaellebofia17699@gmail.com', 'MI', NULL, 1714040932),
(1714041142, 1710930700, 'Ntone', 'samuel', 'professionnel', '26/03/1975', 12345678, '//', 'louis marie -louisette juileit', 'gaellebofia17699@gmail.com', 'MI', NULL, 1714041142),
(1714583391, 1710930700, 'freeboy_willy', 'celestine ', 'superieure', '26/03/2008', 12345678, '//', 'louis marie -louisette juileit', 'bberinyuy960@gmail.com', 'LII', NULL, 1714583391),
(1714583732, 0, 'kakonhey', 'Flora', 'secondaire', '26/03/1975', 12345678, '//', 'louis marie -louisette juileit', 'Berinyuy@gmail.com', '4', NULL, 1714583732),
(1714583812, 0, 'kakonhey', 'Flora', 'secondaire', '26/03/1975', 12345678, '//', 'louis marie -louisette juileit', 'Berinyuy@gmail.com', '4', NULL, 1714583812),
(1714583814, 0, 'kakonhey', 'Flora', 'secondaire', '26/03/1975', 12345678, '//', 'louis marie -louisette juileit', 'Berinyuy@gmail.com', '4', NULL, 1714583814),
(1714583815, 0, 'kakonhey', 'Flora', 'secondaire', '26/03/1975', 12345678, '//', 'louis marie -louisette juileit', 'Berinyuy@gmail.com', '4', NULL, 1714583815),
(1714583816, 0, 'kakonhey', 'Flora', 'secondaire', '26/03/1975', 12345678, '//', 'louis marie -louisette juileit', 'Berinyuy@gmail.com', '4', NULL, 1714583816),
(1714583817, 0, 'kakonhey', 'Flora', 'secondaire', '26/03/1975', 12345678, '//', 'louis marie -louisette juileit', 'Berinyuy@gmail.com', '4', NULL, 1714583817),
(1714583818, 0, 'kakonhey', 'Flora', 'secondaire', '26/03/1975', 12345678, '//', 'louis marie -louisette juileit', 'Berinyuy@gmail.com', '4', NULL, 1714583818),
(1714583819, 0, 'kakonhey', 'Flora', 'secondaire', '26/03/1975', 12345678, '//', 'louis marie -louisette juileit', 'Berinyuy@gmail.com', '4', NULL, 1714583819),
(1714583820, 0, 'kakonhey', 'Flora', 'secondaire', '26/03/1975', 12345678, '//', 'louis marie -louisette juileit', 'Berinyuy@gmail.com', '4', NULL, 1714583820),
(1714583861, 1713564776, 'kakonhey', 'Flora', 'secondaire', '26/03/1975', 12345678, '//', 'louis marie -louisette juileit', 'Berinyuy@gmail.com', '4', NULL, 1714583861),
(1714583931, 1713564776, 'Mouafo', 'celestine ', 'secondaire', '26/03/1975', 12345678, '', 'louis marie -louisette juileit', 'kakonheyfrank@gmail.com', '3', NULL, 1714583931),
(1714584052, 1713564776, 'Mouafo', 'celestine ', 'secondaire', '26/03/1975', 12345678, '', 'louis marie -louisette juileit', 'kakonheyfrank@gmail.com', '3', NULL, 1714584052);

-- --------------------------------------------------------

--
-- Structure de la table `taches`
--

CREATE TABLE `taches` (
  `id_task` int(11) NOT NULL,
  `id_users` int(11) NOT NULL,
  `subject` text NOT NULL,
  `status` int(11) NOT NULL,
  `code` int(11) NOT NULL,
  `admin` int(11) NOT NULL,
  `timestamp` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Structure de la table `topics`
--

CREATE TABLE `topics` (
  `parent` smallint(6) NOT NULL,
  `id` int(11) NOT NULL,
  `id2` int(11) NOT NULL,
  `title` varchar(256) NOT NULL,
  `message` longtext NOT NULL,
  `file` text NOT NULL,
  `authorid` int(11) NOT NULL,
  `timestamp` int(11) NOT NULL,
  `timestamp2` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `topics`
--

INSERT INTO `topics` (`parent`, `id`, `id2`, `title`, `message`, `file`, `authorid`, `timestamp`, `timestamp2`) VALUES
(0, 4, 2, '', '[url]HTML [/url]', '', 1710930700, 1713972806, 1713972806),
(20, 5, 1, ' =bjr', '<strong>hjki </strong>', '', 1710930700, 1714736113, 1714736113);

-- --------------------------------------------------------

--
-- Structure de la table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `nom` text NOT NULL,
  `email` varchar(255) NOT NULL,
  `pays` text NOT NULL,
  `mdp` text NOT NULL,
  `avatar` text NOT NULL,
  `grade` int(11) NOT NULL,
  `timestamp` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `users`
--

INSERT INTO `users` (`id`, `nom`, `email`, `pays`, `mdp`, `avatar`, `grade`, `timestamp`) VALUES
(1710930700, 'freeboy_willy', 'kakonheyfrank@gmail.com', 'CMR', '123456', 'SmallLogoDev.png', 1, 1710930700),
(1711032451, 'Bofia', 'kakonheyfrank@gmail.com', 'India', '123456', 'kmer-go.PNG', 0, 1711032451),
(1711032834, 'Berinyuy', 'kakonheyfrank@gmail.com', 'India', '123456', '', 0, 1711032834),
(1711032973, 'freeboy', 'kakonheyfrank@gmail.com', 'India', '123456', 'kmer-go.PNG', 0, 1711032973),
(1711047653, 'flora', 'gaellebofia17699@gmail.com', 'CMR', 'frank', 'SmallLogoDev.png', 0, 1711047653),
(1711047899, 'ladouce', 'carinekah709@gmail.com', 'UK', '000000', 'SmallLogoDev.png', 0, 1711047899),
(1711130874, 'Chelsea Rania ', 'carinekah709@gmail.com', 'CMR', '123456', 'SmallLogoDev.png', 0, 1711130874),
(1711546245, 'Djeukam', 'djeukam@outlook.com', 'CMR', '123456', 'FB_IMG_1702853714629.jpg', 0, 1711546245),
(1714073202, 'AZEMEKEU', 'carinekah709@gmail.com', 'CMR', '000000', '2024-04-21.png', 0, 1714073202),
(1714096162, 'chelsea', 'kakonheyfrank@gmail.com', 'CMR', '000000', 'WIN_20210418_16_54_06_Pro.jpg', 4, 1714096162),
(1714141192, 'Khloe_West ', 'gaellebofia17699@gmail.com', 'UK', '000000', 'moi meme.jpg', 0, 1714141192);

-- --------------------------------------------------------

--
-- Structure de la table `usersonline`
--

CREATE TABLE `usersonline` (
  `id` int(10) NOT NULL,
  `ip` varchar(255) NOT NULL DEFAULT '',
  `id_user` text NOT NULL,
  `timestamp` varchar(255) NOT NULL DEFAULT '',
  `url` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `usersonline`
--

INSERT INTO `usersonline` (`id`, `ip`, `id_user`, `timestamp`, `url`) VALUES
(30, '127.0.0.1', 'bofia', '1714825972', '/kdrive.com/index.php');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `categorie`
--
ALTER TABLE `categorie`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `topics`
--
ALTER TABLE `topics`
  ADD PRIMARY KEY (`id`,`id2`);

--
-- Index pour la table `usersonline`
--
ALTER TABLE `usersonline`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `usersonline`
--
ALTER TABLE `usersonline`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
