DELIMITER //

DROP PROCEDURE IF EXISTS insertion_festival//
CREATE PROCEDURE insertion_festival(
    IN p_nom VARCHAR(150),
    IN p_description VARCHAR(1000),
    IN p_image VARCHAR(250),
    IN p_debut DATE,
    IN p_fin DATE,
    IN p_categorie INT,
    IN p_id_responsable INT,
    IN p_duree_entre_spectacle INT,
    IN p_heure_debut TIME,
    IN p_heure_fin TIME
)
BEGIN
    START TRANSACTION;

    INSERT INTO festival (nom, description, illustration, debut, fin, id_categorie, id_responsable, duree_entre_spectacle, heure_debut_spectacle, heure_fin_spectacle) 
    VALUES (p_nom, p_description, p_image, p_debut, p_fin, p_categorie, p_id_responsable, p_duree_entre_spectacle, p_heure_debut, p_heure_fin);

    COMMIT;
END //

DROP PROCEDURE IF EXISTS insertion_liste_organisateur//
CREATE PROCEDURE insertion_liste_organisateur(
    IN p_id_festival INT, 
    IN p_id_organisateur INT
)
BEGIN
    START TRANSACTION;

    INSERT INTO liste_organisateur (id_festival, id_organisateur) 
    VALUES (p_id_festival, p_id_organisateur);

    COMMIT;
END //

DROP PROCEDURE IF EXISTS insertion_liste_spectacle_scene//
CREATE PROCEDURE insertion_liste_spectacle_scene(
    IN p_id_festival INT, 
    IN p_id_scene INT, 
    IN p_id_spectacle INT
)
BEGIN
    START TRANSACTION;

    INSERT INTO spectacle_festival_scene (id_festival, id_spectacle, id_scene) 
    VALUES (p_id_festival, p_id_spectacle, p_id_scene);

    COMMIT;
END //

DROP PROCEDURE IF EXISTS suppression_spectacle_festival_scene//
CREATE PROCEDURE suppression_spectacle_festival_scene(
    IN p_id_festival INT, 
    IN p_id_scene INT, 
    IN p_id_spectacle INT
 )
    BEGIN
    START TRANSACTION;
        DELETE FROM spectacle_festival_scene WHERE id_festival = p_id_festival AND id_scene = p_id_scene and id_spectacle = p_id_spectacle ;

        COMMIT; 
    END //

DROP PROCEDURE IF EXISTS insertion_temporaire//
CREATE PROCEDURE insertion_temporaire(
    IN p_id_festival INT, 
    IN p_id_scene INT, 
    IN p_id_spectacle INT
)
    BEGIN
        INSERT INTO liste_spectacle_temporaire (id_festival, id_spectacle, id_scene) 
        VALUES (p_id_festival, p_id_spectacle, p_id_scene);

        COMMIT; 
    END //

DROP PROCEDURE IF EXISTS vide_table_tempo//
CREATE PROCEDURE vide_table_tempo(
    IN p_id_festival INT
 )
    BEGIN
    START TRANSACTION;
        DELETE FROM spectacle_festival_scene WHERE id_festival = p_id_festival ;

        COMMIT; 
    END //

CREATE PROCEDURE supprimer_festival(IN p_id_festival INT)
BEGIN
    DECLARE EXIT HANDLER FOR SQLEXCEPTION
    BEGIN
        ROLLBACK;
        SIGNAL SQLSTATE '45000'
            SET MESSAGE_TEXT = 'Erreur lors de la suppression du festival';
    END;

    START TRANSACTION;

    DELETE FROM spectacle_festival_scene WHERE id_festival = p_id_festival;
    DELETE FROM liste_scene WHERE id_festival = p_id_festival;
    DELETE FROM liste_organisateur WHERE id_festival = p_id_festival;
    DELETE FROM festival WHERE id_festival = p_id_festival;

    COMMIT;
END //

DELIMITER ;
