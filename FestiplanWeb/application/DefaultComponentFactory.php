<?php
/*
 * yasmf - Yet Another Simple MVC Framework (For PHP)
 *     Copyright (C) 2023   Franck SILVESTRE
 *
 *     This program is free software: you can redistribute it and/or modify
 *     it under the terms of the GNU Affero General Public License as published
 *     by the Free Software Foundation, either version 3 of the License, or
 *     (at your option) any later version.
 *
 *     This program is distributed in the hope that it will be useful,
 *     but WITHOUT ANY WARRANTY; without even the implied warranty of
 *     MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 *     GNU Affero General Public License for more details.
 *
 *     You should have received a copy of the GNU Affero General Public License
 *     along with this program.  If not, see <https://www.gnu.org/licenses/>.
 */

namespace application;

use controllers\AccesListeSpectaclesController;
use controllers\AjouterListesSpectaclesController;
use controllers\CreateFestivalController;
use controllers\ErrorController;
use controllers\SupressionFestivalController;
use controllers\UserController;
use Exception;
use services\AccesListeSpectaclesService;
use services\AjouterListesSpectaclesServices;
use services\createFestivalService;
use services\SupressionFestivalServices;
use services\UserService;
use controllers\DashboardController;
use controllers\SettingsController;
use controllers\CreateSpectacleController;
use PDO;
use services\CreateSpectacleService;
use services\DashboardService;
use services\SessionService;
use controllers\PlanificationController;
use services\PlanificationService;

use yasmf\ComponentFactory;
use yasmf\HttpHelper;
use yasmf\NoControllerAvailableForNameException;
use yasmf\NoServiceAvailableForNameException;

/**
 *  The controller factory
 */
class DefaultComponentFactory implements ComponentFactory
{
    private ?UserService $userService = null;
    private ?DashboardService $dashboardService = null;
    private ?PlanificationService $planificationService = null;
    private ?CreateSpectacleService $createSpectacleService = null;

    private ?CreateFestivalService $createFestivalService = null;	
    private ?AccesListeSpectaclesService $accesListeSpectaclesService = null;
    private ?AjouterListesSpectaclesServices $ajouterListesSpectaclesServices = null;
    private $createFestivalServices;

    /**
     * @param string $controller_name the name of the controller to instanciate
     * @return mixed the controller
     * @throws NoControllerAvailableForNameException when controller is not found
     * @throws Exception
     */
    public function buildControllerByName(string $controller_name): mixed
    {
        return match ($controller_name) {

            "CreateFestival" => $this->buildCreateFestival(),
            "Home" => $this->buildUserController(),
            "Dashboard" => $this->buildDashboardController(),
            "Planification" => $this->buildPlanificationController(),
            "Error" => new ErrorController(),
            "AccesListeSpectacles" => $this->buildAccesListeSpectaclesController(),
            "AjouterListesSpectacles" => $this->buildAjouterListesSpectaclesController(),
            "CreateSpectacle" => $this->buildCreateSpectacleController(),
            "Settings" => $this->buildSettingsController(),
            "SupressionFestival" =>$this->buildSupressionFestivalController(),
            default => throw new NoControllerAvailableForNameException($controller_name),

        };
    }

    /**
     * @param string $service_name the name of the service
     * @return mixed the created service
     * @throws NoServiceAvailableForNameException when service is not found
     * @throws Exception
     */
    public function buildServiceByName(string $service_name): mixed
    {
        return match ($service_name) {
            "User" => $this->buildUserService(),
            "Dashboard" => $this->buildDashboardService(),
            "CreateFestival" => $this->buildCreateFestivalService(),
            "Planification" => $this->buildPlanificationService(), 
            "AccesListeSpectacles" => $this->buildAccesListeSpectaclesService(),
            "AjouterListesSpectacles" => $this->buildAjouterListesSpectaclesService(),
            "CreateSpectacle" => $this->buildCreateSpectacleService(),
            default => throw new NoServiceAvailableForNameException($service_name)
        };
    }

    /**
     * @return UserService
     */
    private function buildUserService(): UserService
    {
        if ($this->userService == null) {
            $this->userService = new UserService();
        }
        return $this->userService;
    }

    /**
     * @return UserController
     */
    private function buildUserController(): UserController
    {
        return new UserController($this->buildUserService());
    }

    /**
     * @return CreateFestivalController
     * @throws Exception
     */
    private function buildCreateFestival(): CreateFestivalController
    {
        return new CreateFestivalController($this->buildCreateFestivalService());
    }

    /**
     * @return createFestivalService
     * @throws Exception
     */
    private function buildCreateFestivalService(): createFestivalService
    {
        if($this->createFestivalService == null) {
            $pdo = $this->getPDO("root");
            $this->createFestivalService = new createFestivalService($pdo);
        }
        return $this->createFestivalService;
    }

    /**
     * @throws Exception
     */
    private function buildDashboardService(): DashboardService
    {
        if ($this->dashboardService == null) {
            $pdo = $this->getPDO("root");
            $this->dashboardService = new DashboardService($pdo);
        }
        return $this->dashboardService;
    }

    /**
     * @return CreateSpectacleController
     */
    private function buildCreateSpectacleController(): CreateSpectacleController
    {
        return new CreateSpectacleController($this->buildCreateSpectacleService()
                                           , $this->buildUserService(), $this->buildCreateFestivalService(), $this->getPDO("root", "root"));
    }

    private function buildDashboardController(): DashboardController
    {
        return new DashboardController($this->buildDashboardService());
    }

    private function buildPlanificationService(): PlanificationService
    {
        if ($this->planificationService == null) {
            $pdo = $this->getPDO("root"); // TODO faire un user approprié
            $this->planificationService = new PlanificationService($pdo);
        }
        return $this->planificationService;
    }

    private function buildPlanificationController(): PlanificationController
    {
        return new PlanificationController($this->buildPlanificationService());
    }


    /**
     * @throws Exception
     */
    private function buildAccesListeSpectaclesController(): AccesListeSpectaclesController
    {
        return new AccesListeSpectaclesController($this->buildAccesListeSpectaclesService());
    }

    /**
     * @throws Exception
     */
    private function buildAccesListeSpectaclesService() : AccesListeSpectaclesService
    {
        if ($this->accesListeSpectaclesService == null) {
            $pdo = $this->getPDO("root");
            $this->accesListeSpectaclesService = new AccesListeSpectaclesService($pdo);
        }
        return $this->accesListeSpectaclesService;
    }


    /**
     * À partir d'un utilisateur, renvoie un PDO avec les informations de connexion
     * @param string $utilisateur L'utilisateur pour lequel on veut récupérer les informations de connexion
     * @return PDO Le PDO avec les informations de connexion
     * @throws Exception Si l'utilisateur n'existe pas
     */
    public function getPDO(string $utilisateur): PDO
    {
        $dbConfig = new \DBConfig();
        $dbConfig = match ($utilisateur) {
            "root" => $dbConfig->getRoot(),
            "lectureSpectacles" => $dbConfig->getLectureSpectacle(),
            "lectureSpectacleFestival" => $dbConfig->getLectureSpectacleFestival(),
            default => throw new Exception("Utilisateur inconnu")
        };
        return new PDO(
            "mysql:host=" . $dbConfig['db_host'] . ";port=" . $dbConfig['db_port'] . ";dbname=" . $dbConfig['db_name'] . ";charset=" . $dbConfig['db_charset'],
            $dbConfig['db_user'],
            $dbConfig['db_pass'],
            [
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
                PDO::ATTR_PERSISTENT => true
            ]
        );
    }

    /**
     * @throws NoServiceAvailableForNameException
     */
    private function buildAjouterListesSpectaclesController() : AjouterListesSpectaclesController
    {
        return new AjouterListesSpectaclesController($this->buildServiceByName("AjouterListesSpectacles"));
    }

    /**
     * @throws Exception
     */
    private function buildAjouterListesSpectaclesService() : AjouterListesSpectaclesServices
    {
        if ($this->ajouterListesSpectaclesServices == null) {
            $pdo = $this->getPDO("root");
            $this->ajouterListesSpectaclesServices = new AjouterListesSpectaclesServices($pdo);
        }
        return $this->ajouterListesSpectaclesServices;
    }

    private function buildCreateSpectacleService(): ?CreateSpectacleService
    {
        if ($this->createSpectacleService == null) {
            $pdo = $this->getPDO("root", "root");
            $this->createSpectacleService = new CreateSpectacleService($pdo, $this->buildUserService());
        }
        return $this->createSpectacleService;
    }

    private function buildSettingsController(): SettingsController
    {
        return new SettingsController($this->buildUserService());
    }

    private function buildSupressionFestivalController(): SupressionFestivalController
    {
        return new SupressionFestivalController($this->buildSupressionFestivalService());
    }

    private function buildSupressionFestivalService(): SupressionFestivalServices
    {
        if ($this->createFestivalServices == null) {
            $pdo = $this->getPDO("root");
            $this->createFestivalServices = new SupressionFestivalServices($pdo, $this->buildUserService());
        }
        return $this->createFestivalServices;
    }
}