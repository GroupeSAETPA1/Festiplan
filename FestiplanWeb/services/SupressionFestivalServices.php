<?php

namespace services;

use PDO;

class SupressionFestivalServices
{

    private PDO $pdoSupressionFestival;

    private UserService $userService;

    public function __construct(PDO $pdo, UserService $userService)
    {
        $this->pdoSupressionFestival = $pdo;
        $this->userService = $userService;
    }
}
