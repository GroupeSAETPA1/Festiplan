INSERT INTO `utilisateurs` (`nom`, `prenom`, `mail`, `mdp`, `login`) VALUES
('Delaclasse', 'Hubert', 'hubert.delaclasse@gmail.com', 'eccb683f08f51a94814a065de13cd9167e6e2e0462f89ca73281830d61710c23', 'hubert'),
('de Lande d\'Aussac de Saint Palais', 'François', 'francois.desaintpalais@iut-rodez.fr', 'mf>N=tyS$9){', 'francois_SP'),
('Costes', 'Quentin', 'quentin.costes@iut-rodez.fr', 'mf>N=tyS$9){', 'quentinformatique'),
('Descriaud', 'Lucas', 'lucas.descriaud@iut-rodez.fr', 'luc@$123', 'lucas'),
('Bécogné', 'Néo', 'neo.becogne@iut-rodez.fr', 'sxdefrcvtgb$=$é222', 'neo'),
('Douaud', 'Tom', 'tom.douaud@iut-rodez.fr', 'T0mD1234', 'tom'),
('Silvestre', 'Franck', 'franck.silvestre@iut-rodez.fr', 'abcdef123@', 'franck');

INSERT INTO categorie (id_categorie, nom) VALUES
(1, 'Concert'),
(2, 'Pièce de thèatre'),
(3, 'Cirque'),
(4, 'Danse'),
(5, 'Projection de film');

INSERT INTO `taille_scene` (`id_taille`, `taille`) VALUES
(1, 'Petite (4mx4m)'),
(2, 'Moyenne (10mx10m)'),
(3, 'Grande (30mx30m)'),
(4, 'Très Grande (100mx100m)');

INSERT INTO festival (id_festival, nom, description, debut, fin, id_categorie, id_responsable, `duree_entre_spectacle`, illustration, heure_debut_spectacles, heure_fin_spectacles)
VALUES
(1,'Bonne année', 'premier festival de l\'anne',                STR_TO_DATE('01/01/2024', '%d/%m/%Y') ,STR_TO_DATE('07/01/2024', '%d/%m/%Y') ,1,1,10, 'Rien', STR_TO_DATE('08:00', '%H:%i'), STR_TO_DATE('18:00', '%H:%i')),
(2,'Festival de la chanson', 'festival de la chanson',          STR_TO_DATE('01/01/2024', '%d/%m/%Y') ,STR_TO_DATE('07/01/2024', '%d/%m/%Y') ,2,2,10, 'Rien', STR_TO_DATE('08:00', '%H:%i'), STR_TO_DATE('18:00', '%H:%i')),
(3,'Festival de la danse', 'festival de la danse',              STR_TO_DATE('01/01/2024', '%d/%m/%Y') ,STR_TO_DATE('07/01/2024', '%d/%m/%Y') ,3,3,10, 'Rien', STR_TO_DATE('08:00', '%H:%i'), STR_TO_DATE('18:00', '%H:%i')),
(4,'Festival de la musique', 'festival de la musique',          STR_TO_DATE('01/01/2024', '%d/%m/%Y') ,STR_TO_DATE('07/01/2024', '%d/%m/%Y') ,4,4,10, 'Rien', STR_TO_DATE('08:00', '%H:%i'), STR_TO_DATE('18:00', '%H:%i')),
(5,'Festival de la peinture', 'festival de la peinture',        STR_TO_DATE('01/01/2024', '%d/%m/%Y') ,STR_TO_DATE('07/01/2024', '%d/%m/%Y') ,4,5,10, 'Rien', STR_TO_DATE('08:00', '%H:%i'), STR_TO_DATE('18:00', '%H:%i')),
(6,'Festival de la sculpture', 'festival de la sculpture',      STR_TO_DATE('01/01/2024', '%d/%m/%Y') ,STR_TO_DATE('07/01/2024', '%d/%m/%Y') ,4,6,10, 'Rien', STR_TO_DATE('08:00', '%H:%i'), STR_TO_DATE('18:00', '%H:%i')),
(7,'Festival de la photographie', 'festival de la photographie',STR_TO_DATE('01/01/2024', '%d/%m/%Y') ,STR_TO_DATE('07/01/2024', '%d/%m/%Y') ,5,7,10, 'Rien', STR_TO_DATE('08:00', '%H:%i'), STR_TO_DATE('18:00', '%H:%i')),
(8,'Festival de la litterature', 'festival de la litterature',  STR_TO_DATE('01/01/2024', '%d/%m/%Y') ,STR_TO_DATE('07/01/2024', '%d/%m/%Y') ,5,1,10, 'Rien', STR_TO_DATE('08:00', '%H:%i'), STR_TO_DATE('18:00', '%H:%i'));

INSERT INTO `scene` (`id_scene`, `nom`, `nb_spectateurs`, `id_taille`) VALUES
(1, 'amphi iut ', 500, 3),
(2, 'salle b301', 70, 2);

INSERT INTO `spectacle` (`nom`, `description`, `illustration`, `duree`, id_categorie, taille_scene, responsable_spectacle) VALUES
-- ('Festiplan', 'ouverture du site web', '', 50, 5, 1, 2),
-- ('Marathon hunger game', 'regardez la trilogie en une journée', '', 600, 5, 2, 6),
('Spectacle de magie', 'Un spectacle de magie époustouflant', '', 120, 3, 1, 1),
('Concert de rock', 'Un concert de rock endiablé', '', 180, 1, 2, 2),
('Pièce de théâtre classique', 'Une pièce de théâtre de Molière', '', 90, 2, 1, 3),
('Exposition de peinture', 'Exposition des œuvres de Van Gogh', '', 240, 5, 2, 4),
('Projection de film', 'Projection du film Inception', '', 148, 5, 1, 5),
('Spectacle de danse contemporaine', 'Un spectacle de danse contemporaine innovant', '', 60, 4, 2, 6),
('Cirque acrobatique', 'Un spectacle de cirque avec des acrobates de haut niveau', '', 120, 3, 1, 7),
('Concert de musique classique', 'Un concert de musique classique avec un orchestre symphonique', '', 120, 1, 2, 1),
('Pièce de théâtre moderne', 'Une pièce de théâtre moderne', '', 90, 2, 1, 2),
('Exposition de sculpture', 'Exposition des œuvres de Rodin', '', 240, 5, 2, 1),
('Projection de film', 'Projection du film Interstellar', '', 169, 5, 1, 2),
('Spectacle de danse classique', 'Un spectacle de danse classique', '', 60, 4, 2, 3),
('Cirque avec animaux', 'Un spectacle de cirque avec des animaux', '', 120, 3, 1, 4),
('Concert de musique électronique', 'Un concert de musique électronique', '', 120, 1, 2, 5),
('Pièce de théâtre contemporaine', 'Une pièce de théâtre contemporaine', '', 90, 2, 1, 6),
('Exposition de photographie', 'Exposition des œuvres de Cartier-Bresson', '', 240, 5, 2, 7),
('Projection de film', 'Projection du film Le Seigneur des Anneaux', '', 228, 5, 1, 1),
('Spectacle de danse moderne', 'Un spectacle de danse moderne', '', 60, 4, 2, 2),
('Cirque avec clowns', 'Un spectacle de cirque avec des clowns', '', 120, 3, 1, 3),
('Concert de musique pop', 'Un concert de musique pop', '', 120, 1, 2, 4),
('Pièce de théâtre classique', 'Une pièce de théâtre classique', '', 90, 2, 1, 5),
('Exposition de peinture', 'Exposition des œuvres de Picasso', '', 240, 5, 2, 6),
('Projection de film', 'Projection du film Le Parrain', '', 175, 5, 1, 7);

INSERT INTO liste_scene (id_scene, id_festival) VALUES
(1, 1),
(1, 2);

INSERT INTO liste_spectacle (id_festival, id_spectacle) VALUES
(1, 1),
(1, 2);

INSERT INTO liste_organisateur VALUES
(1, 1),
(1, 2),
(1, 3),
(2, 3);


