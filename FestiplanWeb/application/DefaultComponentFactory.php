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

use controllers\CreateFestivalController;
use controllers\HomeController;
use services\createFestivalService;
use services\UsersService;

use controllers\DashboardController;
use controllers\UserController;
use services\DashboardService;
use services\UserService;

use yasmf\ComponentFactory;
use yasmf\NoControllerAvailableForNameException;
use yasmf\NoServiceAvailableForNameException;

use PDO;
/**
 *  The controller factory
 */
class DefaultComponentFactory implements ComponentFactory
{
    private ?UserService $userService = null;
    private ?SessionService $sessionService = null;
    private ?DashboardService $dashboardService = null;

    private ?CreateFestivalService $createFestivalService = null;	

    /**
     * @param string $controller_name the name of the controller to instanciate
     * @return mixed the controller
     * @throws NoControllerAvailableForNameException when controller is not found
     */
    public function buildControllerByName(string $controller_name): mixed {
        return match ($controller_name) {

            "CreateFestival" => $this->buildCreateFestival(),
            "Home" => $this->buildUserController(),
            "Dashboard" => $this->buildDashboardController(),

            default => throw new NoControllerAvailableForNameException($controller_name)
        };
    }

    /**
     * @param string $service_name the name of the service
     * @return mixed the created service
     * @throws NoServiceAvailableForNameException when service is not found
     */
    public function buildServiceByName(string $service_name): mixed
    {
        return match($service_name) {
            "User" => $this->buildUserService(),
            "Session" => $this->buildSessionService(),
            "Dashboard" => $this->buildDashboardService(),
            "CreateFestival" => $this->buildCreateFestivalService() , 
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
     * @return SessionService
     */
    private function buildSessionService(): SessionService
    {
        if ($this->sessionService == null) {
            $this->sessionService = new SessionService();
        }
        return $this->sessionService;
    }

    /**
     * @return HomeController
     */
    private function buildUserController(): UserController
    {
        return new UserController($this->buildUserService());
    }

    /**
     * @return CreateFestivalController
     */
    private function buildCreateFestival(): CreateFestivalController
    {
        return new CreateFestivalController($this->buildCreateFestivalService());
    }

    /**
     * @return createFestivalService
     */
    private function buildCreateFestivalService(): createFestivalService
    {
        if($this->createFestivalService == null) {
            // TODO recuperer le pdo
            $pdo = $this->getPDO("root", "root");
            var_dump($pdo);
            echo "<br>Service : ";
            var_dump($this->createFestivalService);
            $this->createFestivalService = new createFestivalService($pdo);
        }
        return $this->createFestivalService;
    }

    private function buildDashboardService(): ?DashboardService
    {
        if ($this->dashboardService == null) {
            $pdo = null; // TODO : récupérer le PDO
            $this->dashboardService = new DashboardService($pdo);
        }
        return $this->dashboardService;
    }

    private function buildDashboardController(): DashboardController
    {
        return new DashboardController($this->buildDashboardService());
    }

    
    /**
     * À partir d'un nom d'utilisateur et de son mot de passe,
     * renvoie la PDO associé
     * @param $user
     * @param $mdp
     * @return PDO
     */
    public function getPDO($user, $mdp): PDO
    {
        $ds_name = "mysql:host=localhost;port=0;dbname=festiplan;charset=utf8mb4";
        $options = [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
            PDO::ATTR_EMULATE_PREPARES => false,
            PDO::ATTR_PERSISTENT => true
        ];

        return new PDO($ds_name, $user, $mdp, $options);
    }
}