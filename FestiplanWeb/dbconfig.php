<?php

/**
 * Permet de récupérer les informations pour se connecter à la base de données
 * avec différent utilisateur, qui n'ont pas forcément les mêmes droits
 */
class DBConfig
{

    private $db_host;
    private $db_port;
    private $db_name;
    private $db_charset;


    public function __construct()
    {
        $this->db_host = "localhost";
        $this->db_port = "0";
        $this->db_name = "festiplan";
        $this->db_charset = "utf8mb4";
    }

    /**
     * Renvoie les informations de connexion pour l'utilisateur root
     *
     * @return array Les informations de connexion
     */
    public function getRoot(): array
    {
        return [
            'db_host' => $this->db_host,
            'db_port' => $this->db_port,
            'db_name' => $this->db_name,
            'db_user' => 'admin',
            'db_pass' => 'admin',
            'db_charset' => $this->db_charset
        ];
    }

    public function getLectureSpectacle(): array
    {
        return [
            'db_host' => $this->db_host,
            'db_port' => $this->db_port,
            'db_name' => $this->db_name,
            'db_user' => 'lectureSpectacle',
            'db_pass' => 'spectacle',
            'db_charset' => $this->db_charset
        ];
    }

    public function getLectureSpectacleFestival(): array
    {
        return [
            'db_host' => $this->db_host,
            'db_port' => $this->db_port,
            'db_name' => $this->db_name,
            'db_user' => 'lectureSpectacleFestival',
            'db_pass' => 'spectacleFestival',
            'db_charset' => $this->db_charset
        ];
    }
}

