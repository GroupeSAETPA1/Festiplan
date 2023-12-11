<?php

include('database.php');

/**
 * @param int $id_gestionnaire_festival
 * @return array
 */
function get_festivals(int $id_gestionnaire_festival): array
{
    $reponse = array();

    //STUB
    $id_festival = 1;
    $nom_festival = 'De Scene Palais';
    $date_debut = '16/12/2023';
    $date_fin = '24/15/2023';
    $lien_image = '../src/assets/img/deScenePalais.jpg';
    $categories = ['Musique', 'Divertissement', 'Divertissement', 'Divertissement', 'Divertissement', 'ABCDEF'];

    $reponse[] = array(
        'id_festival' => $id_festival,
        'nom_festival' => $nom_festival,
        'date_debut' => $date_debut,
        'date_fin' => $date_fin,
        'lien_image' => $lien_image,
        'categories' => $categories
    );

    return $reponse;
}

function get_spectacles(int $id_gestionnaire_spectacle)
{
    $reponse = array();

    //STUB
    $id_spectacle = 1;
    $nom_spectacle = 'De Scene Palais';
    $lien_image = '../src/assets/img/deScenePalais.jpg';
    $categories = ['Musique', 'Divertissement', 'Divertissement', 'Divertissement', 'ABCDEF'];
    $duree = 120;

    $reponse[] = array(
        'id_spectacle' => $id_spectacle,
        'nom_spectacle' => $nom_spectacle,
        'lien_image' => $lien_image,
        'categories' => $categories,
        'duree' => $duree
    );

    return $reponse;
}
