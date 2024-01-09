-- Insertion dans la table `utilisateurs`
INSERT INTO `utilisateurs` (`nom`, `prenom`, `mail`, `mdp`, `login`) VALUES
('Delaclasse', 'Hubert', 'hubert.delaclasse@gmail.com', 'eccb683f08f51a94814a065de13cd9167e6e2e0462f89ca73281830d61710c23', 'hubert'),
('de Lande d\'Aussac de Saint Palais', 'François', 'francois.desaintpalais@iut-rodez.fr', 'mf>N=tyS$9){', 'francois_SP'),
('Costes', 'Quentin', 'quentin.costes@iut-rodez.fr', 'mf>N=tyS$9){', 'quentinformatique'),
('Descriaud', 'Lucas', 'lucas.descriaud@iut-rodez.fr', 'luc@$123', 'lucas'),
('Bécogné', 'Néo', 'neo.becogne@iut-rodez.fr', 'sxdefrcvtgb$=$é222', 'neo'),
('Douaud', 'Tom', 'tom.douaud@iut-rodez.fr', 'T0mD1234', 'tom'),
('Silvestre', 'Franck', 'franck.silvestre@iut-rodez.fr', 'abcdef123@', 'franck'),
('Roux', 'Sophie', 'sophie.roux@iut-rodez.fr', 'soph!e123', 'sophie'),
('Girard', 'Julie', 'julie.girard@iut-rodez.fr', 'jul13!94', 'julieG'),
('Lefebvre', 'Antoine', 'antoine.lefebvre@iut-rodez.fr', 'p@ssW0rd', 'antoineL'),
('Lemoine', 'Camille', 'camille.lemoine@iut-rodez.fr', 'c@mille789', 'cam_lem'),
('Martinez', 'Emmanuel', 'emmanuel.martinez@iut-rodez.fr', 'M@rt1n3z', 'emma_M'),
('Legrand', 'Charlotte', 'charlotte.legrand@iut-rodez.fr', 'ch@rl0tte', 'c.legrand'),
('Fournier', 'Maxime', 'maxime.fournier@iut-rodez.fr', 'f0urni3r!', 'maxF'),
('Caron', 'Laura', 'laura.caron@iut-rodez.fr', 'l@ur@321', 'lauraC'),
('Michel', 'Théo', 'theo.michel@iut-rodez.fr', 'm1chel123', 'theoM'),
('Noël', 'Valentine', 'valentine.noel@iut-rodez.fr', 'n0elV@l', 'val_noel'),
('Bernard', 'Élise', 'elise.bernard@iut-rodez.fr', 'b3rn@rd', 'eliseB'),
('Dubois', 'Gabriel', 'gabriel.dubois@iut-rodez.fr', 'dub0!s', 'gab_dub');



-- Insertion dans la table `categorie`
INSERT INTO categorie (id_categorie, nom) VALUES
(1, 'Concert'),
(2, 'Pièce de théâtre'),
(3, 'Cirque'),
(4, 'Danse'),
(5, 'Projection de film');

-- Insertion dans la table `taille_scene`
INSERT INTO `taille_scene` (`id_taille`, `taille`) VALUES
(1, 'Petite (4mx4m)'),
(2, 'Moyenne (10mx10m)'),
(3, 'Grande (30mx30m)');

-- Insertion dans la table `festival`
INSERT INTO festival (nom, description, debut, fin, id_categorie, id_responsable, `duree_entre_spectacle`, heure_debut_spectacles, heure_fin_spectacles, illustration)
VALUES
('Bonne année', 'premier festival de l\'année', '2024-01-01', '2024-01-07', 1, 1, 10, '12:00:00', '23:59:59', 'Rien'),
('festival de quentin', 'premier festival pour quentin', '2024-01-10', '2024-01-11', 1, 1, 10, '12:00:00', '23:59:59', 'Rien'),
('Festival de Printemps', 'Célébration du renouveau printanier', '2024-03-20', '2024-03-25', 2, 2, 15, '10:00:00', '22:00:00', 'Rien'),
('Nuit des Arts', 'Exploration artistique nocturne', '2024-04-15', '2024-04-16', 3, 3, 20, '18:00:00', '04:00:00', 'Rien'),
('Festival du Cinéma', 'Hommage au septième art', '2024-05-10', '2024-05-15', 4, 4, 30, '02:00:00', '23:59:59', 'Rien'),
('Fête de la Musique', 'Célébration de la musique', '2024-06-21', '2024-06-25', 5, 1, 15, '12:00:00', '23:00:00', 'Rien'),
('Festival de la Mode', 'Défilés et tendances', '2024-09-05', '2024-09-10', 1, 6, 25, '11:00:00', '21:00:00', 'Rien'),
('Carnaval Coloré', 'Joie, couleurs et déguisements', '2024-02-25', '2024-02-26', 2, 7, 10, '14:00:00', '23:00:00', 'Rien'),
('Festival de l\'Automne', 'Adieu à l\'été, bienvenue à l\'automne', '2024-10-15', '2024-10-20', 3, 8, 20, '09:00:00', '20:00:00', 'Rien'),
('Festival des Étoiles', 'Observation du ciel nocturne', '2024-08-10', '2024-08-11', 4, 9, 15, '20:00:00', '04:00:00', 'Rien');


-- Insertion dans la table `scene`
INSERT INTO `scene` (`nom`, `nb_spectateurs`, `id_taille`) VALUES
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
('Festiplan', 'ouverture du site web', '', 50, 2, 1, 1),
('Marathon hunger game', 'regardez la trilogie en une journée', '', 600, 5, 2, 2),
('Frank Zappa & The Mothers of Invention Live at Fillmore East', 'Performance live in New York', 'FillmoreEastPic', 120, 1, 3, 3),
('The Rolling Stones Live at Madison Square Garden', 'Iconic concert in NYC', 'MadisonSquarePic', 90, 1, 1, 1),
('Pink Floyd: The Dark Side of the Moon Tour', 'Gig showcasing the legendary album', 'DarkSideTourPic', 100, 1, 2, 2),
('Jimi Hendrix Experience at Woodstock', 'Historic performance at the legendary festival', 'WoodstockPic', 80, 1, 3, 3),
('David Bowie: Ziggy Stardust Live', 'Bowie\'s famous alter ego on stage', 'ZiggyLivePic', 110, 1, 1, 1),
('Led Zeppelin: Stairway to Heaven Tour', 'Highlighting their iconic song', 'StairwayTourPic', 95, 1, 2, 2),
('The Doors at Whisky a Go Go', 'Early performance at the famous club', 'WhiskyAGoGoPic', 75, 1, 3, 3),
('BLACK SABBATH Paranoid tour', 'Celebrating their breakthrough album', 'BlackSabbathPic', 105, 1, 1, 1),
('Frank Zappa: Roxy & Elsewhere Tour', 'Live tour promoting the iconic album', 'RoxyTourPic', 100, 1, 2, 2),
('Frank Zappa: Bongo Fury Live', 'Collaborative tour with Captain Beefheart', 'BongoFuryPic', 95, 1, 3, 3),
('Frank Zappa: Sheik Yerbouti Live', 'Concert tour promoting the album', 'YerboutiLivePic', 105, 1, 1, 1),
('Frank Zappa: Halloween Live', 'Special Halloween concert', 'HalloweenLivePic', 95, 1, 2, 2),
('The Who: Tommy Live', 'Full performance of the rock opera', 'TommyLivePic', 100, 1, 3, 3),
('Frank Zappa: Apostrophe Tour', 'Live performances featuring hits', 'ApostropheTourPic', 100, 1, 1, 1),
('Does Humor Belong in Music?', 'Interview et concert de Frank Zappa', 'HumourInMusicPic', 95, 1, 2, 2),
('The Allman Brothers Band at The Fillmore', 'Epic live recordings', 'AllmanFillmorePic', 105, 1, 3, 3),
('James Brown: Live at The Apollo', 'Incredible performance at the iconic venue', 'ApolloLivePic', 85, 1, 1, 1),
('The Torture Never Stops', 'Concert NYC Palladium de Zappa', 'TTNS81Pic', 105, 1, 2, 2),
('Stevie Wonder: Songs in the Key of Life Concert', 'Celebrating the classic album', 'KeyOfLifePic', 100, 1, 3, 3),
('The Eagles: Hotel California Tour', 'Showcasing their landmark album', 'HotelCaliforniaPic', 100, 1, 1, 1),
('Projection The Thing', 'Projection du film culte de science-fiction', 'TheThingFilmPic', 110, 5, 2, 2),
('Projection Escape from New York Screening', 'Projection du classique d\'action', 'EscapeNYFilmPic', 105, 5, 3, 3),
('Projection Assault on Precinct 13 Screening', 'Projection du thriller original', 'AssaultPrecinct13Pic', 100, 5, 1, 1),
('Projection They Live Screening', 'Projection du film de science-fiction dystopique', 'TheyLiveFilmPic', 115, 5, 2, 2),
('Cirque du Soleil: Mystère', 'Spectacle captivant mêlant acrobaties et musique', 'MysterePic', 120, 3, 3, 3),
('Cirque Éloize: Saloon', 'Spectacle alliant cirque et théâtre autour d\'une ambiance western', 'SaloonPic', 110, 3, 1, 1),
('Cirque Phénix: Le Monde de Jalèya', 'Voyage fantastique à travers un univers mystérieux', 'JaleyaPic', 105, 3, 2, 2),
('Cirque Gruss: Quintessence', 'Spectacle traditionnel de cirque avec une touche moderne', 'QuintessencePic', 100, 3, 3, 3),
('Cirque Arlette Gruss: Bêtes de Cirque', 'Spectacle mettant en scène la complicité entre l\'homme et l\'animal', 'BetesCirquePic', 115, 3, 1, 1),
('Ballet Bolchoï: Le Lac des Cygnes', 'Classique du ballet interprété par le Bolchoï', 'BolchoiSwanLakePic', 120, 4, 2, 2),
('Compagnie Alvin Ailey: Revelations', 'Spectacle de danse moderne et vibrant', 'AlvinAileyRevelationsPic', 110, 4, 3, 3),
('Ballet Royal de Londres: Roméo et Juliette', 'Interprétation du célèbre ballet de Shakespeare', 'RoyalBalletRomeoJulietPic', 105, 4, 1, 3),
('Cirque du Soleil: Alegria', 'Combinaison envoûtante de danse et d\'acrobaties', 'AlegriaDancePic', 100, 4, 2, 4),
('Compagnie Martha Graham: Appalachian Spring', 'Spectacle emblématique de danse moderne', 'MarthaGrahamSpringPic', 115, 4, 3, 5),
('William Shakespeare: Hamlet', 'La célèbre tragédie de Shakespeare', 'HamletShakespearePic', 150, 5, 1, 1),
('Anton Tchekhov: La Cerisaie', 'Drame poignant sur le passage du temps et les souvenirs', 'CerisaieTchekhovPic', 135, 5, 2, 2),
('Molière: Le Misanthrope', 'Comédie classique sur l\'hypocrisie sociale', 'MisanthropeMolierePic', 130, 5, 3, 3),
('Arthur Miller: Death of a Salesman', 'Étude tragique de la vie et des rêves américains', 'DeathSalesmanMillerPic', 140, 5, 1, 4),
('Tennessee Williams: A Streetcar Named Desire', 'Portrait bouleversant de la fragilité humaine', 'StreetcarWilliamsPic', 145, 5, 2, 5);


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
(6, 12, 1);

INSERT INTO `liste_organisateur` (`id_festival`, `id_organisateur`) VALUES
(1,1),
(6,1),
(6,5);
