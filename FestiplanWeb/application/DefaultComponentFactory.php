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

use controllers\DashboardController;
use controllers\HomeController;
use services\DashboardService;
use services\UsersService;
use yasmf\ComponentFactory;
use yasmf\NoControllerAvailableForNameException;
use yasmf\NoServiceAvailableForNameException;

/**
 *  The controller factory
 */
class DefaultComponentFactory implements ComponentFactory
{
    private ?UsersService $usersService = null;
    private ?DashboardService $dashboardService = null;

    /**
     * @param string $controller_name the name of the controller to instanciate
     * @return mixed the controller
     * @throws NoControllerAvailableForNameException when controller is not found
     */
    public function buildControllerByName(string $controller_name): mixed {
        return match ($controller_name) {
            "Home" => $this->buildHomeController(),
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
            "Users" => $this->buildUsersService(),
            "Dashboard" => $this->buildDashboardService(),
            default => throw new NoServiceAvailableForNameException($service_name)
        };
    }

    /**
     * @return UsersService
     */
    private function buildUsersService(): UsersService
    {
        if ($this->usersService == null) {
            $this->usersService = new UsersService();
        }
        return $this->usersService;
    }

    /**
     * @return HomeController
     */
    private function buildHomeController(): HomeController
    {
        return new HomeController($this->buildUsersService());
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


}