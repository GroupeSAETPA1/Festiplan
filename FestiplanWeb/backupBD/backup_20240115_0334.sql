-- Création de la base de données
CREATE DATABASE `festiplan` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_bin */;

USE festiplan;

-- Structure de la table `categorie`
CREATE TABLE `categorie` (
  `id_categorie` int(6) NOT NULL AUTO_INCREMENT COMMENT 'id de la categorie',
  `nom` varchar(70) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL COMMENT 'nom de la categorie',
  PRIMARY KEY (`id_categorie`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;

-- Insertion des données dans la table `categorie`
INSERT INTO categorie (id_categorie, nom) VALUES ('1', 'Concert');
INSERT INTO categorie (id_categorie, nom) VALUES ('2', 'Pièce de théâtre');
INSERT INTO categorie (id_categorie, nom) VALUES ('3', 'Cirque');
INSERT INTO categorie (id_categorie, nom) VALUES ('4', 'Danse');
INSERT INTO categorie (id_categorie, nom) VALUES ('5', 'Projection de film');

-- Structure de la table `utilisateurs`
CREATE TABLE `utilisateurs` (
  `id_utilisateur` int(6) NOT NULL AUTO_INCREMENT,
  `nom` varchar(50) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `prenom` varchar(30) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `mail` varchar(70) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `mdp` varchar(64) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `login` varchar(50) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  PRIMARY KEY (`id_utilisateur`),
  UNIQUE KEY `login` (`login`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;

-- Insertion des données dans la table `utilisateurs`
INSERT INTO utilisateurs (id_utilisateur, nom, prenom, mail, mdp, login) VALUES ('1', 'Delaclasse', 'Hubert', 'hubert.delaclasse@gmail.com', 'eccb683f08f51a94814a065de13cd9167e6e2e0462f89ca73281830d61710c23', 'hubert');
INSERT INTO utilisateurs (id_utilisateur, nom, prenom, mail, mdp, login) VALUES ('2', 'de Lande d\'Aussac de Saint Palais', 'François', 'francois.desaintpalais@iut-rodez.fr', '088026d94b02b0f2c315f8a4068306231d11c4fe55a181fee58878b350d513d1', 'francois_SP');
INSERT INTO utilisateurs (id_utilisateur, nom, prenom, mail, mdp, login) VALUES ('3', 'Costes', 'Quentin', 'quentin.costes@iut-rodez.fr', '088026d94b02b0f2c315f8a4068306231d11c4fe55a181fee58878b350d513d1', 'quentinformatique');
INSERT INTO utilisateurs (id_utilisateur, nom, prenom, mail, mdp, login) VALUES ('4', 'Descriaud', 'Lucas', 'lucas.descriaud@iut-rodez.fr', '2d9c5a065cecb1782b97249d81ee5e02d622feb4f38d7ba6d82f915cb3d1c286', 'lucas');
INSERT INTO utilisateurs (id_utilisateur, nom, prenom, mail, mdp, login) VALUES ('5', 'Bécogné', 'Néo', 'neo.becogne@iut-rodez.fr', '4a6bde82f1ca76f860f78430e232094003768ac7e64498aefbf6a732c10f6d6f', 'neo');
INSERT INTO utilisateurs (id_utilisateur, nom, prenom, mail, mdp, login) VALUES ('6', 'Douaud', 'Tom', 'tom.douaud@iut-rodez.fr', '5f15de5595a55a3232a413c944771b04aba0167418d9006bdc5bc12aa48146ca', 'tom');
INSERT INTO utilisateurs (id_utilisateur, nom, prenom, mail, mdp, login) VALUES ('7', 'Silvestre', 'Franck', 'franck.silvestre@iut-rodez.fr', 'b2b51495ee1dc27b26413ef3b1498c2eaad13de5c3ed3bd3954647670b126393', 'franck');

-- Structure de la table `taille_scene`
CREATE TABLE `taille_scene` (
  `id_taille` int(2) NOT NULL AUTO_INCREMENT,
  `taille` varchar(30) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  PRIMARY KEY (`id_taille`),
  UNIQUE KEY `taille` (`taille`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;

-- Insertion des données dans la table `taille_scene`
INSERT INTO taille_scene (id_taille, taille) VALUES ('3', 'Grande (30mx30m)');
INSERT INTO taille_scene (id_taille, taille) VALUES ('2', 'Moyenne (10mx10m)');
INSERT INTO taille_scene (id_taille, taille) VALUES ('1', 'Petite (4mx4m)');

-- Structure de la table `festival`
CREATE TABLE `festival` (
  `id_festival` int(6) NOT NULL AUTO_INCREMENT COMMENT 'id du festival',
  `nom` varchar(150) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL COMMENT 'nom du festival',
  `description` varchar(1000) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL COMMENT 'description du festival',
  `illustration` varchar(250) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL COMMENT 'lien de l''image pour le code php',
  `debut` date NOT NULL COMMENT 'date de debut du festival',
  `fin` date NOT NULL COMMENT 'date de fin du festival',
  `id_categorie` int(11) NOT NULL COMMENT 'id de la categorie',
  `id_responsable` int(11) NOT NULL COMMENT 'id du responsable',
  `duree_entre_spectacle` int(11) NOT NULL COMMENT 'duree entre chaque spectacle',
  `heure_debut_spectacles` time NOT NULL COMMENT 'heure à laquelle commence le premier spectacle',
  `heure_fin_spectacles` time NOT NULL COMMENT 'heure à laquelle fini le dernier spectacle',
  PRIMARY KEY (`id_festival`),
  KEY `id_categorie` (`id_categorie`),
  KEY `id_responsable` (`id_responsable`),
  CONSTRAINT `festival_ibfk_1` FOREIGN KEY (`id_categorie`) REFERENCES `categorie` (`id_categorie`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `festival_ibfk_2` FOREIGN KEY (`id_responsable`) REFERENCES `utilisateurs` (`id_utilisateur`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;

-- Insertion des données dans la table `festival`
INSERT INTO festival (id_festival, nom, description, illustration, debut, fin, id_categorie, id_responsable, duree_entre_spectacle, heure_debut_spectacles, heure_fin_spectacles) VALUES ('1', 'Bonne année', 'premier festival de l\'année', 'BonneAnnee.jpg', '2024-01-01', '2024-01-07', '1', '1', '10', '12:00:00', '23:59:00');
INSERT INTO festival (id_festival, nom, description, illustration, debut, fin, id_categorie, id_responsable, duree_entre_spectacle, heure_debut_spectacles, heure_fin_spectacles) VALUES ('2', 'festival de quentin', 'premier festival pour quentin', 'FestivalQuentin.jpg', '2024-01-10', '2024-01-11', '1', '1', '10', '12:00:00', '23:59:00');
INSERT INTO festival (id_festival, nom, description, illustration, debut, fin, id_categorie, id_responsable, duree_entre_spectacle, heure_debut_spectacles, heure_fin_spectacles) VALUES ('3', 'Festival de Printemps', 'Célébration du renouveau printanier', 'FestivalPrintemps.jpg', '2024-03-20', '2024-03-25', '2', '2', '15', '10:00:00', '22:00:00');
INSERT INTO festival (id_festival, nom, description, illustration, debut, fin, id_categorie, id_responsable, duree_entre_spectacle, heure_debut_spectacles, heure_fin_spectacles) VALUES ('4', 'Nuit des Arts', 'Exploration artistique nocturne', 'NuitArt.jpg', '2024-04-15', '2024-04-16', '3', '3', '20', '18:00:00', '04:00:00');
INSERT INTO festival (id_festival, nom, description, illustration, debut, fin, id_categorie, id_responsable, duree_entre_spectacle, heure_debut_spectacles, heure_fin_spectacles) VALUES ('5', 'Festival du Cinéma', 'Hommage au septième art', 'FestivalCinema.jpg', '2024-05-10', '2024-05-15', '4', '4', '30', '02:00:00', '23:59:00');
INSERT INTO festival (id_festival, nom, description, illustration, debut, fin, id_categorie, id_responsable, duree_entre_spectacle, heure_debut_spectacles, heure_fin_spectacles) VALUES ('6', 'Fête de la Musique', 'Célébration de la musique', 'FeteMusique.jpg', '2024-06-21', '2024-06-25', '5', '1', '15', '12:00:00', '23:00:00');
INSERT INTO festival (id_festival, nom, description, illustration, debut, fin, id_categorie, id_responsable, duree_entre_spectacle, heure_debut_spectacles, heure_fin_spectacles) VALUES ('7', 'Festival de la Mode', 'Défilés et tendances', 'FestivalMode.jpg', '2024-09-05', '2024-09-10', '1', '6', '25', '11:00:00', '21:00:00');
INSERT INTO festival (id_festival, nom, description, illustration, debut, fin, id_categorie, id_responsable, duree_entre_spectacle, heure_debut_spectacles, heure_fin_spectacles) VALUES ('8', 'Carnaval Coloré', 'Joie, couleurs et déguisements', 'CarnavalCouleur.jpg', '2024-02-25', '2024-02-26', '2', '7', '10', '14:00:00', '23:00:00');
INSERT INTO festival (id_festival, nom, description, illustration, debut, fin, id_categorie, id_responsable, duree_entre_spectacle, heure_debut_spectacles, heure_fin_spectacles) VALUES ('9', 'Festival de l\'Automne', 'Adieu à l\'été, bienvenue à l\'automne', 'FestivalAutomne.jpg', '2024-10-15', '2024-10-20', '3', '1', '20', '09:00:00', '20:00:00');
INSERT INTO festival (id_festival, nom, description, illustration, debut, fin, id_categorie, id_responsable, duree_entre_spectacle, heure_debut_spectacles, heure_fin_spectacles) VALUES ('10', 'Festival des Étoiles', 'Observation du ciel nocturne', 'FestivalEtoile.jpg', '2024-08-10', '2024-08-11', '4', '2', '15', '20:00:00', '04:00:00');

-- Structure de la table `liste_organisateur`
CREATE TABLE `liste_organisateur` (
  `id_festival` int(6) NOT NULL,
  `id_organisateur` int(6) NOT NULL,
  PRIMARY KEY (`id_festival`,`id_organisateur`),
  KEY `id_organisateur` (`id_organisateur`),
  CONSTRAINT `liste_organisateur_ibfk_1` FOREIGN KEY (`id_festival`) REFERENCES `festival` (`id_festival`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `liste_organisateur_ibfk_2` FOREIGN KEY (`id_organisateur`) REFERENCES `utilisateurs` (`id_utilisateur`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;

-- Insertion des données dans la table `liste_organisateur`
INSERT INTO liste_organisateur (id_festival, id_organisateur) VALUES ('1', '1');

-- Structure de la table `scene`
CREATE TABLE `scene` (
  `id_scene` int(6) NOT NULL AUTO_INCREMENT COMMENT 'id scene',
  `nom` varchar(50) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL COMMENT 'nom de la scene',
  `id_taille` int(11) NOT NULL COMMENT 'id taille depuis taille scene',
  `nb_spectateurs` int(11) NOT NULL COMMENT 'nombre de spectateurs maximum',
  `longitude` decimal(10,7) NOT NULL DEFAULT '0.0000000' COMMENT 'longitude de la scence',
  `latitude` decimal(10,7) NOT NULL DEFAULT '0.0000000' COMMENT 'latitude de la scence',
  PRIMARY KEY (`id_scene`),
  KEY `id_taille` (`id_taille`),
  CONSTRAINT `scene_ibfk_1` FOREIGN KEY (`id_taille`) REFERENCES `taille_scene` (`id_taille`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;

-- Insertion des données dans la table `scene`
INSERT INTO scene (id_scene, nom, id_taille, nb_spectateurs, longitude, latitude) VALUES ('1', 'Amphi IUT', '3', '500', '0.0000000', '0.0000000');
INSERT INTO scene (id_scene, nom, id_taille, nb_spectateurs, longitude, latitude) VALUES ('2', 'Salle B301', '2', '70', '0.0000000', '0.0000000');
INSERT INTO scene (id_scene, nom, id_taille, nb_spectateurs, longitude, latitude) VALUES ('3', 'Fillmore East', '1', '2500', '0.0000000', '0.0000000');
INSERT INTO scene (id_scene, nom, id_taille, nb_spectateurs, longitude, latitude) VALUES ('4', 'New York Capitol', '2', '3500', '0.0000000', '0.0000000');
INSERT INTO scene (id_scene, nom, id_taille, nb_spectateurs, longitude, latitude) VALUES ('5', 'Palais des Congrès', '3', '4000', '0.0000000', '0.0000000');
INSERT INTO scene (id_scene, nom, id_taille, nb_spectateurs, longitude, latitude) VALUES ('6', 'Olympia', '1', '2000', '0.0000000', '0.0000000');
INSERT INTO scene (id_scene, nom, id_taille, nb_spectateurs, longitude, latitude) VALUES ('7', 'Roxy Theatre', '2', '1500', '0.0000000', '0.0000000');
INSERT INTO scene (id_scene, nom, id_taille, nb_spectateurs, longitude, latitude) VALUES ('8', 'Palladium', '3', '3000', '0.0000000', '0.0000000');

-- Structure de la table `spectacle`
CREATE TABLE `spectacle` (
  `id_spectacle` int(6) NOT NULL AUTO_INCREMENT COMMENT 'id du spectacle',
  `nom` varchar(150) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL COMMENT 'le nom du spectacle',
  `description` varchar(1000) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL COMMENT 'la description du scpectacle',
  `illustration` varchar(200) CHARACTER SET utf8 COLLATE utf8_bin DEFAULT NULL COMMENT 'le nom de l''image pour le code php',
  `duree` int(3) NOT NULL COMMENT 'la duree du spectacle en minute',
  `id_categorie` int(11) NOT NULL COMMENT 'cle etrangere de categorie',
  `taille_scene` int(11) NOT NULL COMMENT 'cle etrangere de scene',
  `responsable_spectacle` int(11) NOT NULL COMMENT 'cle etrangere de utilisateur',
  PRIMARY KEY (`id_spectacle`),
  KEY `id_categorie` (`id_categorie`),
  KEY `taille_scene` (`taille_scene`),
  KEY `responsable_spectacle` (`responsable_spectacle`),
  CONSTRAINT `spectacle_ibfk_1` FOREIGN KEY (`id_categorie`) REFERENCES `categorie` (`id_categorie`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `spectacle_ibfk_2` FOREIGN KEY (`taille_scene`) REFERENCES `taille_scene` (`id_taille`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `spectacle_ibfk_3` FOREIGN KEY (`responsable_spectacle`) REFERENCES `utilisateurs` (`id_utilisateur`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=51 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;

-- Insertion des données dans la table `spectacle`
INSERT INTO spectacle (id_spectacle, nom, description, illustration, duree, id_categorie, taille_scene, responsable_spectacle) VALUES ('1', 'Festiplan', 'ouverture du site web', 'OuvertureFestiplan.jpg', '50', '5', '1', '2');
INSERT INTO spectacle (id_spectacle, nom, description, illustration, duree, id_categorie, taille_scene, responsable_spectacle) VALUES ('2', 'Marathon hunger game', 'regardez la trilogie en une journée', 'MarathonHungerGames.jpg', '600', '5', '2', '6');
INSERT INTO spectacle (id_spectacle, nom, description, illustration, duree, id_categorie, taille_scene, responsable_spectacle) VALUES ('3', 'Rock Fest', 'Un concert de rock avec des groupes locaux talentueux', 'ConcertRock.jpg', '120', '1', '2', '3');
INSERT INTO spectacle (id_spectacle, nom, description, illustration, duree, id_categorie, taille_scene, responsable_spectacle) VALUES ('4', 'Démonstration de Robotique', 'Une démonstration de robots innovants et leurs fonctionnalités', 'DemoRobo.jpg', '90', '2', '1', '4');
INSERT INTO spectacle (id_spectacle, nom, description, illustration, duree, id_categorie, taille_scene, responsable_spectacle) VALUES ('5', 'Expériences Scientifiques en Direct', 'Un spectacle interactif de démonstration d\'expériences scientifiques', 'ExperienceScientifique.jpg', '75', '3', '1', '5');
INSERT INTO spectacle (id_spectacle, nom, description, illustration, duree, id_categorie, taille_scene, responsable_spectacle) VALUES ('6', 'Jazz Night', 'Une soirée de jazz avec des artistes renommés', 'SoireeJazz.jpg', '150', '1', '3', '2');
INSERT INTO spectacle (id_spectacle, nom, description, illustration, duree, id_categorie, taille_scene, responsable_spectacle) VALUES ('7', 'Show de Magie Moderne', 'Une démonstration de magie moderne et d\'illusions étonnantes', 'SpectacleMagie.jpg', '60', '2', '2', '6');
INSERT INTO spectacle (id_spectacle, nom, description, illustration, duree, id_categorie, taille_scene, responsable_spectacle) VALUES ('8', 'Atelier de Cuisine en Direct', 'Une démonstration culinaire avec un chef étoilé', 'SpectacleCuisine.jpg', '120', '3', '2', '1');
INSERT INTO spectacle (id_spectacle, nom, description, illustration, duree, id_categorie, taille_scene, responsable_spectacle) VALUES ('9', 'Projection de Film Classique', 'Une soirée de projection de films classiques du cinéma', 'ProjectionClassique.jpg', '180', '4', '3', '1');
INSERT INTO spectacle (id_spectacle, nom, description, illustration, duree, id_categorie, taille_scene, responsable_spectacle) VALUES ('10', 'Concert Acoustique Intime', 'Un concert acoustique avec des artistes en petit comité', 'ConcertAcoustique.jpg', '90', '1', '1', '3');
INSERT INTO spectacle (id_spectacle, nom, description, illustration, duree, id_categorie, taille_scene, responsable_spectacle) VALUES ('11', 'Défilé de Mode Innovant', 'Un spectacle de défilé de mode mettant en avant des créations innovantes', 'ModeInnovante.jpg', '120', '2', '3', '4');
INSERT INTO spectacle (id_spectacle, nom, description, illustration, duree, id_categorie, taille_scene, responsable_spectacle) VALUES ('12', 'Expérience VR Interactive', 'Une démonstration immersive en réalité virtuelle', 'ExperienceVR.jpg', '60', '3', '1', '5');
INSERT INTO spectacle (id_spectacle, nom, description, illustration, duree, id_categorie, taille_scene, responsable_spectacle) VALUES ('13', 'Frank Zappa & The Mothers of Invention Live at Fillmore East', 'Performance live in New York', 'ZappaFilmore.jpg', '120', '1', '3', '3');
INSERT INTO spectacle (id_spectacle, nom, description, illustration, duree, id_categorie, taille_scene, responsable_spectacle) VALUES ('14', 'The Rolling Stones Live at Madison Square Garden', 'Iconic concert in NYC', 'StonesMadison.jpg', '90', '1', '1', '1');
INSERT INTO spectacle (id_spectacle, nom, description, illustration, duree, id_categorie, taille_scene, responsable_spectacle) VALUES ('15', 'Pink Floyd: The Dark Side of the Moon Tour', 'Gig showcasing the legendary album', 'FloydDarkSideMoon.jpg', '100', '1', '2', '2');
INSERT INTO spectacle (id_spectacle, nom, description, illustration, duree, id_categorie, taille_scene, responsable_spectacle) VALUES ('16', 'Jimi Hendrix Experience at Woodstock', 'Historic performance at the legendary festival', 'HendrixWoodstock.jpg', '80', '1', '3', '3');
INSERT INTO spectacle (id_spectacle, nom, description, illustration, duree, id_categorie, taille_scene, responsable_spectacle) VALUES ('17', 'David Bowie: Ziggy Stardust Live', 'Bowie\'s famous alter ego on stage', 'BowieStardust.jpg', '110', '1', '1', '1');
INSERT INTO spectacle (id_spectacle, nom, description, illustration, duree, id_categorie, taille_scene, responsable_spectacle) VALUES ('18', 'Led Zeppelin: Stairway to Heaven Tour', 'Highlighting their iconic song', 'ZepplinStarway.jpg', '95', '1', '2', '2');
INSERT INTO spectacle (id_spectacle, nom, description, illustration, duree, id_categorie, taille_scene, responsable_spectacle) VALUES ('19', 'The Doors at Whisky a Go Go', 'Early performance at the famous club', 'DoorsWiskey.jpg', '75', '1', '3', '3');
INSERT INTO spectacle (id_spectacle, nom, description, illustration, duree, id_categorie, taille_scene, responsable_spectacle) VALUES ('20', 'BLACK SABBATH Paranoid tour', 'Celebrating their breakthrough album', 'SabbathParanoid.jpg', '105', '1', '1', '1');
INSERT INTO spectacle (id_spectacle, nom, description, illustration, duree, id_categorie, taille_scene, responsable_spectacle) VALUES ('21', 'Frank Zappa: Roxy & Elsewhere Tour', 'Live tour promoting the iconic album', 'ZappaRoxy.jpg', '100', '1', '2', '2');
INSERT INTO spectacle (id_spectacle, nom, description, illustration, duree, id_categorie, taille_scene, responsable_spectacle) VALUES ('22', 'Frank Zappa: Bongo Fury Live', 'Collaborative tour with Captain Beefheart', 'ZappaBongoFury.jpg', '95', '1', '3', '3');
INSERT INTO spectacle (id_spectacle, nom, description, illustration, duree, id_categorie, taille_scene, responsable_spectacle) VALUES ('23', 'Frank Zappa: Sheik Yerbouti Live', 'Concert tour promoting the album', 'ZappaYerbouti.jpg', '105', '1', '1', '1');
INSERT INTO spectacle (id_spectacle, nom, description, illustration, duree, id_categorie, taille_scene, responsable_spectacle) VALUES ('24', 'Frank Zappa: Halloween Live', 'Special Halloween concert', 'ZappaHalloween.jpg', '95', '1', '2', '2');
INSERT INTO spectacle (id_spectacle, nom, description, illustration, duree, id_categorie, taille_scene, responsable_spectacle) VALUES ('25', 'The Who: Tommy Live', 'Full performance of the rock opera', 'WhoTommy.jpg', '100', '1', '3', '3');
INSERT INTO spectacle (id_spectacle, nom, description, illustration, duree, id_categorie, taille_scene, responsable_spectacle) VALUES ('26', 'Frank Zappa: Apostrophe Tour', 'Live performances featuring hits', 'ZappaApostrophe.jpg', '100', '1', '1', '1');
INSERT INTO spectacle (id_spectacle, nom, description, illustration, duree, id_categorie, taille_scene, responsable_spectacle) VALUES ('27', 'Does Humor Belong in Music?', 'Interview et concert de Frank Zappa', 'ZappaHumour.jpg', '95', '1', '2', '2');
INSERT INTO spectacle (id_spectacle, nom, description, illustration, duree, id_categorie, taille_scene, responsable_spectacle) VALUES ('28', 'The Allman Brothers Band at The Fillmore', 'Epic live recordings', 'AlmanFilmore.jpg', '105', '1', '3', '3');
INSERT INTO spectacle (id_spectacle, nom, description, illustration, duree, id_categorie, taille_scene, responsable_spectacle) VALUES ('29', 'James Brown: Live at The Apollo', 'Incredible performance at the iconic venue', 'JamesBrown.jpg', '85', '1', '1', '1');
INSERT INTO spectacle (id_spectacle, nom, description, illustration, duree, id_categorie, taille_scene, responsable_spectacle) VALUES ('30', 'Stevie Wonder: Songs in the Key of Life Concert', 'Celebrating the classic album', 'StevieWonder.jpg', '100', '1', '3', '3');
INSERT INTO spectacle (id_spectacle, nom, description, illustration, duree, id_categorie, taille_scene, responsable_spectacle) VALUES ('31', 'The Eagles: Hotel California Tour', 'Showcasing their landmark album', 'EaglesCalifornia.jpg', '100', '1', '1', '1');
INSERT INTO spectacle (id_spectacle, nom, description, illustration, duree, id_categorie, taille_scene, responsable_spectacle) VALUES ('32', 'Projection The Thing', 'Projection du film culte de science-fiction', 'TheThing.jpg', '110', '5', '2', '2');
INSERT INTO spectacle (id_spectacle, nom, description, illustration, duree, id_categorie, taille_scene, responsable_spectacle) VALUES ('33', 'Projection Escape from New York Screening', 'Projection du classique d\'action', 'EscapeNY.jpg', '105', '5', '3', '3');
INSERT INTO spectacle (id_spectacle, nom, description, illustration, duree, id_categorie, taille_scene, responsable_spectacle) VALUES ('34', 'Projection Assault on Precinct 13 Screening', 'Projection du thriller original', 'Assault13.jpg', '100', '5', '1', '1');
INSERT INTO spectacle (id_spectacle, nom, description, illustration, duree, id_categorie, taille_scene, responsable_spectacle) VALUES ('35', 'Projection They Live Screening', 'Projection du film de science-fiction dystopique', 'TheyLive.jpg', '115', '5', '2', '2');
INSERT INTO spectacle (id_spectacle, nom, description, illustration, duree, id_categorie, taille_scene, responsable_spectacle) VALUES ('36', 'Cirque du Soleil: Mystère', 'Spectacle captivant mêlant acrobaties et musique', 'CirqueMystere.jpg', '120', '3', '3', '3');
INSERT INTO spectacle (id_spectacle, nom, description, illustration, duree, id_categorie, taille_scene, responsable_spectacle) VALUES ('37', 'Cirque Éloize: Saloon', 'Spectacle alliant cirque et théâtre autour d\'une ambiance western', 'CirqueSaloon.jpg', '110', '3', '1', '1');
INSERT INTO spectacle (id_spectacle, nom, description, illustration, duree, id_categorie, taille_scene, responsable_spectacle) VALUES ('38', 'Cirque Phénix: Le Monde de Jalèya', 'Voyage fantastique à travers un univers mystérieux', 'CirquePhenix.jpg', '105', '3', '2', '2');
INSERT INTO spectacle (id_spectacle, nom, description, illustration, duree, id_categorie, taille_scene, responsable_spectacle) VALUES ('39', 'Cirque Gruss: Quintessence', 'Spectacle traditionnel de cirque avec une touche moderne', 'CirqueGruss.jpg', '100', '3', '3', '3');
INSERT INTO spectacle (id_spectacle, nom, description, illustration, duree, id_categorie, taille_scene, responsable_spectacle) VALUES ('40', 'Cirque Arlette Gruss: Bêtes de Cirque', 'Spectacle mettant en scène la complicité entre l\'homme et l\'animal', 'CirqueArlette.jpg', '115', '3', '1', '1');
INSERT INTO spectacle (id_spectacle, nom, description, illustration, duree, id_categorie, taille_scene, responsable_spectacle) VALUES ('41', 'Ballet Bolchoï: Le Lac des Cygnes', 'Classique du ballet interprété par le Bolchoï', 'LacCygnes.jpg', '120', '4', '2', '2');
INSERT INTO spectacle (id_spectacle, nom, description, illustration, duree, id_categorie, taille_scene, responsable_spectacle) VALUES ('42', 'Compagnie Alvin Ailey: Revelations', 'Spectacle de danse moderne et vibrant', 'BalletRevelations.jpg', '110', '4', '3', '3');
INSERT INTO spectacle (id_spectacle, nom, description, illustration, duree, id_categorie, taille_scene, responsable_spectacle) VALUES ('43', 'Ballet Royal de Londres: Roméo et Juliette', 'Interprétation du célèbre ballet de Shakespeare', 'RomeoJuliette.jpg', '105', '4', '1', '3');
INSERT INTO spectacle (id_spectacle, nom, description, illustration, duree, id_categorie, taille_scene, responsable_spectacle) VALUES ('44', 'Cirque du Soleil: Alegria', 'Combinaison envoûtante de danse et d\'acrobaties', 'CirqueAlergia.jpg', '100', '4', '2', '4');
INSERT INTO spectacle (id_spectacle, nom, description, illustration, duree, id_categorie, taille_scene, responsable_spectacle) VALUES ('45', 'Compagnie Martha Graham: Appalachian Spring', 'Spectacle emblématique de danse moderne', 'AppalachianSpring.jpg', '115', '4', '3', '5');
INSERT INTO spectacle (id_spectacle, nom, description, illustration, duree, id_categorie, taille_scene, responsable_spectacle) VALUES ('46', 'William Shakespeare: Hamlet', 'La célèbre tragédie de Shakespeare', 'Hamlet.jpg', '150', '5', '1', '1');
INSERT INTO spectacle (id_spectacle, nom, description, illustration, duree, id_categorie, taille_scene, responsable_spectacle) VALUES ('47', 'Anton Tchekhov: La Cerisaie', 'Drame poignant sur le passage du temps et les souvenirs', 'Tchekhov.jpg', '135', '5', '2', '2');
INSERT INTO spectacle (id_spectacle, nom, description, illustration, duree, id_categorie, taille_scene, responsable_spectacle) VALUES ('48', 'Molière: Le Misanthrope', 'Comédie classique sur l\'hypocrisie sociale', 'MoliereMisantropie.jpg', '130', '5', '3', '3');
INSERT INTO spectacle (id_spectacle, nom, description, illustration, duree, id_categorie, taille_scene, responsable_spectacle) VALUES ('49', 'Arthur Miller: Death of a Salesman', 'Étude tragique de la vie et des rêves américains', 'DeathSalesman.jpg', '140', '5', '1', '4');
INSERT INTO spectacle (id_spectacle, nom, description, illustration, duree, id_categorie, taille_scene, responsable_spectacle) VALUES ('50', 'Tennessee Williams: A Streetcar Named Desire', 'Portrait bouleversant de la fragilité humaine', 'StreetcarDesire.jpg', '145', '5', '2', '5');

-- Structure de la table `spectacle_festival_scene`
CREATE TABLE `spectacle_festival_scene` (
  `id_festival` int(6) NOT NULL,
  `id_spectacle` int(6) NOT NULL,
  `id_scene` int(6) NOT NULL,
  PRIMARY KEY (`id_festival`,`id_spectacle`,`id_scene`),
  KEY `id_spectacle` (`id_spectacle`),
  KEY `id_scene` (`id_scene`),
  CONSTRAINT `spectacle_festival_scene_ibfk_1` FOREIGN KEY (`id_festival`) REFERENCES `festival` (`id_festival`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `spectacle_festival_scene_ibfk_2` FOREIGN KEY (`id_spectacle`) REFERENCES `spectacle` (`id_spectacle`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `spectacle_festival_scene_ibfk_3` FOREIGN KEY (`id_scene`) REFERENCES `scene` (`id_scene`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;

-- Insertion des données dans la table `spectacle_festival_scene`
INSERT INTO spectacle_festival_scene (id_festival, id_spectacle, id_scene) VALUES ('1', '1', '1');
INSERT INTO spectacle_festival_scene (id_festival, id_spectacle, id_scene) VALUES ('1', '2', '2');
INSERT INTO spectacle_festival_scene (id_festival, id_spectacle, id_scene) VALUES ('6', '3', '1');
INSERT INTO spectacle_festival_scene (id_festival, id_spectacle, id_scene) VALUES ('6', '4', '2');
INSERT INTO spectacle_festival_scene (id_festival, id_spectacle, id_scene) VALUES ('6', '5', '3');
INSERT INTO spectacle_festival_scene (id_festival, id_spectacle, id_scene) VALUES ('6', '6', '1');
INSERT INTO spectacle_festival_scene (id_festival, id_spectacle, id_scene) VALUES ('6', '7', '2');
INSERT INTO spectacle_festival_scene (id_festival, id_spectacle, id_scene) VALUES ('6', '8', '3');
INSERT INTO spectacle_festival_scene (id_festival, id_spectacle, id_scene) VALUES ('6', '9', '1');
INSERT INTO spectacle_festival_scene (id_festival, id_spectacle, id_scene) VALUES ('6', '10', '2');
INSERT INTO spectacle_festival_scene (id_festival, id_spectacle, id_scene) VALUES ('6', '11', '3');
INSERT INTO spectacle_festival_scene (id_festival, id_spectacle, id_scene) VALUES ('6', '12', '1');
INSERT INTO spectacle_festival_scene (id_festival, id_spectacle, id_scene) VALUES ('6', '13', '3');
INSERT INTO spectacle_festival_scene (id_festival, id_spectacle, id_scene) VALUES ('6', '14', '1');
INSERT INTO spectacle_festival_scene (id_festival, id_spectacle, id_scene) VALUES ('6', '15', '3');
INSERT INTO spectacle_festival_scene (id_festival, id_spectacle, id_scene) VALUES ('6', '16', '1');

-- Structure de la table `liste_spectacle_temporaire`
CREATE TABLE `liste_spectacle_temporaire` (
  `id_festival` int(6) NOT NULL,
  `id_spectacle` int(6) NOT NULL,
  `id_scene` int(6) NOT NULL,
  PRIMARY KEY (`id_festival`,`id_spectacle`,`id_scene`),
  KEY `id_spectacle` (`id_spectacle`),
  KEY `id_scene` (`id_scene`),
  CONSTRAINT `liste_spectacle_temporaire_ibfk_1` FOREIGN KEY (`id_festival`) REFERENCES `festival` (`id_festival`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `liste_spectacle_temporaire_ibfk_2` FOREIGN KEY (`id_spectacle`) REFERENCES `spectacle` (`id_spectacle`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `liste_spectacle_temporaire_ibfk_3` FOREIGN KEY (`id_scene`) REFERENCES `scene` (`id_scene`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;

-- Structure de la table `liste_scene_temporaire`
CREATE TABLE `liste_scene_temporaire` (
  `id_festival` int(6) NOT NULL,
  `id_scene` int(6) NOT NULL,
  PRIMARY KEY (`id_festival`,`id_scene`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;

-- Structure de la table `liste_inter_hors_scene`
CREATE TABLE `liste_inter_hors_scene` (
  `id_spectacle` int(6) NOT NULL,
  `id_inter` int(6) NOT NULL,
  PRIMARY KEY (`id_spectacle`,`id_inter`),
  KEY `id_inter` (`id_inter`),
  CONSTRAINT `liste_inter_hors_scene_ibfk_1` FOREIGN KEY (`id_spectacle`) REFERENCES `spectacle` (`id_spectacle`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `liste_inter_hors_scene_ibfk_2` FOREIGN KEY (`id_inter`) REFERENCES `utilisateurs` (`id_utilisateur`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;

-- Structure de la table `liste_inter_scene`
CREATE TABLE `liste_inter_scene` (
  `id_spectacle` int(6) NOT NULL,
  `id_inter` int(6) NOT NULL,
  PRIMARY KEY (`id_spectacle`,`id_inter`),
  KEY `id_inter` (`id_inter`),
  CONSTRAINT `liste_inter_scene_ibfk_1` FOREIGN KEY (`id_spectacle`) REFERENCES `spectacle` (`id_spectacle`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `liste_inter_scene_ibfk_2` FOREIGN KEY (`id_inter`) REFERENCES `utilisateurs` (`id_utilisateur`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;

-- Structure de la table `liste_scene`
CREATE TABLE `liste_scene` (
  `id_festival` int(6) NOT NULL,
  `id_scene` int(6) NOT NULL,
  PRIMARY KEY (`id_festival`,`id_scene`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;

-- Insertion des données dans la table `liste_scene`
INSERT INTO liste_scene (id_festival, id_scene) VALUES ('1', '1');
INSERT INTO liste_scene (id_festival, id_scene) VALUES ('1', '6');
INSERT INTO liste_scene (id_festival, id_scene) VALUES ('2', '1');
INSERT INTO liste_scene (id_festival, id_scene) VALUES ('5', '6');

