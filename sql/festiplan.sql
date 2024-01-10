-- Base de données : `festiplan`
CREATE DATABASE IF NOT EXISTS `festiplan` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_bin;
USE `festiplan`;
-- --------------------------------------------------------
-- Structure de la table `categorie`
CREATE  TABLE IF NOT EXISTS `categorie`
(
    `id_categorie` int(6)                       NOT NULL AUTO_INCREMENT COMMENT 'id de la categorie',
    `nom`          varchar(70) COLLATE utf8_bin NOT NULL COMMENT 'nom de la categorie',
    PRIMARY KEY (`id_categorie`)
);

-- Structure de la table `utilisateurs`
CREATE   TABLE IF NOT EXISTS `utilisateurs`
(
    `id_utilisateur` int(6)                       NOT NULL AUTO_INCREMENT,
    `nom`            varchar(50) COLLATE utf8_bin NOT NULL,
    `prenom`         varchar(30) COLLATE utf8_bin NOT NULL,
    `mail`           varchar(70) COLLATE utf8_bin NOT NULL,
    `mdp`            varchar(64) COLLATE utf8_bin NOT NULL,
    `login`          varchar(50) COLLATE utf8_bin NOT NULL UNIQUE,
    PRIMARY KEY (id_utilisateur)
);

-- Structure de la table `taille scene`
CREATE  TABLE IF NOT EXISTS `taille_scene`
(
    `id_taille` int(2)                       NOT NULL AUTO_INCREMENT,
    `taille`    varchar(30) COLLATE utf8_bin NOT NULL UNIQUE,
    PRIMARY KEY (id_taille)
);


-- Structure de la table `festival`
CREATE  TABLE IF NOT EXISTS `festival`
(
    `id_festival`            int(6)                         NOT NULL AUTO_INCREMENT COMMENT 'id du festival',
    `nom`                    varchar(150) COLLATE utf8_bin  NOT NULL COMMENT 'nom du festival',
    `description`            varchar(1000) COLLATE utf8_bin NOT NULL COMMENT 'description du festival',
    `illustration`           varchar(250) COLLATE utf8_bin  NOT NULL COMMENT 'lien de l''image pour le code php',
    `debut`                  date                           NOT NULL COMMENT 'date de debut du festival',
    `fin`                    date                           NOT NULL COMMENT 'date de fin du festival',
    `id_categorie`           int(11)                        NOT NULL COMMENT 'id de la categorie',
    `id_responsable`         int(11)                        NOT NULL COMMENT 'id du responsable',
    `duree_entre_spectacle`  int(11)                        NOT NULL COMMENT 'duree entre chaque spectacle',
    `heure_debut_spectacles` time                           NOT NULL COMMENT 'heure à laquelle commence le premier spectacle',
    `heure_fin_spectacles`   time                           NOT NULL COMMENT 'heure à laquelle fini le dernier spectacle',
    PRIMARY KEY (id_festival),
    FOREIGN KEY (id_categorie) REFERENCES categorie (id_categorie) ON UPDATE cascade ON DELETE cascade,
    FOREIGN KEY (id_responsable) REFERENCES utilisateurs (id_utilisateur) ON UPDATE cascade ON DELETE cascade
);
-- Structure de la table `liste_organisateur`
CREATE  TABLE IF NOT EXISTS `liste_organisateur`
(
    `id_festival`     int(6) NOT NULL,
    `id_organisateur` int(6) NOT NULL,
    PRIMARY KEY (id_festival, id_organisateur),
    FOREIGN KEY (id_festival) REFERENCES festival (id_festival) ON UPDATE cascade ON DELETE cascade,
    FOREIGN KEY (id_organisateur) REFERENCES utilisateurs (id_utilisateur) ON UPDATE cascade ON DELETE cascade
);

-- Structure de la table `scene`
CREATE  TABLE IF NOT EXISTS `scene`
(
    `id_scene`       int(6)                       NOT NULL AUTO_INCREMENT COMMENT 'id scene',
    `nomScene`            varchar(50) COLLATE utf8_bin NOT NULL COMMENT 'nom de la scene',
    `id_taille`      int(11)                      NOT NULL COMMENT 'id taille depuis taille scene',
    `nb_spectateurs` int(11)                      NOT NULL COMMENT 'nombre de spectateurs maximum',
    `longitude`       NUMERIC(10, 7)                   NOT NULL COMMENT 'longitude de la scence' DEFAULT 0.0000000,
    `latitude`       NUMERIC(10, 7)                   NOT NULL COMMENT 'latitude de la scence' DEFAULT 0.0000000,
    PRIMARY KEY (id_scene),
    FOREIGN KEY (id_taille) REFERENCES `taille_scene` (id_taille) ON UPDATE cascade ON DELETE cascade
);

-- Structure de la table `spectacle`
CREATE  TABLE IF NOT EXISTS `spectacle`
(
    `id_spectacle`          int(6)                         NOT NULL AUTO_INCREMENT COMMENT 'id du spectacle',
    `nom`                   varchar(150) COLLATE utf8_bin  NOT NULL COMMENT 'le nom du spectacle',
    `description`           varchar(1000) COLLATE utf8_bin NOT NULL COMMENT 'la description du scpectacle',
    `illustration`          varchar(200) COLLATE utf8_bin DEFAULT NULL COMMENT 'le nom de l''image pour le code php',
    `duree`                 int(3)                         NOT NULL COMMENT 'la duree du spectacle en minute',
    `id_categorie`          int(11)                        NOT NULL COMMENT 'cle etrangere de categorie',
    `taille_scene`          int(11)                        NOT NULL COMMENT 'cle etrangere de scene',
    `responsable_spectacle` int(11)                        NOT NULL COMMENT 'cle etrangere de utilisateur',
    PRIMARY KEY (id_spectacle),
    FOREIGN KEY (id_categorie) REFERENCES categorie (id_categorie) ON UPDATE cascade ON DELETE cascade,
    FOREIGN KEY (taille_scene) REFERENCES taille_scene (id_taille) ON UPDATE cascade ON DELETE cascade,
    FOREIGN KEY (responsable_spectacle) REFERENCES utilisateurs (id_utilisateur)  ON UPDATE cascade ON DELETE cascade
);

-- Structure de la table `liste_scene`
-- La table liste_scene est une table qui permet de stocker les scenes dans un festival.
CREATE TABLE `liste_scene`
(
    `id_festival` int(6) NOT NULL,
    `id_scene`    int(6) NOT NULL,
    PRIMARY KEY (id_festival, id_scene)
);

-- Structure de la table `spectacle_festival_scene`
-- La table spectacle_festival_scene est une table qui permet de stocker les spectacles qui sont dans un festival et dans une scene.
CREATE  TABLE IF NOT EXISTS `spectacle_festival_scene`
(
    `id_festival`  int(6) NOT NULL,
    `id_spectacle` int(6) NOT NULL,
    `id_scene`     int(6) NOT NULL,
    PRIMARY KEY (id_festival, id_spectacle, id_scene),
    FOREIGN KEY (id_festival) REFERENCES festival (id_festival) ON UPDATE cascade ON DELETE cascade,
    FOREIGN KEY (id_spectacle) REFERENCES spectacle (id_spectacle) ON UPDATE cascade ON DELETE cascade,
    FOREIGN KEY (id_scene) REFERENCES scene (id_scene) ON UPDATE cascade ON DELETE cascade
);

-- Structure de la table `liste_spectacle_temporaire`
-- La table liste_spectacle_temporaire est une table temporaire qui permet de stocker les spectacles qui seront ajoutés au festival
-- dans le formulaire d'ajout de spectacle.
CREATE  TABLE IF NOT EXISTS `liste_spectacle_temporaire`
(
    `id_festival`  int(6) NOT NULL,
    `id_spectacle` int(6) NOT NULL,
    `id_scene`     int(6) NOT NULL,
    PRIMARY KEY (id_festival, id_spectacle, id_scene)
);

-- Structure de la table `liste_scene_temporaire`
-- La table liste_scene_temporaire est une table temporaire qui permet de stocker les scenes qui seront ajoutés au festival
-- dans le formulaire d'ajout de scene.
CREATE  TABLE IF NOT EXISTS `liste_scene_temporaire`
(
    `id_festival` int(6) NOT NULL,
    `id_scene`    int(6) NOT NULL,
    PRIMARY KEY (id_festival, id_scene)
);

-- Structure de la table `liste_inter_hors_scene`
-- La table liste_inter_hors_scene est une table qui permet de stocker les intervenants qui sont hors de la scene d'un spectacle.
CREATE  TABLE IF NOT EXISTS `liste_inter_hors_scene`
(
    `id_spectacle` int(6) NOT NULL,
    `id_inter`     int(6) NOT NULL,
    PRIMARY KEY (id_spectacle, id_inter),
    FOREIGN KEY (id_spectacle) REFERENCES spectacle (id_spectacle) ON UPDATE cascade ON DELETE cascade,
    FOREIGN KEY (id_inter) REFERENCES utilisateurs (id_utilisateur) ON UPDATE cascade ON DELETE cascade
);

-- Structure de la table `liste_inter_scene`
-- La table liste_inter_scene est une table qui permet de stocker les intervenants qui sont dans la scene d'un spectacle.
CREATE  TABLE IF NOT EXISTS `liste_inter_scene`
(
    `id_spectacle` int(6) NOT NULL,
    `id_inter`     int(6) NOT NULL,
    PRIMARY KEY (id_spectacle, id_inter),
    FOREIGN KEY (id_spectacle) REFERENCES spectacle (id_spectacle) ON UPDATE cascade ON DELETE cascade,
    FOREIGN KEY (id_inter) REFERENCES utilisateurs (id_utilisateur) ON UPDATE cascade ON DELETE cascade
);

-- Structure de la table `liste_scene`
CREATE  TABLE IF NOT EXISTS `liste_scene`
(
    `id_festival` int(6) NOT NULL,
    `id_scene`    int(6) NOT NULL,
    PRIMARY KEY (id_festival, id_scene),
    FOREIGN KEY (id_festival) REFERENCES festival (id_festival) ON UPDATE cascade ON DELETE cascade,
    FOREIGN KEY (id_scene) REFERENCES scene (id_scene) ON UPDATE cascade ON DELETE cascade
);