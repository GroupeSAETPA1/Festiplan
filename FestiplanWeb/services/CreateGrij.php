<?php

namespace services;

use PDO;

class CreateGrij
{

    private PDO $pdoCreationGrij;

    private UserService $userService;

    public function __construct(PDO $pdo, UserService $userService)
    {
        $this->pdoCreationGrij = $pdo;
        $this->userService = $userService;
    }

    public function recup


}