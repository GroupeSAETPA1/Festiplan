<?php

namespace controllers;

use services\UserService;

class CreateSpectacleController
{
    private $createSpectacleService;
    private $userService;

    public function __construct(CreateFestivalController $createSpectacleService, UserService $userService)
    {
        $this->createSpectacleService = $createSpectacleService;
        $this->userService = $userService;
    }

    /**
     * verifie si l'utilisateur existe par son email
     */
    public function checkUserByEmail($pdo): bool
    {
        $email = htmlspecialchars(HttpHelper::getParam('email') ?: "");
        return $this->userService->emailExiste($pdo, $email);
    }

}