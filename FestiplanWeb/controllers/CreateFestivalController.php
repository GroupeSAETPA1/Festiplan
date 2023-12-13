<?php
namespace controllers;

use PDO;
use services\CreateFestivalService;
use yasmf\HttpHelper;
use yasmf\View;

/**
 * Default controller
 */
class CreateFestivalController {

    private CreateFestivalService $createFestivalService;
    public function __construct(CreateFestivalService $createFestivalService )
    {
        $this->createFestivalService = $createFestivalService;
    }

    public function index(PDO $pdo): View{
        $view = new View("views/createFestival.php");
        return $view;
    }
}
