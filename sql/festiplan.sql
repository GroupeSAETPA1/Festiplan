-- Base de données : `festiplan`
CREATE DATABASE IF NOT EXISTS `festiplan` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_bin;
USE `festiplan`;
-- --------------------------------------------------------
-- Structure de la table `categorie`
CREATE TABLE `categorie`
(
    `id_categorie` int(6)                       NOT NULL AUTO_INCREMENT COMMENT 'id de la categorie',
    `nom`          varchar(70) COLLATE utf8_bin NOT NULL COMMENT 'nom de la categorie',
    PRIMARY KEY (`id_categorie`)
);

-- Structure de la table `utilisateurs`
CREATE TABLE `utilisateurs`
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
CREATE TABLE `taille_scene`
(
    `id_taille` int(2)                       NOT NULL AUTO_INCREMENT,
    `taille`    varchar(30) COLLATE utf8_bin NOT NULL UNIQUE,
    PRIMARY KEY (id_taille)
);


-- Structure de la table `festival`
CREATE TABLE `festival`
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
    FOREIGN KEY (id_categorie) REFERENCES categorie (id_categorie),
    FOREIGN KEY (id_responsable) REFERENCES utilisateurs (id_utilisateur)
);
-- Structure de la table `liste_organisateur`
CREATE TABLE `liste_organisateur`
(
    `id_festival`     int(6) NOT NULL,
    `id_organisateur` int(6) NOT NULL,
    PRIMARY KEY (id_festival, id_organisateur)
);
-- Structure de la table `liste_scene`
CREATE TABLE `liste_scene`
(
    `id_festival` int(6) NOT NULL,
    `id_scene`    int(6) NOT NULL,
    PRIMARY KEY (id_festival, id_scene)
);
-- Structure de la table `liste_spectacle`
CREATE TABLE `liste_spectacle`
(
    `id_festival`  int(6) NOT NULL,
    `id_spectacle` int(6) NOT NULL,
    PRIMARY KEY (id_festival, id_spectacle)
);
-- Structure de la table `scene`
CREATE TABLE `scene`
(
    `id_scene`       int(6)                       NOT NULL AUTO_INCREMENT COMMENT 'id scene',
    `nom`            varchar(50) COLLATE utf8_bin NOT NULL COMMENT 'nom de la scene',
    `id_taille`      int(11)                      NOT NULL COMMENT 'id taille depuis taille scene',
    `nb_spectateurs` int(11)                      NOT NULL COMMENT 'nombre de spectateurs maximum',
    PRIMARY KEY (id_scene),
    FOREIGN KEY (id_taille) REFERENCES `taille_scene` (id_taille)
);
-- Structure de la table `spectacle`
CREATE TABLE `spectacle`
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
    FOREIGN KEY (id_categorie) REFERENCES categorie (id_categorie),
    FOREIGN KEY (taille_scene) REFERENCES taille_scene (id_taille),
    FOREIGN KEY (responsable_spectacle) REFERENCES utilisateurs (id_utilisateur)
);