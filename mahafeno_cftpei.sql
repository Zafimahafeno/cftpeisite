-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le : dim. 01 déc. 2024 à 13:07
-- Version du serveur : 8.0.31
-- Version de PHP : 8.0.26

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `eharogna_projet`
--

-- --------------------------------------------------------

--
-- Structure de la table `admin`
--

DROP TABLE IF EXISTS `admin`;
CREATE TABLE IF NOT EXISTS `admin` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nom` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `prenom` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `email` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `motDePasse` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `admin`
--

INSERT INTO `admin` (`id`, `nom`, `prenom`, `email`, `motDePasse`) VALUES
(3, 'RANDRIANARISON', 'Sanders', 'admin@e-harogna.mg', '$2b$10$1Hk01jkSz/LN2.NuCFxBDOPUr1cMEx9DQI8Wi6NGLrunoVDAAuuD6');

-- --------------------------------------------------------

--
-- Structure de la table `competences`
--

DROP TABLE IF EXISTS `competences`;
CREATE TABLE IF NOT EXISTS `competences` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nom` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb3;

-- --------------------------------------------------------

--
-- Structure de la table `cours`
--

DROP TABLE IF EXISTS `cours`;
CREATE TABLE IF NOT EXISTS `cours` (
  `id` int NOT NULL AUTO_INCREMENT,
  `titre` varchar(100) DEFAULT NULL,
  `description` text,
  `formationAssociee` int DEFAULT NULL,
  `datePublication` varchar(50) DEFAULT NULL,
  `imageCours` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `formationAssociee` (`formationAssociee`)
) ENGINE=MyISAM AUTO_INCREMENT=26 DEFAULT CHARSET=utf8mb3;

--
-- Déchargement des données de la table `cours`
--

INSERT INTO `cours` (`id`, `titre`, `description`, `formationAssociee`, `datePublication`, `imageCours`) VALUES
(5, 'Comment créer un CV qui interesse le recruteur ?', 'Apprenez à créer un CV qui attire l\'attention des recruteurs, en vous démarquant dans le marché de l\'emploi.', 13, '15 Septembre 2024', '/uploads/imagesCours/1726431994425-601502382.png'),
(6, 'Quelle tenue mettre durant un entretien d’embauche ?', 'Conseils pour choisir une tenue qui reflète confiance et professionnalisme lors d\'un entretien d\'embauche.', 13, '15 Septembre  2024', '/uploads/imagesCours/1726432150720-375468643.jpg'),
(7, 'Créer la Lettre de Motivation appropriée à votre candidature', 'Techniques pour rédiger une lettre de motivation captivante et marquante pour les recruteurs.', 13, '15 Septembre 2024', '/uploads/imagesCours/1726432215596-863637345.jpg'),
(8, 'Gérer son temps efficacement', 'Stratégies pour gérer efficacement votre temps, augmenter la productivité et équilibrer travail et vie personnelle.', 14, '15 Septembre 2024', '/uploads/imagesCours/1726432391179-193013376.png'),
(9, 'Leadership dans votre quotidien', 'Développez des compétences de leadership pour influencer positivement votre environnement professionnel.', 14, '15 Septembre 2024', '/uploads/imagesCours/1726432434422-208972913.png'),
(10, 'Résilience au travail', 'Stratégies pour renforcer votre motivation et résilience tout au long de votre carrière.', 14, '15 Septembre 2024', '/uploads/imagesCours/1726432563437-901363598.png'),
(11, 'La prise de parole en public', 'Techniques pour gagner en confiance, surmonter le trac et captiver votre auditoire.', 14, '15 Septembre 2024', '/uploads/imagesCours/1726432660114-197432027.PNG'),
(12, 'Savoir travailler en équipe', 'Développez des compétences pour collaborer efficacement et surmonter les défis en équipe.', 14, '15 Septembre 2024', '/uploads/imagesCours/1726432739004-102791405.jpg'),
(15, 'Campagne de publicité avec Google Ads', 'Développez les compétences nécessaires pour créer des campagnes publicitaires percutantes et génératrices de résultats. Vous serez prêt(e) à atteindre votre public cible, accroître votre visibilité en ligne et maximiser le potentiel de votre entreprise grâce à la puissance de Google Ads. Préparez-vous à dominer le monde', 15, '15 Septembre 2024', '/uploads/imagesCours/1730175584430-877711510.jpg'),
(14, 'Devenir rédacteur web', 'Découvrez les techniques de rédaction persuasives pour influencer et convaincre votre audience. Apprenez à créer des appels à l\'action percutants, à développer des arguments persuasifs et à utiliser des stratégies de storytelling pour donner vie à votre contenu et inciter vos lecteurs à passer à l\'action.', 15, '15 Septembre 2024', '/uploads/imagesCours/1730175164405-845325315.jpg'),
(16, 'Maîtriser Facebook Ads', 'Vous allez apprendre à mesurer et analyser les résultats de vos campagnes publicitaires sur Facebook. Explorez les outils d\'analyse et les métriques clés pour évaluer l\'efficacité de vos annonces et ajuster votre stratégie en fonction des données.', 15, '15 Septembre 2024', '/uploads/imagesCours/1730175715496-998907659.png'),
(17, 'Maitriser les Socials Media Analytics', 'Vous allez tirer parti des données des réseaux sociaux et maximiser l\'impact de votre présence en ligne. Vous serez prêt(e) à prendre des décisions stratégiques éclairées, à optimiser votre stratégie sur les réseaux sociaux et à atteindre vos objectifs de manière efficace. ', 15, '15 Septembre 2024', '/uploads/imagesCours/1730175792365-51021704.jpg'),
(18, 'Gestion et Management du Projet', 'Devenez un chef d\'orchestre qui planifie, organise et supervise chaque étape, du concept à la réalisation. En tant que gestionnaire de projet, vous serez chargé de coordonner les équipes, de gérer les ressources et de respecter les délais.', 16, '15 Septembre 2024', '/uploads/imagesCours/1730175951951-700053842.png'),
(19, 'Appuie à la création de l’entreprise', 'Vous allez créer et développer votre propre entreprise avec confiance et passion. Vous serez prêt(e) à transformer votre idée en réalité, à surmonter les défis de l\'entrepreneuriat et à bâtir une entreprise prospère. ', 16, '15 Septembre 2024', '/uploads/imagesCours/1730175996721-803541833.png'),
(20, 'Initiation à la méthodologie Agile', 'Vous allez gérer vos projets de manière plus souple, plus collaborative et plus efficace. Soyez prêt(e) à transformer votre approche de la gestion de projet, à favoriser l\'innovation et à obtenir des résultats exceptionnels grâce à la méthodologie Agile.', 16, '15 Septembre 2024', ''),
(21, 'Réussir son étude du marché', 'Réduisez les risques d\'échec, en vous permettant de prendre les mesures adéquates pour vous implanter durablement sur votre marché et, à plus long terme, de comprendre votre marché, à anticiper les besoins de vos clients et à prendre des décisions stratégiques éclairées pour le succès de votre entreprise.', 16, '15 Septembre 2024', '/uploads/imagesCours/1730176101543-61641433.png'),
(22, 'Apprendre Gimp', 'Vous allez sublimer vos photos, créer des compositions artistiques et développer vos compétences en graphisme, GIMP sera votre outil de prédilection. ', 17, '15 Septembre 2024', '/uploads/imagesCours/1730176415622-830242250.png'),
(23, 'Créer des visuels avec Illustrator', 'Donner vie à votre imagination et créer des visuels époustouflants. Que vous souhaitiez concevoir des illustrations, des logos, des infographies ou des éléments graphiques, Illustrator sera votre outil de prédilection.', 17, '15 Septembre 2024', '/uploads/imagesCours/1730176459451-49570899.png'),
(24, 'Initiation au Design Thinking', 'Souhaiteriez-vous améliorer votre entreprise? Vous avez besoin de libérer votre potentiel créatif et résoudre les problèmes de manière innovante. ', 17, '15 Septembre 2024', '/uploads/imagesCours/1730176526030-470356062.jpg'),
(25, 'Les bases de Photoshop', 'Maîtriser l\'art de la retouche photo et de la création graphique. Vous allez développer des possibilités créatives infinies de Photoshop pour la création graphique et la manipulation d\'images.', 17, '15 Septembre 2024', '/uploads/imagesCours/1730176583683-173067253.jpg');

-- --------------------------------------------------------

--
-- Structure de la table `etudiant_competence`
--

DROP TABLE IF EXISTS `etudiant_competence`;
CREATE TABLE IF NOT EXISTS `etudiant_competence` (
  `etudiant_id` int NOT NULL,
  `competence_id` int NOT NULL,
  PRIMARY KEY (`etudiant_id`,`competence_id`),
  KEY `competence_id` (`competence_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb3;

-- --------------------------------------------------------

--
-- Structure de la table `experience`
--

DROP TABLE IF EXISTS `experience`;
CREATE TABLE IF NOT EXISTS `experience` (
  `id` int NOT NULL AUTO_INCREMENT,
  `titrePoste` varchar(100) DEFAULT NULL,
  `entreprise` varchar(100) DEFAULT NULL,
  `dateDebut` date DEFAULT NULL,
  `dateFin` date DEFAULT NULL,
  `etudiant_id` int DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `etudiant_id` (`etudiant_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb3;

-- --------------------------------------------------------

--
-- Structure de la table `formation`
--

DROP TABLE IF EXISTS `formation`;
CREATE TABLE IF NOT EXISTS `formation` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nom` varchar(100) DEFAULT NULL,
  `description` text,
  `lienFormation` varchar(150) NOT NULL,
  `codeCouleur` char(7) DEFAULT '#007bff',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=20 DEFAULT CHARSET=utf8mb3;

--
-- Déchargement des données de la table `formation`
--

INSERT INTO `formation` (`id`, `nom`, `description`, `lienFormation`, `codeCouleur`) VALUES
(13, 'Préparer son Embauche', 'Trouver un emploi peut être une tâche intimidante, mais avec les bonnes compétences, une stratégie efficace et les outils appropriés, vous pouvez mettre toutes les chances de votre côté pour décrocher le poste de vos rêves. Dans ce guide, nous vous fournirons des conseils précieux et des ressources essentielles pour vous aider à préparer votre embauche de manière optimale.', '/compte/formations/embauche', '#006A6B'),
(14, 'Soft Skills', 'Pour réussir dans votre carrière, il est crucial de maîtriser l\'art de la communication. C’est la clé pour établir des relations solides et transmettre vos idées avec succès. Nos programmes en compétence relationnelle sont conçus pour vous fournir les outils et techniques nécessaires pour améliorer vos compétences tant à l\'oral qu\'à l\'écrit. Préparez-vous à briller dans votre carrière grâce à une communication claire et convaincante!', '/compte/formations/skills', '#007bff'),
(15, 'Les Métiers du Web', 'Le métier du web offre une multitude d\'opportunités, c\'est l\'occasion de laisser libre cours à votre créativité, de développer des interfaces intuitives et de transformer des idées en réalité virtuelle. Plongez dans ce domaine en constante évolution, où vous pourrez développer des compétences uniques, contribuer à la transformation numérique et façonner l\'avenir du web.', '/compte/formations/metiers-du-web', '#FDC613'),
(16, 'Gestion de projet', 'Devenez un gestionnaire d\'entreprise accompli en planifiant, organisant et supervisant chaque étape de vos projets, de la conception à la réalisation. En tant que chef d\'orchestre de l\'entreprise, vous serez responsable de la coordination des équipes, de la gestion des ressources et du respect des délais. Avec une formation adéquate et une expérience pratique, vous pourrez devenir un expert en gestion de projet et atteindre de nouveaux sommets dans votre carrière d\'entreprise.', '/compte/formations/gestion-de-projet', '#E781AE'),
(17, 'P.A.O et Design', 'Découvrez le monde incroyablement créatif et innovant de l’édition électronique et du design ! Vous aurez l\'opportunité de laisser libre cours à votre créativité et de jouer avec les typographies, les couleurs et les images pour transmettre des messages clairs et esthétiquement plaisants. Votre talent artistique et votre sens de l\'esthétique seront valorisés à leur juste mesure.', '/compte/formations/design', '#FD4E26'),
(18, 'Bureautique', 'Des professions essentielles qui garantissent l\'efficacité et le bon fonctionnement des activités administratives au sein des entreprises.Du traitement de texte à la gestion de données, en passant par la planification et la communication, le métier de bureautique vous permettra de naviguer avec aisance dans l\'univers professionnel moderne.', '/compte/formations/bureautique', '#007bff'),
(19, 'Autres', 'La création d’un projet est un travail acharné, il est nécessaire d’avoir des stratégies, des méthodologies élaborées pour son succès. Pour cela, une bonne gestion vous est utile. Découvrez dans cette catégorie les lignes à suivre pour, contrôler, organiser, assurer vos projets.', '/compte/formations/autres', '#007bff');

-- --------------------------------------------------------

--
-- Structure de la table `informationscarriere`
--

DROP TABLE IF EXISTS `informationscarriere`;
CREATE TABLE IF NOT EXISTS `informationscarriere` (
  `id` int NOT NULL AUTO_INCREMENT,
  `etudiant_id` int DEFAULT NULL,
  `experienceProfessionnelle` text,
  PRIMARY KEY (`id`),
  KEY `etudiant_id` (`etudiant_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb3;

-- --------------------------------------------------------

--
-- Structure de la table `inscriptioncours`
--

DROP TABLE IF EXISTS `inscriptioncours`;
CREATE TABLE IF NOT EXISTS `inscriptioncours` (
  `etudiant_id` int NOT NULL,
  `cours_id` int NOT NULL,
  `dateInscription` date DEFAULT NULL,
  `progression` int DEFAULT NULL,
  PRIMARY KEY (`etudiant_id`,`cours_id`),
  KEY `cours_id` (`cours_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb3;

--
-- Déchargement des données de la table `inscriptioncours`
--

INSERT INTO `inscriptioncours` (`etudiant_id`, `cours_id`, `dateInscription`, `progression`) VALUES
(15, 6, '2024-09-17', 0),
(15, 7, '2024-09-17', 0),
(15, 10, '2024-09-17', 0),
(15, 9, '2024-09-18', 0),
(15, 8, '2024-09-19', 0),
(15, 11, '2024-09-19', 0),
(15, 12, '2024-09-19', 0),
(15, 5, '2024-09-19', 0),
(23, 5, '2024-09-23', 50),
(23, 11, '2024-09-23', 0),
(23, 6, '2024-09-23', 0),
(23, 7, '2024-09-23', 0),
(24, 5, '2024-09-24', 100),
(24, 8, '2024-09-24', 0),
(24, 7, '2024-09-24', 100),
(24, 6, '2024-09-24', 100),
(24, 9, '2024-09-24', 0),
(24, 10, '2024-09-26', 0),
(25, 5, '2024-09-27', 100),
(25, 6, '2024-09-27', 33),
(24, 12, '2024-09-30', 0),
(24, 11, '2024-09-30', 0),
(26, 6, '2024-10-02', 67),
(26, 5, '2024-10-02', 0),
(26, 7, '2024-10-02', 0),
(26, 8, '2024-10-02', 0),
(26, 9, '2024-10-02', 0),
(63, 5, '2024-10-27', 100),
(63, 6, '2024-10-27', 100),
(63, 9, '2024-10-27', 80),
(63, 7, '2024-10-29', 71),
(63, 14, '2024-10-29', 50),
(63, 10, '2024-10-29', 0),
(63, 18, '2024-11-20', 0),
(63, 19, '2024-11-20', 0);

-- --------------------------------------------------------

--
-- Structure de la table `lecturesupport`
--

DROP TABLE IF EXISTS `lecturesupport`;
CREATE TABLE IF NOT EXISTS `lecturesupport` (
  `etudiant_id` int NOT NULL,
  `support_id` int NOT NULL,
  `cours_id` int NOT NULL,
  `etatLecture` tinyint(1) DEFAULT '0',
  `dateLecture` datetime DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`etudiant_id`,`support_id`),
  KEY `support_id` (`support_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb3;

--
-- Déchargement des données de la table `lecturesupport`
--

INSERT INTO `lecturesupport` (`etudiant_id`, `support_id`, `cours_id`, `etatLecture`, `dateLecture`) VALUES
(25, 5, 6, 1, '2024-09-27 08:53:44'),
(24, 14, 7, 1, '2024-09-26 23:45:06'),
(24, 5, 6, 1, '2024-09-26 23:22:11'),
(24, 4, 5, 1, '2024-09-26 23:21:27'),
(24, 2, 5, 1, '2024-09-26 23:08:45'),
(24, 6, 6, 1, '2024-09-27 13:12:07'),
(23, 2, 5, 1, '2024-09-27 19:19:23'),
(24, 13, 7, 1, '2024-09-30 13:24:58'),
(26, 5, 6, 1, '2024-10-02 11:03:08'),
(26, 6, 6, 1, '2024-10-02 21:55:31'),
(24, 7, 6, 1, '2024-10-25 07:38:45'),
(63, 2, 5, 1, '2024-10-27 09:03:46'),
(63, 4, 5, 1, '2024-10-27 09:03:50'),
(63, 5, 6, 1, '2024-10-27 09:04:33'),
(63, 6, 6, 1, '2024-10-27 09:04:35'),
(63, 19, 9, 1, '2024-10-29 05:56:21'),
(63, 23, 14, 1, '2024-10-29 06:01:58'),
(63, 16, 7, 1, '2024-10-29 08:56:00'),
(63, 15, 7, 1, '2024-10-29 08:56:03'),
(63, 17, 7, 1, '2024-10-29 08:56:06'),
(63, 18, 7, 1, '2024-10-29 08:56:08'),
(63, 7, 6, 1, '2024-10-29 08:57:00'),
(63, 28, 9, 1, '2024-10-29 09:04:31'),
(63, 20, 9, 1, '2024-10-29 11:24:32'),
(63, 21, 9, 1, '2024-10-29 11:24:42'),
(63, 27, 14, 1, '2024-10-31 08:07:39'),
(63, 13, 7, 1, '2024-11-20 10:01:44');

-- --------------------------------------------------------

--
-- Structure de la table `notification`
--

DROP TABLE IF EXISTS `notification`;
CREATE TABLE IF NOT EXISTS `notification` (
  `id` int NOT NULL AUTO_INCREMENT,
  `message` text,
  `dateRecpt` date DEFAULT NULL,
  `etudiant_id` int DEFAULT NULL,
  `typeNotification` enum('offre_emploi','profil_incomplet','progression','nouveau_support') DEFAULT 'offre_emploi',
  `isRead` tinyint(1) DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `etudiant_id` (`etudiant_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb3;

-- --------------------------------------------------------

--
-- Structure de la table `offreemploi`
--

DROP TABLE IF EXISTS `offreemploi`;
CREATE TABLE IF NOT EXISTS `offreemploi` (
  `id` int NOT NULL AUTO_INCREMENT,
  `titre` varchar(100) DEFAULT NULL,
  `description` text,
  `datePublication` date DEFAULT NULL,
  `entreprise` varchar(100) DEFAULT NULL,
  `localisation` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb3;

--
-- Déchargement des données de la table `offreemploi`
--

INSERT INTO `offreemploi` (`id`, `titre`, `description`, `datePublication`, `entreprise`, `localisation`) VALUES
(1, 'Développeur Web', 'Recherche un développeur web avec 2 ans d\'expérience.', '2024-09-23', 'TechCorp', 'Fianarantsoa'),
(2, 'Développeur Frontend', 'Nous recherchons un développeur frontend passionné pour rejoindre notre équipe. Expérience avec React et Redux souhaitée.', '2024-09-15', 'WebSolutions', 'Antananarivo'),
(5, 'Développeur Backend', 'Poste ouvert pour un développeur backend ayant une expertise en Node.js et MongoDB.', '2024-09-10', 'DevHub', 'Fianarantsoa'),
(6, 'Ingénieur DevOps', 'Nous cherchons un ingénieur DevOps pour gérer l\'infrastructure et les déploiements. Connaissance de Docker et Kubernetes requise.', '2024-09-20', 'CloudTech', 'Fiananrantsoa'),
(7, 'Testeur QA', 'Recherche un testeur QA pour assurer la qualité des applications web. Expérience avec Selenium souhaitée.', '2024-09-28', 'Quality First', 'Antananarivo'),
(8, 'Consultant en Cybersécurité', 'Nous cherchons un consultant en cybersécurité pour évaluer et améliorer la sécurité de nos systèmes.', '2024-09-29', 'SecureTech', 'Antananarivo'),
(9, 'Développeur PHP', 'Poste disponible pour un développeur PHP avec des compétences en Laravel.', '2024-09-26', 'WebMasters', 'Fiananrantsoa');

-- --------------------------------------------------------

--
-- Structure de la table `postulation`
--

DROP TABLE IF EXISTS `postulation`;
CREATE TABLE IF NOT EXISTS `postulation` (
  `id` int NOT NULL AUTO_INCREMENT,
  `etudiant_id` int NOT NULL,
  `offreEmploi_id` int NOT NULL,
  `datePostulation` date NOT NULL,
  `etatPostulation` varchar(50) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `cv` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `etudiant_id` (`etudiant_id`),
  KEY `offreEmploi_id` (`offreEmploi_id`)
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `postulation`
--

INSERT INTO `postulation` (`id`, `etudiant_id`, `offreEmploi_id`, `datePostulation`, `etatPostulation`, `cv`) VALUES
(1, 15, 1, '2024-09-23', 'En attente', NULL),
(2, 15, 1, '2024-09-23', 'En attente', '/uploads/cv/1727060818041-react_native_tutorial.pdf'),
(3, 1, 1, '2024-09-23', 'En attente', '/uploads/cv/1727081679753-Cahier de charge 2.pdf'),
(4, 0, 1, '2024-09-23', 'En attente', '/uploads/cv/1727086343473-B-IntroductionSystemes.pdf'),
(5, 15, 1, '2024-09-23', 'En attente', '/uploads/cv/1727086782068-B-IntroductionSystemes.pdf'),
(6, 23, 1, '2024-09-23', 'En attente', '/uploads/cv/1727117524215-1-html_css.pdf');

-- --------------------------------------------------------

--
-- Structure de la table `supportdecours`
--

DROP TABLE IF EXISTS `supportdecours`;
CREATE TABLE IF NOT EXISTS `supportdecours` (
  `id` int NOT NULL AUTO_INCREMENT,
  `titreSupport` varchar(150) NOT NULL,
  `typeFichier` varchar(50) DEFAULT NULL,
  `cheminAcces` varchar(255) DEFAULT NULL,
  `cours_id` int DEFAULT NULL,
  `datePublication` datetime DEFAULT CURRENT_TIMESTAMP,
  `description` text,
  PRIMARY KEY (`id`),
  KEY `cours_id` (`cours_id`)
) ENGINE=MyISAM AUTO_INCREMENT=29 DEFAULT CHARSET=utf8mb3;

--
-- Déchargement des données de la table `supportdecours`
--

INSERT INTO `supportdecours` (`id`, `titreSupport`, `typeFichier`, `cheminAcces`, `cours_id`, `datePublication`, `description`) VALUES
(2, '', 'docx', '/uploads/cours/docs/français.docx', 5, '2024-11-26 15:17:07', NULL),
(4, '', 'docx', '/uploads/cours/docs/français.docx', 5, '2024-11-26 15:17:07', NULL),
(5, '', 'docx', '/uploads/cours/docs/MémoiredeFindeCycledeLicence.docx', 6, '2024-11-26 15:17:07', NULL),
(6, '', 'docx', '/uploads/cours/docs/TexteSitewebDonaBe.docx', 6, '2024-11-26 15:17:07', NULL),
(7, '', 'docx', '/uploads/cours/docs/CONTENUEUHDONABEEUH.docx', 6, '2024-11-26 15:17:07', NULL),
(16, 'Maîtriser l\'art de la lettre de motivation personnalisée', 'Doc', '/uploads/cours/docs/Asupercomputer isacomputerwithahighlevelofperfomanceas comparedtoageneral.docx', 7, '2024-10-26 15:17:07', NULL),
(15, 'Lettre de motivation : Convaincre en quelques lignes', 'Doc', '/uploads/cours/docs/SUPERCOMPUTER(DNA).docx', 7, '2024-11-26 15:17:07', NULL),
(13, 'Rédiger une lettre de motivation percutante et adaptée', 'Vidéo', '/uploads/cours/videos/test.mp4', 7, '2024-11-26 15:17:07', NULL),
(14, 'Personnalisez votre candidature avec une lettre de motivation efficace', 'Vidéo', '/uploads/cours/videos/video.mp4', 7, '2024-11-26 15:17:07', NULL),
(17, 'Boostez vos chances d\'obtenir un entretien grâce à votre lettre de motivation', 'Doc', '/uploads/cours/docs/Asupercomputer isacomputerwithahighlevelofperfomanceas comparedtoageneral.docx', 7, '2024-11-26 15:17:07', NULL),
(18, 'Une lettre de motivation qui attire l\'attention des recruteurs', 'Doc', '/uploads/cours/docs/Leterme.docx', 7, '2024-11-26 15:17:07', NULL),
(19, '', 'Doc', '/uploads/cours/docs/CPI 2.docx', 9, '2024-11-26 15:17:07', NULL),
(20, '', 'Doc', '/uploads/cours/docs/CPI.docx', 9, '2024-11-26 15:17:07', NULL),
(21, '', 'Doc', '/uploads/cours/docs/Processeur.docx', 9, '2024-11-26 15:17:07', NULL),
(22, '', 'Doc', '/uploads/cours/docs/Projet LSQL L2.docx', 9, '2024-11-26 15:17:07', NULL),
(23, '', 'Doc', '/uploads/cours/docs/BDA_devoir.docx', 14, '2024-11-26 15:17:07', NULL),
(24, '', 'Doc', '/uploads/cours/docs/Cahier de charge.docx', 14, '2024-11-26 15:17:07', NULL),
(25, '', 'Doc', '/uploads/cours/docs/Cahiers de charge rÃ©seau.docx', 14, '2024-11-26 15:17:07', NULL),
(26, 'Transformez votre candidature grâce à une lettre de motivation réussie', 'Vidéo', '/uploads/cours/videos/Extrait de l\'intervention d\'Ylias Akbaraly Ã  Invincible 2022.mp4', 7, '2024-11-26 15:17:07', NULL),
(27, '', 'Vidéo', '/uploads/cours/videos/6 Attitudes Charismatiques qui Forcent le Respect.mp4', 14, '2024-11-26 15:17:07', NULL),
(28, '', 'Vidéo', '/uploads/cours/videos/LA CLÃ D\'UNE HAUTE CONFIANCE EN SOI.mp4', 9, '2024-11-26 15:17:07', NULL);

-- --------------------------------------------------------

--
-- Structure de la table `utilisateur`
--

DROP TABLE IF EXISTS `utilisateur`;
CREATE TABLE IF NOT EXISTS `utilisateur` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nom` varchar(100) NOT NULL,
  `prenom` varchar(50) NOT NULL,
  `dateNaissance` varchar(25) NOT NULL,
  `adresse` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `telephone` varchar(12) NOT NULL,
  `motDePasse` varchar(255) NOT NULL,
  `niveauAbonnement` varchar(50) NOT NULL,
  `photoProfil` varchar(200) DEFAULT NULL,
  `dateInscription` varchar(50) NOT NULL,
  `statutValidation` tinyint(1) NOT NULL,
  `verificationCode` varchar(6) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL,
  `codeExpiresAt` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=72 DEFAULT CHARSET=utf8mb3;

--
-- Déchargement des données de la table `utilisateur`
--

INSERT INTO `utilisateur` (`id`, `nom`, `prenom`, `dateNaissance`, `adresse`, `email`, `telephone`, `motDePasse`, `niveauAbonnement`, `photoProfil`, `dateInscription`, `statutValidation`, `verificationCode`, `codeExpiresAt`) VALUES
(63, 'RANDRIANANDRASANA', 'Lucas Eliade', '12 mars 2005', 'Isaha', 'lucaseliade@gmail.com', '0349152129', '$2b$10$5XC2ai22EOyiflqbC98Mn.hoUx5kT6qbt2NhatruaQ3d6wNOVBraq', 'Membre annuel', '/uploads/images/1730000790182-482561495.png', '2024-10-27 04:46:30', 1, '489210', '2024-10-27 04:51:30'),
(71, 'RANDRIANANDRASANA', 'Volana', '12 mars 2005', 'Tanambao', 'andievolana@gmail.com', '0349152129', '$2b$10$M9TIrNNVtq6KJsALRyOB0.5tNmj84hZdRIApvjgCorKrKL/qZdt7G', 'Membre trimestriel', '/uploads/images/1731683815095-778630430.jpg', '2024-11-15 16:16:55', 0, '513376', '2024-11-15 16:21:56');

-- --------------------------------------------------------

--
-- Structure de la table `utilisateur_temp`
--

DROP TABLE IF EXISTS `utilisateur_temp`;
CREATE TABLE IF NOT EXISTS `utilisateur_temp` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nom` varchar(50) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `prenom` varchar(50) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `email` varchar(100) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `telephone` varchar(20) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `adresse` text COLLATE utf8mb4_general_ci,
  `dateNaissance` date DEFAULT NULL,
  `niveauAbonnement` varchar(20) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `verificationCode` varchar(6) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `codeExpiresAt` datetime DEFAULT NULL,
  `dateInscription` datetime DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `email` (`email`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
