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
INSERT INTO `taille_scene` (`id_taille`, `taille`) VALUES
(1, 'Petite (4mx4m)'),
(2, 'Moyenne (10mx10m)'),
(3, 'Grande (30mx30m)');

-- Insertion dans la table `festival`
INSERT INTO festival (nom, description, debut, fin, id_categorie, id_responsable, `duree_entre_spectacle`, heure_debut_spectacles, heure_fin_spectacles, illustration)
VALUES
('Bonne année', 'premier festival de l\'année', '2024-01-01', '2024-01-07', 1, 1, 10, '12:00:00', '23:59:59', 'Rien'),
('festival de quentin', 'premier festival pour quentin', '2024-01-10', '2024-01-11', 1, 1, 10, '12:00:00', '23:59:59', 'Rien');


-- Insertion dans la table `scene`
INSERT INTO `scene` (`nom`, `nb_spectateurs`, `id_taille`) VALUES
    ('amphi iut', 500, 3),
    ('salle b301', 70, 2);

-- Insertion dans la table `spectacle`
INSERT INTO `spectacle` (`nom`, `description`, `illustration`, `duree`, `id_categorie`, `taille_scene`, `responsable_spectacle`) VALUES
('Festiplan', 'ouverture du site web', '', 50, 5, 1, 2),
('Marathon hunger game', 'regardez la trilogie en une journée', '', 600, 5, 2, 6);

-- Insertion dans les tables de liaison
INSERT INTO `spectacle_festival_scene` (`id_festival`, `id_spectacle`, `id_scene`) VALUES
(1, 1, 1),
(1, 2, 2);
