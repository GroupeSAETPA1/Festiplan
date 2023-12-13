INSERT INTO `utilisateurs` (`nom`, `prenom`, `mail`, `mdp`, `login`) VALUES
('Delaclasse', 'Hubert', 'hubert.delaclasse@gmail.com', 'hubert12$', 'hubert'),
('de Lande d\'Aussac de Saint Palais', 'François', 'francois.desaintpalais@iut-rodez.fr', 'mf>N=tyS$9){', 'francois_SP'),
('Costes', 'Quentin', 'quentin.costes@iut-rodez.fr', 'mf>N=tyS$9){', 'quentinformatique'),
('Descriaud', 'Lucas', 'lucas.descriaud@iut-rodez.fr', 'luc@$123', 'lucas'),
('Bécogné', 'Néo', 'neo.becogne@iut-rodez.fr', 'sxdefrcvtgb$=$é222', 'neo'),
('Douaud', 'Tom', 'tom.douaud@iut-rodez.fr', 'T0mD1234', 'tom'),
('Silvestre', 'Franck', 'franck.silvestre@iut-rodez.fr', 'abcdef123@', 'franck');

INSERT INTO festival (id_festival, nom, description, debut, fin, id_categorie, id_responsable, `duree entre spectacle`, illustration)
VALUES
(1,'Bonne année', 'premier festival de l\'anne',STR_TO_DATE('01/01/2024', 'jj/mm/aaaa') ,STR_TO_DATE('07/01/2024', 'jj/mm/aaaa') ,1,1,10, 'Rien'),
(2,'Festival de la chanson', 'festival de la chanson',STR_TO_DATE('01/01/2024', 'jj/mm/aaaa') ,STR_TO_DATE('07/01/2024', 'jj/mm/aaaa') ,2,2,10, 'Rien'),
(3,'Festival de la danse', 'festival de la danse',STR_TO_DATE('01/01/2024', 'jj/mm/aaaa') ,STR_TO_DATE('07/01/2024', 'jj/mm/aaaa') ,3,3,10, 'Rien'),
(4,'Festival de la musique', 'festival de la musique',STR_TO_DATE('01/01/2024', 'jj/mm/aaaa') ,STR_TO_DATE('07/01/2024', 'jj/mm/aaaa') ,4,4,10, 'Rien'),
(5,'Festival de la peinture', 'festival de la peinture',STR_TO_DATE('01/01/2024', 'jj/mm/aaaa') ,STR_TO_DATE('07/01/2024', 'jj/mm/aaaa') ,5,5,10, 'Rien'),
(6,'Festival de la sculpture', 'festival de la sculpture',STR_TO_DATE('01/01/2024', 'jj/mm/aaaa') ,STR_TO_DATE('07/01/2024', 'jj/mm/aaaa') ,6,6,10, 'Rien'),
(7,'Festival de la photographie', 'festival de la photographie',STR_TO_DATE('01/01/2024', 'jj/mm/aaaa') ,STR_TO_DATE('07/01/2024', 'jj/mm/aaaa') ,7,7,10, 'Rien'),
(8,'Festival de la litterature', 'festival de la litterature',STR_TO_DATE('01/01/2024', 'jj/mm/aaaa') ,STR_TO_DATE('07/01/2024', 'jj/mm/aaaa') ,8,1,10, 'Rien');

INSERT INTO categorie (id_categorie, nom) VALUES
(1, 'Concert'),
(2, 'Pièce de thèatre'),
(3, 'Cirque'),
(4, 'Danse'),
(5, 'Projection de film');