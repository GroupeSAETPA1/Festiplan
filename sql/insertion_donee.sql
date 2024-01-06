-- Insertion dans la table `utilisateurs`
INSERT INTO `utilisateurs` (`nom`, `prenom`, `mail`, `mdp`, `login`) VALUES
('Delaclasse', 'Hubert', 'hubert.delaclasse@gmail.com', 'eccb683f08f51a94814a065de13cd9167e6e2e0462f89ca73281830d61710c23', 'hubert'),
('de Lande d\'Aussac de Saint Palais', 'François', 'francois.desaintpalais@iut-rodez.fr', 'mf>N=tyS$9){', 'francois_SP'),
('Costes', 'Quentin', 'quentin.costes@iut-rodez.fr', 'mf>N=tyS$9){', 'quentinformatique'),
('Descriaud', 'Lucas', 'lucas.descriaud@iut-rodez.fr', 'luc@$123', 'lucas'),
('Bécogné', 'Néo', 'neo.becogne@iut-rodez.fr', 'sxdefrcvtgb$=$é222', 'neo'),
('Douaud', 'Tom', 'tom.douaud@iut-rodez.fr', 'T0mD1234', 'tom'),
('Silvestre', 'Franck', 'franck.silvestre@iut-rodez.fr', 'abcdef123@', 'franck');

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
('Bonne année', 'premier festival de l\'année', '2024-01-01', '2024-01-07', 1, 1, 10, '12:00:00', '23:59:59', 'Rien');


-- Insertion dans la table `scene`
INSERT INTO `scene` (`nom`, `nb_spectateurs`, `id_taille`) VALUES
    ('amphi iut', 500, 3),
    ('salle b301', 70, 2);

-- Insertion dans la table `spectacle`
INSERT INTO `spectacle` (`nom`, `description`, `illustration`, `duree`, `id_categorie`, `taille_scene`, `responsable_spectacle`) VALUES
('Festiplan', 'ouverture du site web', '', 50, 5, 1, 2),
('Marathon hunger game', 'regardez la trilogie en une journée', '', 600, 5, 2, 6);

-- Insertion dans les tables de liaison
INSERT INTO `liste_scene` (`id_festival`, `id_scene`) VALUES
(1, 1),
(2, 1);

INSERT INTO `liste_spectacle` (`id_festival`, `id_spectacle`) VALUES
(1, 1),
(1, 2);
