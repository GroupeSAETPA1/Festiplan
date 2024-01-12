-- Insertion dans la table `utilisateurs`
INSERT INTO `utilisateurs` (`nom`, `prenom`, `mail`, `mdp`, `login`) VALUES
('Delaclasse', 'Hubert', 'hubert.delaclasse@gmail.com', 'eccb683f08f51a94814a065de13cd9167e6e2e0462f89ca73281830d61710c23', 'hubert'), -- mdp: hubert12$
('de Lande d\'Aussac de Saint Palais', 'François', 'francois.desaintpalais@iut-rodez.fr', '088026d94b02b0f2c315f8a4068306231d11c4fe55a181fee58878b350d513d1', 'francois_SP'), -- mdp : mf>N=tyS$9){
('Costes', 'Quentin', 'quentin.costes@iut-rodez.fr', '088026d94b02b0f2c315f8a4068306231d11c4fe55a181fee58878b350d513d1', 'quentinformatique'), -- mdp : mf>N=tyS$9){
('Descriaud', 'Lucas', 'lucas.descriaud@iut-rodez.fr', '2d9c5a065cecb1782b97249d81ee5e02d622feb4f38d7ba6d82f915cb3d1c286', 'lucas'), -- mdp : luc@$123
('Bécogné', 'Néo', 'neo.becogne@iut-rodez.fr', '4a6bde82f1ca76f860f78430e232094003768ac7e64498aefbf6a732c10f6d6f', 'neo'), -- mdp : sxdefrcvtgb$=$é222
('Douaud', 'Tom', 'tom.douaud@iut-rodez.fr', '5f15de5595a55a3232a413c944771b04aba0167418d9006bdc5bc12aa48146ca', 'tom'), -- mdp : T0mD1234
('Silvestre', 'Franck', 'franck.silvestre@iut-rodez.fr', 'b2b51495ee1dc27b26413ef3b1498c2eaad13de5c3ed3bd3954647670b126393', 'franck'); -- mdp : abcdef123@

-- Insertion dans la table `categorie`
INSERT INTO categorie (id_categorie, nom) VALUES
(1, 'Concert'),
(2, 'Pièce de théâtre'),
(3, 'Cirque'),
(4, 'Danse'),
(5, 'Projection de film');

-- Insertion dans la table `taille_scene`
INSERT INTO `taille_scene` (`taille`) VALUES
('Petite (4mx4m)'),
('Moyenne (10mx10m)'),
('Grande (30mx30m)');

-- Insertion dans la table `festival`
INSERT INTO festival (nom, description, debut, fin, id_categorie, id_responsable, `duree_entre_spectacle`, heure_debut_spectacles, heure_fin_spectacles, illustration)
VALUES
('Bonne année', 'premier festival de l\'année', '2024-01-01', '2024-01-07', 1, 1, 10, '12:00:00', '23:59:00', 'BonneAnnee.jpg'),
('festival de quentin', 'premier festival pour quentin', '2024-01-10', '2024-01-11', 1, 1, 10, '12:00:00', '23:59:00', 'FestivalQuentin.jpg'),
('Festival de Printemps', 'Célébration du renouveau printanier', '2024-03-20', '2024-03-25', 2, 2, 15, '10:00:00', '22:00:00', 'FestivalPrintemps.jpg'),
('Nuit des Arts', 'Exploration artistique nocturne', '2024-04-15', '2024-04-16', 3, 3, 20, '18:00:00', '04:00:00', 'NuitArt.jpg'),
('Festival du Cinéma', 'Hommage au septième art', '2024-05-10', '2024-05-15', 4, 4, 30, '02:00:00', '23:59:00', 'FestivalCinema.jpg'),
('Fête de la Musique', 'Célébration de la musique', '2024-06-21', '2024-06-25', 5, 1, 15, '12:00:00', '23:00:00', 'FeteMusique.jpg'),
('Festival de la Mode', 'Défilés et tendances', '2024-09-05', '2024-09-10', 1, 6, 25, '11:00:00', '21:00:00', 'FestivalMode.jpg'),
('Carnaval Coloré', 'Joie, couleurs et déguisements', '2024-02-25', '2024-02-26', 2, 7, 10, '14:00:00', '23:00:00', 'CarnavalCouleur.jpg'),
('Festival de l\'Automne', 'Adieu à l\'été, bienvenue à l\'automne', '2024-10-15', '2024-10-20', 3, 1, 20, '09:00:00', '20:00:00', 'FestivalAutomne.jpg'),
('Festival des Étoiles', 'Observation du ciel nocturne', '2024-08-10', '2024-08-11', 4, 2, 15, '20:00:00', '04:00:00', 'FestivalEtoile.jpg');


-- Insertion dans la table `scene`
INSERT INTO `scene` (`nomScene`, `nb_spectateurs`, `id_taille`) VALUES
('Amphi IUT', 500, 3),
('Salle B301', 70, 2),
('Fillmore East', 2500, 1),
('New York Capitol', 3500, 2),
('Palais des Congrès', 4000, 3),
('Olympia', 2000, 1),
('Roxy Theatre', 1500, 2),
('Palladium', 3000, 3);

-- Insertion dans la table `spectacle`
INSERT INTO `spectacle` (`nom`, `description`, `illustration`, `duree`, `id_categorie`, `taille_scene`, `responsable_spectacle`) VALUES
('Festiplan', 'ouverture du site web', 'OuvertureFestiplan.jpg', 50, 5, 1, 2),
('Marathon hunger game', 'regardez la trilogie en une journée', 'MarathonHungerGames.jpg', 600, 5, 2, 6),
('Rock Fest', 'Un concert de rock avec des groupes locaux talentueux', 'ConcertRock.jpg', 120, 1, 2, 3),
('Démonstration de Robotique', 'Une démonstration de robots innovants et leurs fonctionnalités', 'DemoRobo.jpg', 90, 2, 1, 4),
('Expériences Scientifiques en Direct', 'Un spectacle interactif de démonstration d\'expériences scientifiques', 'ExperienceScientifique.jpg', 75, 3, 1, 5),
('Jazz Night', 'Une soirée de jazz avec des artistes renommés', 'SoireeJazz.jpg', 150, 1, 3, 2),
('Show de Magie Moderne', 'Une démonstration de magie moderne et d\'illusions étonnantes', 'SpectacleMagie.jpg', 60, 2, 2, 6),
('Atelier de Cuisine en Direct', 'Une démonstration culinaire avec un chef étoilé', 'SpectacleCuisine.jpg', 120, 3, 2, 1),
('Projection de Film Classique', 'Une soirée de projection de films classiques du cinéma', 'ProjectionClassique.jpg', 180, 4, 3, 1),
('Concert Acoustique Intime', 'Un concert acoustique avec des artistes en petit comité', 'ConcertAcoustique.jpg', 90, 1, 1, 3),
('Défilé de Mode Innovant', 'Un spectacle de défilé de mode mettant en avant des créations innovantes', 'ModeInnovante.jpg', 120, 2, 3, 4),
('Expérience VR Interactive', 'Une démonstration immersive en réalité virtuelle', 'ExperienceVR.jpg', 60, 3, 1, 5),
('Frank Zappa & The Mothers of Invention Live at Fillmore East', 'Performance live in New York', 'ZappaFilmore.jpg', 120, 1, 3, 3),
('The Rolling Stones Live at Madison Square Garden', 'Iconic concert in NYC', 'StonesMadison.jpg', 90, 1, 1, 1),
('Pink Floyd: The Dark Side of the Moon Tour', 'Gig showcasing the legendary album', 'FloydDarkSideMoon.jpg', 100, 1, 2, 2),
('Jimi Hendrix Experience at Woodstock', 'Historic performance at the legendary festival', 'HendrixWoodstock.jpg', 80, 1, 3, 3),
('David Bowie: Ziggy Stardust Live', 'Bowie\'s famous alter ego on stage', 'BowieStardust.jpg', 110, 1, 1, 1),
('Led Zeppelin: Stairway to Heaven Tour', 'Highlighting their iconic song', 'ZepplinStarway.jpg', 95, 1, 2, 2),
('The Doors at Whisky a Go Go', 'Early performance at the famous club', 'DoorsWiskey.jpg', 75, 1, 3, 3),
('BLACK SABBATH Paranoid tour', 'Celebrating their breakthrough album', 'SabbathParanoid.jpg', 105, 1, 1, 1),
('Frank Zappa: Roxy & Elsewhere Tour', 'Live tour promoting the iconic album', 'ZappaRoxy.jpg', 100, 1, 2, 2),
('Frank Zappa: Bongo Fury Live', 'Collaborative tour with Captain Beefheart', 'ZappaBongoFury.jpg', 95, 1, 3, 3),
('Frank Zappa: Sheik Yerbouti Live', 'Concert tour promoting the album', 'ZappaYerbouti.jpg', 105, 1, 1, 1),
('Frank Zappa: Halloween Live', 'Special Halloween concert', 'ZappaHalloween.jpg', 95, 1, 2, 2),
('The Who: Tommy Live', 'Full performance of the rock opera', 'WhoTommy.jpg', 100, 1, 3, 3),
('Frank Zappa: Apostrophe Tour', 'Live performances featuring hits', 'ZappaApostrophe.jpg', 100, 1, 1, 1),
('Does Humor Belong in Music?', 'Interview et concert de Frank Zappa', 'ZappaHumour.jpg', 95, 1, 2, 2),
('The Allman Brothers Band at The Fillmore', 'Epic live recordings', 'AlmanFilmore.jpg', 105, 1, 3, 3),
('James Brown: Live at The Apollo', 'Incredible performance at the iconic venue', 'JamesBrown.jpg', 85, 1, 1, 1),
('Stevie Wonder: Songs in the Key of Life Concert', 'Celebrating the classic album', 'StevieWonder.jpg', 100, 1, 3, 3),
('The Eagles: Hotel California Tour', 'Showcasing their landmark album', 'EaglesCalifornia.jpg', 100, 1, 1, 1),
('Projection The Thing', 'Projection du film culte de science-fiction', 'TheThing.jpg', 110, 5, 2, 2),
('Projection Escape from New York Screening', 'Projection du classique d\'action', 'EscapeNY.jpg', 105, 5, 3, 3),
('Projection Assault on Precinct 13 Screening', 'Projection du thriller original', 'Assault13.jpg', 100, 5, 1, 1),
('Projection They Live Screening', 'Projection du film de science-fiction dystopique', 'TheyLive.jpg', 115, 5, 2, 2),
('Cirque du Soleil: Mystère', 'Spectacle captivant mêlant acrobaties et musique', 'CirqueMystere.jpg', 120, 3, 3, 3),
('Cirque Éloize: Saloon', 'Spectacle alliant cirque et théâtre autour d\'une ambiance western', 'CirqueSaloon.jpg', 110, 3, 1, 1),
('Cirque Phénix: Le Monde de Jalèya', 'Voyage fantastique à travers un univers mystérieux', 'CirquePhenix.jpg', 105, 3, 2, 2),
('Cirque Gruss: Quintessence', 'Spectacle traditionnel de cirque avec une touche moderne', 'CirqueGruss.jpg', 100, 3, 3, 3),
('Cirque Arlette Gruss: Bêtes de Cirque', 'Spectacle mettant en scène la complicité entre l\'homme et l\'animal', 'CirqueArlette.jpg', 115, 3, 1, 1),
('Ballet Bolchoï: Le Lac des Cygnes', 'Classique du ballet interprété par le Bolchoï', 'LacCygnes.jpg', 120, 4, 2, 2),
('Compagnie Alvin Ailey: Revelations', 'Spectacle de danse moderne et vibrant', 'BalletRevelations.jpg', 110, 4, 3, 3),
('Ballet Royal de Londres: Roméo et Juliette', 'Interprétation du célèbre ballet de Shakespeare', 'RomeoJuliette.jpg', 105, 4, 1, 3),
('Cirque du Soleil: Alegria', 'Combinaison envoûtante de danse et d\'acrobaties', 'CirqueAlergia.jpg', 100, 4, 2, 4),
('Compagnie Martha Graham: Appalachian Spring', 'Spectacle emblématique de danse moderne', 'AppalachianSpring.jpg', 115, 4, 3, 5),
('William Shakespeare: Hamlet', 'La célèbre tragédie de Shakespeare', 'Hamlet.jpg', 150, 5, 1, 1),
('Anton Tchekhov: La Cerisaie', 'Drame poignant sur le passage du temps et les souvenirs', 'Tchekhov.jpg', 135, 5, 2, 2),
('Molière: Le Misanthrope', 'Comédie classique sur l\'hypocrisie sociale', 'MoliereMisantropie.jpg', 130, 5, 3, 3),
('Arthur Miller: Death of a Salesman', 'Étude tragique de la vie et des rêves américains', 'DeathSalesman.jpg', 140, 5, 1, 4),
('Tennessee Williams: A Streetcar Named Desire', 'Portrait bouleversant de la fragilité humaine', 'StreetcarDesire.jpg', 145, 5, 2, 5);


-- Insertion dans les tables de liaison
INSERT INTO `spectacle_festival_scene` (`id_festival`, `id_spectacle`, `id_scene`) VALUES
(1, 1, 1),
(1, 2, 2),
(6, 3, 1),
(6, 4, 2),
(6, 5, 3),
(6, 6, 1),
(6, 7, 2),
(6, 8, 3),
(6, 9, 1),
(6, 10, 2),
(6, 11, 3),
(6, 12, 1),
(6, 13, 3),
(6, 14, 1),
(6, 15, 3),
(6, 16, 1);

INSERT INTO `liste_organisateur` (`id_festival`, `id_organisateur`) VALUES
(1,1);

INSERT INTO liste_scene (id_scene, id_festival) VALUES
(1, 1),
(1, 2),
(6, 1),
(6, 5);
