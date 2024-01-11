<?php

namespace controllers;

use PDO;
use services\SupressionFestivalServices;
use yasmf\HttpHelper;
use yasmf\View;

class SupressionFestivalController
{

    private SupressionFestivalServices $supressionFestivalServices;

    public function __construct( SupressionFestivalServices $supressionFestivalServices)
    {
        $this->SupressionFestivalServices=$supressionFestivalServices;
    }

    public function index(): View
    {

        $id_festival_actif = HttpHelper::getParam("id_festival") ?? null;

        if ($id_festival_actif == null) {
             echo "Erreur : id_festival_actif est null index()";
        }
        return $this->construireVue($id_festival_actif);
    }

    public function construireVue( int $id_festival_actif ) : View
    {

        $_SESSION["id_festival_a_supprimer"] = $id_festival_actif;
        $festival = $this->SupressionFestivalServices->recupFestival($id_festival_actif);

        $view = new View("views/supression/supressionFestival");
        $view->setVar("festival", $festival);


        return $view;
    }

    public function suprimmer(Pdo $pdo)
    {
        $this->SupressionFestivalServices->supression($_SESSION['id_festival_a_supprimer']);

        header('Location: /Festiplan/FestiplanWeb/?controller=Dashboard');
    }
}